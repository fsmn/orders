<?php
class Variable_model extends CI_Model
{
	
	var $var_category;
	var $var_name;
	var $var_value;
	
	function __construct()
	{
		parent::__construct();
	}
	
	function prepare_variables()
	{
		$variables = array("var_category","var_name","var_value");
		for($i = 0; $i < count($variables); $i++){
			$myVariable = $variables[$i];
			if($this->input->post($myVariable)){
				$this->$myVariable = $this->input->post($myVariable);
			}
		}
	}
	
	/* function get($kVar)
	{
		
		$this->db->where("kVar", $kVar);
		$this->db->from("variable");
		$result = $this->db->get()->row();
		return $result;
		
	} */
	
	
	function get_all($var_category)
	{
		
		$this->db->where("var_category", $var_category);
		$this->db->from("variable");
		$this->db->order_by("var_value");
		$result = $this->db->get()->result();
		return $result;
	}
	
	
	
	function insert()
	{
		
		$this->prepare_variables();
		$this->db->insert("variable", $this);
		$kVar = $this->db->insert_id();
		return $kVar;
		
	}
	
	
	function update()
	{
		
	}
	
	
	
	
}