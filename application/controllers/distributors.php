<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Distributors extends CI_Controller {

	public $distributor_id = '';
	public $distributor_url = '';
	public $distributor_title = '';
	public $header_card_image = '';
	public $header_card_slides = array();
	public $ci;
	
	public function __construct(){
		parent::__construct();	
		$this->ci =& get_instance();
		
  
		$this->distributor_url = $this->uri->segment(1);		
		$distributor = $this->commonmodel->get_vendor($this->distributor_url);
		
	 
		if( $this->session->userdata("ISLOGIN") ){
			redirect(base_url().$this->distributor_url."/members/");
		}
		
		if( @$distributor->dist_id == 0 ){
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

		$this->data['show_header'] = TRUE;

		$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
		$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
		$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
		$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

		if ($iphone || $android || $palmpre || $ipod || $berry == true) { 
			redirect('http://mobile.ricktag.ca');
		}else{
			if( !$this->is_ssl() ){ 
				redirect(base_url().$this->distributor_url); 
			}
		}
		
	}
		
	public function index()
	{
	  	
		$data["page_name"] = 'homepage';

		$data["cities"] = $this->commonmodel->cities(true);
		
		$this->load->view('midas/header_new', $data);
		$this->load->view('midas/menu_bar_new', $data);
		$this->load->view('midas/main-content', $data);
		$this->load->view('midas/footer_new');
		//$this->load->view('common/login');
	}
	
	function is_ssl() {

		if ( isset($_SERVER['HTTPS']) ) {
			if ( 'on' == strtolower($_SERVER['HTTPS']) )
			return true;
			if ( '1' == $_SERVER['HTTPS'] )
			return true;
		} elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
			return true;
		}
		return false;
	}	
	
	public function contactus(){
		$data["page_name"] = 'contactus';
		
		$this->load->view('midas/header_new', $data);
		$this->load->view('midas/menu_bar_new', $data);
		$this->load->view('midas/contactus');
		$this->load->view('midas/footer_new');
	}
	
	public function contactus_action(){
	
		$result = array('status'=>false,
						'txt'=>'');
	 
		$this->load->library('form_validation');
		$this->load->helper('string');
		$this->load->library('email');
		
		
		$this->form_validation->set_rules('fname', 'First Name', 'required|trim');
		$this->form_validation->set_rules('lname', 'Last Name', 'required'); 
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');		
		$this->form_validation->set_rules('phone', 'Phone Number', 'required');		
		$this->form_validation->set_rules('help', 'How we can help you?', '');		
		$this->form_validation->set_rules('messages', 'Message', 'required');		
		$this->form_validation->set_rules('code', 'Security Check', 'required|callback_security_code_check');		
		
		if($this->form_validation->run() == FALSE ){
			$result['txt'] = validation_errors();
		}else{
		  
			 
			$config['protocol'] = 'sendmail';
			$config['charset'] 	= "iso-8859-1";
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = "html";
			$config['newline'] 	= "\n";			 
			
			$this->email->initialize($config);  
			
			$fname = $this->input->post("fname");
			$lname = $this->input->post("lname");
			$email = $this->input->post("email");
			$phone = $this->input->post("phone");
			$help = $this->input->post("help");
			$messages = $this->input->post("messages");
			
			$message = 'Name: '.$fname.' '.$lname.'<br/>'; 
			$message .= 'Email: '.$email.'<br/>'; 
			$message .= 'Phone: '.$phone.'<br/>'; 
			$message .= 'How we can help you? : '.$help.'<br/>'; 
			$message .= 'Message: '.$messages.'<br/>'; 
			
			
			$this->email->from($email, $fname.' '.$lname);
			$this->email->to( 'customerservice@ricktag.ca, rbrooks@ricktag.ca');
			//$this->email->cc('another@another-example.com');
			$this->email->bcc('milez69roda@gmail.com');
			$this->email->message($message);
			$this->email->subject($help);
			
			if( $this->email->send() ){		 
				$result['status'] 	= true;
				$result['txt'] 	= "<p>Successfully Sent</p>";
			} 
			 
		}
		echo json_encode($result);	
	}
	
	public function security_code_check($str){
	
		$ses_code = $this->session->userdata("captcha_word");
		if ($str != $ses_code ){
			$this->form_validation->set_message('security_code_check', 'The %s does not match.');
			return FALSE;
		} else {
			return TRUE;
		}	
	}
	
	/*
	public function howitworks(){
		
		$data["page_name"] = 'howitworks';

		$data["cities"] = $this->commonmodel->cities(true);	
		$this->load->view('midas/header_new', $data);
		$this->load->view('midas/menu_bar_new', $data);
		$this->load->view('midas/howitworks', $data);
		$this->load->view('midas/footer_new');
		
	}
	*/
	
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
				
				$c = $this->db->get_where('cities', array('id'=>$res->CITY_ID))->row();
				/* $ct['id'] = $c->id; 
				$ct['name'] = $c->name;  */
				$this->session->set_userdata('CUR_CITY', $c);
				
			}else{
				 
				$json["msg"] = "Username/Password is Incorrect";			
			}			
		}else{
			$json["msg"] = "Username/Password is Incorrect";	
		}
		 
		echo json_encode($json);
	}
	
	
	public function unsubscribe(){
	   
		//ECHO PRINT_R($_GET);
		$card_id = $_GET['card']; 
		$card_key = $_GET['key']; 
		
		$this->db->where("CARD_ID", $card_id);  
		$this->db->where("CARD_TYPE", 'RC');  
		$res = $this->db->get("card_holders");
		//echo $this->db->last_query();
		if( $res->num_rows() > 0 ){

			$res = $res->row();  
			
			if( $res->PASSWORD == $card_key ){

				//$json["url"] = base_url().$this->distributor_url."/members/myaccount";  

				$this->session->set_userdata('ISLOGIN', TRUE);
				$this->session->set_userdata('CARDID', $card_id);

				$c = $this->db->get_where('cities', array('id'=>$res->CITY_ID))->row();    
				$this->session->set_userdata('CUR_CITY', $c);    
				redirect(base_url().$this->distributor_url."/members/myaccount");

			}else{ 
				redirect(base_url()); 
				//echo 'test1';
			}
		}else{
			redirect(base_url());
			//echo 'test2';
		}
	}	
	
	
	
	public function register(){
		
		$data["page_name"] = 'register_user';

		$data["cities"] = $this->commonmodel->cities(true);
	
		$this->load->view('midas/header_new');
		$this->load->view('midas/menu_bar_new',$data);
		$this->load->view('midas/register');
		$this->load->view('midas/footer_new');
	}

	public function register_user(){
		
		$result = array('status'=>false,
						'text'=>'');
	 
		$this->load->library('form_validation');
		$this->load->helper('string');
		$this->load->library('email');
		
		$this->form_validation->set_rules('card_number', 'Card Number', 'required|is_unique[card_holders.CARD_ID]|callback_email_range_exist');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required'); 
		$this->form_validation->set_rules('dateofbirth', 'Date of Birth', 'required'); 
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[card_holders.email]');		
		$this->form_validation->set_rules('postal', 'Postal Code', 'required');		
		$this->form_validation->set_rules('gender', 'Gender', 'required');		
		$this->form_validation->set_rules('terms', 'Terms and Condition', 'required');		
		
		if($this->form_validation->run() == FALSE ){
			$result['text'] = validation_errors();
		}else{
			
			//$distributor = $this->db->query("SELECT dist_id FROM card_info WHERE ('".$this->input->post("card_number")."' BETWEEN card_start AND card_end) AND card_url = '".$this->distributor_url."'")->row();	
			$res_query = $this->db->query("SELECT card_info.dist_id, card_url,company_name 
											FROM card_info 
											LEFT OUTER JOIN distributor_info ON distributor_info.dist_id = card_info.dist_id	
											WHERE ('".$this->input->post("card_number")."' BETWEEN card_start AND card_end) 
											AND card_type = 'RC' ")->row();	
											
			//$card_id = $this->midasmodel->register($this->distributor_id);
			$card_id = $this->midasmodel->register($res_query->dist_id);
			if( $card_id["id"]  > 0 ){
				
				$this->db->where("ID", $card_id["id"]);
				$cardinfo = $this->db->get("card_holders")->row();
				 
				$card = $this->input->post("card_number");	
				
				$msgTpldata["name"] = $this->input->post("name");
				$msgTpldata["card"] = $card;
				$msgTpldata["pass"] = $card_id["readpass"];
				$msgTpldata["link"] = base_url().$this->distributor_url.'/verify/?c='.$card.'&vc='.$cardinfo->CONFIRM_CODE.'&hc='.$card_id["readpass"].'&t='.strtotime('now');
				 
				$message = $this->load->view("common/verification_email", $msgTpldata, true);
					
				$config['protocol'] = 'sendmail';
				$config['charset'] 	= "iso-8859-1";
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = "html";
				$config['newline'] 	= "\n";			 
				
				$this->email->initialize($config);  
				
				
				//$this->email->from('rbrooks@ricktag.ca', 'Ricktag');
				//$this->email->from($this->distributor_url.'-no-reply@ricktag.ca');
				
				$from_name = (trim($res_query->company_name) != '')?$res_query->company_name:'Ricktag';
				$this->email->from($res_query->card_url.'-no-reply@ricktag.ca', $from_name);										
				$this->email->to( $this->input->post("email") );
				//$this->email->cc('another@another-example.com');
				//$this->email->bcc('them@their-example.com');
				$this->email->message($message);
				//$this->email->subject('Ricktag Registration - Please Confirm Your Email');
				$this->email->subject('Thanks for registering your card. Please confirm your email.');
				
				if( $this->email->send() ){		 
					$result['status'] 	= true;
					$result['text'] 	= "<p>You have successfully registered your card.</p>
					<p>Please check your email for our confirmation.</p>
					<p>If you do not see it in your inbox then check your spam folder</p>
					<p>Thank you, </p>
					<p>Ricktag Customer Support</p>";
				}
			}else{
				$result['status'] 	= false;
				$result['text'] 	= "Failed to register, please contact admninistrator";
			}
		}
		echo json_encode($result);
	} 
	
	public function email_range_exist($card){
		
		//$res = $this->db->query("SELECT card_id FROM card_info WHERE ('".$card."' BETWEEN card_start AND card_end) AND dist_id = ".$this->distributor_id);
		$res = $this->db->query("SELECT card_id FROM card_info WHERE ('".$card."' BETWEEN card_start AND card_end) AND card_url = '".$this->distributor_url."'");
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
			$set["MODIFY_DATE"] = date('Y-m-d H:i:s');
			$this->db->where($where);
			if( $this->db->update("card_holders", $set) ){
			
				$this->session->set_userdata('ISLOGIN', TRUE);
				$this->session->set_userdata('CARDID', $card);	
				$info = $res->row();
				$query = $this->db->query("SELECT name, id FROM cities WHERE id = ".$info->CITY_ID);
				
				$q = $query->row();
				$this->session->set_userdata('CUR_CITY', $q);
				
				$location = (count($q) > 0)? $q->name:'No Location';
				$query_dist = $this->db->query("SELECT email as dist_email,first_name FROM distributor_info WHERE  dist_id = ".$info->Distributer_Id);
				$q_d = $query_dist->row();
				$send_to = (count($q_d) > 0)? $q_d->dist_email:'';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: <customerservice@ricktag.ca>"Ricktag Customer Service"' . "\r\n";
				$headers .= 'Bcc: milez69roda@gmail.com' . "\r\n";
				$subject = "Someone just registered your card at Ricktag";
				$body  = 'Hello '.$q_d->first_name.',<br/><br/>';
				$body .= 'Someone just registered your card. Let’s check them out.<br/><br/>';
				$body .= 'Name: '.ucfirst($info->FIRSTNAME).' '.ucfirst($info->LASTNAME).'<br/>';
				$body .= 'Location: '.$location.'<br/>';
				$body .= 'Email:: '.$info->EMAIL.'<br/><br/>';
				$body .= 'We respect the privacy of our valued members and this information should not be shared with anyone and is the sole purpose of thanking them for registering your card.<br/><br/>';
				$body .= 'Thank you<br/>Ricktag';
				 
				
				$sql = "SELECT
							card_holders.EMAIL as email,
							FIRSTNAME,
							CARD_ID,
							cities.name AS city_name,
							company_name,
							card_balance
							FROM card_holders 
							LEFT OUTER JOIN distributor_info ON distributor_info.dist_id = card_holders.Distributer_Id
							LEFT OUTER JOIN cities ON cities.id = card_holders.CITY_ID
							WHERE CARD_ID = ".$card;
				$res = $this->db->query($sql)->row();
				
				
				include(APPPATH.'libraries/MCAPI.class.php');
				
				$api = new MCAPI($this->ci->config->item('mailchimp_api'));				
				//$listId = '7eeebefeaa';
				//$listId = 'c975687a1b';
				$listId = $this->ci->config->item('mailchimp_listid');
					 
				//$merge_vars = array("EMAIL"=>"$send_to", "FNAME"=>'Richard', "LNAME"=>'Wright');
				
				$merge_vars['EMAIL'] = $res->email;
				$merge_vars['FNAME'] = $res->FIRSTNAME;
				$merge_vars['MMERGE3'] = $res->CARD_ID;
				$merge_vars['MMERGE2'] = $res->city_name;
				$merge_vars['D_NAME'] = $res->company_name;
				//$merge_vars['MMERGE2'] = $res->card_balance;
				
					 
				$cardinfo = $this->db->query("SELECT * FROM card_info WHERE $res->CARD_ID BETWEEN card_start AND card_end AND card_type='RC'")->row();
				
				$app_send_to_dist = 'rbrooks@ricktag.ca'; 
				
				if( $cardinfo->notification ){
					$app_send_to_dist .= ', '.$send_to;
				}
				
				mail($app_send_to_dist, $subject, $body,$headers);
				
				if($api->listSubscribe($listId, $res->email, $merge_vars, 'html ', false) === true) {
					// It worked!	
					//echo 'Success! Check your email to confirm sign up.'; 
					//redirect(base_url().$this->distributor_url."/members/editaccount");	
				}else{
					//redirect(base_url().$this->distributor_url);		
				}				
				
				redirect(base_url().$this->distributor_url."/members/myaccount");		
			}
		}else{
			echo "Your confirmation is already expired";
		}
	}
	
	public function forgotpassword(){
	
		/* $this->load->helper('captcha');
		
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
		$this->session->set_userdata('word', $cap['word']);	 */
		$data = '';
		$this->load->view("midas/forgotpassword", $data);
	}

	public function forgot(){
		$data["page_name"] = 'forgot_password';
	
		$this->load->view('midas/header_new');
		$this->load->view('midas/menu_bar_new',$data);
		$this->load->view('midas/forgot');
		$this->load->view('midas/footer_new');
	}
	
	public function captcha(){
	  // initialise image with dimensions of 120 x 30 pixels
	  $image = @imagecreatetruecolor(120, 30) or die("Cannot Initialize new GD image stream");

	  // set background to white and allocate drawing colours
	  //$background = imagecolorallocate($image, 251, 252, 234);
	  $background = imagecolorallocate($image, 252, 252, 252);
	  imagefill($image, 0, 0, $background);
	  //$linecolor = imagecolorallocate($image, 0xCC, 0xCC, 0xCC);
	  $linecolor = imagecolorallocate($image, 255, 255, 255);
	  $textcolor_arr = imagecolorallocate($image, 0x33, 0x33, 0x33);

	  // draw random lines on canvas
	  for($i=0; $i < 3; $i++) {
		imagesetthickness($image, rand(1,3));
		imageline($image, 0, rand(0,30), 120, rand(0,30), $linecolor);
	  }

	  //session_start();
		//if(!isset($_SESSION)): session_start(); endif;

	  $captcha_text = '';
	  for($x = 20; $x <= 100; $x += 20) {
		$captcha_text .= ($num = rand(0, 9));
		$new_x = $x - 3; 
		imagechar($image, 5, $new_x, 8, $num, $textcolor_arr);
		//imagechar($image, rand(3, 5), $new_x, rand(2, 14), $num, $textcolor_arr);
	  }

	  // record digits in session variable
	  //$_SESSION['sess_captcha'] = $captcha_text;
	  $this->session->set_userdata('captcha_word', $captcha_text);		
	  // display image and clean up
	  header('Content-type: image/png');
	  imagepng($image);
	  imagedestroy($image);
	
	}
	
	public function forgotpassword_send(){
		
		$this->load->library('email');
		$json = array("status"=>'', "msg"=>'');
		
		$email = $this->input->post("text-email");
		$code = $this->input->post("text-code");
		
		if( $email != ''  ){
		 
			if( $code == $this->session->userdata("captcha_word") ){
				//distributor_url
				
				$this->db->where("email", $email);
				$this->db->where("card_holders.CARD_TYPE", "RC");
				$this->db->where("card_info.card_type", "RC");
				$this->db->where("card_url", $this->distributor_url);
				
				$this->db->join("card_info", "card_info.dist_id = card_holders.Distributer_Id");				
				$res = $this->db->get("card_holders");
				
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
						$json['msg'] 		= "Your password was sent to your email \nPlease check your inbox for your new password \nIf you do not see it check your spam folder";
						$json['url']		= base_url().$this->distributor_url;	
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
	public function terms(){
		
		if( $this->distributor_url == 'midas' ){

			$data["page_name"] = 'terms';

			$data["cities"] = $this->commonmodel->cities(true);
			
			$this->load->view('midas/header_new', $data);
			$this->load->view('midas/menu_bar_new', $data);
			$this->load->view('midas/terms', $data);
			$this->load->view('midas/footer_new');
		}else{
			redirect(base_url().'midas/howitworks');
		}	
	}


/* static content for midas and ricktag */
	public function giftcards(){

		$data["page_name"] = 'giftcards';
	
		$this->load->view('midas/header_new');
		$this->load->view('midas/menu_bar_new',$data);
		$this->load->view('ricktag/giftcards');
		$this->load->view('midas/footer_new');
		
	}

	public function getacard(){

		$data["page_name"] = 'getcards';
	
		$this->load->view('midas/header_new');
		$this->load->view('midas/menu_bar_new',$data);
		$this->load->view('ricktag/getcards');
		$this->load->view('midas/footer_new');
	}

	public function howitworks(){

		$data["page_name"] = 'howitworks';
	
		$this->load->view('midas/header_new');
		$this->load->view('midas/menu_bar_new',$data);
		$this->load->view('ricktag/howitworks');
		$this->load->view('midas/footer_new');
	}

	public function termsandconditions(){

		$data["page_name"] = 'termsandconditions';
	
		$this->load->view('midas/header_new');
		$this->load->view('midas/menu_bar_new',$data);
		$this->load->view('ricktag/termsandconditions');
		$this->load->view('midas/footer_new');
	}

	public function privacypolicy(){

		$data["page_name"] = 'privacypolicy';
	
		$this->load->view('midas/header_new');
		$this->load->view('midas/menu_bar_new',$data);
		$this->load->view('ricktag/termsandconditions');
		$this->load->view('midas/footer_new');
	}

	public function popup_login(){

		$data["page_name"] = 'popup_login';
	
		$this->load->view('common/login');		
	}
/* static content for midas and ricktag */	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */