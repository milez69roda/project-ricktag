<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminlogin extends CI_Controller {

	public function __construct(){
		parent::__construct(); 
		
		if( $this->session->userdata("ADMIN_ISLOGIN") ){
			redirect(base_url()."admin/"); 
		}		 
	
	}
  

	public function index()
	{ 
		if($_POST){ 
		
			if( $this->input->post("submit") == "login" ){
				
				$username = $this->input->post("uname");
				$password = md5($this->input->post("pass"));
				
				$this->db->where("userName", $username);
				$res = $this->db->get("users");
				
				if( $res->num_rows() > 0){
					$res = $res->row();
					
					if( $res->passwordHash == $password ){
						
						$this->session->set_userdata('ADMIN_ISLOGIN', 1);
						$this->session->set_userdata('USER', $res->userName);
						$this->session->set_userdata('USERID_45', $res->id);
						//$this->session->set_userdata('USEREMAIL_45', $res->email);
						redirect(base_url()."admin/");
					}
				
				} 
			}
		
		}
		 
		$this->load->view('admin/login');
		 
	}
	

		
 
}	

/* End of file welcome.php */
/* Location: ./application/controllers/admin.php */