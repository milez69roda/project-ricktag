<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<base href="<?php echo base_url(); ?>" />	
	<title><?php echo $this->distributor_title; ?></title>
	
	<link rel="stylesheet" type="text/css" href="static/midas/style.css" />
	<link rel="stylesheet" type="text/css" href="static/jquery-ui-themes/custom-theme/jquery-ui-1.8.23.custom.css" />
	<link rel="stylesheet" href="static/midas/flexslider.css" />
	
	<script type="text/javascript" src="static/js/jquery-1.7.2.min.js"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>-->
	<script src="static/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
	<script src="static/midas/midas.js" type="text/javascript"></script>
	
	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyDOwuJfgTuDlNIumPiG97HRTjOqcfwp02c"  type="text/javascript"></script>
	 
	<script type="text/javascript" src="static/fancybox/jquery.fancybox.js?v=2.1.0"></script>
	<link rel="stylesheet" type="text/css" href="static/fancybox/jquery.fancybox.css?v=2.1.0" media="screen" />	

	<script src="static/js/jquery.flexslider.js"></script>   
    <script type="text/javascript" charset="utf-8">
        $(window).load(function () {
            $('.flexslider').flexslider({
                animationLoop: true,
                slideshowSpeed: 4000
            });
        });
	</script>
	 
	<script type="text/javascript">	
		
		$(document).ready(function(){
		
			$('.this_pop').hide();
			$('.this_pop1').hide();
			$('.w_pop').hide();
			
			
			
			$('.wht').mouseover(function(){
				
				$('.w_pop').fadeIn('slow');
				
			}).mouseout(function(){
				$('.w_pop').fadeOut('slow');;
			}); 
			
			
			$('._this').mouseover(function(){
				
				$('.this_pop').fadeIn('slow');
				
			}).mouseout(function(){
				$('.this_pop').fadeOut('slow');;
			});
			
			
			$('._this1').mouseover(function(){
				
				$('.this_pop1').fadeIn('slow');
				
			}).mouseout(function(){
				$('.this_pop1').fadeOut('slow');;
			});
			


			
			$('#this_pop').click(function(){
				$(this).fadeOut('slow');
			});
			$('#card_area_list').hide();
			//$('#reg_area_list').hide();
			$('.gift_list p').click(function(){
			
				$(this).css('color', 'black');
				$('.reg_list p').css('color', 'white');
				
			
				$('#reg_area_list').fadeOut('slow');
				$('#card_area_list').fadeIn('slow');
			});
			$('.reg_list p').click(function(){
			
				$(this).css('color', 'black');
				$('.gift_list p').css('color', 'white');
				
				$('#reg_area_list').fadeIn('slow')
				$('#card_area_list').fadeOut('slow');
			});
			
		});
		
	</script>
