<body>
  <?php
    if(empty($this->distributor_url)){
		
		$url =  $this->uri->segment(1);
		if( $url != 'learn' )
			$base_url_val = '/'.$url.'/guest/';
		else
			$base_url_val = '/learn/guest/';
    }else{
        $base_url_val = '/'.$this->distributor_url.'/members/';
    }

    if($page_name == 'checkoutdeals'){
      $page_name_val = 'category';
      $list_cls = 'list_deals_active';
      $map_cls = 'map_deals';
    }else if($page_name == 'checkoutdeals_maps'){
      $page_name_val = 'map';
      $list_cls = 'list_deals';
      $map_cls = 'map_deals_active';
    }else{
      $page_name_val = ($this->uri->segment(6)) ? $this->uri->segment(6) : 'category';
      if($page_name_val == 'category'){
        $list_cls = 'list_deals_active';
        $map_cls = 'map_deals';
      }else{
        $list_cls = 'list_deals';
        $map_cls = 'map_deals_active';
      }
    }
    ?>
     <div id="top_fixed">
      <div id="top">
        <div id="toplistleft">
        <?php $active_city = $this->session->userdata("CUR_CITY")->name; ?>
        <p>Change Location 
          <input type="hidden" name="category_val" id="category_val" value="<?php echo ($this->uri->segment(4)) ? $this->uri->segment(4) : '0'; ?>" />
          <input type="hidden" name="citi_val" id="citi_val" value="<?php echo ($this->uri->segment(5)) ? $this->uri->segment(5) : '0'; ?>" />
          <input type="hidden" name="base_url_val" id="base_url_val" value="<?php echo $base_url_val; ?>" />
          <input type="hidden" name="page_name_val" id="page_name_val" value="<?php echo $page_name_val; ?>" />
          <input type="hidden" name="crd_num_val" id="crd_num_val" value="<?php echo isset($_GET['c2']) ? '?c2='.$_GET['c2'] : ''; ?>" />
          <!--<label class="change_location_holder">-->
            <select name="Change Location" class="changelocation">
              <?php foreach($cities as $key=>$value): ?>                
                    <option <?php if($active_city == $value->name){ echo 'selected="selected"'; }?>  value="<?php echo $value->id; ?>" class="changelocationlist"><?php echo $value->name; ?></option>
              <?php endforeach; ?>  
            </select>
          <!--</label>-->
        </p> 
        </div>
          <div id="toplistright">
              <?php if( $this->session->userdata("ISLOGIN") && !empty($this->distributor_url) ){ ?>
                <p style="color:#83868d;">
                  <!--My Ricktag Number&nbsp;&nbsp;&nbsp;<input type = "text" name = "" readonly="readonly" class="members_crd_id_holder" value = "<?php echo $this->session->userdata("CARDID"); ?>" />
                  &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;-->
                  My Reward Bucks&nbsp;&nbsp;&nbsp;<span class="members_ponts"><?php echo $this->my_points; ?></span>
                  &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                  <span class="members_ponts"><a href = "<?php echo $base_url_val.'myaccount';?>"><?php echo $this->distributor_name; ?></a></span>
                  &nbsp;&nbsp;
                  <span class = "settings_arrow"><img src = "<?php echo base_url()?>static/new_member/images/down_arrow.png" alt = "" /></span>
                </p>
                <div id = "settings_info">
                  <ul>
                    <li><a href="<?php echo $base_url_val.'myaccount';?>">My Account</a></li>					
					<!--<li><a href = "<?php echo $base_url_val.'myspecialoffers'; ?>">My Special Offers</a></li>-->
					<li><a href = "<?php echo $base_url_val.'mycardhistory'; ?>">My Card History</a></li>
                    <li><a href="<?php echo $base_url_val.'logout';?>">Sign Out</a></li>
                  </ul>
                </div>
              <?php }else {?>
                      <p>Welcome Guest&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="<?php echo isset($_GET['c2']) ? base_url('/welcome/popup_login').'?c2='.$_GET['c2'] : base_url('/welcome/popup_login'); ?>" class = "fancybox fancybox.ajax" id="button">Member Login</a></p>
              <?php } ?>
          </div>
       </div>
        </div>
 <div id="navigation_fixed">      
     <div id="navigation_wrap">   
        <div id="nav_menu">
               <ul>
                    <a href="<?php echo isset($_GET['c2']) ? base_url($base_url_val.$page_name_val.'/0').'?c2='.$_GET['c2'] : base_url($base_url_val.$page_name_val.'/0'); ?>"><li id="menu_1" class = "<?php echo ($this->uri->segment(4)==0)?"current_1":"";  ?>"></li></a>
                    <a href="<?php echo isset($_GET['c2']) ? base_url($base_url_val.$page_name_val.'/1').'?c2='.$_GET['c2'] : base_url($base_url_val.$page_name_val.'/1'); ?>"><li id="menu_2" class = "<?php echo ($this->uri->segment(4)==1)?"current_2":"";  ?>"></li></a>
                    <a href="<?php echo isset($_GET['c2']) ? base_url($base_url_val.$page_name_val.'/2').'?c2='.$_GET['c2'] : base_url($base_url_val.$page_name_val.'/2'); ?>"><li id="menu_3" class = "<?php echo ($this->uri->segment(4)==2)?"current_3":"";  ?>"></li></a>
                    <a href="<?php echo isset($_GET['c2']) ? base_url($base_url_val.$page_name_val.'/3').'?c2='.$_GET['c2'] : base_url($base_url_val.$page_name_val.'/3'); ?>"><li id="menu_4" class = "<?php echo ($this->uri->segment(4)==3)?"current_4":"";  ?>"></li></a>
                    <a href="<?php echo isset($_GET['c2']) ? base_url($base_url_val.$page_name_val.'/4').'?c2='.$_GET['c2'] : base_url($base_url_val.$page_name_val.'/4'); ?>"><li id="menu_5" class = "<?php echo ($this->uri->segment(4)==4)?"current_5":"";  ?>"></li></a>
                    <a href="<?php echo isset($_GET['c2']) ? base_url($base_url_val.$page_name_val.'/5').'?c2='.$_GET['c2'] : base_url($base_url_val.$page_name_val.'/5'); ?>"><li id="menu_6" class = "<?php echo ($this->uri->segment(4)==5)?"current_6":"";  ?>"></li></a>
                    <a href="<?php echo isset($_GET['c2']) ? base_url($base_url_val.$page_name_val.'/6').'?c2='.$_GET['c2'] : base_url($base_url_val.$page_name_val.'/6'); ?>"><li id="menu_7" class = "<?php echo ($this->uri->segment(4)==6)?"current_7":"";  ?>"></li></a>
                    <a href="<?php echo isset($_GET['c2']) ? base_url($base_url_val.$page_name_val.'/7').'?c2='.$_GET['c2'] : base_url($base_url_val.$page_name_val.'/7'); ?>"><li id="menu_8" class = "<?php echo ($this->uri->segment(4)==7)?"current_8":"";  ?>"></li></a>
                    <a href="<?php echo isset($_GET['c2']) ? base_url($base_url_val.$page_name_val.'/8').'?c2='.$_GET['c2'] : base_url($base_url_val.$page_name_val.'/8'); ?>"><li id="menu_9" class = "<?php echo ($this->uri->segment(4)==8)?"current_9":"";  ?>"></li></a>
                </ul>
       </div>
     </div>
