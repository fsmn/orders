<?php

class Item_model extends CI_Model{

	var $kPO;
	var $itemCount;
	var $itemNumber;
	var $itemDescription;
	var $itemPrice;
	var $itemCategory;
	var $kOrder;
	var $itemTotal;

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * set up all the variables for the object. 
	 */
	function prepare_variables()
	{
		if($this->input->post('kPO')) {
			$this->kPO = $this->input->post('kPO');
		};

		if($this->input->post('itemCount')){
			$this->itemCount = $this->input->post('itemCount');
		}

		if($this->input->post('itemNumber')){
			$this->itemNumber = $this->input->post('itemNumber');
		}

		if($this->input->post('itemDescription')){
			$this->itemDescription = $this->input->post('itemDescription');
		}

		if($this->input->post('itemPrice')){
			$this->itemPrice = $this->input->post('itemPrice');
		}

		if($this->input->post('itemCategory')){
			$this->itemCategory = $this->input->post('itemCategory');
		}

		if($this->input->post('itemTotal')){
			$this->itemTotal = $this->itemCount * $this->itemPrice;
		}

		if($this->input->post('kOrder')){
			$this->kOrder = $this->input->post('kOrder');
		}
	}


	function insert_item()
	{
		$this->prepare_variables();
		$this->db->insert('item', $this);
		$this->load->model("order_model");
		$this->order_model->update_total($this->kPO);
		return $this->db->insert_id();
	}

	
	function update_item($kItem)
	{
		$this->prepare_variables();
		$this->db->where('kItem', $kItem);
		$this->db->update('item', $this);
		$this->load->model("order_model");
		$this->order_model->update_total($this->kPO);

	}

	
	function update_po($kPO, $newPO)
	{
		$field_array= array('kPO' => $newPO);
		$this->db->where('kPO', $kPO);
		$this->db->update('item', $field_array);
	}


	function delete_item($kItem)
	{
		$item = $this->fetch_item($kItem);
		$kPO = $item->kPO;
		$id_array = array('kItem' => $kItem);
		$this->db->delete('item', $id_array);
		$this->load->model("order_model");
		$this->order_model->update_total($this->kPO);
	}


	function delete_item_by_order( $kPO )
	{
		$id_array = array('kPO' => $kPO );
		$this->db->delete('item', $id_array);
	}


	function fetch_items($kPO)
	{
		$this->db->where('kPO', $kPO);
		$this->db->from('item');
		$this->db->order_by('kItem');
		$query = $this->db->get();
		return $query->result();
	}


	function fetch_item($kItem)
	{
		$this->db->where('kItem', $kItem);
		$this->db->from('item');
		$result = $this->db->get()->row();
		return $result;
	}

	
	function find($data)
	{
		$this->db->like("itemDescription", $data);
		$this->db->or_like("itemNumber", $data);
		$this->db->from("item");
		$result = $this->db->get()->result();
		return $result;

	}

	function fetch_item_totals($kPO)
	{
		$this->db->where("kPO", $kPO);
		$this->db->select("SUM(`itemPrice` * `itemCount`) AS total");
		$this->db->from('item');
		$result = $this->db->get()->row();
		return $result->total;
	}
}