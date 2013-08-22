<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller {
	
	public $distributor_id;
	public $card_id;
	public $distributor_url;
	public $cities;
	public $distributor_name;
	public $my_points;
	
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
		
		if( $this->card_id == '' ) {
			$this->session->sess_destroy();
			redirect(base_url().$this->distributor_url);			
		}
		
		$account_info = $this->db->get_where("card_holders", array("CARD_ID"=>$this->card_id))->row();
		$this->distributor_name =  $account_info->FIRSTNAME; 
		$this->my_points =  $account_info->card_balance; 


		$this->activated_deals_id = $this->user_model->get_activated_deal($this->card_id);
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
			//$data["stores"] = $this->midasmodel->stores_by_city($city_id,"f"); 
			
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
			$data["cities"] = $this->commonmodel->cities_dp(1);
			
			//echo $this->db->last_query();
			
		}else{
			  
			$this->db->where('isactive', 1); 
			$stores = $this->db->get('store_info')->result();
			
			foreach($stores as $row){
				$data['stores'][$row->id] = $row;
			} 
			
			$this->db->where('city_id', $city_id);
			
			$data['featured_stores'] = $this->db->get('featured_stores_in_city')->row();
			 			
		}
		 
		$data["categories"] = $this->db->get_where("categories", array("category_id"=>$cat_id))->row();
 
		//$this->load->view('member/header_view', $data);
		//$this->load->view('member/main-content', $data);
		//$this->load->view('member/footer_view');


		$data["cat_id"] = $cat_id;

		$data["page_name"] = 'member_checkoutdeals';

		$data["cities"] = $this->commonmodel->cities(true);

		$this->load->view('ricktag/header_new');
		$this->load->view('midas/checkoutdeals_menu_bar',$data);
		if( $cat_id > 0  ){
			$this->load->view('midas/checkoutdeals',$data);
		}else{ 
			$this->load->view('midas/checkoutdeals_featured',$data);
		}
		$this->load->view('midas/checkoutdeals_member_footer');
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
		$this->db->where("CARD_TYPE", "RC" );
		$this->db->select("card_holders.*, cities.name as  city_name");
		$this->db->join("cities", "cities.id = card_holders.CITY_ID");
		$data["info"] = $this->db->get("card_holders")->row();
		$data["rewardused"] = $this->db->query("SELECT SUM(Amount_Used) as Amount_Used FROM card_holder_activity_info WHERE CardType='R' AND CARD_ID = '{$this->card_id}'")->row();		 
		$data["notify"] = $this->db->get_where("notifications", array("card_id"=>$this->card_id))->row();
		$data["cities"] = $this->commonmodel->cities_dp(1); 
	
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
	
	public function saveFieldsAccount(){
		
		$field = $this->input->post("f");
		$value = $this->input->post("v");
		$field_string = $this->input->post("fs");
		$json = array("status"=>false,"txt"=>"Failed to update");
		$set["MODIFY_DATE"]	= date("Y-m-d H:i:s");
		
		if( $field == "BIRTHDAY" ){ 
		
			if( $this->card_id != '' ){
				$set[$field] = date("Y-m-d", strtotime($value)); 
				$this->db->where("CARD_ID", $this->card_id);
				if( $this->db->update("card_holders", $set) ){
					$json["status"] = true;
					$json["txt"] = $field_string." was successfully updated";
				} 
			}			
		}else if( $field == "PASSWORD" ){
		
			$v2 = $this->input->post("v2");
			$v21 = $this->input->post("v21");
			
			if( strlen($v2) >= 6  AND strlen($v21) >= 6){
			
				$this->db->where("CARD_ID", $this->card_id);
				$res = $this->db->get_where("card_holders")->row();
				
				//if($res->PASSWORD == md5($value)){
					
					if( $v2 == $v21 ){
						
						if( $this->card_id != '' ){
							$pass = md5($v2);
							$set["PASSWORD"] = $pass;
							$set["ispasschanged"] = 1;
							$set["passlastchangeddate"] = date('Y-m-d H:i:s');
							$this->db->where("CARD_ID", $this->card_id);						
							$this->db->where("CARD_TYPE", 'RC');						
							if( $this->db->update("card_holders", $set) ){
								$json["status"] = true;
								$json["txt"] = "Password was successfully changed";
							} 	
						}						
					}else{
						$json["status"] = false;
						$json["txt"] = "New password does not match";					
					}
					
				/* }else{
			 
					$json["status"] = false;
					$json["txt"] = "Current password is incorrect";			
				} */
			}else{
				$json["status"] = false;
				$json["txt"] = "New password must be greater than 5 characters";				
			}
			 
		}else{
			$set[$field] = $value; 
			$this->db->where("CARD_ID", $this->card_id);
			if( $this->db->update("card_holders", $set) ){
				$json["status"] = true;
				$json["txt"] = $field_string." was successfully updated";
			} 			
		}
 
		echo json_encode($json);   
		 
	}
	
	public function saveEmailNot(){
	 
		$json = array("status"=>false,"txt"=>"Failed to update");
		
		$field = $this->input->post("f"); 
		$value = $this->input->post("v");  
		$set2[$field] = $value;	
		
		$notify = $this->db->get_where("notifications", array("card_id"=>$this->card_id));			
		if( $notify->num_rows() > 0 ){  
			$this->db->where("card_id",  $this->card_id);
			if( $this->db->update("notifications", $set2) ){
				$json["status"] 	= true;	
				$json["txt"] 	= "You have successfully updated your Email Notifications";				
			}
		}else{
			$set2["card_id"] = $this->card_id;
			if( $this->db->insert("notifications", $set2) ){
				$json["status"] 	= true;	
				$json["txt"] 	= "You have successfully updated your Email Notifications";			
			}
		}
	 
		echo json_encode($json) ;
	}
	
	public function savePreferences(){
		$json = array("status"=>false,"txt"=>"Failed to update");
		
		$pre_name = $this->input->post('name');
		$pre_val = $this->input->post('value');
		
		$set[$pre_name] = $pre_val;
		$this->db->where("card_id", $this->card_id);
		$this->db->where("CARD_TYPE", 'RC');
		if( $this->db->update('card_holders', $set) ){
			$json["status"] 	= true;	
			$json["txt"] 	= "You have successfully updated your Email Notifications";	
		}
		//echo $this->db->last_query();
		echo json_encode($json) ;
	}
	
	public function map(){
		
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

			$this->db->select("store_category_link.store_id, store_category_link.category_id, islist, active, store_city_link.city_id,cities.name AS  city_name ,
							store_info.*");
			
			$this->db->join("store_info", "store_info.id = store_category_link.store_id AND  store_category_link.active = 1");		
			$this->db->join("store_city_link", "store_city_link.store_id = store_category_link.store_id");	
			$this->db->join("cities", "cities.id = store_city_link.city_id");		
			//$this->db->join("store_city_link", "store_city_link.store_id = store_category_link.store_id AND store_city_link.city_id = store_info.city_id");		
			
			$data["stores"] = $this->db->get("store_category_link")->result();
			//echo $this->db->last_query();
			$data["cities"] = $this->commonmodel->cities_dp(1);
			
			//echo $this->db->last_query(); 
			 
			
			//$data["stores"] = $this->midasmodel->stores_by_city($city_id,"f");
		}else{
			
			$this->db->select('store_info.*, cities.name as city_name');
			$this->db->where('isactive', 1);  
			$this->db->join('cities', 'cities.id = store_info.city_id', 'LEFT OUTER');
			$stores = $this->db->get('store_info')->result();
			 
			
			foreach($stores as $row){
				$data['stores'][$row->id] = $row;
			} 
			 
			$this->db->where('city_id', $city_id); 
			$data['featured_stores'] = $this->db->get('featured_stores_in_city')->row();			
		}
		$data["categories"] = $this->db->get_where("categories", array("category_id"=>$cat_id))->row();
		
		$data["page_name"] = 'checkoutdeals_maps';

		$data["cities"] = $this->commonmodel->cities(true);

		$this->load->view('ricktag/header_new');
		$this->load->view('midas/checkoutdeals_menu_bar',$data);
		if( $cat_id > 0  ){
			$this->load->view('midas/checkoutdeals_map',$data);
		}else{
			$this->load->view('midas/checkoutdeals_map_featured',$data);
		}
		$this->load->view('midas/checkoutdeals_footer');			
	} 
	
	public function map2(){
		$data= '';
		$this->load->view('new_member/header_map_view', $data);
		$this->load->view('new_member/map-canvas');
		$this->load->view('new_member/footer_map_view');		
	}


	public function deals(){

		if($this->session->userdata("ISLOGIN")){
		//add custon session
		if(!$this->session->userdata("CUR_CITY")){
			$cur_city = (object)array("id"=>"3", "name"=>"Barrie", "sequence" => "" ,"hidden"=>"1");
			$this->session->set_userdata('CUR_CITY', $cur_city);
		}
		//add custon session
		
		$cat_id = $this->uri->segment(4);
		 
		if( @count($this->session->userdata("CUR_CITY")->id) > 0){
			
			$cur_city = $this->commonmodel->cities_first($this->session->userdata("CUR_CITY")->id);
			$this->session->set_userdata('CUR_CITY', $cur_city);  
			
			$city_id = $cur_city->id; 
		
		}else{
			$city_id = $this->session->userdata("CUR_CITY")->id;
		} 


		$id = $this->uri->segment(5);
		
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
		//$data["categories"] = substr($cat_text, 0, -2);


		if( $cat_id > 0  ){
			$this->db->where("store_city_link.city_id", $city_id);
			$this->db->where("store_city_link.islist ", 1);
			$this->db->where("store_category_link.category_id", $cat_id);
			$this->db->select("store_category_link.store_id, store_category_link.category_id, islist, active, store_city_link.city_id,
							store_info.company_name, store_info.small_banner, store_info.large_banner, store_info.discount, store_info.id");
			$this->db->join("store_info", "store_info.id = store_category_link.store_id AND  store_category_link.active = 1");		
			$this->db->join("store_city_link", "store_city_link.store_id = store_category_link.store_id");		
			
			$data["stores_list"] = $this->db->get("store_category_link")->result();
		}else{
			$data["stores_list"] = $this->midasmodel->stores_by_city($city_id,"f");
		}

		$data["categories"] = $this->db->get_where("categories", array("category_id"=>$cat_id))->row();

		$data["cat_id"] = $cat_id;

		$data["page_name"] = 'viewdeals';

		$data["cities"] = $this->commonmodel->cities(true);

		$this->load->view('ricktag/header_new');
		$this->load->view('midas/checkoutdeals_menu_bar',$data);
		$this->load->view('midas/viewdeals',$data);
		$this->load->view('midas/checkoutdeals_footer');
	}else{
		redirect(base_url('/learn/guest/category'));	
	}

	}
	
	
	public function mycardhistory(){
	
		$this->db->where("CARD_ID", $this->card_id );
		$this->db->select("card_holders.*, cities.name as  city_name");
		$this->db->join("cities", "cities.id = card_holders.CITY_ID");
		$data["info"] = $this->db->get("card_holders")->row();
		$data["rewardused"] = $this->db->query("SELECT SUM(Amount_Used) as Amount_Used FROM card_holder_activity_info WHERE CardType='R' AND CARD_ID = '{$this->card_id}'")->row();		 
		$data["notify"] = $this->db->get_where("notifications", array("card_id"=>$this->card_id))->row();
		$data["cities"] = $this->commonmodel->cities_dp(1); 

		$query_history = "SELECT  Date_Card_ID, discount,store_info.company_name, Purchased_Amount, Amount_Used, 
						ROUND((Purchased_Amount/p_value)*p_points, 0) AS 'Points'
						FROM card_holder_activity_info
						LEFT OUTER JOIN store_info ON store_info.id = card_holder_activity_info.Store_ID
						WHERE CardType = 'R' AND Card_ID = '{$this->card_id}'";
		$data["history"] = $this->db->query($query_history )->result();
		
		
		$this->load->view('member/header_bucks_view', $data);
		$this->load->view('member/mycardhistory_view', $data);
		$this->load->view('member/footer_view');	
		
	
	}
	
	public function myspecialoffers(){
	
		$this->db->where("CARD_ID", $this->card_id );
		$this->db->select("card_holders.*, cities.name as  city_name");
		$this->db->join("cities", "cities.id = card_holders.CITY_ID");
		$data["info"] = $this->db->get("card_holders")->row();
		
		$data["rewardused"] = $this->db->query("SELECT SUM(Amount_Used) as Amount_Used FROM card_holder_activity_info WHERE CardType='R' AND CARD_ID = '{$this->card_id}'")->row();
		$data["notify"] = $this->db->get_where("notifications", array("card_id"=>$this->card_id))->row();
		$data["cities"] = $this->commonmodel->cities_dp(1); 
	
		$this->load->view('member/header_bucks_view', $data);
		$this->load->view('member/myspecialoffers_view', $data);
		$this->load->view('member/footer_view');	
		
	}	
	 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */