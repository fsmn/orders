<?php


class Vendor_model extends CI_Model
{
	var $vendorName = '';
	var $vendorContact = '';
	var $vendorAddress = '';
	var $vendorCityStateZip = '';
	var $vendorURL = '';
	var $vendorPhone = '';
	var $vendorFax = '';
	var $vendorEmail = '';
	var $vendorCustomerID = '';


	function __construct()
	{
		parent::__construct();
	}

	function prepare_variables()
	{
		if( $this->input->post('vendorName') ){
			$this->vendorName = $this->input->post('vendorName');
		}

		if( $this->input->post('vendorContact') ){
			$this->vendorContact = $this->input->post('vendorContact');
		}

		if( $this->input->post('vendorAddress') ){
			$this->vendorAddress = $this->input->post('vendorAddress');
		}

		if( $this->input->post('vendorCityStateZip') ){
			$this->vendorCityStateZip = $this->input->post('vendorCityStateZip');
		}

		if( $this->input->post('vendorURL') ){
			$this->vendorURL = $this->input->post('vendorURL');
		}

		if( $this->input->post('vendorPhone') ){
			$this->vendorPhone = $this->input->post('vendorPhone');
		}

		if( $this->input->post('vendorFax') ){
			$this->vendorFax = $this->input->post('vendorFax');
		}

		if( $this->input->post('vendorEmail') ){
			$this->vendorEmail = $this->input->post('vendorEmail');
		}

		if( $this->input->post('vendorCustomerID') ){
			$this->vendorCustomerID = $this->input->post('vendorCustomerID');
		}
	}



	function insert_vendor($data = null)
	{
		$this->prepare_variables();
		$this->db->insert('vendor', $this);
		return $this->db->insert_id();

	}

	function update_vendor($kVendor)
	{
		$this->prepare_variables();
		$this->db->where('kVendor', $kVendor);
		$this->db->update('vendor', $this);

	}

	function get_vendor_value($kVendor, $fieldName)
	{

		$this->db->where('kVendor', $kVendor);
		$this->db->from('vendor');
		if(is_array($fieldName)){
			foreach($fieldName as $field){
				$this->db->select($field);
			}
		}else{
			$this->db->select($fieldName);
		}
		$query = $this->db->get();
		$result = $query->result();
		$object = $result[0];
		$output = $object->$fieldName;
		return $output;
		
	}

	function fetch_vendor_values($fields, $orderFields = null){
		$this->db->from('vendor');
		$this->db->distinct();

		if(is_array($fields)){
			foreach($fields as $field){
				$this->db->select($field);
			}
		}else{
			$this->db->select($fields);
		}

		if($orderFields){
			if(is_array($orderFields)){
				foreach($orderFields as $order){
					$this->db->order_by($order);
				}
			}else{
				$this->db->order_by($orderFields);
			}
		}

		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function fetch_vendor_list()
	{
		
		$vendorList = $this->fetch_vendor_values(array('kVendor','vendorName'), 'vendorName');
        $vendorPairs = getKeyedPair($vendorList, array('kVendor', 'vendorName'));
        return $vendorPairs;
		
	}

	function delete_vendor($kVendor)
	{
		$id_array = array('kVendor' => $kVendor);

		$this->db->delete('order', $id_array);
	}

	function fetch_vendors($limiters = null)
	{
		$this->db->from('vendor');
		$this->db->order_by('vendorName');
		if($limiters){
			if($limiters['limit']){
		      $this->db->limit( $limiters['limit'] );
			}
			if($limiters['offset']) {
				$this->db->offset( $limiters['offset'] );
			}
		}
		$query = $this->db->get();
		return $query->result();
	}


	function fetch_vendor($kVendor)
	{
		$this->db->where('kVendor', $kVendor);
		$this->db->from('vendor');
		$query = $this->db->get();
		$output = $query->result();
		return $output[0];
	}


	function find_vendor()
	{

	}
}