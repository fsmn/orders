<?php


class Vendor extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("vendor_model");
	}


	function index()
	{
		$data["title"] = "Purchase Order System: Vendor List";
		$data["print"] = false;
		$this->load->library("pagination");

		$config["base_url"] = base_url(). "index.php/vendor/index/";
		$config["per_page"] = 21;
		$config["num_links"] = 20;
		$config["full_tag_open"] = "<div class='pagination'>";
		$config["full_tag_close"] = "</div>";
		$config["next_link"] = "Next";
		$config["prev_link"] = "Previous";

		$limits = array("limit" => $config["per_page"], "offset"=> $this->uri->segment(3));
		$config["total_rows"] = $this->db->get("vendor")->num_rows();

		$this->pagination->initialize($config);
		$data["links"] = $this->pagination->create_links();

		$data["vendors"] = $this->vendor_model->fetch_vendors($limits);

		$data["target"] = "vendor/list";
		$this->load->view("page/index", $data);

	}


	function edit()
	{
		$kVendor = $this->uri->segment(3);
		$vendor = $this->vendor_model->fetch_vendor($kVendor);
		$data["vendor"] = $vendor;
		$data["action"] = "save";
		if($this->input->post("ajax") == 1) {
			$this->load->view("vendor/edit", $data);
		}else{
			$data["title"] = "Purchase Order System: Edit Vendor";
			$data["print"] = false;
			$data["target"] = "vendor_edit";
			$this->load->view("page/index", $data);
		}
			
	}

	//@TODO this should be changed to "update" to match the other controllers.
	function save()
	{

		if(  $this->input->post("kVendor") ){
			$kVendor = $this->input->post("kVendor");
			$this->vendor_model->update_vendor($kVendor);
			redirect("vendor/view/" . $kVendor);
		}

	}

	function insert()
	{
		$kVendor = $this->vendor_model->insert_vendor();
		redirect("vendor/view/" . $kVendor);
	}


	function view()
	{
		$kVendor = $this->uri->segment(3);
		$data["title"] = "Vendor View";
		$data["print"] = false;
		$data["target"] = "vendor/view";
		$data["vendor"] = $this->vendor_model->fetch_vendor($kVendor);
		$this->load->view("page/index", $data);
	}

	function add()
	{
		if( $this->input->post("action") == "add" ){
			$data["action"] = "insert";
			$data["vendor"] = null;
			$data["title"] = "Add a Vendor";
			$data["target"] = "vendor/edit";
			$data["print"] = true;
			if($this->input->post("ajax") == 1) {
				$this->load->view("vendor/edit", $data);
			}else{
				$data["print"] = false;
				$this->load->view("page/index", $data);
			}
		}
	}


}