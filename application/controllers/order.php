<?php

class Order extends MY_Controller

{

    function __construct ()
    {
        parent::__construct();
        $this->load->model("order_model");
        $this->load->model("item_model");
        $this->load->model("vendor_model");
        $this->load->model("variable_model");
    }

    function index ()
    {
        $data["title"] = "Purchase Order System: Order List";
        $data["print"] = "false";
        $this->vendor_orders();
    }

    function add ()
    {
        if ($this->uri->segment(3)) {
            $data["kVendor"] = $this->uri->segment(3);
            $data["action"] = "insert";
            $data["order"] = null;
            $data["methodPairs"] = $this->order_model->fetch_value_list(
                    "poOrderMethod", "poOrderMethod");
            $data["methodPairs"]["other"] = "Other...";
            $data["typePairs"] = $this->order_model->fetch_value_list(
                    "poPaymentType", "poPaymentType");
            $data["typePairs"]["other"] = "Other...";
            $categories = $this->variable_model->get_all("poCategory");
            $options = array(
                    "other" => TRUE,
                    "initial_blank" => TRUE
            );
            $data["categoryPairs"] = getKeyedPair($categories,
                    array(
                            "var_name",
                            "var_value"
                    ), $options);
            $data["categoryPairs"]["other"] = "Other...";
            $data["vendorPairs"] = $this->vendor_model->fetch_vendor_list();
            if ($this->input->post("ajax") == 1) {
                $this->load->view("order/edit", $data);
            } else {
                $data["print"] = FALSE;
                $data["title"] = "Add an Order";
                $data["target"] = "order/edit";
                $this->load->view("page/index", $data);
            }
        }
    }

    function insert ()
    {
        if ($this->input->post("kVendor")) {

            $this->order_model->insert_order();
            $this->view($this->input->post("kPO"));
        }
    }

    function view ($kPO = null)
    {
        if ($this->uri->segment(3) || $kPO != null) {
            if ($this->uri->segment(3)) {
                $kPO = $this->uri->segment(3);
            }
            $print = false;
            $target = "order/view";
            if ($this->uri->segment(4)) {
                $print = true;
                $target = "order/print";
            }
            $data["kPO"] = $kPO;
            $order = $this->order_model->fetch_order($kPO);
            $data["order"] = $order;
            $kVendor = $order->kVendor;
            $vendor = $this->vendor_model->fetch_vendor($kVendor);
            $data["vendor"] = $vendor;
            $data["title"] = "Viewing Order " . $kPO;
            $items = $this->item_model->fetch_items($kPO);
            $data["items"] = $items;
            $data["class"] = "list";
            $data["target"] = $target;
            if($print){
                $data["title"] = "PO-$kPO $vendor->vendorName";
            }
            $data["print"] = $print;
            $this->load->view("page/index", $data);
        }
    }

    function vendor_orders ()
    {
        $kVendor = false;
        $data["vendorName"] = false;
        $data["kVendor"] = false;
        $data["title"] = "List of Orders"; // seems unwise to allow display of
                                           // all orders

        if ($this->uri->segment(3)) {
            $kVendor = $this->uri->segment(3);
            $vendorName = $this->vendor_model->get_vendor_value($kVendor,
                    "vendorName");
            $data["vendorName"] = $vendorName;
            $data["kVendor"] = $kVendor;
            $data["title"] = "List of Orders for $vendorName";
        }

        $data["target"] = "order/list";
        $data["print"] = false;
        $orders = $this->order_model->fetch_vendor_orders($kVendor);
        foreach ($orders as $order) {
            $order->orderTotal = $this->item_model->fetch_item_totals(
                    $order->kPO);
        }
        $data["orders"] = $orders;
        $this->load->view("page/index", $data);
    }

    function edit ()
    {
        $kPO = $this->uri->segment(3);
        $order = $this->order_model->fetch_order($kPO);
        $data["order"] = $order;
        $data["kVendor"] = $order->kVendor;
        $data["methodPairs"] = $this->order_model->fetch_value_list(
                "poOrderMethod", "poOrderMethod");
        $data["typePairs"] = $this->order_model->fetch_value_list(
                "poPaymentType", "poPaymentType");
        $categories = $this->variable_model->get_all("poCategory");
        $options = array(
                "other" => TRUE,
                "initial_blank" => TRUE
        );
        $data["categoryPairs"] = getKeyedPair($categories,
                array(
                        "var_name",
                        "var_value"
                ), $options);
        $data["vendorPairs"] = $this->vendor_model->fetch_vendor_list();
        $data["action"] = "update";
        if ($this->input->post("ajax") == 1) {
            $this->load->view("order/edit", $data);
        } else {
            $data["title"] = "Purchase Order System: Edit Vendor";
            $data["print"] = false;
            $data["target"] = "order/edit";
            $this->load->view("page/index", $data);
        }
    }

    function delete ()
    {
        if ($this->input->post("kPO")) {
            $kPO = $this->input->post("kPO");
            $this->order_model->delete_order($kPO);
            echo $this->item_model->delete_item_by_order($kPO);
            $kVendor = $this->input->post("kVendor");
            redirect("order/vendor_orders/$kVendor");
        }
    }

    function update ()
    {
        if ($this->input->post("kPO")) {
            $kPO = $this->input->post("kPO");
            $target = $kPO;
            if ($this->input->post("newPO")) {
                $newPO = $this->input->post("newPO");
                if ($newPO != $kPO) {
                    $this->item_model->update_po($kPO, $newPO);
                    $target = $newPO;
                }
            }
            print $this->order_model->update_order($kPO);
            redirect("order/view/$target");
        }
    }

    function has_match ()
    {
        $ok = base_url() . "/images/ok.png";
        $delete = base_url() . "images/delete.png";
        if ($this->uri->segment(3)) {
            $kPO = $this->uri->segment(3);
            $result = $this->order_model->fetch_order($kPO);
            $properties["style"] = "width:12px";
            $properties["title"] = "The PO $kPO is OK.";
            $properties["alt"] = $properties["title"];
            $output = createButton($ok, $properties);
            // $output = "The PO $kPO is Ok";
            if ($result != false) {
                $properties["title"] = "The PO $kPO already exists in the database.";
                $properties["alt"] = $properties["title"];
                $output = createButton($delete, $properties);
                // $output = "The PO $kPO already exists in the database.";
            }
            echo $output;
        }
    }

    function show_search ()
    {
        $this->load->view("order/search");
    }

    function find_records ()
    {
        $startDate = $this->input->post("startDate");
        $endDate = $this->input->post("endDate");
        $data["orders"] = $this->order_model->fetch_by_date_range($startDate,
                $endDate);
        $data["startDate"] = $startDate;
        $data["endDate"] = $endDate;
        setCookie("startDate", $startDate);
        setCookie("endDate", $endDate);
        $data["reportType"] = $this->input->post("reportType");
        $data["title"] = "Order Totals by Date Range";
        $data["print"] = false;
        if ($this->input->post("print") == true) {
            $data["print"] = true;
        }
        $data["target"] = "order/totals";
        $this->load->view("page/index", $data);
    }
}