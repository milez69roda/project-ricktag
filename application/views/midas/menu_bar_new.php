<body>
  <?php if(!empty($_SERVER['HTTP_REFERER'])) { ?>
    <?php if(strpos($_SERVER['HTTP_REFERER'], 'learn') ){ ?>
      <script type="text/javascript" charset="utf-8">
        $(window).load(function () {
            $('#button_login').trigger('click');
        });
      </script>
   <?php } ?>
 <?php }else{ ?>
      <script type="text/javascript" charset="utf-8">
        $(window).load(function () {
            $('#button_login').trigger('click');
        });
      </script>
 <?php } ?>
  <input type="hidden" id="distributor_url" value="<?php echo $this->distributor_url; ?>" />
  <div class="headerbg">
    <div class="header"><a href="<?php echo base_url('learn');?>" class="header_icon"><img src="<?php echo base_url();?>static/ricktag/images/Ricktag-Logo.gif" alt="ricktag rewards logo"/></a> 
       <img class="header_icon2" src = "<?php echo $this->header_card_image; ?>" alt = ""  width="150" height="100" alt="" />             
             
    <div class="check">
      <span <?php /*href="<?php echo base_url('giftcards');?>" */?> class="midas_check_icon"></span>   
      <!--<a href="<?php echo isset($_GET['c2']) ? base_url($this->distributor_url.'/giftcards').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/giftcards'); ?>" class="check_icon"></a>   -->
      <div class="follow">           
        <p style="position: relative;left: 100px;float: left;top: -2px;">Follow Us: </p>
        <a href="//www.facebook.com/RicktagAdvantageCards" target="_blank" class="facebook_icon"></a> 
        <a href="//www.twitter.com/ricktagrewards" target="_blank" class="twitter_icon"></a>
      </div> 
      <div class="login_holder">
        <a href="<?php echo isset($_GET['c2']) ? base_url($this->distributor_url.'/popup_login').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/popup_login'); ?>" class = "fancybox fancybox.ajax" id="button_login">Member Login</a>
      </div>
    </div>        
              </div>
<!-- end .headerbg --></div>
  <div class="clearfix"></div>
<?php 
    $home_btn = '';
    $gift_cards_btn = '';
    $get_cards_btn = '';
    $how_to_use_btn = '';

    /*
    switch ($page_name) {
      case 'homepage':
        $home_btn = 'active_home_btn';
        break;
      case 'giftcards':
        $gift_cards_btn = 'active_gift_cards_btn';
        break;
      case 'getcards':
        $get_cards_btn = 'active_get_a_card_btn';
        break;
      case 'howitworks':
        $how_to_use_btn = 'active_how_to_use_btn';
        break;
      default:
        
        break;
    }
    */ 
	 
    ?>
  
    <div id="nav_bg">
        <div id="navigation">
        <ul>
            <li><a class=" <?php echo $home_btn; ?> home_btn" href="<?php echo isset($_GET['c2']) ? base_url($this->distributor_url).'?c2='.$_GET['c2'] : base_url($this->distributor_url); ?>"></a></li>
            <li><a class=" <?php echo $how_to_use_btn; ?> how_to_use_btn" href="<?php echo isset($_GET['c2']) ? base_url($this->distributor_url.'/howitworks').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/howitworks'); ?>"></a></li>
            <li><a class="<?php echo $get_cards_btn; ?> midas_get_a_card_btn" href="<?php echo isset($_GET['c2']) ? base_url($this->distributor_url.'/register').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/register'); ?>"></a></li>
            <!--<li><a class="<?php echo $gift_cards_btn; ?> gift_cards_btn" href="<?php echo isset($_GET['c2']) ? base_url($this->distributor_url.'/giftcards').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/giftcards'); ?>"></a></li>-->
            <li><a class="midas_grow_your_business_btn" href="//www.merchant.ricktag.ca"></a></li>
            <li><a class="shop_ricktag_btn" href="<?php echo isset($_GET['c2']) ? base_url('/'.$this->distributor_url.'/guest/category').'?c2='.$_GET['c2'] : base_url('/'.$this->distributor_url.'/guest/category'); ?>"></a></li>
            <li class="space_ricktag_btn" ></li>
        </ul>
        </div>
     </div>
     <div class="clearfix"></div>