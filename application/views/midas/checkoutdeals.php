<!--body content starts here-->                         
<div class="guest_list_container">
    <div class="guest_list_content">
    <?php
    if(empty($this->distributor_url)){
        $base_url_val = '/learn/guest/';
    }else{
        $base_url_val = '/'.$this->distributor_url.'/members/';
    }
	
    if(!$this->session->userdata("ISLOGIN")){
      $is_login_validation = 0;

    }else{
      $is_login_validation = 1;
    }
	
	//checking for valid distributor link
	$verify_url_dist = $this->uri->segment(1);
	$verify_url_allowed  = TRUE;
	if( $verify_url_dist == 'learn' OR $verify_url_dist == 'members' ){		 
		$verify_url_allowed = FALSE;	
	} 
	 
    ?> 
      <input type="hidden" name="is_login_validation" id="is_login_validation" value="<?php echo $is_login_validation; ?>" />
      <input type="hidden" name="get_param" id="get_param" value="<?php echo isset($_GET['c2']) ? '?c2='.$_GET['c2']: ''; ?>" />
      <?php 
		
		if(  $is_login_validation == 1 OR $verify_url_allowed){
			
			$url = $verify_url_dist;	
			if( !$verify_url_allowed ){
				$url = $this->distributor_url;
			} 	
				
			$exclusive = $this->db->get_where("distributor_exclusive_stores", array('url'=>$url))->row();
			 
			if( count($exclusive) > 0 ){
				if( $exclusive->category_id == $this->uri->segment(4) ){
					if( $exclusive->stores != '' ){
						$this->db->where(' id IN (', $exclusive->stores.')', false);
						$stores = $this->db->get('store_info')->result();
					}
				} 
			}
		}
	  
		foreach ($stores as $key => $value) {
			$this->db->join("categories", "categories.category_id = store_category_link.category_id");
			$cat = $this->db->get_where("store_category_link", array("store_id"=>$value->id))->result();
			
			$cat_text = '';
			foreach($cat as $c){
			  $cat_text .= $c->name.', ';

			  $cat_id = $this->uri->segment(4);
			  if($cat_id == ''){
				$cat_id = 0;
			  }
			} 
 
        if($key == 0){ ?>
          <div class="guest_list_content_top">
            <div class="guest_list_content_top_right">
            <h1><?php echo isset($value->company_name) ? $value->company_name : '' ; ?></h1>
            <p><?php echo isset($value->offer_details) ? $value->offer_details : 'No Details Provided' ; ?></p>
              
              <?php
              if($is_login_validation == 1){
                $featured_url =  isset($_GET['c2']) ? '<a class="view_deal" href="' .base_url($base_url_val.'deals/'.$cat_id.'/'.$value->id).'?c2='.$_GET['c2']. '"></a>' : '<a class="view_deal" href="' .base_url($base_url_val.'deals/'.$cat_id.'/'.$value->id). '"></a>';
              }else if($is_login_validation == 0){
                $featured_url = isset($_GET['c2']) ? '<a href="' .base_url('/welcome/popup_login').'?c2='.$_GET['c2']. '" class = "fancybox fancybox.ajax view_deal" id="button"></a>' : '<a href="' .base_url('/welcome/popup_login'). '" class = "fancybox fancybox.ajax view_deal" id="button"></a>';
              }
              echo $featured_url;
              ?>
            </div>
            <div class="guest_list_content_top_left">
              <img width="435px" height="260px" class="rounded" src="<?php echo $value->small_banner; ?>" alt="<?php echo isset($value->company_name) ? $value->company_name : '' ; ?>">
            </div>
          </div>
          <div class="guest_list_content_bottom">
            <div class="deals_data">
              <ul>
        <?php }else{ ?>

              <li>
                <div class="widget widget-one rounded">
                  <a class="deal" href="#">
                    <div class="guest_list_image">
                      <img class=" rounded_top" width="274px" height="164px" src="<?php echo $value->small_banner; ?>" alt="<?php echo isset($value->company_name) ? $value->company_name : '' ; ?>">
                    </div>
                    <div class="guest_list_text">
                      <h3><?php echo isset($value->company_name) ? $value->company_name : '' ; ?></h3>
                      <p><?php echo isset($cat_text) ? substr($cat_text,0,-2) : '' ; ?></p>
                    </div>
                  </a>
                  <input type="hidden" class="view_id" value="<?php echo $value->id; ?>" />
                </div>
              </li>
      <?php 
        }
      } 
      ?>
                  </ul>            
          </div>
        <div class="clearfix"></div>
        </div>
    </div>  
</div>
<!--body content ends here-->
  
<div class="clearfix"></div>   