<body style="background: #fff;">
<script type="text/javascript">
$(document).ready(function() {
  /*
  $('#cycle_crds').cycle({ 
    fx:   'zoom', 
    sync:  true, 
    delay:  -4000 
  });
  */

  $('#dg-container').gallery({
    autoplay  : true
  });
});
</script>
<div class="container_no_border">

  <div class="content">
    
    
    <!--body content starts here-->

             <div class="howitworkscontainer">

     <div class="top" style="text-align: right;">
      <!--<a href="<?php echo base_url('/welcome/popup_login'); ?>" class = "fancybox fancybox.ajax home_login hover_orange" id="button">Member Login</a>-->
    </div>

             <div class="pageintro">
             
             <img style="margin: 10px 0px 55px -18px;" src="<?php echo base_url();?>static/ricktag/images/ricktag_logo_lrg.gif" alt="ricktag logo"> 


          <section id="dg-container" class="dg-container">
              <div class="dg-wrapper">
                <a href="#"><img width="322px" height="203px" src="<?php echo base_url();?>static/ricktag/banner_logo/Midas-Card.png" alt="Midas card"></a>
                <a href="#"><img width="322px" height="203px" src="<?php echo base_url();?>static/ricktag/banner_logo/Nissan-Card.png" alt="Nissan Card"></a>
                <a href="#"><img width="322px" height="203px" src="<?php echo base_url();?>static/ricktag/banner_logo/NewRoads-Card.png" alt="NEw Roads card"></a>
                <a href="#"><img width="322px" height="203px" src="<?php echo base_url();?>static/ricktag/banner_logo/Igor-Vujovic-Card.png" alt="Igor Vujovic Card"></a>
                <a href="#"><img width="322px" height="203px" src="<?php echo base_url();?>static/ricktag/banner_logo/McCallum-Card.png" alt="McCallum card"></a>
              </div>
        </section>

             <h3>About our Cards</h3>

<p style="line-height: 25px;">Ricktag® is a free loyalty and rewards program that offers Ricktag® card holders exclusive local discounts and rewards each time you use your card at participating Sponsors.  With your card you get restaurant discounts, shopping discounts, hair salon discounts, hotel discounts, golf discounts, home services discounts and so much more for you and your family.</p>

<br/>
<div class="cardbox_container">
  <h1 style="font-size: 30px; font-weight:normal;">Enter your Ricktag Card Number</h1>

  <form name="form1" action="<?php echo current_url(); ?>" method="post">
  <div class="main_login_field login_field"><label for="username" class="placeholder">Card number</label> <input type="text" class="main_login_text" name="card1" tabindex="1" class="av-text" value="" id="card1"></div>
            <?php /*<input type = "text" name = "card1" value = "enter number" placeholder= "enter number" onfocus="if (this.value == 'enter number') {this.value = '';}" onblur="if (this.value == '') {this.value = 'enter number';}"/> */?>

            <?php /*<input type="text" name="card1" tabindex="1" class="home_page_text" value="" id="card1"> */?>
            
            <input type="submit" name="submit" class="common_button main_login_submit" value="GO">
            <!--main_login_submit go_btn_sbmt-->

  </form> 
  <div class="clearfix"></div> 

  <p style="text-align:left;margin-left: 140px;font-size: 16px;">Get rewarded, earn points and save money right in your<br/>neighbourhood using your Ricktag Rewards Card.</p>
</div>

<br/>  <br/>
      <!--<a href="<?php echo base_url('guest/register'); ?>" class="register_your_card_btn">Register Your Card</a>-->
      <a href="<?php echo base_url('guest/register'); ?>" style="font-size: 25px;color:#666666">don't have a card?</a>
      <a href="<?php echo base_url('learn'); ?>" style="margin-left:50px;" class="custom1_button">Take A Tour</a>
      <!--take_a_tour_btn-->
    <br/>
    <br/>

  <p>Business owners? <a class="hover" href="//www.ricktagworks.ca/">click here</a></p>
 <br/>
<br/>

  



      </div>
   
  <p>© Copyright 2013 Ricktag Rewards. All Rights Reserved.<a class="merchant_login hover_orange" href="//www.ricktagworks.ca/login">Merchant Login</a></p>
  </div>


<!--body content ends here-->
  </div>  
</div>

</body>
</html>