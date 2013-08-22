<!--body content starts here-->                         
<div class="guest_list_container">
    <div class="guest_list_content">
    <?php
	$distributor_url = '';
	
    if(empty($this->distributor_url)){
        $base_url_val = '/learn/guest/'; 
    }else{
        $base_url_val = '/'.$this->distributor_url.'/members/';
		$distributor_url = $this->distributor_url;
    }

    if(!$this->session->userdata("ISLOGIN")){
      $is_login_validation = 0;

    }else{
      $is_login_validation = 1;
    }
	
    ?>
    
	<input type="hidden" name="is_login_validation" id="is_login_validation" value="<?php echo $is_login_validation; ?>" />
	<input type="hidden" name="get_param" id="get_param" value="<?php echo isset($_GET['c2']) ? '?c2='.$_GET['c2']: ''; ?>" />

	<?php
	
	if( @$featured_stores->main_store != ''):
		$main = $stores[$featured_stores->main_store];
			
		$this->db->join("categories", "categories.category_id = store_category_link.category_id");
		$cat = $this->db->get_where("store_category_link", array("store_id"=>$featured_stores->main_store))->result();			
		$cat_text = '';
		foreach($cat as $c){
		  $cat_text .= $c->name.', ';

		  $cat_id = $this->uri->segment(4);
		  if($cat_id == ''){
			$cat_id = 0;
		  }
		} 		
	?>	 
	<div class="guest_list_content_top">
		<div class="guest_list_content_top_right">
			<h1><?php echo isset($main->company_name) ? $main->company_name : '' ; ?></h1>			 
			<p><?php echo isset($main->featured_short_desc) ? $main->featured_short_desc : 'No Details Provided' ; ?></p>
			  
			  <?php
			  if($is_login_validation == 1){
				$featured_url =  isset($_GET['c2']) ? '<a class="view_deal" href="' .base_url($base_url_val.'deals/'.$cat_id.'/'.$main->id).'?c2='.$_GET['c2']. '"></a>' : '<a class="view_deal" href="' .base_url($base_url_val.'deals/'.$cat_id.'/'.$main->id). '"></a>';
			  }else if($is_login_validation == 0){
				$featured_url = isset($_GET['c2']) ? '<a href="' .base_url('/welcome/popup_login').'?c2='.$_GET['c2']. '" class = "fancybox fancybox.ajax view_deal" id="button"></a>' : '<a href="' .base_url('/welcome/popup_login'). '" class = "fancybox fancybox.ajax view_deal" id="button"></a>';
			  }
			  echo $featured_url;
			  ?>
		</div>
		<div class="guest_list_content_top_left">
			<img width="435px" height="260px" class="rounded" src="<?php echo $main->small_banner; ?>" alt="<?php echo isset($main->company_name) ? $main->company_name : '' ; ?>">
		</div>
	</div> 
	<?php endif; ?>	  
		  
		  
          <div class="guest_list_content_bottom">
            <div class="deals_data">
              <ul>
	<?php 
		$exclusive_stores = array();
		$distributor_category = '';
		$verify_url_dist = $this->uri->segment(1);
		 
		if( $verify_url_dist != 'learn' ){		 
			
			if( !empty($distributor_url) ) $verify_url_dist = $distributor_url;
			
			$this->db->where('url', $verify_url_dist);
			$exclusive_stores_res = $this->db->get('distributor_exclusive_stores')->row();
			if( count($exclusive_stores_res) > 0 ){
				$distributor_category = $exclusive_stores_res->category_id;
				$exclusive_stores = explode(',', $exclusive_stores_res->stores);	
			}
			//print_r($exclusive_stores);
		} 
	   
		
		if( @$featured_stores->stores ):
			$featured = explode(',',$featured_stores->stores);
		
			foreach ($featured as $storeid):
			
				$this->db->join("categories", "categories.category_id = store_category_link.category_id");
				$cat = $this->db->get_where("store_category_link", array("store_id"=>$storeid))->result();
				
				$value = $stores[$storeid];
				
				$cat_text = '';
				foreach($cat as $c){
				  $cat_text .= $c->name.', ';

				  $cat_id = $this->uri->segment(4);
				  if($cat_id == ''){
					$cat_id = 0;
				  }
				} 
				
				$islowed = true;
				if( $distributor_category == $value->category_id ){
					 
					if( !in_array($value->id, $exclusive_stores ) ){
						$islowed = false;
					}
				}
				
				if($islowed):
			?>
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
				endif;
			endforeach;
		endif;
      ?>
                  </ul>            
          </div>
        <div class="clearfix"></div>
        </div>
    </div>  
</div>
<!--body content ends here-->
  
<div class="clearfix"></div>   