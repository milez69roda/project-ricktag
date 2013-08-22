<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function check_balance(){

		$result = array();
		$this->form_validation->set_rules('card_number', 'Card Number', 'required|exact_length[8]|callback_card_number_exists'); 

		if ($this->form_validation->run()){
			$result['status'] = 'success';
			$card_number = $this->input->post("card_number");

			$balance = $this->user_model->get_balance($card_number);
			$result['balance'] = $balance;

		}else{
			$result['status'] = 'failed';
			$result['balance'] = '0';
			$result['message'] = validation_errors();
		}

		echo json_encode($result);
	}


	public function activatedeals(){

		$user_id = $this->input->post("user_id");
		$deal_id = $this->input->post("deal_id");

		if(!empty($user_id) && !empty($deal_id)){

			$update_status = $this->user_model->update_activate_deal($user_id, $deal_id);
			
			if($update_status == 'success'){
				$featured_val = $this->user_model->get_featured_val($deal_id);
				$result['featured_val'] = $featured_val;

				$update_deal = $this->user_model->update_activated_deal($user_id, $deal_id);
				$result['status'] = $update_deal;
			}

		}else{
			$result['status'] = 'failed';
		}

		echo json_encode($result);
	}

/*---------------------------------------------------------------------------------callback functions--------------------------------------------------------------------------------------------*/

	function card_number_exists($card_number){
		$is_exists = $this->user_model->card_number_exists($card_number);
	    if($is_exists){
	        return TRUE;

	    }else{
	    	$this->form_validation->set_message('card_number_exists', 'Card Number Does not Exists');
	        return FALSE;
	    }
	}
}
