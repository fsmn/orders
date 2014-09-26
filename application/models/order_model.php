<?php

class Order_model extends CI_Model
{

    var $kPO;

    var $poDate;

    var $poOrderMethod;

    var $poPaymentType;

    var $poOrderedBy;

    var $poBillingContact;

    var $poCategory;

    var $poConfirmation;

    var $poShipping;

    var $poReceived;

    var $poQuote;

    var $kVendor;

    function __construct ()
    {
        parent::__construct();
    }

    function prepare_variables ()
    {
        if ($this->input->post('kPO')) {
            $this->kPO = $this->input->post('kPO');
        }
        ;

        if ($this->input->post('poDate')) {
            $this->poDate = formatDate($this->input->post('poDate'), "mysql");
        }

        if ($this->input->post('poOrderMethod')) {
            $this->poOrderMethod = $this->input->post('poOrderMethod');
        }

        if ($this->input->post('poPaymentType')) {
            $this->poPaymentType = $this->input->post('poPaymentType');
        }

        if ($this->input->post('poOrderedBy')) {
            $this->poOrderedBy = $this->input->post('poOrderedBy');
        }

        if ($this->input->post('poBillingContact')) {
            $this->poBillingContact = $this->input->post('poBillingContact');
        }

        if ($this->input->post('poCategory')) {
            $this->poCategory = $this->input->post('poCategory');
        }

        if ($this->input->post('poConfirmation')) {
            $this->poConfirmation = $this->input->post('poConfirmation');
        }

        if ($this->input->post('poShipping')) {
            $this->poShipping = $this->input->post('poShipping');
        }

        if ($this->input->post('poReceived')) {
            $this->poReceived = $this->input->post('poReceived');
        }

        if ($this->input->post('poQuote')) {
            $this->poQuote = $this->input->post('poQuote');
        }

        if ($this->input->post('kVendor')) {
            $this->kVendor = $this->input->post('kVendor');
        }
    }

    function insert_order ()
    {
        $this->prepare_variables();
        $this->db->insert('order', $this);
        return $this->kVendor;
    }

    function update_order ($kPO)
    {
        $this->prepare_variables();
        if ($this->input->post('newPO')) {
            $this->kPO = $this->input->post('newPO');
        }
        $this->db->where('kPO', $kPO);
        $this->db->update('order', $this);
    }

    function delete_order ($kPO)
    {
        $id_array = array(
                'kPO' => $kPO
        );

        echo $this->db->delete('order', $id_array);
    }

    function fetch_orders ()
    {
        $id = $this->input->post('kPO');
        $this->db->where('kPO', $id);
        $this->db->from('order');
        $query = $this->db->get();
        return $query->result();
    }

    function fetch_order ($kPO, $orderFields = null)
    {
        $this->db->where('kPO', $kPO);
        $this->db->from('order');
        if ($orderFields) {
            if (is_array($orderFields)) {
                foreach ($orderFields as $field) {
                    $this->db->select($field);
                }
            } else {
                $this->db->select($orderFields);
            }
        }
        $query = $this->db->get();
        $output = $query->result();
        if (count($output) > 0) {
            return $output[0];
        } else {
            return false;
        }
    }

    function fetch_vendor_orders ($kVendor = null)
    {
        $this->db->select(
                "vendor.kVendor as kVendor, vendor.vendorName as vendorName, order.poDate as poDate, order.kPO as kPO");
        $this->db->join('vendor', 'vendor.kVendor = order.kVendor');
        $this->db->from('order');
        $this->db->order_by('vendorName', 'asc');
        $this->db->order_by('poDate', 'desc');
        if ($kVendor) {
            $this->db->where("vendor.kVendor = $kVendor");
        }

        $output = $this->db->get()->result();
        // $this->session->set_flashdata("notice",$this->db->last_query());
        return $output;
    }

    function fetch_order_values ($fields, $orderFields = null)
    {
        $this->db->from('order');
        $this->db->distinct();

        if (is_array($fields)) {
            foreach ($fields as $field) {
                $this->db->select($field);
            }
        } else {
            $this->db->select($fields);
        }

        if ($orderFields) {
            if (is_array($orderFields)) {
                foreach ($orderFields as $order) {
                    $this->db->order_by($order);
                }
            } else {
                $this->db->order_by($orderFields);
            }
        }

        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function fetch_value_list ($fieldName, $valueName)
    {
        $fieldList = $this->fetch_order_values($fieldName, $valueName);
        $fieldPairs = getKeyedPair($fieldList, array(
                $fieldName,
                $valueName
        ));
        return $fieldPairs;
    }

    function fetch_by_date_range ($startDate, $endDate)
    {
        // SELECT * FROM po , item WHERE po.kPO=item.kPO AND (po.poDate between
        // '2010-07-01' AND '2011-06-30') order by po.kPO,po.poDate
        $start = formatDate($startDate, 'mysql');
        $end = formatDate($endDate, 'mysql');
        $this->db->order_by('poDate', 'DESC');

        $this->db->order_by('order.kPO');
        $this->db->from('order');
        $this->db->from('item');
        $this->db->where("`poDate` BETWEEN '$start' AND '$end'");
        $this->db->where('`order`.`kPO` = `item`.`kPO`');
        $query = $this->db->get();
        return $query->result();
    }

    function update_total ($kPO)
    {
        $this->load->model("item_model");
        $total = $this->item_model->fetch_item_totals($kPO);
        $this->db->where('kPO', $kPO);
        $this->db->update('order', $update);
    }
}