<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<title>Map View</title>
	<base href="<?php echo base_url(); ?>" />
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
	<script type="text/javascript"	src="http://maps.googleapis.com/maps/api/js?AIzaSyCwYxCKPcj0DRupO2CeKrgUwCAVIkwBLpc&sensor=false"></script>
	<script type="text/javascript">
	  var script = '<script type="text/javascript" src="http://google-maps-' + 'utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble';
	  if (document.location.search.indexOf('compiled') !== -1) {
		script += '-compiled';
	  }
	  script += '.js"><' + '/script>';
	  document.write(script);
	</script>
	
	<script type="text/javascript">
		var markers = [];
		var mapInfoWindow;
		var mapLocTitles = [];
		var loctitle = '';
		var infoBubble;
		function initialize() {
			var map;
			var mapOptions = {
				center: new google.maps.LatLng(44.0491,-79.430834),
				zoom: 11,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);
			mapInfoWindow = new google.maps.InfoWindow();	
			var stylez = [
				{
					featureType: "all",
					elementType: "all",
					stylers: [
						{ saturation: -85 } //Greyscale
					]
				}
			];	
			var mapType = new google.maps.StyledMapType(stylez, { name:"Grayscale" }); 
			map.mapTypes.set('tehgrayz', mapType);
			map.setMapTypeId('tehgrayz');
			content = '<div style="padding: 5px; width: 200px; height: 75px;">'+
					'<div style="float:left; margin-right: 10px;"><img src="http://request.ricktag.ca/demo/static/new_member/images/midas.png" /></div>'+
					'<div style="float:left; font-weight:bold;color:#191401;">Midas Automotive<br />341 Yonge Street<br /><a href="../list_view.html" style="color:#191401;">view deal</a></div>'+
					'</div>';
			addMarker(44.043301,-79.426543, "NewMarket",content,map);
			addMarker(44.134904,-79.642054, "Bradford West Gwillimbury, ON",content,map);
			addMarker(44.098425,-79.44224, "Sharon",content,map);
			addMarker(44.086096,-79.490992, "East Gwillimbury, ON",content,map);
			
			
			
			
		}
		function addMarker(lat,lng,title,contentString,map){
			var location= new google.maps.LatLng(lat,lng);
			var index = 0;
			var marker = new google.maps.Marker({
				position: location,
				icon: '<?php echo base_url()?>static/new_member/images/marker.png',
				title: title,
				map: map,
			});
			markers.push(marker);
			mapLocTitles.push('<span style="font-size: 35px; padding: 0px; margin: 0px;">'+title+'</span>');
			index = markers.length-1;
			var infoBubble = new InfoBubble({
				maxWidth: 700,
				content: contentString,
				shadowStyle: 1,
				disableAutoPan: true,
				hideCloseButton: true
			});
			google.maps.event.addListener(markers[index], 'mouseover', function(){
				infoBubble.open(map, markers[index]);
			});
			google.maps.event.addListener(markers[index], 'mouseout', function(){
				infoBubble.close(map, markers[index]);
			});										
		}
	</script>
</head>
<body onload="initialize()">
<div id = "top_fixed">
		<div id = "top">
							<div id = "top-wrap">
						<div id = "top_left">	
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
						<div id = "ricktag_num_area">
							<p>
								<label>My Ricktag Number</label>
								<input type = "text" name = "" value = "<?php echo $this->session->userdata("CARDID"); ?>" />
							</p>
						</div>
						<div id = "top_right">
							
							<ul>
								<li><p><a href = "<?php echo $this->distributor_url ?>/members/myaccount">My Account</a></p></li>
								<li><p><a href = "<?php echo $this->distributor_url ?>/members/myaccount">Rick Brooks</a></p></li>
								<p class = "settings_arrow"><img src = "<?php echo base_url()?>static/new_member/images/down_arrow.png" alt = "" /></p>
							</ul>
							<div id = "settings_info">
								<ul>
									<li><a href="<?php echo $this->distributor_url ?>/members/myaccount">My Account</a></li>
									<li><a href = "">My Special Offers</a></li>
									<li><a href = "">My Reward Bucks</a></li>
									<li><a href = "">My Subscription</a></li>
									<li><a href = "">My Card History</a></li>
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
							<h1>
							<?php 
								 
								if( ($this->uri->segment(4) == "") OR ($this->uri->segment(4)) == 0 ){
									echo 'Ricktag Featured Deals'; 
								}else{
									echo 'Ricktag '.$categories->name.' Deals';
								}
							?>
							 
							<span> in <?php echo $this->session->userdata("CUR_CITY")->name; ?></span>							
							</h1>
						</div>
						<div id = "details_section_right"> 
						
							<ul>
								<a href = "<?php echo $this->distributor_url; ?>/members/category/"><li id = "list_deals" class = "<?php echo ($this->uri->segment(3)=='category')?"current":"";  ?>"></li></a>
								<a href = "<?php echo $this->distributor_url; ?>/members/map"> <li id = "map_deals" class = "<?php echo ($this->uri->segment(3)=='map')?"cur_2":"";  ?>"></li></a>
							</ul> 
						</div>
						<div class = "clear"></div>
					</div>
				</div><!--end of header -->
				
			</div>
		</div>
	</div>	