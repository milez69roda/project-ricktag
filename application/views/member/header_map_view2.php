<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<title>Map View</title>
	<base href="<?php echo base_url(); ?>" />
	
	<link rel="stylesheet" type="text/css" href="static/jquery-ui-themes/custom-theme/jquery-ui-1.8.23.custom.css" />
	<script type="text/javascript" src="<?php echo base_url()?>static/new_member/js/jquery-1.7.2.min.js"></script>
	<script src="static/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>static/new_member/styles.css" />
	
	<script type="text/javascript" src="static/fancybox/jquery.fancybox.js?v=2.1.0"></script>
	<link rel="stylesheet" type="text/css" href="static/fancybox/jquery.fancybox.css?v=2.1.0" media="screen" />	
	
	<script>
	
	var modal;
	
	$(document).ready(function(){
		$(".drop_arrow").click(function(){
			$("#city_info").slideToggle();
		});

		$(".settings_arrow").click(function(){
			$("#settings_info").slideToggle();
		});
	  
		$(".ui-widget-overlay").click(function(){  		
			modal.dialog("close"); 
		}); 

		$(".fancybox1").live("click", function(e){
			e.prevenDefault();
			$(this).fancybox();
		 
		});
	});
	</script> 
	
	<!--<script type="text/javascript"	src="http://maps.googleapis.com/maps/api/js?AIzaSyCwYxCKPcj0DRupO2CeKrgUwCAVIkwBLpc&sensor=false"></script>-->
	<script type="text/javascript"	src="http://maps.googleapis.com/maps/api/js?AIzaSyAhxOQk7ffgO7iLg4a0H0Y2BSHDngAkNtg&sensor=false"></script>
	

	
	<script src="static/member/member.js" type="text/javascript"></script>	
	
	
	<script type="text/javascript">
	  var script = '<script type="text/javascript" src="http://google-maps-' + 'utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble';
	  if (document.location.search.indexOf('compiled') !== -1) {
		script += '-compiled';
	  }
	  script += '.js"><' + '/script>';
	  document.write(script);
	  
	function fancybox_ppp(url)	{
		 
		modal = $('<div></div>').load(url);				
		modal.dialog( "destroy" );				
		modal.dialog({ 
				
				modal: true,						 
				width: "920px",
				height: "300px" ,
				closeOnEscape: true		
		});	  
		modal.dialog( "open" );			
	}
	  
	</script>
	
	<script type="text/javascript">
		var markers = [];
		var mapInfoWindow;
		var mapLocTitles = [];
		var loctitle = '';
		var infoBubble;  
		var map; 
		var geocoder;
		 
		
		function initialize() {
		
			geocoder = new google.maps.Geocoder();
			var lat = 0
			var lng = 0; 
			address = $("#ccenter_name").html()+", CA";
			geocoder.geocode( { 'address': address}, function(results, status) {			
				if (status == google.maps.GeocoderStatus.OK) {
					var location1 = results[0].geometry.location ; 
					lat = location1["Xa"];
					lng = location1["Ya"];
					 
				
					var latlng = new google.maps.LatLng(lat,lng);
					var mapOptions = {
						zoom: 12,
						center: latlng,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					}
					map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
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
					
					
					<?php 
						$counter = 1;
						foreach($stores as $store):  ?> 

					var content<?php echo $counter; ?> = '<div style="padding: 5px; width: 220px; height: 75px;">'+
							'<div style="float:left; margin-right: 10px; width: 77px;"><img width="75" height="75" src="<?php echo base_url().$store->logo; ?>" /></div>'+
							'<div style="float:left; font-weight:bold;color:#191401; width:120px" ><?php echo addslashes($store->company_name); ?><br /><?php echo $store->address; ?><br />'+
							//'<a href="<?php echo base_url().$this->distributor_url.'/members/storesinfo_no_map/'.$store->id; ?>" style="color:#191401;" class="fancybox1 fancybox.ajax">view deal</a></div>'+
							'<a href="javascript:fancybox_ppp(\'<?php echo base_url().$this->distributor_url.'/members/storesinfo_no_map/'.$store->id; ?>\')" style="color:#191401;" class="fancybox fancybox.ajax" >view deal</a></div>'+
							'</div>';			
					codeAddress('<?php echo $store->address.', '.$store->city_name.' '.$store->postal_code; ?>', "<?php echo $store->city_name; ?>",content<?php echo $counter; ?> );
					<?php $counter++; endforeach; ?>				
				}
			});		 
 
		}

		function codeAddress(address,title,contentString) {
			 
			geocoder.geocode( { 'address': address}, function(results, status) {
			
				if (status == google.maps.GeocoderStatus.OK) { 
				
					var location = results[0].geometry.location  
					var marker = new google.maps.Marker({
						map: map,
						position: location,
						icon: '<?php echo base_url()?>static/new_member/images/marker.png',
					});
					 
					
					markers.push(marker);
					//mapLocTitles.push('<span style="font-size: 35px; padding: 0px; margin: 0px;">'+title+'</span>');					
					var index = markers.length-1;
					
					mapLocTitles.push(contentString);
					var index2 = mapLocTitles.length-1;
					 
					var infoBubble  = new InfoBubble({ 		  
						maxWidth: 700, 
						content: mapLocTitles[index2],  
						shadowStyle: 1,
						position: location,
						disableAutoPan: true,
						hideCloseButton: true
					});
					 
					
					google.maps.event.addListener(markers[index], 'mouseover', function(){ 
					
						newlong = marker.getPosition().lng() + (0.00003 * Math.pow(2, (21 - map.getZoom())));
						infoBubble.setContent(mapLocTitles[index2]);	
						infoBubble.setPosition(marker.getPosition(), newlong); 
						
						infoBubble.open(map, markers[index]);
						
					});
					google.maps.event.addListener(markers[index], 'mouseout', function(){
						infoBubble.close(map, markers[index]);
					});  
					
				} else {
					alert("Geocode was not successful for the following reason: " + status);
				}
			});
		} 
		 google.maps.event.addDomListener(window, 'load', initialize); 
	</script>
	
	<style>
		.ui-widget-header{
			background: #fff !important;
			border: none !important;			
		}
		
		.ui-dialog-titlebar {
			background: #fff !important;
		}		
		
		.ui-helper-clearfix:before, .ui-helper-clearfix:after {		
			display:none !important;
		}
		
		.ui-dialog-content, .ui-widget-content{
			height: 330px !important;
		}
		
		.ui-dialog .ui-dialog-content {		
			overflow: none !important;
		}
	</style>
</head>
<body >
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
						<div id = "ricktag_num_area" style = " margin-left: 105px;">
							<p>
								<label>My Ricktag Number</label>
								<input type = "text" name = "" readonly="readonly" value = "<?php echo $this->session->userdata("CARDID"); ?>" />
							</p>
						</div>
					<div id = "top_right" style = " width: 310px;">
							
							<ul>
								<li style = "padding-right:10px; padding-left:10px;"><p style = "color:#fff; font-size:14px;  margin-right: 10px;  margin-top: 8px;">My Points</p><p style = "color:#fff; font-size:20px;  margin-top: 8px;">0</p></li>
								
								<li><p><a href = "<?php echo $this->distributor_url ?>/members/myaccount"><?php echo $this->distributor_name; ?></a></p></li>
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
							<a href="<?php echo $this->distributor_url; ?>/members/map/"><li id="menu_1" class = "<?php echo ($this->uri->segment(4)=='')?"current_1":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/map/1"><li id="menu_2" class = "<?php echo ($this->uri->segment(4)==1)?"current_2":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/map/2"><li id="menu_3" class = "<?php echo ($this->uri->segment(4)==2)?"current_3":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/map/3"><li id="menu_4" class = "<?php echo ($this->uri->segment(4)==3)?"current_4":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/map/4"><li id="menu_5" class = "<?php echo ($this->uri->segment(4)==4)?"current_5":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/map/5"><li id="menu_6" class = "<?php echo ($this->uri->segment(4)==5)?"current_6":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/map/6"><li id="menu_7" class = "<?php echo ($this->uri->segment(4)==6)?"current_7":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/map/7"><li id="menu_8" class = "<?php echo ($this->uri->segment(4)==7)?"current_8":"";  ?>"></li></a>
							<a href="<?php echo $this->distributor_url; ?>/members/map/8"><li id="menu_9" class = "<?php echo ($this->uri->segment(4)==8)?"current_9":"";  ?>"></li></a>
			
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
								<!--<a href = "<?php// echo $this->distributor_url; ?>/members/points"> <li id = "points" class = "<?php// echo ($this->uri->segment(3)=='points')?"cur_3":"";  ?>"></li></a>-->
							</ul> 
						</div>
						<div class = "clear"></div>
					</div>
				</div><!--end of header -->
				
			</div>
		</div>
	</div>	