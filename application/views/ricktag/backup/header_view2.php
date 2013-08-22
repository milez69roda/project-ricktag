<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<title>Ricktag</title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/jquery-ui-themes/custom-theme/jquery-ui-1.8.23.custom.css" />	 
	<script type="text/javascript" src="<?php echo base_url();?>static/ricktag/js/jquery-1.7.2.min.js"></script>
	<script src="<?php echo base_url();?>static/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/ricktag/styles.css" />
	
	<script type="text/javascript">	
		$(document).ready(function(){
		
			$('.this_pop').hide();
			
			$('.wht').mouseover(function(){
				
				$('.this_pop').fadeIn('slow');
				
			}).mouseout(function(){
				$('.this_pop').fadeOut('slow');;
			}); 
			
		});
	</script>
	
	
</head>
<body>
	<div id = "wrapper-main">
		<div id = "wrapper">
			<div id = "header">
				<div id = "header-log-area">
					<div id = "h-login-area">
						<p style = "margin-top:45px" class = "_member_txt">YOUR RICKTAG NUMBER</p>
						<form name="form1" action="" method="post">
						<div class = "this_pop"><img src = "static/midas/images/what_this_img.png" alt = "" /></div>
						<p style = "margin-top:15px">
							<!-- <label>Enter 8 digit number</label>
							<input type = "text" name = "" value = "" />  -->
							<label style = "margin-left:59px; font-size:12px;" class = "wht">what's this?</label>
							
							<input type = "text" name = "card1" value = "" placeholder = "10004455" /> 
							
						</p>
						<p>
						<!--<input type="image" src="<?php// echo base_url();?>static/ricktag/images/enter_site_btn.png">-->
						
						<input type="image" src="<?php echo base_url();?>static/ricktag/images/EnterSite-Button.png" name="submit" onmouseout="this.src='<?php echo base_url();?>static/ricktag/images/EnterSite-Button.png'" onmouseover="this.src='<?php echo base_url();?>static/ricktag/images/EnterSite-Button-hover.png'">
						</p>
						</form>
					</div>
					<div id = "r_logo"> 
						 <img src = "<?php echo base_url();?>static/ricktag/images/ricktag_logo.png" alt = "" />
					</div>
					<div id = "banner">
						<img src = "<?php echo base_url();?>static/ricktag/images/Ricktag-Intro-Banner.png" alt = "" />
					</div>
					<!-- <div id = "partners_area">
						<ul>
							<li><img src = "images/img_1.png" alt = "" /></li>
							<li><img src = "images/img_2.png" alt = "" /></li>
							<li><img src = "images/img_3.png" alt = "" /></li>
							<li><img src = "images/img_4.png" alt = "" /></li>
							<li><img src = "images/img_5.png" alt = "" /></li>
							<li><img src = "images/img_6.png" alt = "" /></li>
							<li><img src = "images/img_7.png" alt = "" /></li>
						</ul>
					</div> -->
				</div>
			</div><!--end of header -->
			<div id = "mid-box">
				<div id = "mid-box-h2">
					<ul>
						<li><p>Register your card</p></li>
						<li><img src = "<?php echo base_url();?>static/ricktag/images/arrow.png" alt = ""></li>
						<li><p>Show & Save</p></li>
						<li><img src = "<?php echo base_url();?>static/ricktag/images/arrow.png" alt = ""></li>
						<li><p>Swipe & Earn</p></li>
					</ul>
					
				</div>
				<div id = "mid_box1" class = "mbox">
					
					<div class = "img_icon"><img src = "<?php echo base_url();?>static/ricktag/images/icon_1.png"></div>
					<p>Ricktag is a free loyalty and rewards card that save consumers money.</p>
				</div>
				<div id = "mid_box2" class = "mbox">
					
					<div class = "img_icon"><img src = "<?php echo base_url();?>static/ricktag/images/icon_2.png"></div>
					<p>Save money right in your neighbourhood on shops, restaurants, spas, and more.</p>
				</div>
				<div id = "mid_box3" class = "mbox">
					
					<div class = "img_icon"><img src = "<?php echo base_url();?>static/ricktag/images/Star-Icon.png"></div>
					<p>Swipe your card at local businesses and earn loyalty dollars on each purchase.</p>
				</div>
			</div>