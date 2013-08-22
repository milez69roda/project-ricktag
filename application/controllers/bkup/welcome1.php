<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if( $_POST ){
		
			$card = $_POST["card1"]; 
			$res = $this->db->query("SELECT * FROM card_info WHERE '$card' BETWEEN card_start AND card_end ");
			
			if( $res->num_rows() > 0)	{
				$res = $res->row();
				redirect(base_url().$res->card_url."/?c2=".$_POST["card1"]);	
			
			}
		
		}
		
		$this->load->view('ricktag/header_view');
		$this->load->view('ricktag/main-content');
		$this->load->view('ricktag/footer_view');
	}
	
	public function contactus(){
		
		 
		$this->load->view('ricktag/header_view');
		$this->load->view('ricktag/contactus');
		$this->load->view('ricktag/footer_view');
			
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */