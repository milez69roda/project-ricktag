<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminModel extends CI_Model {
 
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
   
	function card_save(){
			
		$id 		= @$this->input->post("id");
		$form_type 	= $this->input->post("form_type");
		
		$set["card_type"] 	= $this->input->post("card_type");
		$set["card_start"] 	= $this->input->post("card_start");
		$set["card_end"] 	= $this->input->post("card_end");
		$set["card_url"] 	= $this->input->post("card_url");			
		$set["card_value"] 	= $this->input->post("card_value");			
		$set["card_max_value"] 	= $this->input->post("card_max_value");			
		
		if( $form_type == "new"  )	{
			$set["dist_id"] = $this->input->post("dist_id");

			$this->db->insert("card_info", $set);			
			$id = $this->db->insert_id();
		}
		
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
			 
			$config['file_name']  		= $id."_1.".$ext;
			$filename = "files/distributor/cards/".$config['file_name'];
			
			$this->upload->initialize($config); 
			if ($this->upload->do_upload('userfile_1')) {
				 
				$set["slider_image1"] = $filename;
						
			}
			else {
				echo $this->upload->display_errors();
			}
 
		}
		
		if (!empty($_FILES['userfile_2']['name']))  {
 
			$ext 	= pathinfo($_FILES['userfile_2']['name'], PATHINFO_EXTENSION);
			$type 	= $this->input->post("type");
			 
			$config['file_name']  		= $id."_2.".$ext;
			$filename = "files/distributor/cards/".$config['file_name'];
			
			$this->upload->initialize($config); 
			if ($this->upload->do_upload('userfile_2')) {
				 
				$set["slider_image2"] = $filename;
						
			}
			else {
				echo $this->upload->display_errors();
			}
 
		}

		if (!empty($_FILES['userfile_3']['name']))  {
 
			$ext 	= pathinfo($_FILES['userfile_3']['name'], PATHINFO_EXTENSION);
			$type 	= $this->input->post("type");
			 
			$config['file_name']  		= $id."_3.".$ext;
			$filename = "files/distributor/cards/".$config['file_name'];
			
			$this->upload->initialize($config); 
			if ($this->upload->do_upload('userfile_3')) {
				 
				$set["slider_image3"] = $filename;
							
			}
			else {
				echo $this->upload->display_errors();
			}
 
		}

		if (!empty($_FILES['userfile_4']['name']))  {
 
			$ext 	= pathinfo($_FILES['userfile_4']['name'], PATHINFO_EXTENSION);
			$type 	= $this->input->post("type");
			 
			$config['file_name']  		= $id."_4.".$ext;
			$filename = "files/distributor/cards/".$config['file_name'];
			
			$this->upload->initialize($config); 
			if ($this->upload->do_upload('userfile_4')) {
				 
				$set["slider_image4"] = $filename;
					
			}
			else {
				echo $this->upload->display_errors();
			}
 
		}

		if (!empty($_FILES['userfile_5']['name']))  {
			
			$config['upload_path'] 		= './files/distributor/banners/';				
			$ext 	= pathinfo($_FILES['userfile_5']['name'], PATHINFO_EXTENSION);
			$type 	= $this->input->post("type");
			
			$config['file_name']  		= $id."_banner.".$ext;
			$filename = "files/distributor/banners/".$config['file_name'];
			
			$this->upload->initialize($config); 
			if ($this->upload->do_upload('userfile_5')) {
				
				$set["card_image"] = $filename;
				
								
			}
			else {
				echo $this->upload->display_errors();
			}
 
		}
		$set['notification'] = isset($_POST['notification'])? 1:0; 
		$this->db->where("card_id", $id );	 
		$this->db->update("card_info", $set);

		if( $form_type == "new" ){
			redirect(base_url()."admin/cardmanager_edit/".$id);
		}		
	}
}

/* End of file welcome.php */
/* Location: ./application/model/midasmodel.php */