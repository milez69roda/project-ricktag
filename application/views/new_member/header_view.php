<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	 <title>List View</title>
	<script type="text/javascript" src="<?php echo base_url()?>static/new_member/js/jquery-1.7.2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>static/new_member/styles.css" />
	
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
		<div id = "top">
							<div id = "top-wrap">
						<div id = "top_left">	
							<p>Barrie</p>
							<p class = "drop_arrow"><img src = "<?php echo base_url()?>static/new_member/images/dropdown_arrow.png" alt = "" /></p>
							<div id = "city_info">
								<ul>
									<li><a href = "">Barrie</a></li>
									<li><a href = "">Bradford</a></li>
									<li><a href = "">Innisfil</a></li>
									<li><a href = "">Keswick</a></li>
									<li><a href = "">Newmarket</a></li>
									<li><a href = "">Richmond Hill</a></li>
								</ul>
							</div>
						</div>
						<div id = "ricktag_num_area">
							<p>
								<label>My Ricktag Number</label>
								<input type = "text" name = "" value = "30002766" />
							</p>
						</div>
						<div id = "top_right">
							
							<ul>
								<li><p><a href = "">My Account</a></p></li>
								<li><p><a href = "">Rick Brooks</a></p></li>
								<p class = "settings_arrow"><img src = "<?php echo base_url()?>static/new_member/images/down_arrow.png" alt = "" /></p>
							</ul>
							<div id = "settings_info">
								<ul>
									<li><a href = "">My Account</a></li>
									<li><a href = "">My Special Offers</a></li>
									<li><a href = "">My Reward Bucks</a></li>
									<li><a href = "">My Subscription</a></li>
									<li><a href = "">My Card History</a></li>
									<li><a href = "">Sign Out</a></li>
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
							<a href = "index.html"><li id = "menu_1" class = "current_1"></li></a>
							<a href = "auto.html"><li id = "menu_2" class = ""></li></a>
							<a href = "family.html"><li id = "menu_3" class = ""></li></a>
							<a href = "food_and_dining.html"><li id = "menu_4" class = ""></li></a>
							<a href = "health_and_beauty.html"><li id = "menu_5" class = ""></li></a>
							<a href = "home_and_garden.html"><li id = "menu_6" class = ""></li></a>
							<a href = "services.html"><li id = "menu_7" class = ""></li></a>
							<a href = "shopping.html"><li id = "menu_8" class = ""></li></a>
							<a href = "travel_and_leisure.html"><li id = "menu_9" class = ""></li></a>
						</ul>
					</div>
					<div id = "details_section">
						<div id = "details_section_left">
							<h1>Featured Deals in Barrie</h1>
						</div>
						<div id = "details_section_right">
							<!-- <img src = "images/list_deals_btn.png" alt = "" />
							<a href="map/home.html"><img src = "images/map_deals_btn.png" alt = "" /></a> -->
							<ul>
								<li id = "list_deals" class = "current"></li>
								<a href = "http://request.ricktag.ca/demo/new_members/map">
								<li id = "map_deals" class = ""></li></a>
							</ul>
						</div>
						<div class = "clear"></div>
					</div>
				</div><!--end of header -->
				<div id = "wrap-main">