<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
 
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
   
	function get_balance($card_number){
		$return_data = '0';

		$this->db->select('card_balance');
		$this->db->from('card_holders');
		$this->db->where('card_id', $card_number);

		$query = $this->db->get();

		if ($query->num_rows() > 0){
			$return_data = $query->row()->card_balance;
		}

		return $return_data;
	}	

	function card_number_exists($card_number){

		$this->db->select('card_balance');
		$this->db->from('card_holders');
		$this->db->where('card_id', $card_number);

		$query = $this->db->get();

		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}

	function update_activate_deal($user_id, $deal_id){

		$featured_val = $this->get_featured_val($deal_id);

		$data = array(
               'featured' => $featured_val + 1
            );

		$this->db->where('id', $deal_id);
        $this->db->update('store_info', $data); 

        if($this->db->affected_rows() == 0){
            return 'failed';
        }else{
            return 'success';  
        }
	}

	function get_featured_val($deal_id){

		$this->db->select('featured');
		$this->db->from('store_info');
		$this->db->where("id", $deal_id); 	

		$query = $this->db->get();

		if ($query->num_rows() > 0){
			$return_data = $query->row()->featured;
		}else{
			$return_data = 0;
		}

		return $return_data;
	}

	function update_activated_deal($user_id, $deal_id){

		$activated_deals = $this->get_activated_deal($user_id);

		if($activated_deals == ''){
			$activated_deals = $deal_id;

			$data = array(
				'card_id' => $user_id,
                'deals_ids' => $activated_deals
            );

	        $this->db->insert('activated_deals', $data); 
		}else{

			if(in_array($deal_id, explode(",",$activated_deals))){
				return 'failed';
			}else{
				$activated_deals = $activated_deals.', '.$deal_id;
				$data = array(
	                'deals_ids' => $activated_deals
	            );

				$this->db->where('card_id', $user_id);
		        $this->db->update('activated_deals', $data); 
		    }
		}	

		if($this->db->affected_rows() == 0){
            return 'failed';
        }else{
            return 'success';  
        }	
	}

	function get_activated_deal($user_id){

		$this->db->select('deals_ids');
		$this->db->from('activated_deals');
		$this->db->where("card_id", $user_id); 	

		$query = $this->db->get();

		if ($query->num_rows() > 0){
			$return_data = $query->row()->deals_ids;
		}else{
			$return_data = '';
		}

		return $return_data;
	}
}