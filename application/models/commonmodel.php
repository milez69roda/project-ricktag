<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CommonModel extends CI_Model {
 
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
   	
	function cities( $hidden=0 ){
		
		if( $hidden != 0 )
			$this->db->where("hidden", $hidden);
		 
		$this->db->order_by("name", "asc");
		$res = $this->db->get("cities")->result();
		return $res;
	}	

	function cities_dp($hidden){
		
		 
		$this->db->where("hidden", 1);
		 
		$this->db->order_by("name", "asc");
		$res = $this->db->get("cities")->result();
		
		$cities = array();
		foreach( $res as $row){
			$cities[$row->id] = $row->name;
		}
		return $cities;	
	}
	
	function cities_first($city_id = ''){
		
		if( $city_id != '' )
		$this->db->where("id", $city_id);
		
		
		$this->db->where("hidden", 1);
		$this->db->order_by("name", "asc");
		$this->db->limit(1);
		$res = $this->db->get("cities")->row();
		return $res;
	}
	
	function categories_dp( $hidden=false ){
		if( $hidden )
			$this->db->where("hidden", 0);
		 
		$this->db->order_by("name", "asc");
		$res = $this->db->get("categories")->result();
		
		$cat = array();
		foreach( $res as $row){
			$cat[$row->category_id] = $row->name;
		}
		return $cat;	
	}
	
	function distributor_dp($status){
		
		if( $status )
			//$this->db->where("dist_status", 1);
			
		
		$this->db->select("dist_id, company_name, first_name, last_name"); 
		$this->db->order_by("company_name", "asc");
		$res = $this->db->get("distributor_info")->result();
		
		$options = array();
		foreach( $res as $row){
			$options[$row->dist_id] = $row->company_name." - ". $row->first_name." ". $row->last_name;
		}
		return $options;	
	}	

	function get_vendor ($vendorlink){
		
		$this->db->where("card_url", $vendorlink);	
		if( $vendorlink == "midas" ){
			$this->db->where("card_id", 79);		
		}
				
		$this->db->select("card_id, distributor_info.dist_id, distributor_info.city_id, company_name,distributor_info.first_name, distributor_info.last_name, card_info.card_image, slider_image1, slider_image2, slider_image3, slider_image4");				
		$this->db->join("distributor_info", "distributor_info.dist_id = card_info.dist_id");
		$this->db->limit(1);
		$res = $this->db->get("card_info");
		
		if( $res->num_rows() > 0 ){
			$res = $res->row();
		 
			return $res;
		}else{
			return 0;
		}
	}
	 
	
	public function save_routes() {
	 
		$this->db->select("card_url");
		$this->db->where("is_page", 1);
		$this->db->where("card_type", "RC");
		$routes = $this->db->get("card_info")->result(); 
	  
		if ( count($routes) > 0 ) {
			 
			foreach( $routes as $route )
			{
				$data[] = '$route["' . $route->card_url . '/members"] = "members";';
				$data[] = '$route["' . $route->card_url . '/members/(:any)"] = "members/$1";';			
				$data[] = '$route["' . $route->card_url . '/guest/category"] = "welcome/checkoutdeals";';
				$data[] = '$route["' . $route->card_url . '/guest/category/(:any)"] = "welcome/checkoutdeals/$1";';
				$data[] = '$route["' . $route->card_url . '"] = "distributors";';
				$data[] = '$route["' . $route->card_url . '/(:any)"] = "distributors/$1";';
				$data[] = '';
			}
	 
			$output = "<?php \n".implode("\n", $data);
	 
			$this->load->helper('file');
			write_file(APPPATH . "cache/routes.php", $output);
		}
		return true;
	}	

	public function getLatLong($address){
		if (!is_string($address))die("All Addresses must be passed as a string");
		$_url = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
		$_result = false;
		if($_result = file_get_contents($_url)) {
			if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
			preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);
			$_coords['lat'] = $_match[1];
			$_coords['long'] = $_match[2];
		}
		return $_coords;
	}	
	
}

/* End of file welcome.php */
/* Location: ./application/model/commonmodel.php */