</div>    
  <div id="featured_deals_fixed">      
     <div id="featured_deals_wrap">
     
     
     <div id="featured_deals_btns">
    <ul>
        <li><a class="<?php echo $list_cls; ?>" href="<?php echo isset($_GET['c2']) ? base_url($base_url_val.'category/'.$this->uri->segment(4)).'?c2='.$_GET['c2'] : base_url($base_url_val.'category/'.$this->uri->segment(4)); ?>"></a></li>
        <li><a class="<?php echo $map_cls; ?>" href="<?php echo isset($_GET['c2']) ? base_url($base_url_val.'map/'.$this->uri->segment(4)).'?c2='.$_GET['c2'] : base_url($base_url_val.'map/'.$this->uri->segment(4)); ?>"></a></li>
        </ul>
     </div>   
    <h1>
    <?php 
    if( $this->uri->segment(4) == "" || $this->uri->segment(4) == 0 ){
      echo 'Ricktag Featured Deals in '; 
    }else{

      $categories_nme = isset($categories->name) ? $categories->name : $categories ;

      echo 'Ricktag '. $categories_nme .' Deals in ';
    }
    echo $this->session->userdata("CUR_CITY")->name; 
    ?>
    </h1>
    </div>
   </div>
                         
                         
                         <div class="clearfix"></div>