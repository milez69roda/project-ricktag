<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taskmanager extends CI_Controller {
  
	public $ci;
	
	public function __construct(){
		parent::__construct();	
		$this->ci =& get_instance(); 
	}
	public function index() {
		 
	}
	
	public function jobresendconfirmation(){
		 
		$query = "SELECT CARD_ID, CREATE_DATE, DATEDIFF(CURRENT_TIMESTAMP, CREATE_DATE) AS days
					FROM card_holders 
					WHERE CONFIRMED = 0 
					AND CARD_TYPE = 'RC'
					AND (DATEDIFF(CURRENT_TIMESTAMP, CREATE_DATE) = 2 
						 OR DATEDIFF(CURRENT_TIMESTAMP, CREATE_DATE) = 5
					)
				";  
				
		/* $query = "SELECT CARD_ID, CREATE_DATE, DATEDIFF(CURRENT_TIMESTAMP, CREATE_DATE) AS days
				FROM card_holders 
				WHERE CONFIRMED = 0 
				AND CARD_TYPE = 'RC'
				AND DATEDIFF(CURRENT_TIMESTAMP, CREATE_DATE) BETWEEN 150 AND 200
				ORDER BY days ASC	
			";				 */
		$res_query = $this->db->query($query)->result();		
		foreach( $res_query as $row  ){
		
			$status = $this->_resendemailverification( $row->CARD_ID );		 
			$set['status'] = $status;	
			$set['card_id'] = $row->CARD_ID; 
			$set['days'] = $row->days; 
			$this->db->insert('tasklog_resendconfirmation', $set);
			
		}
		 
	}
	
	
	private function _resendemailverification( $card_id ){
	
		$result = array("status"=>false, "text"=>'');
		$this->load->helper('string');
		$this->load->library('email');
		 
		$res_query = $this->db->get_where("card_holders", array("CARD_ID"=>$card_id))->row();		
		
		$res_query_url = $this->db->query("SELECT card_info.dist_id, card_url,company_name 
										FROM card_info 
										LEFT OUTER JOIN distributor_info ON distributor_info.dist_id = card_info.dist_id	
										WHERE ('".$card_id."' BETWEEN card_start AND card_end) 
										AND card_type = 'RC' ")->row();	
		 
		if( count($res_query_url) > 0 ){
		
			$confirmationcode 		= md5("'".$card_id."'");
			$set["CONFIRM_CODE"] 	= $confirmationcode;
			$password 				= random_string('alnum', 13);
			$set["PASSWORD"] 		= md5($password );		
			
			$this->db->where("CARD_ID",$card_id);
			if( $this->db->update("card_holders", $set) ){
			 
				$msgTpldata["name"] = $res_query->FIRSTNAME;
				$msgTpldata["card"] = $card_id;
				$msgTpldata["pass"] = $password;
				$msgTpldata["link"] = base_url().$res_query_url->card_url.'/verify/?c='.$card_id.'&vc='.$confirmationcode.'&hc='.$password.'&t='.strtotime('now');
				//print_r($msgTpldata); 
				$message = $this->load->view("midas/verification_email", $msgTpldata, true);
					
				$config['protocol'] = 'sendmail';
				$config['charset'] 	= "iso-8859-1";
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = "html";
				$config['newline'] 	= "\n";			 
				
				$this->email->initialize($config);   
				
				$from_name = (trim($res_query_url->company_name) != '')?$res_query_url->company_name:'Ricktag';
				$this->email->from($res_query_url->card_url.'-no-reply@ricktag.ca', $from_name);										
				$this->email->to( $res_query->EMAIL );				
				 
				//$this->email->cc('another@another-example.com');
				//$this->email->bcc('them@their-example.com');
				
				$this->email->message($message);
				$this->email->subject('Please complete your card registration');
				
				if( $this->email->send() ){		 
					return '1';
				}else{
					return '0';
				} 	
				 
			}else{
				return '2';
			}
		}else{
			return '3';
		}
		
	}	
	
	public function mytime(){
		echo date('Y-m-d H:i:s');
	}
 
}

/* End of file taskmananger.php */
/* Location: ./application/controllers/taskmanager.php */