</head>
<body>
 	<div id = "my_reward">
			<img src = "<?php echo base_url(); ?>static/midas/images/my_reward.png" alt = "" />
	</div>
	<div id = "wrapper-main-container">	
		<input type="hidden" id="distributor_url" value="<?php echo @$this->distributor_url; ?>" />
	
		<div id = "wrapper-main">
			<div id = "wrapper-main-top">
				<div id = "wrapper-main-top-960">
						<div id = "top-wrap">
						
							<div id = "logo" class = "left">
								<a href = "<?php echo base_url().(@$this->distributor_url);  ?>" title = "Ricktag"><img src = "static/midas/images/logo.png" alt = "" /></a>
							</div>

							<div id = "h-login-area">
								<form name="loginform" action="<?php echo base_url().(@$this->distributor_url).'/login'; ?>" method="post" onsubmit="return Midas.login(this);">
								<p class = "_member_txt">
								MEMBER LOG IN 
								
								</p>
								<div class = "w_pop"><img src = "static/midas/images/what_this_img.png" alt = "" /></div>
								
								<p style = "width:265px; margin-top:7px">
									<!--<label>enter 8 digit number</label>
									<input type = "text" name = "card1" value = "<?php //echo @$_GET["c1"]; ?>" maxlength = "4" placeholder = "0000"/> -->
									<label style = "margin-left:30px;" class = "wht">what's this?</label>
									
									<input type = "text" name = "card2" value = "<?php echo @$_GET["c2"]; ?>" maxlength = "8" placeholder = "0000"/> 
									<label style = "margin-left:20px;"><a href = "http://request.ricktag.ca/demo/midas" class = "forgot_pass" title = "Forgot Password">forgot password?</a></label>
									<input type = "text" name = "pwd" value = "" placeholder = "password" style = "width:105px;"/> 
								</p>
								<p><input type="image" src="static/midas/images/midas_login_img.png" name="submit" onmouseout="this.src='static/midas/images/midas_login_img.png'" onmouseover="this.src='static/midas/images/midas_login_hover.png'"></p>
								</form>
							</div>

							
							<div class = "clear"></div>
						</div>
				</div>
			</div>
			<div id = "wrapper-main-head"></div>
			
			<div id = "wrapper-960">
				<div id = "wrapper">
					<div id = "header">
					
						<div id = "top-2-wrap">
							<div id = "reg-card">
								
								<img src = "<?php echo $this->header_card_image; ?>" alt = ""  width="264" height="171" alt="" />
							</div>
							<div id = "reg-con">
								<h2><span>Ricktag cards</span> keep it local <span>and</span> reward those loyal!</h2>

							<div id = "menu" class = "left">
								<ul>	
									<li><a href="<?php echo @$this->distributor_url; ?>">Home</a></li>
									<li><a href="<?php echo @$this->distributor_url; ?>/howitworks">How It Works</a></li>
									<li><a href="http://request.ricktag.ca/business/get-featured" title = "Get Featured">Get Featured</a></li>
								</ul>
							</div>
								 
							</div>
						</div>
						<div id = "top-3-wrap">
							<div id = "top-3-left">
								<div id="banner" class="flexslider">
				 
									<ul class="slides">
										<?php
											foreach( $this->header_card_slides as $img ):
										?>	
											<li><a href="#"><img src="<?php echo $img; ?>"  width="516" height="310" alt="" /></a></li>
										<?php endforeach; ?>									
									  <!--<li><a href=".html"><img src="static/midas/images/Midas_Show_Your_Card_Banner_516x310.png" height="310" width="516" alt="" /></a></li>
									  <li><a href=".html"><img src="static/midas/images/Midas_Rewards_Banner_516x310.png" height="310" width="516" alt="" /></a></li>
									  <li><a href=".html"><img src="static/midas/images/Midas_FB_Banner_516x310.png" height="310" width="516" alt="" /></a></li>
									   <li><a href=".html"><img src="static/midas/images/Houston_Steak_Banner_516x310.png" height="310" width="516" alt="" /></a></li>-->
									</ul>
								</div>
							</div>
							 
							<div id = "top-3-right-area">
								<div id = "midas_card_list">
									<ul>
										<li class = "reg_list"><p>Register Card</p></li>
										<li class = "gift_list"><p>Gift Card</p></li>
									</ul>
								</div>
								<div id = "reg_area_list">
									<div id = "top-3-right">
										<div class = "reg_card">
											<p style = "float:right; margin-right: 15px;" class = "_this">what's this?</p>
											<div class = "this_pop"><img src = "static/midas/images/what_this_img.png" alt = "" /></div>
											<form action = ""  method = "post" onsubmit="return Midas.register(this)">
												<p><input type = "text" name = "card_number" id = "card_number" placeholder = "Card Number" /></p>
												<p><select name = "city" id = "city">
													<option value="">Select City</option>
													<?php foreach( $cities as $city ): ?>
													<option value="<?php echo $city->id; ?>"><?php echo $city->name; ?></option> 
													<?php endforeach; ?>
												</select></p>
												<p><input type = "text" name = "name" id = "fullname" placeholder = "Name" />
												<!--<input type = "text" name = "name" id = "fullname" placeholder = "Name" style="width: 35% !important"/>--></p>
												<p><input type = "text" name = "email" id = "email" placeholder = "Email" /></p>
												<p class = "postal_code">
													<input type = "text" name = "postal" id = "postal" placeholder = "Postal Code" />
													<input type="radio" name="gender" value="male" checked="checked">Male 
													<input type="radio" name="gender" value="female"> Female
												</p>
												<p><input type="checkbox" name="terms" id="terms" value="1" />Yes, I agree to the <a href = "<?php echo base_url().'midas/howitworks'; ?>" title = "Terms and Conditions" style = "color:#000;">terms and conditions</a></p>
												<p  style = "margin-top:10px;"><input type="image" src="static/midas/images/register_btn.png" onclick="" /></p>
												<p style = "margin-left:7px;">* We take the security of your information very
			seriously and will always respect your privacy.</p>
											</form>
										</div>
									</div>
								</div>
								<div id = "card_area_list">
									<div id = "card_list">
										<h2>Get Your Card Balance</h2>
										<p><img src = "static/midas/images/gift_card_midas.png" alt = "" /></p>
										<p style = "float:right; " class = "_this1">what's this?</p>										
										<div class = "this_pop1"><img src = "static/midas/images/what_this_img.png" alt = "" /></div>
										<form action = ""  method = "post" onsubmit="return Midas.giftcard(this)">
											<p><input type = "text" name = "card_number" placeholder = "Enter Your Card Number" /></p>
											<p style = "margin-top:10px;"><input onmouseover="this.src='static/midas/images/check_balance_hover.png'" onmouseout="this.src='static/midas/images/check_balance_img.png'" type="image" name="submit" src="static/midas/images/check_balance_img.png"></p>
											<p class = "bal" id="gc_bal_label"> </p>
										</form>
									</div>
								</div>						
						
							</div>
						
						
							<!--	
							<div id = "top-3-left">
								<img src = "static/midas/images/register_img.png" alt = "" />
							</div>
							<div id = "top-3-right">
								<ul>
									<li>Register Card</li>
									<li>Gift Card</li>
								</ul>
								<div>
									<p>what's this?</p>
								</div>
								<form action = ""  method = "post" onsubmit="return Midas.register(this)">
									<p><input type = "text" name = "card_number" id = "card_number" placeholder = "Card Number" /></p>
									<p><select name = "city" id = "city">
										<option value="">Select City</option>
										<?php foreach( $cities as $city ): ?>
										<option value="<?php echo $city->id; ?>"><?php echo $city->name; ?></option> 
										<?php endforeach; ?>
									</select></p>
									<p><input type = "text" name = "name" id = "fullname" placeholder = "Name" />
									 
									<p><input type = "text" name = "email" id = "email" placeholder = "Email" /></p>
									<p class = "postal_code">
										<input type = "text" name = "postal" id = "postal" placeholder = "Postal Code" />
										<input type="radio" name="gender" value="male" checked="checked">Male 
										<input type="radio" name="gender" value="female"> Female
									</p>
									<p><input type="checkbox" name="terms" id="terms" value="1" />Yes, I agree to the <a href = "">terms and conditions</a></p>
									<p><input type="image" src="static/midas/images/register_btn.png" onclick="" /></p>
									<p style = "margin-left:7px;">* We take the security of your information very
seriously and will always respect your privacy.</p>
								</form>
							</div>
							-->
							
							
						</div>
						<div id = "top-4-wrap">
							<div id = "top_box1" class = "tbox">
								<h2>Register your card</h2>
								<div class = "img_icon"><img src = "<?php echo base_url();?>static/midas/images/icon_1.png"></div>
								<p>Ricktag is a free loyalty and rewards card that save consumers money.</p>
							</div>
							<div id = "top_box2" class = "tbox">
								<h2>Show & Save</h2>
								<div class = "img_icon"><img src = "<?php echo base_url();?>static/midas/images/icon_2.png"></div>
								<p>Save money right in your neighbourhood on shops, restaurants, spas, and more.</p>
							</div>
							<div id = "top_box3" class = "tbox">
								<h2>Swipe & Earn</h2>
								<div class = "img_icon"><img src = "<?php echo base_url();?>static/midas/images/icon_3.png"></div>
								<p>Swipe your card at local businesses and earn loyalty dollars on each purchase.</p>
							</div>
						</div>
					</div><!-- end of header -->
					<div id = "wrap">