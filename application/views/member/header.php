<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<title>Ricktag</title>
	<base href="<?php echo base_url(); ?>" />
	<!--<script type="text/javascript" src="<?php echo base_url();?>static/js/jquery-1.7.2.min.js"></script>-->
	<link rel="stylesheet" type="text/css" href="static/jquery-ui-themes/custom-theme/jquery-ui-1.8.23.custom.css" />
	
	<!--<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyDOwuJfgTuDlNIumPiG97HRTjOqcfwp02c"  type="text/javascript"></script>	-->
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBr3dMMcCP29bZEXuwJhsDlxC2dQr_h_jA&sensor=false"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<script src="static/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
	<script src="static/member/member.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/member/style.css" />
	 
	<script type="text/javascript" src="static/fancybox/jquery.fancybox.js?v=2.1.0"></script>
	<link rel="stylesheet" type="text/css" href="static/fancybox/jquery.fancybox.css?v=2.1.0" media="screen" />	
	
	<script>
	$(document).ready(function(){
	
	  $(".drop_arrow").click(function(){
		$("#city_info").slideToggle();
		
	  });
	  
	  $(".settings_arrow").click(function(){
		$("#settings_info").slideToggle();
		
	  });
	  
		$("#nav_menu ul li").click( function(){
			/* var id = $(this).attr();
			alert(id) */
		});
		
		/* $("#right_menu li a").click( function(){
			
			Member.setCity( $(this).attr("data"));
			$("#ccenter_name").html($(this).text()); 
		}) */
	});
	</script>
	
</head>
<body>
	
	<div id = "wrapper-main-container">		
		<div id = "wrapper-main">
			<input type="hidden" id="distributor_url" value="<?php echo @$this->distributor_url; ?>" />
			<div id = "wrapper-main-head"></div>
			<div id = "wrapper-main-top"></div>
			<div id = "wrapper-980">
				<div id = "wrapper">
					<div id = "header">
						<div id = "top-wrap">
							<div id = "top_left">	
								<p id="ccenter_name"><?php echo $this->session->userdata("CUR_CITY")->name; ?></p>
								<p class = "drop_arrow"><img src = "<?php echo base_url(); ?>static/member/images/dropdown_arrow.png" alt = "" /></p>
								<div id = "city_info">
									<ul id="right_menu">
										<?php foreach($this->cities as $key=>$value): ?>
										<li><a id="hctr_<?php echo $key; ?>" data="<?php echo $key; ?>" href="<?php echo $this->distributor_url ?>/members/category/<?php echo ($this->uri->segment(4) == '')?'0':$this->uri->segment(4); ?>/<?php echo $key; ?>"><?php echo $value; ?></a></li>
										<?php endforeach; ?> 
										<!--<li><a href = "">Bardford</a></li>
										<li><a href = "">Innisfil</a></li>
										<li><a href = "">Keswick</a></li>
										<li><a href = "">Newmarket</a></li>
										<li><a href = "">Richmond Hill</a></li>-->
									</ul>
								</div>
							</div>
							<div id = "top_right">
								<ul>
									<li><p><a href = "<?php echo $this->distributor_url ?>/members/myaccount">My Account</a></p></li>
									<li><p><a href = "<?php echo $this->distributor_url ?>/members/myaccount"><?php echo $this->distributor_name; ?></a></p></li>
									<p class = "settings_arrow"><img src = "<?php echo base_url(); ?>static/member/images/down_arrow.png" alt = "" /></p>
								</ul>
								<div id = "settings_info">
									<ul>
									<li><a href="<?php echo $this->distributor_url ?>/members/myaccount">My Account</a></li>
									<!--<li><a href = "<?php echo $this->distributor_url ?>/members/myspecialoffers">My Special Offers</a></li>-->
									<!--<li><a href = "">My Reward Bucks</a></li>
									<li><a href = "">My Subscription</a></li>-->
									<li><a href = "<?php echo $this->distributor_url ?>/members/mycardhistory">My Card History</a></li>
										<li><a href="<?php echo $this->distributor_url ?>/members/logout">Sign Out</a></li>
									</ul>
								</div>
								<div class = "clear"></div>
							</div>
							<div class = "clear"></div>
						</div>
						<div id = "top-2-wrap">
							<div id = "reg-card">
								<img src = "<?php echo base_url(); ?>static/member/images/card_img.png" alt = "" />
							</div>
							<div id = "reg-con">
								<h2>Your Neighbourhood Rewards Card</h2>
								<p>Show.Swipe.Save. It's that easy!</p>
								<!-- <p>Particpating Locations: <br />
								341 Yonge Street, Barrie (705)722-3113<br />
								221 Mapleview Drive West, Barrie (705)722-7576</p> -->
								
								
							</div>
						</div>
		
					</div><!-- end of header -->
					<div id = "wrap">