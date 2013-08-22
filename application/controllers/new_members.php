<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class New_members extends CI_Controller {
	
	
	
	public function __construct(){
		parent::__construct();	
	}
		
	public function index(){
		
		
		$this->load->view('new_member/header_view');
		$this->load->view('new_member/main-content');
		$this->load->view('new_member/footer_view');
		
	
	}
	
	public function map(){
		
		
		$this->load->view('new_member/header_map_view');
		$this->load->view('new_member/map-canvas');
		$this->load->view('new_member/footer_map_view');
		
	
	}
	
	public function my_points(){
		
		
		$this->load->view('new_member/header_points_view');
		$this->load->view('new_member/main-content');
		$this->load->view('new_member/footer_map_view');
		
	
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */