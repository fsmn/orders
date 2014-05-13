<?php

class Item extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model("order_model");
		$this->load->model("item_model");
		$this->load->model("variable_model");
	}

	function add()
	{
		if( $this->input->get_post("kPO") ){
			$kPO = $this->input->get_post("kPO");
			$data["kPO"] = $kPO;
			$data["action"] = "insert";
			$data["item"] = array();
			$order = $this->order_model->fetch_order($kPO, array("kOrder","poCategory") );
			$data["kOrder"] = $order->kOrder;
			$data["itemCategory"] = $order->poCategory;
			$categories = $this->variable_model->get_all("poCategory");
			$options = array("other"=>TRUE, "initial_blank"=>TRUE);
			$data["categoryPairs"] = getKeyedPair($categories, array("var_name","var_value"), $options);
			if($this->input->post("ajax") == 1) {
				$this->load->view("item/edit", $data);
			}else{
				$data["print"] = false;
				$data["title"] = "Add an Order";
				$data["target"] = "item/edit";
				$this->load->view("page/index", $data);
			}
		}
	}


	function edit()
	{
		if( $this->input->post("kItem") ){
			$kItem = $this->input->post("kItem");
			$data["kItem"] = $kItem;
			$data["action"] = "update";
			$item =  $this->item_model->fetch_item($kItem);
			$data["item"] = $item;
			$data["kPO"] = $item->kPO;
			$categories = $this->variable_model->get_all("poCategory");
			$options = array("other"=>TRUE, "initial_blank"=>TRUE);
			$data["categoryPairs"] = getKeyedPair($categories, array("var_name","var_value"),$options);
			if($this->input->post("ajax") == 1) {
				$this->load->view("item/edit", $data);
			}else{
				$data["print"] = false;
				$data["title"] = "Edit an Item";
				$data["target"] = "item/edit";
				$this->load->view("page/index", $data);
			}
		}
	}

	function update()
	{
		if(  $this->input->post("kItem") ){
			$kItem = $this->input->post("kItem");
			$this->item_model->update_item($kItem);
			$kPO = $this->input->post("kPO");
			$total = $this->item_model->fetch_item_totals($kPO);

			$this->order_model->update_total($kPO, $total->total);
		}

		redirect("order/view/" . $this->input->post("kPO") );
	}

	function insert()
	{
		if ($this->input->post("kPO") ) {
			$this->item_model->insert_item();
			$kPO = $this->input->post("kPO");	

			redirect("order/view/" . $kPO );
		}
	}

	function delete()
	{
		if( $this->input->post("kItem") ){
			$kItem = $this->input->post("kItem");
			$this->item_model->delete_item($kItem);
			echo "Item $kItem as been deleted.";

		}
		//redirect("order/view/" . $this->input->post("kPO") );


	}
	
	function search()
	{
		$this->load->view("item/search");
	}
	
	function find()
	{
		$search_string = $this->input->post("search_string");
		$data["items"] = $this->item_model->find($search_string);
		$data["title"] = "Search Results";
		$data["target"] = "item/table";
		$data["search_string"] = $search_string;
		$data["print"] = false;
		$data["class"] = "list";
		$data["kPO"] = "";
		$this->load->view("page/index", $data);
		
	}
}