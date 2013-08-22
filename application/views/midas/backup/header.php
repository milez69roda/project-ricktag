<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<base href="<?php echo base_url(); ?>" />	
	<title>Midas</title>
	<!--<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>-->
	<link rel="stylesheet" type="text/css" href="static/midas/style.css" />
	<link rel="stylesheet" type="text/css" href="static/jquery-ui-themes/custom-theme/jquery-ui-1.8.23.custom.css" />
	<link rel="stylesheet" href="static/midas/flexslider.css" />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<script src="static/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
	<script src="static/midas/midas.js" type="text/javascript"></script>
	
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
 
	<div id = "wrapper-main-container">		
		<div id = "wrapper-main">
			<div id = "wrapper-main-head"></div>
			<div id = "wrapper-main-top"></div>
			<div id = "wrapper-960">
				<div id = "wrapper">
					<div id = "header">
						<div id = "top-wrap">
							<div id = "logo" class = "left">
								<img src = "static/midas/images/logo_1.png" alt = "" />
							</div>

							<div id = "h-login-area">
								<p class = "_member_txt">MEMBER LOG IN</p>
								<form>
								<p style = "width:375px; margin-top:7px">
									<label>enter 8 digit number</label>
									<input type = "text" name = "" value = "" /> 
									<label style = "margin-left:30px;">what's this?</label>
									<input type = "text" name = "" value = "" /> 
									<label style = "margin-left:20px;">forgot password?</label>
									<input type = "text" name = "" value = "" style = "width:105px;"/> 
								</p>
								<p><input type="image" src="static/midas/images/midas_login_img.png" name="submit" onmouseout="this.src='static/midas/images/midas_login_img.png'" onmouseover="this.src='static/midas/midas/images/midas_login_hover.png'"></p>
								</form>
							</div>

							<div id = "get_featured_area">
								<p><a href = "">Have a business?</a></p>
								<a href = "http://request.ricktag.ca/biz/get_featured.html" title = "Get Featured"><img src = "static/midas/images/get_featured_btn.png" alt = "" /></a>
							</div>
							<div class = "clear"></div>
						</div>
						<div id = "top-2-wrap">
							<div id = "reg-card">
								<img src = "static/midas/images/card_img.png" alt = "" />
							</div>
							<div id = "reg-con">
								<h2>Your Neighbourhood Rewards Card</h2>

							<div id = "menu" class = "left">
								<ul>	
									<li><a href = "midas">Home</a></li>
									<li><a href="midas/howitworks">How It Works</a></li>
								 
								</ul>
							</div>
								 
							</div>
						</div>
						<div id = "top-3-wrap">
							<div id = "top-3-left">
								<div id="banner" class="flexslider">
				 
									<ul class="slides">
									
									  <li><a href=".html"><img src="static/midas/images/Midas_Show_Your_Card_Banner_516x310.png" height="310" width="516" alt="" /></a></li>
									  <li><a href=".html"><img src="static/midas/images/Midas_Rewards_Banner_516x310.png" height="310" width="516" alt="" /></a></li>
									  <li><a href=".html"><img src="static/midas/images/Midas_FB_Banner_516x310.png" height="310" width="516" alt="" /></a></li>
									   <li><a href=".html"><img src="static/midas/images/Houston_Steak_Banner_516x310.png" height="310" width="516" alt="" /></a></li>
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
												<p><input type="checkbox" name="terms" id="terms" value="1" />Yes, I agree to the <a href = "">terms and conditions</a></p>
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
					</div><!-- end of header -->
					<div id = "wrap">