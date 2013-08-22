<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct(); 
		
		if( !$this->session->userdata("ISLOGIN") ){
			redirect(base_url()."adminlogin"); 
		}		 
	
	}
	public function index(){
	  redirect(base_url()."admin/cities"); 
	} 
 
	public function logout(){
	
		/* $this->session->set_userdata('ISLOGIN', 0);
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
		$data["card"] = $this->db->get("card_info")->result();
		
		$this->db->where("dist_id", $id );
		$this->db->join("cities", "cities.id = distributor_info.city_id");
		$data["dist"] = $this->db->get("distributor_info")->row();
	
		$this->load->view('admin/header');
		$this->load->view('admin/business-manager-edit',$data);
		$this->load->view('admin/footer');		
	}
	
	public function businessmanager_add(){
		
	 
		$data["cities"] = $this->commonmodel->cities_dp(1);
		
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
		
		if( $this->input->post("bmstatus") == "update" ){

			$this->db->where("dist_id", $this->input->post("id") );	  
		if( $this->db->update("distributor_info", $set) ){
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
		$this->form_validation->set_rules('contact_name', 'Contact Nae', 'trim');		
		$this->form_validation->set_rules('website', 'Website', 'trim');		
		$this->form_validation->set_rules('discount', 'Discount', 'trim');		
		$this->form_validation->set_rules('facebook_link', 'Facebook', 'trim');		
		$this->form_validation->set_rules('twitter_link', 'Twitter', 'trim');		
		$this->form_validation->set_rules('offer_details', 'Offer Details', 'trim');		
		$this->form_validation->set_rules('fine_print', 'Fine Print', 'trim');		
		$this->form_validation->set_rules('google_map_lat_long', 'Google Map Lat Long', 'trim');	 	
		
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
		$this->db->select("store_info.*, cities.name as city_name");
		$this->db->join("cities", "cities.id=store_info.city_id");
		$data["stores"] = $this->db->get("store_info");
		$this->load->view('admin/header');
		$this->load->view('admin/store-manager',$data);
		$this->load->view('admin/footer');		
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
	
	public function cardmanager(){
		$data = "";
		$this->db->select("card_id, distributor_info.dist_id,distributor_info.email as dist_email, company_name,first_name,last_name, card_type, card_url,is_page, cities.name as city_name");
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
	
		$data = "";
		$this->db->select(" card_holders.ID,CARD_ID,CARD_TYPE, FIRSTNAME, LASTNAME, card_holders.EMAIL, GENDER, CONFIRMED, ACTIVE, cities.name as city_name, company_name, distributor_info.first_name, distributor_info.last_name, CREATE_DATE");
		$this->db->join("distributor_info", "distributor_info.dist_id = card_holders.Distributer_Id");
		$this->db->join("cities", "cities.id=card_holders.city_id");
		$this->db->order_by("ID", "asc");
		
		$data["cardholders"] = $this->db->get("card_holders");
		$this->load->view('admin/header');
		$this->load->view('admin/cardholder-manager',$data);
		$this->load->view('admin/footer');	
	
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
		$res_query_url = $this->db->get_where("card_info", array("dist_id"=>$res_query->Distributer_Id))->row();
		 
		$confirmationcode 		= md5("'".$card_id."'");
		$set["CONFIRM_CODE"] 	= $confirmationcode;
		$password 				= random_string('alnum', 13);
		$set["PASSWORD"] 		= md5($password );		
		
		$this->db->where("CARD_ID",$card_id);
		if( $this->db->update("card_holders", $set) ){
		 
			$msgTpldata["name"] = $res_query->FIRSTNAME;
			$msgTpldata["card"] = $card_id;
			$msgTpldata["pass"] = $password;
			$msgTpldata["link"] = $res_query_url->card_url.'/verify/?c='.$card_id.'&vc='.$confirmationcode.'&hc='.$password.'&t='.strtotime('now');
			 
			$message = $this->load->view("midas/verification_email", $msgTpldata, true);
				
			$config['protocol'] = 'sendmail';
			$config['charset'] 	= "iso-8859-1";
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = "html";
			$config['newline'] 	= "\n";			 
			
			$this->email->initialize($config);  
			
			
			$this->email->from('rbrooks@ricktag.ca', 'Ricktag');
			$this->email->to($res_query->EMAIL );
			//$this->email->cc('another@another-example.com');
			//$this->email->bcc('them@their-example.com');
			$this->email->message($message);
			$this->email->subject('Welcome to Ricktag please confirm your email');
			
			if( $this->email->send() ){		 
				$result['status'] 	= true;
				$result['text'] 	= "Resend Verification Successfully";
			}			
		
		}
	}
}	

/* End of file welcome.php */
/* Location: ./application/controllers/admin.php */