<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MidasModel extends CI_Model {
 
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
   
	function register($dist_id){
		$static = array("id"=>0);
		
		$set["CARD_ID"] 		= $this->input->post("card_number");
		$set["CITY_ID"] 		= $this->input->post("city");
		$set["FIRSTNAME"] 		= $this->input->post("name");
		$set["BIRTHDAY"] 		= date('Y-m-d',strtotime($this->input->post("dateofbirth")));
		$set["STREET_UNIT"] 	= $this->input->post("address");
		$set["EMAIL"] 			= $this->input->post("email"); 
		$set["POSTAL_CODE"] 	= $this->input->post("postal");
		$set["GENDER"] 			= ( $this->input->post("gender") == 'male')?'M':'F';
		$set["Distributer_Id"] 	= $dist_id;
		$set["CARD_TYPE"] 		= "RC";
		$set["CONFIRM_CODE"] 	= md5("'".$set["CARD_ID"]."'");
		$password 				= random_string('alnum', 13);
		$set["PASSWORD"] 		= md5($password );
		$set["CREATE_DATE"] 	= date("Y-m-d H:i:s");
		$set["MODIFY_DATE"] 	= date("Y-m-d H:i:s");
		$set["register_online"] = 1;
		
		
		if( $this->db->insert("card_holders", $set) ){
			$static["id"] = $this->db->insert_id();
			
			$notify = $this->db->get_where("notifications", array("card_id"=>$this->input->post("card_number")))->num_rows();
			
			
			if( $notify == 0){
				$set2["card_id"] = $this->input->post("card_number");
				$set2["joined"] 	= 1;
				$set2["offers"] 	= 1; 
				$set2["sponsors"] 	= 1; 
				$set2["bdaygift"] 	= 1; 
				$this->db->insert("notifications", $set2);
			}	 
		 
			$static["readpass"] = $password;
			return $static;
		}
		else{
			return $static; 	
		}	
	}	
	
	function stores_by_city($city,$type="f"){
		
		$this->db->where("store_city_link.city_id", $city);
		$this->db->where("store_city_link.isfeatured", "1");
	/* 	if( $type == "f" ){
			$this->db->where("store_city_link.isfeatured", "1");
		}
		
		if( $type == "l" ){
			$this->db->where("store_city_link.islist", "1");
		} */
		
		$this->db->select("store_info.*, cities.name AS  city_name " );
		$this->db->join("store_info", "store_info.id = store_city_link.store_id");		
		$this->db->join("cities", "cities.id = store_city_link.city_id");		
		//$this->db->join("categories", "categories.category_id = store_info.category_id");	
		$res = $this->db->get("store_city_link")->result();		 	
		return $res;
	}
	
	function stores_city_link($store_id){
		
		$this->db->where("store_id",$store_id);
		$res = $this->db->get("store_city_link")->result();
		$arr = array();
		
		foreach($res as $row){
			$arr[$row->city_id] = $row;
		}
		return $arr;
	}
	
	function store_category_link($store_id){
		$this->db->where("store_id",$store_id);
		$this->db->where("active",1);
		$res = $this->db->get("store_category_link")->result();
		$arr = array();
		
		foreach($res as $row){
			$arr[$row->category_id] = $row;
		}
		return $arr;		
	}
	
	function store_deals($store_id){
		$this->db->where("store_id",$store_id);
		 
		$res = $this->db->get("store_deals")->result();
		$arr = array();
		
		foreach($res as $row){
			$arr[$row->deals_id] = $row;
		}
		return $arr;		
	}	
}

/* End of file welcome.php */
/* Location: ./application/model/midasmodel.php */