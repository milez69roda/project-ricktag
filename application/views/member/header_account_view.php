<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<base href="<?php echo base_url(); ?>" />
	<title>My Account</title>
	
	<link rel="stylesheet" type="text/css" href="static/jquery-ui-themes/custom-theme/jquery-ui-1.8.23.custom.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>static/new_member/styles.css" />
	<link rel="stylesheet" type="text/css" href="static/fancybox/jquery.fancybox.css?v=2.1.0" media="screen" />		
		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<script src="static/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
	
	<!--<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyDOwuJfgTuDlNIumPiG97HRTjOqcfwp02c"  type="text/javascript"></script>-->
	
	<script src="static/member/member.js" type="text/javascript"></script>
	<script type="text/javascript" src="static/fancybox/jquery.fancybox.js?v=2.1.0"></script>

	
	<script>
	$(document).ready(function(){
	  $(".drop_arrow").click(function(){
		$("#city_info").slideToggle();
		
	  });
	  
	  $(".settings_arrow").click(function(){
		$("#settings_info").slideToggle();
		
	  });
	  
	});
	</script>
	

</head>
<body>
	<div id = "top_fixed">
		<input type="hidden" id="distributor_url" value="<?php echo @$this->distributor_url; ?>" />
		<div id = "top">
							<div id = "top-wrap">
						<div id = "top_left">
							<p style="padding-right: 10px; color: rgb(131, 134, 141);">Change Location</p>	
							<p id="ccenter_name"><?php echo $this->session->userdata("CUR_CITY")->name; ?></p>
							<p class = "drop_arrow"><img src = "<?php echo base_url()?>static/new_member/images/dropdown_arrow.png" alt = "" /></p>
							<div id = "city_info">
								<ul>
									<?php foreach($this->cities as $key=>$value): ?>								
									<li><a id="hctr_<?php echo $key; ?>" data="<?php echo $key; ?>" href="<?php echo $this->distributor_url ?>/members/category/<?php echo ($this->uri->segment(4) == '')?'0':$this->uri->segment(4); ?>/<?php echo $key; ?>"><?php echo $value; ?></a></li>
									<?php endforeach; ?> 									 
								</ul>
							</div>
						</div>
						
						<div id = "ricktag_num_area" style = " margin-left: 105px;">
							<p>
								<!--<label>My Ricktag Number</label>
								<input type = "text" name = "" readonly="readonly" value = "<?php echo $this->session->userdata("CARDID"); ?>" />-->
							</p>
						</div>
						<div id = "top_right" style = " width: 310px;">
							
							<ul>
								<!--<li><p><a href = "<?php //echo $this->distributor_url ?>/members/myaccount">My Account</a></p></li>-->
								<li style = "padding-right:10px; padding-left:10px;"><p style = "color:#fff; font-size:14px;  margin-right: 10px;  margin-top: 8px;">My Reward Bucks</p><p style = "color:#fff; font-size:20px;  margin-top: 8px;"><?php echo $info->card_balance; ?></p></li>
								<li><p><a href = "<?php echo $this->distributor_url ?>/members/myaccount"><?php echo $info->FIRSTNAME ?></a></p></li>
								<p class = "settings_arrow"><img src = "<?php echo base_url()?>static/new_member/images/down_arrow.png" alt = "" /></p>
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
		</div>
	</div>
	<div id="full-width">
		<div id = "wrapper-main">
			<div id = "wrapper">
				<div id = "header">
	
					<div id = "nav_menu">
						<ul>
							<!--<a href = "index.html"><li id = "menu_1" class = "current_1"></li></a>
							<a href = "auto.html"><li id = "menu_2" class = ""></li></a>
							<a href = "family.html"><li id = "menu_3" class = ""></li></a>
							<a href = "food_and_dining.html"><li id = "menu_4" class = ""></li></a>
							<a href = "health_and_beauty.html"><li id = "menu_5" class = ""></li></a>
							<a href = "home_and_garden.html"><li id = "menu_6" class = ""></li></a>
							<a href = "services.html"><li id = "menu_7" class = ""></li></a>
							<a href = "shopping.html"><li id = "menu_8" class = ""></li></a>
							<a href = "travel_and_leisure.html"><li id = "menu_9" class = ""></li></a>-->
							
							<a href="<?php echo $this->distributor_url; ?>/members/category/"><li id="menu_1" class = "<?php echo ($this->uri->segment(4)=='')?"current_1":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/category/1"><li id="menu_2" class = "<?php echo ($this->uri->segment(4)==1)?"current_2":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/category/2"><li id="menu_3" class = "<?php echo ($this->uri->segment(4)==2)?"current_3":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/category/3"><li id="menu_4" class = "<?php echo ($this->uri->segment(4)==3)?"current_4":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/category/4"><li id="menu_5" class = "<?php echo ($this->uri->segment(4)==4)?"current_5":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/category/5"><li id="menu_6" class = "<?php echo ($this->uri->segment(4)==5)?"current_6":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/category/6"><li id="menu_7" class = "<?php echo ($this->uri->segment(4)==6)?"current_7":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/category/7"><li id="menu_8" class = "<?php echo ($this->uri->segment(4)==7)?"current_8":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/category/8"><li id="menu_9" class = "<?php echo ($this->uri->segment(4)==8)?"current_9":"";  ?>"></li></a>
			
						</ul>
					</div>
					<div id = "details_section">
						<div id = "details_section_left">
							
						<?php if ($this->uri->segment(3) == "editaccount") :?>
							<h1>Edit Your Account</h1>
						<?php else: ?>
							<h1>My Account</h1>
						<?php endif; ?>
						</div>
						<div id="label-mem-since">Member Since: 04/12/11</div>
						<div class = "clear"></div>
					</div>
				</div><!--end of header -->
				<div id = "wrap-main">