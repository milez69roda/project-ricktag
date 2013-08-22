<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Distributors extends CI_Controller {

	public $distributor_id = '';
	public $distributor_url = '';
	public $distributor_title = '';
	public $header_card_image = '';
	public $header_card_slides = array();
	
	public function __construct(){
		parent::__construct();	
		$this->load->model("midasmodel");
		
		$this->distributor_url = $this->uri->segment(1);		
		$distributor = $this->commonmodel->get_vendor($this->distributor_url);
		
		if( $this->session->userdata("ISLOGIN") ){
			redirect(base_url().$this->distributor_url."/members/");
		}
		
		if( @$distributor->dist_id == 0 )	{
			echo show_404();
			exit(0);
		}
		
		$this->distributor_id =  $distributor->dist_id;
		$this->distributor_city =  $distributor->city_id;
		$this->distributor_title =  $distributor->company_name." - ".$distributor->first_name." ".$distributor->last_name;
		$this->header_card_image =  $distributor->card_image;
		
		$this->header_card_slides[] = $distributor->slider_image1;
		$this->header_card_slides[] = $distributor->slider_image2;
		$this->header_card_slides[] = $distributor->slider_image3;
		$this->header_card_slides[] = $distributor->slider_image4;
		
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
		
	}
	
	public function howitworks(){
		
		$data["cities"] = $this->commonmodel->cities(true);	
		$this->load->view('midas/header', $data);
		$this->load->view('midas/howitworks', $data);
		$this->load->view('midas/footer');
		
	}
	
	public function register_referafriend(){
		$res = array("status"=>false, "text"=>"");
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Your Email Address', 'required|valid_email');
		$this->form_validation->set_rules('f-email', 'Friend\'s Email Address', 'required|valid_email'); 
		
		$set["your_email"] 		= $this->input->post("email");
		$set["friend_email"] 	= $this->input->post("f-email");
		$set["distributor_id"] 	= $this->distributor_id;
		
		if($this->form_validation->run() == FALSE ){
			$res["text"] = validation_errors();
		}else{
		 
			$this->db->where($set);
			$query = $this->db->get("refer_friend");
			
			if( $query->num_rows() > 0 ){
				$res["text"] = "You have already refer that friend";
			}else{
				 
				$this->db->insert("refer_friend", $set);
				
				$res["status"] = true;
				$res["text"] = "Your referral is successfully submitted";
				
			}
		}
		
		echo json_encode($res);
	}
	
	public function register_eclub(){
		$res = array("status"=>false, "text"=>"");
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Your Email Address', 'required|valid_email');

		$set["email_address"] 		= $this->input->post("email");
		$set["distributor_id"] 	= $this->distributor_id;
		
		
		if($this->form_validation->run() == FALSE ){
			$res["text"] = validation_errors();
		}else{ 
			$this->db->where($set);
			$query = $this->db->get("eclub");
			
			if( $query->num_rows() > 0 ){
				$res["text"] = "You have already subscribe to our e-club";
			}else{
				 
				$this->db->insert("eclub", $set);
				
				$res["status"] = true;
				$res["text"] = "You have successfully subscribe to our e-club";
				
			}
		}
		
		echo json_encode($res);			
	}
	
	public function login(){
		$json = array("status"=>false,"msg"=>'');
		
		$card_id = $this->input->post("card2"); 
		$this->db->where("CARD_ID", $card_id);	 
		$res = $this->db->get("card_holders");
		
		if( $res->num_rows() > 0 ){
			$data["PASSWORD"] = md5($this->input->post("pwd"));
			$res = $res->row();
			if( $res->PASSWORD == md5($this->input->post("pwd")) ){
				$json["status"] = true;
				$json["msg"] = "Access Granted"; 
				$json["url"] = base_url().$this->distributor_url."/members"; 
				
				$this->session->set_userdata('ISLOGIN', TRUE);
				$this->session->set_userdata('CARDID', $card_id);
			}else{
				 
				$json["msg"] = "Username/Password is Incorrect";			
			}			
		}else{
			$json["msg"] = "Username/Password is Incorrect";	
		}
		 
		echo json_encode($json);
	}
	
	public function register(){
		
		$result = array('status'=>false,
						'text'=>'');
	 
		$this->load->library('form_validation');
		$this->load->helper('string');
		$this->load->library('email');
		
		
		$this->form_validation->set_rules('card_number', 'Card Number', 'required|is_unique[card_holders.CARD_ID]|callback_email_range_exist');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required'); 
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[card_holders.email]');		
		$this->form_validation->set_rules('postal', 'Postal Code', 'required');		
		$this->form_validation->set_rules('gender', 'Gender', 'required');		
		$this->form_validation->set_rules('terms', 'Terms and Condition', 'required');		
		
		if($this->form_validation->run() == FALSE ){
			$result['text'] = validation_errors();
		}else{
			$card_id = $this->midasmodel->register($this->distributor_id);
			if( $card_id["id"]  > 0 ){
				
				$this->db->where("ID", $card_id["id"]);
				$cardinfo = $this->db->get("card_holders")->row();
				 
				$card = $this->input->post("card_number");	
				
				$msgTpldata["name"] = $this->input->post("name");
				$msgTpldata["card"] = $card;
				$msgTpldata["pass"] = $card_id["readpass"];
				$msgTpldata["link"] = base_url().$this->distributor_url.'/verify/?c='.$card.'&vc='.$cardinfo->CONFIRM_CODE.'&hc='.$card_id["readpass"].'&t='.strtotime('now');
				 
				$message = $this->load->view("midas/verification_email", $msgTpldata, true);
					
				$config['protocol'] = 'sendmail';
				$config['charset'] 	= "iso-8859-1";
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = "html";
				$config['newline'] 	= "\n";			 
				
				$this->email->initialize($config);  
				
				
				$this->email->from('rbrooks@ricktag.ca', 'Ricktag');
				$this->email->to( $this->input->post("email") );
				//$this->email->cc('another@another-example.com');
				//$this->email->bcc('them@their-example.com');
				$this->email->message($message);
				$this->email->subject('Welcome to Ricktag please confirm your email');
				
				if( $this->email->send() ){		 
					$result['status'] 	= true;
					$result['text'] 	= "<p>Your have successfully registered your card. </p>
					<p>Please check your inbox for a confirmation email. </p><p>If you do not see it check your spam folder</p>";
				}
			}else{
				$result['status'] 	= false;
				$result['text'] 	= "Failed to register, please contact admninistrator";
			}
		}
		echo json_encode($result);
	} 
	
	public function email_range_exist($card){
		
		$res = $this->db->query("SELECT card_id FROM card_info WHERE ('".$card."' BETWEEN card_start AND card_end) AND dist_id = ".$this->distributor_id);
		if ($res->num_rows() == 0 ){
			$this->form_validation->set_message('email_range_exist', 'The %s is invalid');
			return FALSE;
		} else
		{
			return TRUE;
		}
	}
	
	public function verify(){
		
		ob_start();
		$card = $_GET["c"];
		$code = $_GET["vc"];
		$password = $_GET["hc"];
		$time = $_GET["t"];
		 
		$where["CARD_ID"] 		= $card;
		$where["PASSWORD"] 		= md5($password);
		$where["CONFIRM_CODE"] 	= $code;
		
		$this->db->where($where);
		$res = $this->db->get("card_holders"); 
		if( $res->num_rows() > 0 ){ 
			
			$set["CONFIRMED"] = 1;
			$set["ACTIVE"] = 1;
			$this->db->where($where);
			if( $this->db->update("card_holders", $set) ){
				$this->session->set_userdata('ISLOGIN', TRUE);
				$this->session->set_userdata('CARDID', $card);	
				$info = $res->row();
				$query = $this->db->query("SELECT name FROM cities WHERE id = ".$info->CITY_ID);
				$q = $query->row();
				$location = (count($q) > 0)? $q->name:'No Location';
				$query_dist = $this->db->query("SELECT email as dist_email,first_name FROM distributor_info WHERE  dist_id = ".$info->Distributer_Id);
				$q_d = $query_dist->row();
				$send_to = (count($q_d) > 0)? $q_d->dist_email:'';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From: Ricktag \r\n";
				$subject = "Someone just registered your card at Ricktag";
				$body  = 'Hello '.$q_d->first_name.',<br/><br/>';
				$body .= 'Someone just registered your card. Let’s check them out.<br/><br/>';
				$body .= 'Name: '.ucfirst($info->FIRSTNAME).' '.ucfirst($info->LASTNAME).'<br/>';
				$body .= 'Location: '.$location.'<br/>';
				$body .= 'Email:: '.$info->EMAIL.'<br/><br/>';
				$body .= 'We respect the privacy of our valued members and this information should not be shared with anyone and is the sole purpose of thanking them for registering your card.<br/><br/>';
				$body .= 'Thank you<br/>Ricktag';
				mail($send_to.',rbrooks@ricktag.ca', $subject, $body,$headers);
				redirect(base_url().$this->distributor_url."/members/editaccount");	
			}
		}else{
			echo "ERROR: PLEASE CONTACT ADMINISTRATOR";
		}
	}
	
	public function forgotpassword(){
	
		$this->load->helper('captcha');
		
		$vals = array(
		'img_path'	 => './files/captcha/',
		'img_url'	 => base_url().'files/captcha/',
		'font_path'	 => base_url().'static/midas/Geo703m_0.tff',
		'img_width'	 => '120',
		'img_height' => 40, 
		'expiration' => 7200
		);

		 //create captcha image
		$cap = create_captcha($vals);

		//store image html code in a variable
		$data['image'] = $cap['image'];

	    //store the captcha word in a session
		$this->session->set_userdata('word', $cap['word']);	
		
		$this->load->view("midas/forgotpassword", $data);
	}
	
	public function forgotpassword_send(){
		
		$this->load->library('email');
		$json = array("status"=>'', "msg"=>'');
		
		$email = $this->input->post("text-email");
		$code = $this->input->post("text-code");
		
		if( $email != ''  ){
		 
			if( $code == $this->session->userdata("code") ){
				
				$res = $this->db->get_where("card_holders", array("email"=>$email,"CARD_TYPE"=>"RC", "Distributer_Id"=>$this->distributor_id));
				if($res->num_rows() > 0 ){
					$res = $res->row();
					$password 	= random_string('alnum', 13); 
				
					$message = "<p>Dear ".$res->FIRSTNAME.",</p>	
					<p>This mail was sent because the 'forgot password' function has been applied to your account. </p> 
						<p>Your new Password: ".$password."</p> 
						<p>Sincerely,<br/>
							Ricktag
							http://ricktag.ca/</p>" ;		
				
					$config['protocol'] = 'sendmail';
					$config['charset'] 	= "iso-8859-1";
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = "html";
					$config['newline'] 	= "\n";			 
					
					$this->email->initialize($config);   
					
					$this->email->from('rbrooks@ricktag.ca', 'Ricktag');
					$this->email->to( $email );
					//$this->email->cc('another@another-example.com');
					//$this->email->bcc('them@their-example.com');
					$this->email->message($message);
					$this->email->subject('Ricktag Retrieve Password');
					
					if( $this->email->send() ){		 
						
						$this->db->where("CARD_ID", $res->CARD_ID);
						$this->db->where("EMAIL", $email);
						$set["PASSWORD"] 		= md5($password);		
						$set["IS_RESET"] 		= 1;		
						
						$this->db->update("card_holders", $set);
					
						$json['status'] 	= true;
						$json['text'] 	= "<p>Your password was sent to your email</p>
						<p>Please check your inbox for your new password</p><p>If you do not see it check your spam folder</p>";
					}			
				
				}else{
					$json["status"] = false;
					$json["msg"] = "Email doesn't  exist"; 
				} 
			}else{
					$json["status"] = false;
					$json["msg"] = "Code does't match"; 				
			}
		}
		echo json_encode($json);
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
		
		$result = array('stores'=>'');
		$i=0;
		foreach( $stores as $store ){
		
			$this->db->join("categories", "categories.category_id = store_category_link.category_id");
			$cat = $this->db->get_where("store_category_link", array("store_id"=>$store->id))->result();
			
			$cat_text = '';
			foreach($cat as $c){
				$cat_text .= $c->name.', ';
			}
			 
			$result["stores"][] = '<li id="strli_'.$i.'" style="display:none">
				<img width="275" height="165" src = "'.$store->small_banner.'" alt = "" />
				<div class = "list_info">
					<div class = "_info">
						<p style = "color:#fff; font-size:14px;">'.$store->company_name.'</p>
						<p style = "color:#83868d;">'.substr($cat_text, 0, -2).'</p>
					</div>
					<div class = "_info_price">
						<p style = "color:#fedf08; font-size:20px; margin-bottom:5px;">'.$store->discount.'<p>
						<p><a class="fancybox fancybox.ajax" href="'.$this->distributor_url.'/storesinfo/'.$store->id.'"><img src="static/midas/images/vide_deal_btn.png" alt = "" /></a><p>
					</div>
					<div class = "clear"></div>
				</div>
			</li>';		
			$i++;
		}
		
		echo json_encode($result);
	}
	
	public function storesinfo(){
	
		$id = $this->uri->segment(3);
		
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
		
		
		$viewdetail = $this->load->view("midas/store-view-details",$data ,true);
		echo $viewdetail; 
	}
	
	public function sendemail(){
		$this->load->helper('string');
		
		//echo random_string('alnum', 13);
		
		echo strtotime('now');
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */