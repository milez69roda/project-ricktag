<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

  
	public function __construct(){
		parent::__construct();	
	}
	
	public function send(){
	
		$this->load->library('email');

		$config['protocol'] = 'sendmail';
		$config['charset'] 	= "iso-8859-1";
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = "html";
		$config['newline'] 	= "\n";	

		$this->email->initialize($config);  
		$message = "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> 
		<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
		<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>";
		
		$this->email->from('midas-no-reply@ricktag.ca');
		$this->email->to( 'rbrooks@ricktag.ca, brooks.ricktag@gmail.com, milez69roda@gmail.com, carmelo_roda@yahoo.com' );
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');
		$this->email->message($message);
		
		$this->email->subject('Testing Email 3');
		
		$this->email->send();
		/* if( $this->email->send() ){	
			echo 'Success';
		}else{
			echo $this->email->print_debugger();
		} */
		
		echo $this->email->print_debugger();
	}
	
}