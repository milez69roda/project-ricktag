<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();	

		$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
		$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
		$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
		$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

		if ($iphone || $android || $palmpre || $ipod || $berry == true) { 
			redirect('http://mobile.ricktag.ca');
		}/* else{
		
			if( $this->is_ssl() ){
				redirect(base_url());
			}
		
		} */
		
	}
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

		redirect(base_url('/learn'));	
		/*
		if( $_POST ){
		
			$card = $_POST["card1"]; 
			$res = $this->db->query("SELECT * FROM card_info WHERE '$card' BETWEEN card_start AND card_end ");
			
			if( $res->num_rows() > 0)	{
				$res = $res->row();
				redirect(base_url().$res->card_url."/?c2=".$_POST["card1"]);	
			
			}
		
		}
		
		$data["page_name"] = 'homepage';

		$this->load->view('ricktag/header_new');
		//$this->load->view('ricktag/menu_bar_new',$data);
		$this->load->view('ricktag/main-content');
		//$this->load->view('ricktag/footer_new');
		*/
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

	
	public function learn()
	{
		if( $_POST ){
		
			$card = $_POST["card1"]; 
			$res = $this->db->query("SELECT * FROM card_info WHERE '$card' BETWEEN card_start AND card_end ");
			
			if( $res->num_rows() > 0)	{
				$res = $res->row();
				redirect(base_url().$res->card_url."/?c2=".$_POST["card1"]);	
			
			}
		
		}

		$data["page_name"] = 'learn';
		
		$this->load->view('ricktag/header_new');
		$this->load->view('ricktag/menu_bar_new',$data);
		$this->load->view('ricktag/learn');
		$this->load->view('ricktag/footer_new');
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

	public function forgot(){
		$data["page_name"] = 'forgot_password';
	
		$this->load->view('ricktag/header_new');
		$this->load->view('ricktag/menu_bar_new',$data);
		$this->load->view('midas/forgot');
		$this->load->view('ricktag/footer_new');
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
						$json['url']		= base_url('/learn');	
					}			
				
				}else{
					$json["status"] = false;
					$json["msg"] = "Email doesn't exist"; 
				} 
			}else{
					$json["status"] = false;
					$json["msg"] = "Code does't match"; 				
			}
		}
		echo json_encode($json);
	}

	
	public function contactus(){

		$data["page_name"] = 'contactus';
	
		$this->load->view('ricktag/header_new');
		$this->load->view('ricktag/menu_bar_new',$data);
		$this->load->view('ricktag/contactus');
		$this->load->view('ricktag/footer_new');
		
	}

	public function giftcards(){

		$data["page_name"] = 'giftcards';
	
		$this->load->view('ricktag/header_new');
		$this->load->view('ricktag/menu_bar_new',$data);
		$this->load->view('ricktag/giftcards');
		$this->load->view('ricktag/footer_new');
		
	}

	public function getacard(){

		$data["page_name"] = 'getcards';
	
		$this->load->view('ricktag/header_new');
		$this->load->view('ricktag/menu_bar_new',$data);
		$this->load->view('ricktag/getcards');
		$this->load->view('ricktag/footer_new');
		
	}

	public function howitworks(){

		$data["page_name"] = 'howitworks';
	
		$this->load->view('ricktag/header_new');
		$this->load->view('ricktag/menu_bar_new',$data);
		$this->load->view('ricktag/howitworks');
		$this->load->view('ricktag/footer_new');
		
	}

	public function termsandconditions(){

		$data["page_name"] = 'termsandconditions';
	
		$this->load->view('ricktag/header_new');
		$this->load->view('ricktag/menu_bar_new',$data);
		$this->load->view('ricktag/termsandconditions');
		$this->load->view('ricktag/footer_new');
	}

	public function privacypolicy(){

		$data["page_name"] = 'privacypolicy';
	
		$this->load->view('ricktag/header_new');
		$this->load->view('ricktag/menu_bar_new',$data);
		$this->load->view('ricktag/termsandconditions');
		$this->load->view('ricktag/footer_new');
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
			$this->email->to( 'customerservice@ricktag.ca');
			//$this->email->cc('another@another-example.com');
			//$this->email->bcc('them@their-example.com');
			$this->email->message($message);
			$this->email->subject($help);
			
			if( $this->email->send() ){		 
				$result['status'] 	= true;
				$result['txt'] 	= "<p>Successfully Sent</p>";
			} 
			 
		}
		echo json_encode($result);	
	}

	public function terms(){
		$this->load->view('ricktag/terms');
	}	

	public function register(){
		
		$data["page_name"] = 'register_user';

		$data["cities"] = $this->commonmodel->cities(true);
	
		$this->load->view('ricktag/header_new');
		$this->load->view('ricktag/menu_bar_new',$data);
		$this->load->view('midas/register');
		$this->load->view('ricktag/footer_new');
	}

	public function register_user(){
		$result = array('status'=>false,
						'text'=>'');
	 
		$this->load->library('form_validation');
		$this->load->helper('string');
		$this->load->library('email');
		
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required'); 
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[card_holders.email]');		
		$this->form_validation->set_rules('postal', 'Postal Code', 'required');		
		$this->form_validation->set_rules('gender', 'Gender', 'required');		
		$this->form_validation->set_rules('terms', 'Terms and Condition', 'required');		
		
		if($this->form_validation->run() == FALSE ){
			$result['text'] = validation_errors();
		}else{
			$msgTpldata["city"] = $this->input->post("city");
			$msgTpldata["name"] = $this->input->post("name");
			$msgTpldata["email"] = $this->input->post("email");
			$msgTpldata["dateofbirth"] = $this->input->post("dateofbirth");
			$msgTpldata["postal"] = $this->input->post("postal");
			$msgTpldata["gender"] = $this->input->post("gender");
			$msgTpldata["address"] = $this->input->post("address");

			$message = $this->load->view("common/card_request", $msgTpldata, true);
				
			$config['protocol'] = 'sendmail';
			$config['charset'] 	= "iso-8859-1";
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = "html";
			$config['newline'] 	= "\n";			 
			
			$this->email->initialize($config);  
			
			$this->email->from('rbrooks@ricktag.ca', 'Ricktag');
			$this->email->to(array('jnpl_003@yahoo.com', 'rbrooks@ricktag.ca'));
			//$this->email->cc('another@another-example.com');
			//$this->email->bcc('them@their-example.com');
			$this->email->message($message);
			$this->email->subject('Ricktag Registration Card Request - Action Required');
			
			if( $this->email->send() ){		 
				$result['status'] 	= true;
				$result['text'] 	= "<p>Your have successfully registered a card request. </p>
				<p>Please check your inbox for a confirmation email. </p><p>If you do not see it check your spam folder</p>";
			}else{
				$result['status'] 	= false;
				$result['text'] 	= "Failed to register, please contact admninistrator";
			}
		}
		echo json_encode($result);
	}	


	public function checkoutdeals(){

		//add custon session
		if(!$this->session->userdata("CUR_CITY")){
			$cur_city = (object)array("id"=>"3", "name"=>"Barrie", "sequence" => "" ,"hidden"=>"1");
			$this->session->set_userdata('CUR_CITY', $cur_city);
		}
		//add custon session

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
		 
		$data["page_name"] = 'checkoutdeals';

		$data["cities"] = $this->commonmodel->cities(true);

		//echo '<pre>';
		//print_r($data);
		//exit();
 
		$this->load->view('ricktag/header_new');
		$this->load->view('midas/checkoutdeals_menu_bar',$data);
		if( $cat_id > 0  ){
			$this->load->view('midas/checkoutdeals',$data);
		}else{ 
			$this->load->view('midas/checkoutdeals_featured',$data);
		}
		$this->load->view('midas/checkoutdeals_learn_footer');
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
		$data["categories"] = substr($cat_text, 0, -2);


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

	public function popup_login(){

		$data["page_name"] = 'popup_login';
	
		$this->load->view('common/login');		
	}


	public function login(){
		$json = array("status"=>false,"msg"=>'');

		$card_id = $this->input->post("card2"); 
		$this->db->where("CARD_ID", $card_id);	 
		$this->db->where("CARD_TYPE", 'RC');	 
		$res = $this->db->get("card_holders");

		if( $res->num_rows() > 0 ){
			$data["PASSWORD"] = md5($this->input->post("pwd"));
			$res = $res->row();

			if(empty($this->distributor_url)){
				$this->db->where("dist_id", $res->Distributer_Id);	 
				$res2 = $this->db->get("card_info");

				$distributor_url = $res2->row()->card_url;
			}

			if( $res->PASSWORD == md5($this->input->post("pwd")) ){
				$json["status"] = true;
				$json["msg"] = "Access Granted"; 
				$json["url"] = base_url().$distributor_url."/members"; 
				
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


	public function map(){

		//add custon session
		if(!$this->session->userdata("CUR_CITY")){
			$cur_city = (object)array("id"=>"3", "name"=>"Barrie", "sequence" => "" ,"hidden"=>"1");
			$this->session->set_userdata('CUR_CITY', $cur_city);
		}
		//add custon session

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
			//$data["cities"] = $this->commonmodel->cities_dp(1);
			
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
	 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */