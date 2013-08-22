<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller {
	
	public $distributor_id;
	public $card_id;
	public $distributor_url;
	public $cities;
	public $distributor_name;
	
	public function __construct(){
		parent::__construct();	
		
		$this->distributor_url = $this->uri->segment(1);		
		$distributor = $this->commonmodel->get_vendor($this->distributor_url);
		

		if( @$distributor->dist_id == 0 )	{
			echo show_404();
			exit(0);
		}

		$this->distributor_id =  $distributor->dist_id; 		
		
		if( !$this->session->userdata("ISLOGIN") ){
			$this->session->sess_destroy();
			redirect(base_url().$this->distributor_url);
		}
		
		$this->card_id = $this->session->userdata("CARDID");
		
		if( @count($this->session->userdata("CUR_CITY")->id) > 0){
			
			$cur_city = $this->commonmodel->cities_first($this->session->userdata("CUR_CITY")->id);
			$this->session->set_userdata('CUR_CITY', $cur_city);  
			
			$city_id = $cur_city->id; 
		
		}else{
			$cur_city = $this->commonmodel->cities_first();
			$this->session->set_userdata('CUR_CITY', $cur_city);  
		}

		$this->cities = $this->commonmodel->cities_dp(1);	
		
		$account_info = $this->db->get_where("card_holders", array("CARD_ID"=>$this->card_id))->row();
		$this->distributor_name =  $account_info->FIRSTNAME; 
	}
	
	public function index(){
		
		/* $data["cities"] = $this->commonmodel->cities_dp(1);
	 
		$this->load->view('member/header', $data);
		$this->load->view('member/main-content', $data);
		$this->load->view('member/footer'); */
		
		redirect(base_url().$this->distributor_url."/members/category/");
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url().$this->distributor_url);	
	}
	
	public function setCity(){
		  
		$id = $this->uri->segment(4);
		
		$cur_city = $this->commonmodel->cities_first($id);
		$this->session->set_userdata('CUR_CITY', $cur_city); 
		 
		redirect(base_url().$this->distributor_url."/members/category/1");
	}
	
	public function category(){
		
		
		if( $this->uri->segment(5) != '' ){
		
			$cur_city = $this->commonmodel->cities_first($this->uri->segment(5));
			$this->session->set_userdata('CUR_CITY', $cur_city); 		
		}
		
		$cat_id = $this->uri->segment(4);
		 
		if( @count($this->session->userdata("CUR_CITY")->id) > 0){
			
			$cur_city = $this->commonmodel->cities_first($this->session->userdata("CUR_CITY")->id);
			$this->session->set_userdata('CUR_CITY', $cur_city);  
			
			$city_id = $cur_city->id; 
		
		}else{
			$city_id = $this->session->userdata("CUR_CITY")->id;
		} 
		
		if( $cat_id > 0  ){
		
			$this->db->where("store_city_link.city_id", $city_id);
			$this->db->where("store_city_link.islist ", 1);
			$this->db->where("store_category_link.category_id", $cat_id);
			$this->db->select("store_category_link.store_id, store_category_link.category_id, islist, active, store_city_link.city_id,
							store_info.company_name, store_info.small_banner, store_info.large_banner, store_info.discount, store_info.id");
			$this->db->join("store_info", "store_info.id = store_category_link.store_id AND  store_category_link.active = 1");		
			$this->db->join("store_city_link", "store_city_link.store_id = store_category_link.store_id");		
			//$this->db->join("store_city_link", "store_city_link.store_id = store_category_link.store_id AND store_city_link.city_id = store_info.city_id");		
			
			$data["stores"] = $this->db->get("store_category_link")->result();
			//echo $this->db->last_query();
			//$data["cities"] = $this->commonmodel->cities_dp(1);
			
			//echo $this->db->last_query();
			 
			$data["categories"] = $this->db->get_where("categories", array("category_id"=>$cat_id))->row();
			
		}else{
		 
			$this->load->model("midasmodel"); 
			$data["stores"] = $this->midasmodel->stores_by_city($city_id,"f");
		}
		 
	
 
		$this->load->view('member/header_view', $data);
		$this->load->view('member/main-content', $data);
		$this->load->view('member/footer_view');
	}
	
	public function storesinfo(){
	
		$id = $this->uri->segment(4);
		
		$this->db->where("store_info.id", $id ); 		
		$this->db->select("store_info.*, cities.name as city_name" );
		$this->db->join("cities", "cities.id=store_info.city_id");		
		//$this->db->join("categories", "categories.category_id=store_info.category_id");		
		
		$data["stores"] = $this->db->get("store_info")->row();
		
		$this->db->join("categories","categories.category_id = store_category_link.category_id");
		$cat = $this->db->get_where("store_category_link", array("store_category_link.store_id"=>$id))->result();
		$cat_text = '';
		foreach( $cat as $row){
			$cat_text .= $row->name.", ";
		}
		$data["categories"] = substr($cat_text, 0, -2);
		
		$viewdetail = $this->load->view("member/store-view-details", $data ,true);
		echo $viewdetail; 
	}	
	
	public function storesinfo_no_map(){
	
		$id = $this->uri->segment(4);
		
		$this->db->where("store_info.id", $id ); 		
		$this->db->select("store_info.*, cities.name as city_name" );
		$this->db->join("cities", "cities.id=store_info.city_id");		
		//$this->db->join("categories", "categories.category_id=store_info.category_id");		
		
		$data["stores"] = $this->db->get("store_info")->row();
		
		$this->db->join("categories","categories.category_id = store_category_link.category_id");
		$cat = $this->db->get_where("store_category_link", array("store_category_link.store_id"=>$id))->result();
		$cat_text = '';
		foreach( $cat as $row){
			$cat_text .= $row->name.", ";
		}
		$data["categories"] = substr($cat_text, 0, -2);
		
		$viewdetail = $this->load->view("member/store-view-details-no-map", $data ,true);
		echo $viewdetail; 
	}	
	
	public function myaccount(){
		
		$this->db->where("CARD_ID", $this->card_id );
		$this->db->select("card_holders.*, cities.name as  city_name");
		$this->db->join("cities", "cities.id = card_holders.CITY_ID");
		$data["info"] = $this->db->get("card_holders")->row();
		$data["notify"] = $this->db->get_where("notifications", array("card_id"=>$this->card_id))->row();
		$this->load->view('member/header_account_view', $data);
		$this->load->view('member/my_account_view', $data);
		$this->load->view('member/footer_view');	
	}
	
	public function editaccount(){
		 
		$data["cities"] = $this->commonmodel->cities_dp(1); 
		$data["info"] 	= $this->db->get_where("card_holders", array("CARD_ID"=>$this->card_id ))->row(); 
		$data["notify"] = $this->db->get_where("notifications", array("card_id"=>$this->card_id ))->row();
		$this->load->view('member/header_account_view', $data);
		$this->load->view('member/edit_account_view', $data);
		$this->load->view('member/footer_view');	
	}	
	
	public function saveaccount(){
			
		$res = array("status"=>false,
					"text"=>"");	
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ppbday', 'Birthday', 'required');
		$this->form_validation->set_rules('ppname', 'Name', 'required'); 
		$this->form_validation->set_rules('ppemail', 'Email', 'required|valid_email'); 
		$this->form_validation->set_rules('ppaddress', 'Address', 'required'); 
		$this->form_validation->set_rules('pppostal', 'Postal', 'required'); 
		
		if($this->form_validation->run() == FALSE ){
			$res["text"] = '<span style="color:red">Error:</span><br/><br/>'.validation_errors();
		}else{
		 
			if( trim($this->input->post("ppbday")) != "" ){
				$set["PASSWORD"] = md5($this->input->post("ppwd")); 
			}
		 
			if( $this->input->post("ppbday") != ''){
				$set["BIRTHDAY"] 	= date("Y-m-d",strtotime($this->input->post("ppbday"))); 
			}
			
			$set["FIRSTNAME"] 	= $this->input->post("ppname"); 
			$set["EMAIL"] 		= $this->input->post("ppemail"); 
			$set["STREET_UNIT"] = $this->input->post("ppaddress"); 
			$set["POSTAL_CODE"] = $this->input->post("pppostal"); 
			$set["MODIFY_DATE"] = date("Y-m-d H:i:s"); 
			
			$this->db->where("CARD_ID",  $this->card_id);
			
			
			if( $this->db->update("card_holders", $set) ){
			 
				$set2["joined"] 	= @$this->input->post("joined"); 
				$set2["offers"] 	= @$this->input->post("offers"); 
				$set2["sponsors"] 	= @$this->input->post("sponsors"); 
				$set2["bdaygift"] 	= @$this->input->post("bdaygift"); 
 
				 
				$notify = $this->db->get_where("notifications", array("card_id"=>$this->card_id));			
				if( $notify->num_rows() > 0 ){  
					$this->db->where("card_id",  $this->card_id);
					$this->db->update("notifications", $set2); 
				}else{
					$set2["card_id"] = $this->card_id;
					$this->db->insert("notifications", $set2);
				}
			
				$res["status"] 	= true;	
				$res["text"] 	= "You have successfully updated your information";
				$res["url"] 	= $this->distributor_url."/members/myaccount";
				
			}else{  
				$res["text"] = "Failed"; 
			}
		}
		
		echo json_encode($res);
	}
	
	
	public function map(){
		
		$data = '';
			
		if( $this->uri->segment(5) != '' ){
		
			$cur_city = $this->commonmodel->cities_first($this->uri->segment(5));
			$this->session->set_userdata('CUR_CITY', $cur_city); 		
		}
		
		$cat_id = $this->uri->segment(4);
		 
		if( @count($this->session->userdata("CUR_CITY")->id) > 0){
			
			$cur_city = $this->commonmodel->cities_first($this->session->userdata("CUR_CITY")->id);
			$this->session->set_userdata('CUR_CITY', $cur_city);  
			
			$city_id = $cur_city->id; 
		
		}else{
			$city_id = $this->session->userdata("CUR_CITY")->id;
		} 
		
		if( $cat_id > 0  ){
		
			$this->db->where("store_city_link.city_id", $city_id);
			$this->db->where("store_city_link.islist ", 1);
			$this->db->where("store_category_link.category_id", $cat_id);
			$this->db->select("store_category_link.store_id, store_category_link.category_id, islist, active, store_city_link.city_id,
							store_info.address, store_info.postal_code, cities.name as city_name,
							store_info.company_name, store_info.logo, store_info.small_banner, store_info.large_banner, store_info.discount, store_info.id, google_map_lat_long");
			$this->db->join("store_info", "store_info.id = store_category_link.store_id AND  store_category_link.active = 1");		
			$this->db->join("store_city_link", "store_city_link.store_id = store_category_link.store_id");		
			$this->db->join("cities", "cities.id = store_city_link.city_id");		
			//$this->db->join("store_city_link", "store_city_link.store_id = store_category_link.store_id AND store_city_link.city_id = store_info.city_id");		
			
			$data["stores"] = $this->db->get("store_category_link")->result();
			//echo $this->db->last_query();
			//$data["cities"] = $this->commonmodel->cities_dp(1);
			
			//echo $this->db->last_query();
			 
			$data["categories"] = $this->db->get_where("categories", array("category_id"=>$cat_id))->row();
			
		}else{
		 
			$this->load->model("midasmodel"); 
			$data["stores"] = $this->midasmodel->stores_by_city($city_id,"f");
		}

		
	
		$this->load->view('member/header_map_view', $data);
		$this->load->view('member/map-canvas2', $data);
		$this->load->view('member/footer_map_view');		
	} 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */