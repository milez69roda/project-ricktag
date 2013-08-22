<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Midas extends CI_Controller {
	
	public $distributor_id = 68;
	
	public function __construct(){
		parent::__construct();	
		$this->load->model("midasmodel");	
	}
	 
	public function index()
	{
		
		$data["cities"] = $this->commonmodel->cities(true);
		
		$this->load->view('midas/header', $data);
		$this->load->view('midas/main-content', $data);
		$this->load->view('midas/footer');
	}
	
	public function contactus(){
		
		$data["cities"] = $this->commonmodel->cities(true);	
		$this->load->view('midas/header', $data);
		$this->load->view('midas/contactus', $data);
		$this->load->view('midas/footer');
		//$this->load->view('ricktag/footer_view'); 
		
	}
	
	public function howitworks(){
		
		$data["cities"] = $this->commonmodel->cities(true);	
		$this->load->view('midas/header', $data);
		$this->load->view('midas/howitworks', $data);
		$this->load->view('midas/footer');
		
	}
	
	public function register_referafriend(){
		
		$set["your_email"] 		= $this->input->post("email");
		$set["friend_email"] 	= $this->input->post("f-email");
		$set["distributor_id"] 	= $this->distributor_id;
		
		$this->db->where($set);
		$res = $this->db->get("refer_friend");
		
		if( $res->num_rows() > 0 ){
			echo 0;
		}else{
			$this->db->insert("refer_friend", $set);
			echo 1;
		}
		
	}
	
	public function register_eclub(){
	
	}
	
	public function register(){
		
		$result = array('status'=>false,
						'text'=>'');
	
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('card_number', 'Card Number', 'required|is_unique[card_holders.CARD_ID]');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required'); 
		$this->form_validation->set_rules('email', 'Email', 'valid_email|is_unique[card_holders.email]');		
		$this->form_validation->set_rules('postal', 'Postal Code', 'required');		
		$this->form_validation->set_rules('gender', 'Gender', 'required');		
		$this->form_validation->set_rules('terms', 'Terms and Condition', 'required');		
		
		if($this->form_validation->run() == FALSE ){
			$result['text'] = validation_errors();
		}else{
			
			$this->midasmodel->register();
		
			$result['status'] 	= true;
			$result['text'] 	= "Your card was successfully registered";
		}
		
		echo json_encode($result);
	} 
	
	public function giftcard(){
		
		$c = trim($_POST["card_number"]);
		
		if( !empty($c) ){
		
			$res = $this->db->query("SELECT * FROM card_info WHERE ('$c' BETWEEN card_start AND card_end) AND dist_id=".$this->distributor_id." AND card_type='GC'");
			
			if( $res->num_rows > 0 ){
				$res = $res->row(); 
				if( $res->card_value > 0 ){
					echo "$".$res->card_value;
				}else{
					echo "NONE";
				}
			}else{
				echo "NONE";
			}
		}else{
			echo "NONE";
		}
	}
	
	public function stores(){
		
		$c = $this->input->post("city");
		$stores = $this->midasmodel->stores_by_city($c,"f");
		
		$result = '';
		foreach( $stores as $store ){
			
			$result .= '<li>
				<img width="275" height="165" src = "'.$store->small_banner.'" alt = "" />
				<div class = "list_info">
					<div class = "_info">
						<p style = "color:#fff; font-size:14px;">'.$store->company_name.'<p>
						<p style = "color:#83868d;">'.$store->category_name.'<p>
					</div>
					<div class = "_info_price">
						<p style = "color:#FD590D; font-size:20px; margin-bottom:5px;">'.$store->discount.'<p>
						<p><a class="fancybox fancybox.ajax" href="midas/storesinfo/'.$store->id.'"><img src="static/midas/images/vide_deal_btn.png" alt = "" /></a><p>
					</div>
					<div class = "clear"></div>
				</div>
			</li>';		
		}
		
		echo $result;
	}
	
	public function storesinfo(){
	
		$id = $this->uri->segment(3);
		
		$this->db->where("store_info.id", $id ); 		
		$this->db->select("store_info.*, cities.name as city_name, categories.name as category_name" );
		$this->db->join("cities", "cities.id=store_info.city_id");		
		$this->db->join("categories", "categories.category_id=store_info.category_id");		
		
		$data["stores"] = $this->db->get("store_info")->row();
 
		$viewdetail = $this->load->view("midas/store-view-details",$data ,true);
		echo $viewdetail; 
	}
 
}

/* End of file welcome.php */
/* Location: ./application/controllers/midas.php */