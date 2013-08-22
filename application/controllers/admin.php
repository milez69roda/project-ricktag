<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public $msg_unread = 0;
	
	public function __construct(){
		parent::__construct(); 
		
		if( !$this->session->userdata("ADMIN_ISLOGIN") ){
			redirect(base_url()."adminlogin"); 
		}		 
		
		$msg_unread = $this->db->query('SELECT COUNT(*) AS unread FROM message_reply WHERE admin_unread = 0')->row();
		$this->msg_unread = $msg_unread->unread;
		
	}
	public function index(){
	  redirect(base_url()."admin/cities"); 
	} 
 
	public function logout(){
	
		/* $this->session->set_userdata('ADMIN_ISLOGIN', 0);
		$this->session->set_userdata('USER','');	  */
		$this->session->sess_destroy();
		redirect(base_url().'adminlogin');
	} 
	public function cities(){
	
		$data["cities"] = $this->commonmodel->cities();
		
		$this->load->view('admin/header');
		$this->load->view('admin/manage-cities', $data);
		$this->load->view('admin/footer');		
	}
	
	public function ajax_cities(){ 
  
		$cities = $this->commonmodel->cities(1);
		$option = '<option value="">All</option>';

		foreach( $cities as $row){
			$option .= '<option value="'.$row->name.'">'.$row->name.'</option>';
		}

		echo '<select id="head_cities">'.$option.'</options>'; 
	}
	
	public function changeCities(){
		
		$id = $this->input->post("id");
		 
		$set["hidden"] = $this->input->post("s");
	 
		$this->db->where("id",$id);
			
		$this->db->update("cities", $set);
		
	}	
	
	public function createCity(){
		
		$set["name"] = $this->input->post("city-name");
		if( $set["name"] != "" ){
			if( $this->db->insert("cities", $set) ){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}
	}
	
	public function business(){
		
		$data["cities"] = $this->commonmodel->cities(1);
		$sql = "SELECT store_id_old.*, cities.name AS 'city_name' 
				FROM store_id_old
				LEFT OUTER JOIN cities ON cities.id = store_id_old.City_ID
				WHERE cities.hidden = 0
				ORDER BY cities.name ASC ";
		
		$query = $this->db->query($sql)->result();
		
		$business = array();
		
		foreach( $query as $row ){
			$business[$row->city_name][] = $row;
		} 
		 
		$data["business"] = $business;
		 
		 
		$this->load->view('admin/header');
		$this->load->view('admin/manage-business',$data);
		$this->load->view('admin/footer');	
	}	
	
	public function featureBusiness(){
		
		$id = $this->input->post("id");
		
	
		if( $this->input->post("s") == 0){
			$set["featured_city"] = 1;
		}else{
			$set["featured_city"] = 0;
		}	

		$this->db->where("id",$id);
			
		$this->db->update("store_id_old", $set);
		
	}

	public function businessmanager(){
		 
		$this->db->join("cities", "cities.id = distributor_info.city_id");
		$data["distributors"] = $this->db->get("distributor_info")->result();
		$this->load->view('admin/header');
		$this->load->view('admin/business-manager',$data);
		$this->load->view('admin/footer');			
	}
	
	public function businessmanager_update(){
		
		$id = $this->uri->segment(3);
		$data["cities"] = $this->commonmodel->cities_dp(1);
		
		$this->db->where("dist_id", $id);
		$this->db->where("card_type", 'RC');
		$data["card"] = $this->db->get("card_info")->result();
		
		$this->db->where("dist_id", $id );
		$this->db->join("cities", "cities.id = distributor_info.city_id");
		$data["dist"] = $this->db->get("distributor_info")->row();
		
		$data["categories"] = $this->commonmodel->categories_dp();
		 
		$data["stores"]	= $this->db->get_where('store_info', array('category_id'=>$data["dist"]->category_id, 'isactive'=>1))->result();
		//print_r($data["stores"]);
		 
		$this->load->view('admin/header');
		$this->load->view('admin/business-manager-edit',$data);
		$this->load->view('admin/footer');		
	}
	
	public function ajax_businessmanager_exclusivestores(){
		
		$url = $this->input->post('url');
		
		$stores = $this->db->get_where('distributor_exclusive_stores', array('url'=>$url) );
		
		if($stores->num_rows() == 0){
		
			$set['url'] = $this->input->post('url');
			$set['category_id'] = $this->input->post('category_id');
			$this->db->insert('distributor_exclusive_stores', $set);
			
			$stores = $this->db->get_where('distributor_exclusive_stores', array('url'=>$url) );
			
		}		
		$stores = $stores->row();
		  
		$store_ids = implode(',',$this->input->post("exclusivestores"));
		 
		$this->db->where('url', $url); 
		$set1['stores'] = $store_ids;
		
		$set1['dateupdated'] = date('Y-m-d H:i:s');
		if( $stores->category_id == '' OR $stores->category_id == 0){
			$set1['category_id'] =$this->input->post('category_id');	
		}
		
		$this->db->update('distributor_exclusive_stores', $set1);
	}
	
	public function businessmanager_add(){
		
	 
		$data["cities"] = $this->commonmodel->cities_dp(1);
		$data["categories"] = $this->commonmodel->categories_dp();
		/* $this->db->where("dist_id", $id);
		$data["card"] = $this->db->get("card_info")->result(); */
		 
	
		$this->load->view('admin/header');
		$this->load->view('admin/business-manager-add',$data);
		$this->load->view('admin/footer');		
	}	
	
	public function businessmanager_view(){
		
		$id = $this->uri->segment(3);
		
		$this->db->where("dist_id", $id);
		$data["card"] = $this->db->get("card_info")->result();
 
		$this->db->where("dist_id", $id );
		$this->db->join("cities", "cities.id = distributor_info.city_id");
		$data["dist"] = $this->db->get("distributor_info")->row();
	
		$this->load->view('admin/header');
		$this->load->view('admin/business-manager-view',$data);
		$this->load->view('admin/footer');	
		
	}
	
	public function businessmanager_update_basic(){
		
		$json = array("status"=>false, 
					"txt"=>'', "bmstatus"=>$this->input->post("bmstatus"),
					"id"=>'');
		
		$set["company_name"] 	= $this->input->post("company_name");
		$set["first_name"] 		= $this->input->post("first_name");
		$set["last_name"] 		= $this->input->post("last_name");
		$set["address"] 		= $this->input->post("address");
		$set["postal_code"] 	= $this->input->post("postal_code");
		$set["phone"] 			= $this->input->post("phone");
		$set["city_id"] 		= $this->input->post("city_id");
		$set["email"] 			= $this->input->post("email");
		$set["website"] 		= $this->input->post("website");
		$set["category_id"] 	= $this->input->post("category_id");
		
		if( isset($_POST['points_earner']) ){ 
			$set["points_earner"] 	= 1;
		}else{
			$set["points_earner"] 	= 0;
		}
		
		
		if( $this->input->post("bmstatus") == "update" ){

			$this->db->where("dist_id", $this->input->post("id") );	  
		if( $this->db->update("distributor_info", $set) ){
				$json["id"] = $this->input->post("id");
				$json["status"] = true;
				$json["txt"] = "Updated Successfully";
			} 	
		}		
		
		if( $this->input->post("bmstatus") == "new" ){
			if( $this->db->insert("distributor_info", $set) ){
				$json["status"] = true;
				$json["id"] = $this->db->insert_id();
				$json["txt"] = "Distributor was successfully created";
			} 	
		}

		echo json_encode($json);
		
	}
	
	/* public function businessmanager_upload_image(){
		
		$data = array('status'=>false,
					   'msg'=>'');
 
		$filename = "";
		
		$ext 	= pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
		$type 	= $this->input->post("type");
		$id 	= $this->input->post("id");
		$config['file_name']  		= $id.".".$ext;
		
		if(  $type == "card_image" ){
			$config['upload_path'] 		= './files/distributor/card/';
			$filename 					= "files/distributor/card/".$config['file_name'];
			 
		}	
		if(  $type == "banner_image" ) {
			$config['upload_path'] 		= './files/distributor/banner/'; 
			$filename		 			= "files/distributor/banner/".$config['file_name'];
		}
		
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']			= '1000';
		$config['max_width']  		= '1024';
		$config['max_height']  		= '768';
		$config['overwrite']  		= TRUE;
		
		//print_r($config);
		
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload("image") ) {			
			redirect(base_url()."admin/businessmanager_update/". $this->input->post("id")); 
			//echo  $this->upload->display_errors();
		}else{
			
			
			$set[$type] = $filename;
			$this->db->where("dist_id", $this->input->post("id") );	 
			if( $this->db->update("distributor_info", $set) ){
				redirect(base_url()."admin/businessmanager_update/". $this->input->post("id")); 
			}
			
		} 
	} */
	
	public function businessmanager_update_cardinfo(){
		$set["card_type"] 	= $this->input->post("type");
		$set["card_start"] 			= $this->input->post("start");
		$set["card_end"] 			= $this->input->post("end");
		$set["card_url"] 			= $this->input->post("url");
		$set["reset_after_usage"] 	= $this->input->post("reset"); 
		$set["card_value"] 			= $this->input->post("val");
		
		$this->db->where("card_id",  $this->input->post("id"));
		if( $this->db->update("card_info", $set) ){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	public function businessmanager_delete_cardinfo(){
		
		$this->db->where('card_id',  $this->input->post("id"));
		
		if( $this->db->delete("card_info") ){
			echo 1;
		}else{
			echo 0;
		}		
	}
	
	public function businessmanager_create_cardinfo(){
	
		$set["card_type"] 			= $this->input->post("type");
		$set["card_start"] 			= $this->input->post("start");
		$set["card_end"] 			= $this->input->post("end");
		$set["card_url"] 			= $this->input->post("url");
		$set["reset_after_usage"] 	= $this->input->post("reset"); 
		$set["card_value"] 			= $this->input->post("val");
		$set["dist_id"] 			= $this->input->post("id");
		 
		if( $this->db->insert("card_info", $set) ){
			echo 1;
		}else{
			echo 0;
		}
	}	
	
	public function businessmanager_cards_upload(){
	
		
		$this->load->library('upload');
		 
		$config['upload_path'] 		= './files/distributor/cards/';		 
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']			= '1000';
		$config['max_width']  		= '1024';
		$config['max_height']  		= '768';
		$config['overwrite']  		= TRUE; 
		
		if (!empty($_FILES['userfile_1']['name']))  {
 
			$ext 	= pathinfo($_FILES['userfile_1']['name'], PATHINFO_EXTENSION);
			$type 	= $this->input->post("type");
			$id 	= $this->input->post("id");
			$config['file_name']  		= $id."_1.".$ext;
			$filename = "files/distributor/cards/".$config['file_name'];
			
            $this->upload->initialize($config); 
            if ($this->upload->do_upload('userfile_1')) {
                //$data = $this->upload->data();
				$set["slider_image1"] = $filename;
				$this->db->where("card_id", $this->input->post("id") );	 
				$this->db->update("card_info", $set);				
            }
            else {
                echo $this->upload->display_errors();
            }
 
        }
		
		if (!empty($_FILES['userfile_2']['name']))  {
 
			$ext 	= pathinfo($_FILES['userfile_2']['name'], PATHINFO_EXTENSION);
			$type 	= $this->input->post("type");
			$id 	= $this->input->post("id");
			$config['file_name']  		= $id."_2.".$ext;
			$filename = "files/distributor/cards/".$config['file_name'];
			
            $this->upload->initialize($config); 
            if ($this->upload->do_upload('userfile_2')) {
                //$data = $this->upload->data();
				$set["slider_image2"] = $filename;
				$this->db->where("card_id", $this->input->post("id") );	 
				$this->db->update("card_info", $set);				
            }
            else {
                echo $this->upload->display_errors();
            }
 
        }

		if (!empty($_FILES['userfile_3']['name']))  {
 
			$ext 	= pathinfo($_FILES['userfile_3']['name'], PATHINFO_EXTENSION);
			$type 	= $this->input->post("type");
			$id 	= $this->input->post("id");
			$config['file_name']  		= $id."_3.".$ext;
			$filename = "files/distributor/cards/".$config['file_name'];
			
            $this->upload->initialize($config); 
            if ($this->upload->do_upload('userfile_3')) {
                //$data = $this->upload->data();
				$set["slider_image3"] = $filename;
				$this->db->where("card_id", $this->input->post("id") );	 
				$this->db->update("card_info", $set);				
            }
            else {
                echo $this->upload->display_errors();
            }
 
        }

		if (!empty($_FILES['userfile_4']['name']))  {
 
			$ext 	= pathinfo($_FILES['userfile_4']['name'], PATHINFO_EXTENSION);
			$type 	= $this->input->post("type");
			$id 	= $this->input->post("id");
			$config['file_name']  		= $id."_4.".$ext;
			$filename = "files/distributor/cards/".$config['file_name'];
			
            $this->upload->initialize($config); 
            if ($this->upload->do_upload('userfile_4')) {
                //$data = $this->upload->data();
				$set["slider_image4"] = $filename;
				$this->db->where("card_id", $this->input->post("id") );	 
				$this->db->update("card_info", $set);				
            }
            else {
                echo $this->upload->display_errors();
            }
 
        }

		if (!empty($_FILES['userfile_5']['name']))  {
			
			$config['upload_path'] 		= './files/distributor/banners/';				
			$ext 	= pathinfo($_FILES['userfile_5']['name'], PATHINFO_EXTENSION);
			$type 	= $this->input->post("type");
			$id 	= $this->input->post("id");
			$config['file_name']  		= $id."_banner.".$ext;
			$filename = "files/distributor/banners/".$config['file_name'];
			
            $this->upload->initialize($config); 
            if ($this->upload->do_upload('userfile_5')) {
                
				$set["card_image"] = $filename;
				$this->db->where("card_id", $this->input->post("id") );	 
				$this->db->update("card_info", $set);				
            }
            else {
                echo $this->upload->display_errors();
            }
 
        }		

		//redirect(base_url()."admin/businessmanager_update/". $this->input->post("dist_id")."/".strtotime("now")."".rand(1,100)); 	
	}
	
	public function businessmanager_howitworks(){
	
		$id = $this->uri->segment(3);
		
		if( $_POST  AND ($_POST["submit"] ==  "Save") ){
			
			$set["text1"] = $this->input->post("text1");
			$set["text2"] = $this->input->post("text2");
			$set["text3"] = $this->input->post("text3");
			$set["text4"] = $this->input->post("text4");
			$set["text5"] = $this->input->post("text5");
			$set["text6"] = $this->input->post("text6");
			$set["terms"] = $this->input->post("terms"); 
			
			$dist_id = $this->input->post("dist_id");
			$res = $this->db->get_where("howitowrks", array("dist_id"=>$dist_id));
			if( $res->num_rows() > 0 ){
				$this->db->where("dist_id", $dist_id);
				$this->db->update("howitowrks", $set);
			}else{
				$set["dist_id"] = $dist_id; 
				$this->db->insert("howitowrks", $set);
			}
		}
		
		
		$data["dist_id"]	= $id;
		$this->db->select("howitowrks.*, distributor_info.company_name");
		$this->db->join("howitowrks", "howitowrks.dist_id = distributor_info.dist_id", " LEFT OUTER ");	
		$data["row"] = $this->db->get_where("distributor_info", array("distributor_info.dist_id"=>$id))->row(); 
		 
		
		$this->load->view('admin/header');
		$this->load->view("admin/business-manager-howitworks", $data);		 
		$this->load->view('admin/footer');		
				
	}
	
	public function storemanager_new(){
		
		
		$this->load->library('form_validation');
		$this->load->library('upload');
		
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		$this->form_validation->set_rules('city_id', 'City', 'required');
		$this->form_validation->set_rules('category_id', 'Category', 'required'); 
		$this->form_validation->set_rules('address', 'Address', '');		
		$this->form_validation->set_rules('phone', 'Phone', 'required');		
		$this->form_validation->set_rules('postal_code', 'Postal Code', 'required');		
		$this->form_validation->set_rules('email', 'Email', 'valid_email');		
		$this->form_validation->set_rules('contact_name', 'Contact Name', 'trim');		
		$this->form_validation->set_rules('website', 'Website', 'trim');		
		$this->form_validation->set_rules('discount', 'Discount', 'trim');		
		$this->form_validation->set_rules('facebook_link', 'Facebook', 'trim');		
		$this->form_validation->set_rules('twitter_link', 'Twitter', 'trim');		
		$this->form_validation->set_rules('offer_details', 'Offer Details', 'trim');		
		$this->form_validation->set_rules('fine_print', 'Fine Print', 'trim');		
		$this->form_validation->set_rules('google_map_lat_long', 'Google Map Lat Long', 'trim');	 	
		$this->form_validation->set_rules('featured_big_banner', 'Featured Big Banner', '');	 	
		$this->form_validation->set_rules('featured_short_desc', 'Featured Short Description', 'trim');	 	
		
		if($this->form_validation->run() ){
			
			$set["company_name"] 	= $this->input->post("company_name");
			$set["city_id"] 		= $this->input->post("city_id");
			$set["category_id"] 	= $this->input->post("category_id");
			$set["address"] 		= $this->input->post("address");
			$set["phone"] 			= $this->input->post("phone");
			$set["postal_code"] 	= $this->input->post("postal_code");
			$set["email"] 			= $this->input->post("email");
			$set["website"] 		= $this->input->post("website");
			$set["facebook_link"] 	= $this->input->post("facebook_link");
			$set["twitter_link"] 	= $this->input->post("twitter_link");
			$set["discount"] 		= $this->input->post("discount");
			$set["p_points"] 		= $this->input->post("p_points");
			$set["p_value"] 		= $this->input->post("p_value");			
			$set["offer_details"] 	= $this->input->post("offer_details");
			$set["fine_print"] 		= $this->input->post("fine_print");
			$set["google_map_lat_long"] = $this->input->post("google_map_lat_long");			 
			
			if( isset($_POST["featured_big_banner"]) ){
				$set["featured_big_banner"] = 1;
			}else{
				$set["featured_big_banner"] = 0;
			}
			$set["featured_short_desc"] = $this->input->post("featured_short_desc");
			
			if( $this->db->insert("store_info", $set) ){
			
				$id = $this->db->insert_id();
				 
				 
				$config['upload_path'] 		= './files/store/';		 
				$config['allowed_types'] 	= 'gif|jpg|png';
				$config['max_size']			= '1000';
				$config['max_width']  		= '1024';
				$config['max_height']  		= '768';
				$config['overwrite']  		= TRUE; 			
				
				if (!empty($_FILES['logo']['name']))  {
		 
					$ext 	= pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
					 
					$config['file_name']  		= $id."_logo.".$ext;
					$filename = "files/store/".$config['file_name'];
					
					$this->upload->initialize($config); 
					
					if ($this->upload->do_upload('logo')) {					 
						$set["logo"] = $filename; 
					}
					else {
						echo $this->upload->display_errors();
					}
		 
				} 			

				if (!empty($_FILES['small_banner']['name']))  {
		 
					$ext 	= pathinfo($_FILES['small_banner']['name'], PATHINFO_EXTENSION);
					
					$config['file_name']  		= $id."_small_banner.".$ext;
					$filename = "files/store/".$config['file_name'];
					
					$this->upload->initialize($config); 
					if ($this->upload->do_upload('small_banner')) {					 
						$set["small_banner"] = $filename; 
					}
					else {
						echo $this->upload->display_errors();
					}
		 
				}
				
				if (!empty($_FILES['large_banner']['name']))  {
		 
					$ext 	= pathinfo($_FILES['large_banner']['name'], PATHINFO_EXTENSION);
					 
					
					$config['file_name']  		= $id."_large_banner.".$ext;
					$filename = "files/store/".$config['file_name'];
					
					$this->upload->initialize($config); 
					if ($this->upload->do_upload('large_banner')) {					 
						$set["large_banner"] = $filename; 
					}
					else {
						echo $this->upload->display_errors();
					}
		 
				}

				$this->db->where("id", $id);	
				$this->db->update("store_info", $set);		

				redirect(base_url()."admin/storemanager_update/".$id);		
			}
			
			
		}
		
		
		$this->load->model("midasmodel");
		$data["cities"] = $this->commonmodel->cities_dp(1);
		$data["categories"] = $this->commonmodel->categories_dp(true);

		
		$this->load->view('admin/header');
		$this->load->view('admin/store-manager-new',$data);
		$this->load->view('admin/footer');		
		
	}	
	public function storemanager(){
		$data = "";
		
		//$this->db->where('isactive', 1);
		$this->db->select("store_info.*, cities.name as city_name");
		$this->db->join("cities", "cities.id=store_info.city_id");
		$this->db->order_by('company_name asc, isactive asc');
		$data["stores"] = $this->db->get("store_info");
		$this->load->view('admin/header');
		$this->load->view('admin/store-manager',$data);
		$this->load->view('admin/footer');		
	}
	
	public function ajax_storemanager_update_isactive(){
		
		$json = array('status'=>false, 'msg'=>''); 
		
		if( $this->input->post('i') != '' ){
			
			$this->db->where('id', $this->input->post('i'));
			$this->db->set('isactive', $this->input->post('v'));
			if( $this->db->update('store_info') ){
				$json['status'] = true;
				$json['msg'] = 'Successfully Updated';
			}
			
		}
		
		echo json_encode($json);
	}
	
	public function storemanager_update(){
		$id = $this->uri->segment(3);
		
		if( $_POST ){
		
			$id 	= $this->input->post("id");
			
			$set["company_name"] 	= $this->input->post("company_name");
			$set["city_id"] 		= $this->input->post("city_id");
			$set["category_id"] 	= $this->input->post("category_id");
			$set["address"] 		= $this->input->post("address");
			$set["phone"] 			= $this->input->post("phone");
			$set["postal_code"] 	= $this->input->post("postal_code");
			$set["email"] 			= $this->input->post("email");
			$set["contact_name"] 	= $this->input->post("contact_name");
			$set["website"] 		= $this->input->post("website");
			$set["facebook_link"] 	= $this->input->post("facebook_link");
			$set["twitter_link"] 	= $this->input->post("twitter_link");
			$set["discount"] 		= $this->input->post("discount");
			$set["p_points"] 		= $this->input->post("p_points");
			$set["p_value"] 		= $this->input->post("p_value");
			$set["offer_details"] 	= $this->input->post("offer_details");
			$set["fine_print"] 		= $this->input->post("fine_print");
			$set["google_map_lat_long"] = $this->input->post("google_map_lat_long");
			if( isset($_POST["featured_big_banner"]) ){
				$set["featured_big_banner"] = 1;
			}else{
				$set["featured_big_banner"] = 0;
			}
			$set["featured_short_desc"] = $this->input->post("featured_short_desc");
			

			$this->load->library('upload');
			 
			$config['upload_path'] 		= './files/store/';		 
			$config['allowed_types'] 	= 'gif|jpg|png';
			$config['max_size']			= '1000';
			$config['max_width']  		= '1024';
			$config['max_height']  		= '768';
			$config['overwrite']  		= TRUE; 			
			
			if (!empty($_FILES['logo']['name']))  {
	 
				$ext 	= pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
				 
				$config['file_name']  		= $id."_logo.".$ext;
				$filename = "files/store/".$config['file_name'];
				
				$this->upload->initialize($config); 
				
				if ($this->upload->do_upload('logo')) {					 
					$set["logo"] = $filename; 
				}
				else {
					echo $this->upload->display_errors();
				}
	 
			} 			

			if (!empty($_FILES['small_banner']['name']))  {
	 
				$ext 	= pathinfo($_FILES['small_banner']['name'], PATHINFO_EXTENSION);
				
				$config['file_name']  		= $id."_small_banner.".$ext;
				$filename = "files/store/".$config['file_name'];
				
				$this->upload->initialize($config); 
				if ($this->upload->do_upload('small_banner')) {					 
					$set["small_banner"] = $filename; 
				}
				else {
					echo $this->upload->display_errors();
				}
	 
			}
			
			if (!empty($_FILES['large_banner']['name']))  {
	 
				$ext 	= pathinfo($_FILES['large_banner']['name'], PATHINFO_EXTENSION);
				 
				
				$config['file_name']  		= $id."_large_banner.".$ext;
				$filename = "files/store/".$config['file_name'];
				
				$this->upload->initialize($config); 
				if ($this->upload->do_upload('large_banner')) {					 
					$set["large_banner"] = $filename; 
				}
				else {
					echo $this->upload->display_errors();
				}
	 
			}

			$this->db->where("id", $id);	
			$this->db->update("store_info", $set);
			
			redirect(base_url()."admin/storemanager_update/". $id."/".strtotime("now")."".rand(1,100)); 	
		}
		
		$this->load->model("midasmodel");
		
		$data["cities"] = $this->commonmodel->cities_dp(1);
		$data["categories"] = $this->commonmodel->categories_dp(true);
		$data["store_city_link"] = $this->midasmodel->stores_city_link($id);
		$data["store_category_link"] = $this->midasmodel->store_category_link($id);
		$data["store_deals"] = $this->midasmodel->store_deals($id);
		
		$this->db->where("id", $id ); 
		$data["store"] = $this->db->get("store_info")->row();	 
		
		$this->load->view('admin/header');
		$this->load->view('admin/store-manager-edit',$data);
		$this->load->view('admin/footer');			
	}
	
	public function storemanager_view(){
	
		$id = $this->uri->segment(3);
		
		$this->db->where("store_info.id", $id ); 		
		$this->db->select("store_info.*, cities.name as city_name, categories.name as category_name" );
		$this->db->join("cities", "cities.id=store_info.city_id");		
		$this->db->join("categories", "categories.category_id=store_info.category_id");		
		$data["store"] = $this->db->get("store_info")->row();
		
		
		$this->load->view('admin/header');
		$this->load->view('admin/store-manager-view',$data);
		$this->load->view('admin/footer');			
	}

	public function storemanager_update_featured(){
		
		$id = $this->input->post("id");	
		$value = $this->input->post("value");	
		
		$set["featured"] = $value;		
		$this->db->where("id",$id);
		if( $this->db->update("store_info", $set)) echo 1;
		else echo 0;
	}
	
	public function store_city_list_featured_update(){
		
		//print_r($_POST);
		$store_id 	=	$this->input->post("storeid");
		$link_id 	=	$this->input->post("linkid");
		$city_id 	=	$this->input->post("cityid");
		$type		=	$this->input->post("type");
		$value		=	$this->input->post("val");
		
		$where["store_id"] 	= $store_id;
		$where["city_id"] 	= $city_id; 
		
		$type_cap = "";	
		if( $type == "l" ){
			$type_cap	= "islist";
		}else{
			$type_cap	= "isfeatured";
		}
			
		$this->db->where($where); 
		$res = $this->db->get("store_city_link");
		 
		if( $res->num_rows() > 0){
			
			$this->db->where($where);
			 
			$set[$type_cap] 	= $value; 
			$this->db->update("store_city_link",$set );
		}else{
			//store,city not exist yet
			$set["store_id"] 	= $store_id;
			$set["city_id"] 	= $city_id; 
			$set[$type_cap] 	= $value; 
			$this->db->insert("store_city_link",$set );				
		}
 
	}
	
	public function store_category_list_active(){
		
		$store_id 		=	$this->input->post("storeid");		 
		$category_id 	=	$this->input->post("categoryid");
		$value			=	$this->input->post("val");
		
		$where["store_id"] 		= $store_id;
		$where["category_id"] 	= $category_id; 		
		$this->db->where($where);
		$res = $this->db->get("store_category_link");
		
		if( $res->num_rows() > 0){
			$this->db->where($where);			 
			$set["active"] 	= $value; 
			$this->db->update("store_category_link",$set );
			
		}else{
			$set["store_id"] 	= $store_id;
			$set["category_id"] = $category_id; 
			$set["active"] 		= $value; 
			$this->db->insert("store_category_link",$set );				
		}
	}
	
	public function store_update_cardpal_option(){
		
		$store_id = $this->input->post("id");
		$type = $this->input->post("t");
		$val = $this->input->post("v");
		
		$json = array('status'=>false);
		$set = '';
		if( $type=='gc'){
			$set["cp_show_gc"] = $val;
		}else if( $type=='rc'){
			$set["cp_show_rc"] = $val;
		}else if( $type=='reg'){
			$set["cp_show_reg"] = $val;
		}else{
		
		}
		
		$this->db->where("id", $store_id);
		if( $this->db->update('store_info', $set) ){
			$json['status'] = true;
		}
		
		echo json_encode($json);
	}
	
	public function cardmanager(){
		$data = "";
		$this->db->select("card_id, card_start, card_end, distributor_info.dist_id, distributor_info.email as dist_email, company_name,first_name,last_name, card_type, card_url,is_page, cities.name as city_name");
		$this->db->join("distributor_info", "distributor_info.dist_id = card_info.dist_id");
		$this->db->join("cities", "cities.id=distributor_info.city_id");
		$data["stores"] = $this->db->get("card_info");
		$this->load->view('admin/header');
		$this->load->view('admin/card-manager',$data);
		$this->load->view('admin/footer');		
	}
	
	public function cardmanager_edit(){
		
		$id = $this->uri->segment(3);
		
		if( $_POST ){
			
			$this->load->model("adminmodel"); 
			
			$this->adminmodel->card_save();
		}
		 
		$this->db->where("card_id", $id ); 			
		$this->db->select("card_info.*, distributor_info.first_name, distributor_info.last_name, company_name, cities.name AS city_name");
		$this->db->join("distributor_info", "distributor_info.dist_id = card_info.dist_id");
		$this->db->join("cities", "cities.id=distributor_info.city_id");	
		$data["cards"] = $this->db->get("card_info")->row();	
		//$data["distributors"] = $this->commonmodel->distributor_dp(true);
		$this->load->view('admin/header');
		$this->load->view('admin/card-manager-edit',$data);
		$this->load->view('admin/footer');				
	}
	
	public function cardmanager_new(){
		 
		if( $_POST ){
			
			$this->load->model("adminmodel"); 
			
			$this->adminmodel->card_save();
		}
		 
 	
		$data["distributors"] = $this->commonmodel->distributor_dp(true);
		$this->load->view('admin/header');
		$this->load->view('admin/card-manager-new',$data);
		$this->load->view('admin/footer');				
	}	
	
	public function createpage(){
		
		$res["status"] = false;  
		$res["txt"] = "Failed to create page"; 
		
		$id = $this->input->post("id");
		$val = $this->input->post("v");
		
		$set["is_page"] = $val;		
		$this->db->where("card_id", $id);
		if( $this->db->update("card_info", $set) ){
			$this->commonmodel->save_routes();	
			
			$res["status"] 	= true;
			
			if( $val ) $res["txt"] 	= "Page is successfully created";
			else $res["txt"] 	= "Page is successfully remove";
		} 
		echo json_encode($res);
	}
	
	public function cardholders(){
		$data = '';
		
		$data["registered"] = $this->db->query("SELECT COUNT(*) AS num, SUM(IF(CONFIRM_CODE,1,0)) AS confirm
												FROM card_holders
												LEFT OUTER JOIN operator_user_info ON operator_user_info.Username = card_holders.register_operator
												LEFT OUTER JOIN store_info ON store_info.id = operator_user_info.Store_ID
												WHERE CARD_TYPE = 'RC'")->row();	

		$data["gender"] 	= $this->db->query("SELECT SUM(IF(GENDER='M',1,0)) AS Male, SUM(IF(GENDER='F',1,0)) AS Female FROM card_holders WHERE CARD_TYPE = 'RC' ")->row();
		
		$data["cities"] 	= $this->db->query("SELECT  cities.name, COUNT(card_holders.id)  AS 'num'
												FROM card_holders
												LEFT OUTER JOIN cities ON cities.id = card_holders.CITY_ID
												WHERE CARD_TYPE = 'RC'
												GROUP BY card_holders.city_id 
												ORDER BY num DESC ")->result();	
												
		$data["total_sales"]= $this->db->query("SELECT  distributor_info.company_name, distributor_info.first_name , COUNT(*) AS total
												FROM card_holder_activity_info
												LEFT OUTER JOIN card_holders ON card_holders.CARD_ID = card_holder_activity_info.Card_ID 
												LEFT OUTER JOIN distributor_info ON distributor_info.dist_id = card_holders.Distributer_Id 
												WHERE  CARD_TYPE = 'RC'
												GROUP BY card_holders.Distributer_Id 
												ORDER BY total DESC  ")->result();													
		 
		$this->load->view('admin/header');
		$this->load->view('admin/cardholder-manager',$data);
		$this->load->view('admin/footer');	
	
	}
	
	public function ajax_cardholders(){
		$this->load->model("adminmodel"); 
		$this->adminmodel->getRegisteredCardMembers();
	}
	
	public function exportcardholders(){
	
		$this->db->select("CREATE_DATE, 
			CARD_ID, 
			card_balance, 
			cities.name as city_name, 
			FIRSTNAME, 
			card_holders.EMAIL, 
			card_holders.PHONE, 
			GENDER, 
			IF(`CONFIRMED`, 'Yes','No') as CONFIRMED, 
			IF(`ACTIVE`, 'Yes','No') as ACTIVE, 
			company_name, 
			CREATE_DATE, 
			register_operator",false );		
		$this->db->join("distributor_info", "distributor_info.dist_id = card_holders.Distributer_Id");
		$this->db->join("cities", "cities.id=card_holders.city_id");	
		$this->db->where('CARD_TYPE', 'RC');
		$this->db->order_by('CREATE_DATE', 'DESC');
		$data = $this->db->get("card_holders")->result();
		
		//exporting
		$this->load->library("ExportDataExcel"); 
		
		$excel = new ExportDataExcel('browser');
		$excel->filename = "Registered_Card_Members_".strtotime(date('Y-m-d H:i:s')).".xls";
  
		$excel->initialize();
		$header = array('DATE', 'CARD ID', 'POINTS', 'CITY', 'NAME', 'EMAIL', 'PHONE', 'GENDER', 'CONFIRMED', 'ACTIVE', 'DISTRIBUTOR', 'OPERATOR');
		$excel->addRow($header);
		foreach($data as $row) {
			$excel->addRow($row);
		}
		$excel->finalize();
	}
	
	public function operators(){
	
		$data = '';
		
		$this->db->select("operator_user_info.*, store_info.company_name, store_info.address");
		$this->db->join("store_info", "store_info.id = operator_user_info.Store_ID");
		$this->db->where("Role", "s");
		$data["operators"] = $this->db->get("operator_user_info")->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/store-operator-manager',$data);
		$this->load->view('admin/footer');			
	}
	public function operators_admin(){
		$data = '';
		
		$this->db->select("operator_user_info.*,distributor_info.company_name");
		$this->db->join("distributor_info", "distributor_info.dist_id = operator_user_info.Distributor_ID");
		$this->db->where("Role", "d");
		$data["operators"] = $this->db->get("operator_user_info")->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/store-operator-manager-admin',$data);
		$this->load->view('admin/footer');				
	}
	
	public function operators_edit(){
		$id = $this->uri->segment(4);
		$new_type = $this->uri->segment(3);
		if( $_POST ){
			if( $new_type == 'admin' ){
				$set["Distributor_ID"] = $this->input->post("Store_ID");
			}else{
				$set["Store_ID"] = $this->input->post("Store_ID");
			}
			$set["fullname"] = $this->input->post("fullname");
			$set["Active"] = $this->input->post("Status");
			$set["Password"] = md5($this->input->post("password")); 
			$set["Gender"] =$this->input->post("gender"); 
			$set["email"] =$this->input->post("email"); 
			$this->db->where("ID",$this->input->post("id") );
			
			if( $this->db->update("operator_user_info", $set) ){
				if( $new_type == 'admin' ){
					redirect(base_url()."admin/operators_admin");
				}else{
					redirect(base_url()."admin/operators");
				}
			}
		}
		
		$data = '';
		
		
		//$data["stores"] = $this->db->get("store_info")->result();
		 
		if( $new_type == 'admin' ){
			$this->db->select("dist_id as id, company_name,  first_name,last_name");
			$data["stores"] = $this->db->get("distributor_info")->result();
		}else{
			$this->db->order_by("company_name","asc");
			$data["stores"] = $this->db->get("store_info")->result();
		}		 
		 
		$data["operators"] = $this->db->get_where("operator_user_info", array("ID"=>$id))->row();
		
		$this->load->view('admin/header');
		$this->load->view('admin/store-operator-manager-edit',$data);
		$this->load->view('admin/footer');			
	}	
	
	public function operators_new(){
	 

		$this->load->library('form_validation'); 
		
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]|is_unique[operator_user_info.username]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('Store_ID', 'Store', 'required');
		$this->form_validation->set_rules('fullname', 'Name', 'trim|required');
		$this->form_validation->set_rules('Status', 'Status', ''); 	 
		$this->form_validation->set_rules('gender', 'Gender', ''); 	 
		
		$new_type = $this->uri->segment(3);
	 
		if($this->form_validation->run() ){
			if( $new_type == 'admin' ){
				$set["Distributor_ID"] = $this->input->post("Store_ID");
				$set["Role"] = 'd';
			}else{
				$set["Store_ID"] = $this->input->post("Store_ID");
				$set["Role"] = 's';
			}
			$set["fullname"] = $this->input->post("fullname");
			$set["username"] = $this->input->post("username");
			$set["email"] = $this->input->post("email");
			$set["Active"] = $this->input->post("Status"); 
			$set["Password"] = md5($this->input->post("password")); 
			$set["Gender"] = $this->input->post("gender"); 
			
			if( $this->db->insert("operator_user_info", $set) ){
				if( $new_type == 'admin' ){
					redirect(base_url()."admin/operators_admin");
				}else{
					redirect(base_url()."admin/operators");
				}
			}
		}		
		
		$this->db->order_by("company_name","asc");
		 
		if( $new_type == 'admin' ){
			$this->db->select("dist_id as id, company_name,  first_name,last_name");
			$data["stores"] = $this->db->get("distributor_info")->result();
		}else{
			$data["stores"] = $this->db->get("store_info")->result();
		}
		
		$this->load->view('admin/header');
		$this->load->view('admin/store-operator-manager-new',$data);
		$this->load->view('admin/footer');		
	
	}
	
	public function resendemailverification(){
		$result = array("status"=>false, "text"=>'');
		$this->load->helper('string');
		$this->load->library('email');
		
		$card_id = $this->input->post("id");
		 
		$res_query = $this->db->get_where("card_holders", array("CARD_ID"=>$card_id))->row();		
		
		$res_query_url = $this->db->query("SELECT card_info.dist_id, card_url,company_name 
										FROM card_info 
										LEFT OUTER JOIN distributor_info ON distributor_info.dist_id = card_info.dist_id	
										WHERE ('".$card_id."' BETWEEN card_start AND card_end) 
										AND card_type = 'RC' ")->row();	
		
		//$res_query_url = $this->db->get_where("card_info", array("dist_id"=>$res_query->Distributer_Id))->row();
		 
		$confirmationcode 		= md5("'".$card_id."'");
		$set["CONFIRM_CODE"] 	= $confirmationcode;
		$password 				= random_string('alnum', 13);
		$set["PASSWORD"] 		= md5($password );		
		
		$this->db->where("CARD_ID",$card_id);
		if( $this->db->update("card_holders", $set) ){
		 
			$msgTpldata["name"] = $res_query->FIRSTNAME;
			$msgTpldata["card"] = $card_id;
			$msgTpldata["pass"] = $password;
			$msgTpldata["link"] = base_url().$res_query_url->card_url.'/verify/?c='.$card_id.'&vc='.$confirmationcode.'&hc='.$password.'&t='.strtotime('now');
			 
			$message = $this->load->view("midas/verification_email", $msgTpldata, true);
				
			$config['protocol'] = 'sendmail';
			$config['charset'] 	= "iso-8859-1";
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = "html";
			$config['newline'] 	= "\n";			 
			
			$this->email->initialize($config);   
			
			$from_name = (trim($res_query_url->company_name) != '')?$res_query_url->company_name:'Ricktag';
			$this->email->from($res_query_url->card_url.'-no-reply@ricktag.ca', $from_name);										
			$this->email->to( $res_query->EMAIL );
				
			/* $this->email->from('rbrooks@ricktag.ca', 'Ricktag');
			$this->email->to($res_query->EMAIL ); */
			
			//$this->email->cc('another@another-example.com');
			//$this->email->bcc('them@their-example.com');
			$this->email->message($message);
			$this->email->subject('Please complete your card registration');
			
			if( $this->email->send() ){		 
				$result['status'] 	= true;
				$result['text'] 	= "Resend Verification Successfully";
			}			
		
		}
		echo json_encode($result);
	}
	
	/*Store Multiple Deals*/
	function stores_deals_action(){
		$json = array('status'=>false,
					  'msg'=>'Failed');
		
		$action = $this->input->post("act");
		$id = $this->input->post("id");
		$val = trim($this->input->post("txt"));
		
		if( $action == "save" ){
			
			if( $val != '' ){ 
				
				$this->db->where("deals_id", $id);
				if( $this->db->update("store_deals", array("deals_text"=>$val, "date_updated"=>date("Y-m-d H:i:s"))) ){
					$json["status"]	= true;
					$json["msg"] = "Successfully updated";
				}
				
			}else{
				$json["msg"] = "Field must be empty";
			}
			
		}elseif( $action == "del"){
			
			if( $this->db->delete("store_deals", array("deals_id"=>$id)) ){
					$json["status"]	= true;
					$json["msg"] = "Successfully Deleted";				
			}
			
		}elseif( $action == "status"){	
		
				$this->db->where("deals_id", $id);
				if( $this->db->update("store_deals", array("deals_status"=>$val, "date_updated"=>date("Y-m-d H:i:s"))) ){
					$json["status"]	= true;
					$json["msg"] = "Successfully updated";
				}		
		}elseif( $action == "add"){
			
			if( $val != '' ){ 
				$set["deals_text"] = $val;
				$set["store_id"] = $id;
				
				if($this->db->insert("store_deals", $set)){
					$json["status"]	= true;
					$json["msg"] = "Successfully Added";						
					$json["id"] = $this->db->insert_id();						
				}
			}
			
		}else{
		
		}
		
		echo json_encode($json);
	}
	 
	public function carc(){
	  
		$this->load->view('admin/header');
		$this->load->view('admin/carc');
		$this->load->view('admin/footer');			
	}
	public function ajax_carc(){
		$this->load->model("adminmodel"); 
		$this->adminmodel->getCardActivityRC();
	}
	
	
	public function cagc(){
	  
		$this->load->view('admin/header');
		$this->load->view('admin/cagc');
		$this->load->view('admin/footer');			
	}
	public function ajax_cagc(){
		$this->load->model("adminmodel"); 
		$this->adminmodel->getCardActivityGC();
	}
	
	public function featured(){
		
		$this->db->order_by('company_name'); 
		$stores= $this->db->get('store_info')->result();  
		foreach($stores as $row){
			$data['stores'][$row->id] = $row;
		}
		
		$this->db->where('cities.hidden', 1);
		$this->db->select('cities.id, cities.name, featured_stores_in_city.stores, featured_stores_in_city.id as "feature_id", featured_stores_in_city.main_store');
		$this->db->join('featured_stores_in_city', 'featured_stores_in_city.city_id = cities.id', 'LEFT OUTER');
		$data['cities'] = $this->db->get("cities")->result();
		//echo $this->db->last_query();	
		
		$this->load->view('admin/header');
		$this->load->view('admin/featured_index', $data);
		$this->load->view('admin/footer');
	}	
	
	public function ajax_featured_stores(){
	
		 
		//$this->db->where('city_id', $this->input->post('center'));
		$this->db->where('isactive', 1);
		$this->db->order_by('company_name');
		$data['stores'] = $this->db->get('store_info')->result();
		
		$this->load->view('admin/featured_store_modal', $data);
	}
	
	public function ajax_featured_add_store(){
		$json = array('msg'=>'', 'status'=>false);
		$fstores = array();
		
		$store_id = $this->input->post('st'); 
		$city_id = $this->input->post('c');
		$this->db->where('city_id', $city_id);
		$fcities = $this->db->get('featured_stores_in_city')->row();
		
		if( count($fcities) == 0){
			 
			$this->db->insert('featured_stores_in_city', array('city_id'=>$city_id));//insert city featured_stores_in_city
			$this->db->flush_cache();
			$this->db->where('city_id', $city_id);
			$fcities = $this->db->get('featured_stores_in_city')->row();// re query
		}
		 
		if( $fcities->stores != '' )
			$fstores = explode(',',$fcities->stores); //extract the store to array
		
		if( !in_array($store_id, $fstores ) ){
		
			$fstores[] = $store_id;
			
			
			$new_stores = implode(',',$fstores); //add the new store
			
			$stores = implode(',',$fstores);
			
			$this->db->where('city_id', $city_id); 
			if( $this->db->update('featured_stores_in_city', array('stores'=>$stores)) ){
				$json['status'] 	= true;
				$json['msg'] 		= 'Successfully Added';
				$json['city_id']	= $city_id;
				
				$this->db->where('id', $store_id);
				$get_store = $this->db->get('store_info')->row();
				$json['store'] =
				'<li id="innerstore-'.$city_id.'_'.$store_id.'" class="ui-state-default innerstore ui-corner-left;" style="z-index: 5" >
				<img width="90" height="70" src="'.$get_store->logo.'" alt=" "> <br />
				<span><strong>'.$get_store->company_name.'</strong><hr />
				'.$get_store->address.'</span>
				</li>';		
			} 

		}else{
			$json['status'] = false;
			$json['msg'] = 'Store is already on list';
		}		
		echo json_encode($json);
	}
	
	public function ajax_featured_sort_store(){
		 
		foreach($_POST as $key=>$val){
			$id = explode('-',$key); $id = $id[1];
			$vals = implode(',',$val);
			
			$this->db->where('city_id', $id); 
			$this->db->update('featured_stores_in_city', array('stores'=>$vals));
		}
	}
	
	public function ajax_featured_makemain_store(){
	
		//print_r($_POST);
		
		$c = $this->input->post('c');
		$s = $this->input->post('s');
		
		$this->db->where('city_id', $c);
		$store = $this->db->get('featured_stores_in_city')->row();
		
		$stores = explode(',',$store->stores);
	 
		$stores = array_diff($stores, array($s));
		
		$stores = implode(',',$stores);
		
		$this->db->where('city_id', $c); 
		$this->db->update('featured_stores_in_city', array('stores'=>$stores, 'main_store'=>$s));
		
	}
	
	public function ajax_featured_remove_store(){
		$json = array('msg'=>'', 'status'=>false);
		
		if( $this->input->post('s') != '' ){
		
			$c = $this->input->post('c');
			$s = $this->input->post('s');
			
			$this->db->where('city_id', $c);
			$store = $this->db->get('featured_stores_in_city')->row();
			
			$stores = explode(',',$store->stores);
		 
			$stores = array_diff($stores, array($s));
			
			$stores = implode(',',$stores);
			
			$this->db->where('city_id', $c); 
			if( $this->db->update('featured_stores_in_city', array('stores'=>$stores)) ){
				$json['status'] = true;
			}else{
				$json['msg'] = 'Failed to remove';
			}
		}
		
		echo json_encode($json);
	}	

	public function messages(){
		
		$this->load->view('admin/header');
		$this->load->view('admin/messages/message_index');
		$this->load->view('admin/footer');		
	}
	
	public function ajax_messages(){
		$this->load->model("messagesmodel"); 
		$this->messagesmodel->getMessages();
	}
	
	public function viewmessage(){
	
		$mid = $this->uri->segment(3);
		$data['message'] = $this->db->get_where('message', array('mid'=>$mid))->row();		
		$data['reply'] = $this->db->get_where('message_reply',array('mid'=>$mid) )->result();
 		
		$set['admin_unread'] = 1; 
		$this->db->where('mid',$mid);
		$this->db->update('message_reply', $set);

		/* $op_res = $this->db->get('operator_user_info')->result();		
		$operator = array();
		foreach($op_res as $row ){
			$operator[$row->Username]= $row->fullname;
		}
		
		$data['operator'] = $operator; */
		
		$this->load->view('admin/header');
		$this->load->view('admin/messages/message_view', $data);
		$this->load->view('admin/footer');			
	}
	
	public function ajax_savereply(){
		$json = array('status'=>false, 'msg'=>'Reply Failed', 'status_email'=>false);
		$this->load->library('email');	
		
		if( $_POST ){ 
		 
			$mid = $this->input->post('m');
			
			$set['comment_text']= $this->input->post('Comment_Body');
			$set['mid'] 		= $mid;
			$set['op_id']		= $this->session->userdata("USERID_45");
			$set['op_user'] 	= $this->session->userdata("USER");
			$set['admin_unread']= 1; 
			$set['isAdmin']		= 1; 
			
			if( $this->db->insert('message_reply', $set) ){
				$mbc_id = $this->db->insert_id();
				
				$uset['date_updated'] = date('Y-m-d H:i:s');
				$this->db->where('mid', $mid);
				$this->db->update('message', $uset);
				
				$this->db->where('mid', $mid);
				$this->db->join('operator_user_info', 'operator_user_info.Username = message.op_user', 'LEFT OUTER');
				$ownerInfo = $this->db->get('message')->row();
			

				$config['protocol'] = 'sendmail';
				$config['charset'] 	= "iso-8859-1";
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = "html";
				$config['newline'] 	= "\n";			 
				
				$this->email->initialize($config);   
				 
				$this->email->from('rbrooks@ricktag.ca','Ricktag Customer Support');										
				$this->email->bcc('milez69roda@gmail.com');										
				//$this->email->from('milez69roda@gmail.com','Ricktag Client Support');										
				$this->email->to( $ownerInfo->email );
				 
				$message = "<p>Hello, ".$ownerInfo->fullname."</p><br />

<p>Please log into ".$ownerInfo->site." to check your message.</p> <br />
<p>Thank you,</p><br />
<p>Ricktag Client Support Team</p>";
				
				$this->email->message($message);
				$this->email->subject('Hello From Ricktag Support!');
				
				if( $this->email->send() ){		 
					$json['status_email'] 	= true;					
				}			
			 
				$set['op_date_created'] = date('Y-m-d H:i:s');
				
				$json['status'] = true;
				$json['mbc'] = $mbc_id;
				$json['msg'] = 'Your message was successfully sent';
			 
				$json['reply'] = '<li id="Comment_'.$mbc_id.'" class="Item Comment Alt" style="display:none">		
				   <div class="Comment">
						<div class="Meta">
							<span class="Author">'.$set['op_user'].'</span>
							<span class="DateCreated">'.date('F j, Y g:i a', strtotime($set['op_date_created'])).'</span>
							<!--<div class="CommentInfo"> <span>Posts: 15,423</span> </div>-->
						</div>
						<div class="Message">
							'.str_replace(array("\r\n"), '<br />',$set['comment_text']).'
						</div>
						 
					</div>
				</li>';				
			}
		
		}

		echo json_encode($json);	
	}	
	
	
	public function newmessage(){

		$data = '';
		$this->load->view('admin/header');
		$this->load->view('admin/messages/message_new', $data);
		$this->load->view('admin/footer');	
	
	}
	

	public function savemessage(){
	
		$this->load->library('email');	 
		$json = array('status'=>false, 'msg'=>'Failed to sent your message', 'status_email'=>false);
		$sendingtostatus = '';
		
		$userid 	= $this->session->userdata("USERID_45");
		$username 	= $this->session->userdata("USER");
		//$useremail	= $this->session->userdata("USEREMAIL_45");		
		
		
		if( $_POST ){ 
			
			$operators = explode(', ',$this->input->post('operators'));		 
			$array=array_diff($operators, array(''));
			 
			$this->db->where_in('Username', $array) ;
			$list = $this->db->get('operator_user_info')->result();
			
			 
			
			foreach( $list as $op ){
				 
				
				$set['msg_subject'] = $this->input->post('newsubject');
				$set['msg_text'] 	= $this->input->post('newmsg');
				$set['site'] 		= (($op->Role == 'd')?'manage.ricktag.ca':'cardpal.ricktag.ca');
				$set['op_id']		= $op->ID;
				$set['op_user'] 	= $op->Username;
				$set['owner_isadmin']=1;
				$set['admin_id'] 	= $userid;
				$set['admin_user'] 	= $username;
				
				
				$set['date_updated']= date('Y-m-d H:i:s');
				
				if( $this->db->insert('message', $set) ){
				
					$mid  = $this->db->insert_id();
					
					$set2['comment_text']= $this->input->post('newmsg');
					$set2['mid'] 		= $mid ;
					$set2['op_id']		= $this->session->userdata("USERID_45");
					$set2['op_user'] 	= $this->session->userdata("USER");
					$set2['admin_unread']= 1; 
					$set2['isAdmin']	= 1; 					
					$this->db->insert('message_reply', $set2);
					
					
					$json['status'] = true;
					$json['msg'] = 'Your message was succefully sent to '.$op->Username;
					
					 

					$config['protocol'] = 'sendmail';
					$config['charset'] 	= "iso-8859-1";
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = "html";
					$config['newline'] 	= "\n";			 
					
					$this->email->initialize($config);   
					 
					$this->email->from('rbrooks@ricktag.ca', 'Ricktag Customer Support');	 
					$this->email->to( $op->email );
					 
					$message = "<p>Hello, ".$op->fullname."</p>
	<p>Please log into ".(($op->Role == 'd')?'manage.ricktag.ca':'cardpal.ricktag.ca')." to check your message.</p>
	<p>Topic: ".$this->input->post('newsubject')."</p>
	<p>Thank you,</p>
	<p>Ricktag Client Support Team</p>";
					
					$this->email->message($message);
					$this->email->subject('Hello From Ricktag Support!');
			 
					if( $this->email->send() ){		 
						$sendingtostatus 	.= 'Your message was succefully sent to '.$op->Username.'<br />';					
					}				
					
				}  
			}
		}
		$json['status_email_text'] = $sendingtostatus;
		echo json_encode($json);	
	}	
 
	public function ajaxOperatorsList(){
	
		$this->db->like('Username', $_GET['term']);
		$this->db->select('Username');
		$this->db->where("Role !=", "a");
		$this->db->order_by('Username', 'ASC');
		$results = $this->db->get('operator_user_info')->result();
		$json = array();
		foreach($results as $row){
			$json[] = $row->Username;
		}
		
		echo json_encode($json);
	}
	
	public function deleteMsg(){
		$json = array('status'=>false, 'msg'=>'');
		
		if($_POST){
			
			$id = $this->input->post('id');
			
			$this->db->where('mid', $id);
			$set['isAdminDeleted'] = 1;
			if( $this->db->update('message', $set) ){
				$json['status'] = true;
				$json['msg'] = 'Delete successfully';
			}
			
			echo json_encode($json);
		}
		
	}
	
}	

/* End of file welcome.php */
/* Location: ./application/controllers/admin.php */