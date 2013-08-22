	  <?php
    if(empty($this->distributor_url)){
        $base_url_val = '/learn/guest/';
    }else{
        $base_url_val = '/'.$this->distributor_url.'/members/';
    }

    	$cat_id = ($this->uri->segment(4)) ? $this->uri->segment(4) : '0'; 
    

    if(!$this->session->userdata("ISLOGIN")){
      $is_login_validation = 0;

    }else{
      $is_login_validation = 1;
    }
    ?>


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
			address = "<?php echo $this->session->userdata("CUR_CITY")->name; ?>, CA";
			geocoder.geocode( { 'address': address}, function(results, status) {			
				if (status == google.maps.GeocoderStatus.OK) {
					var location1 = results[0].geometry.location ; 
					lat = location1["Ya"];
					lng = location1["Za"];
					 
					//console.log(location1.lat()+" "+location1.lng());
					//var latlng = new google.maps.LatLng(lat,lng);
					var mapOptions = {
						zoom: 12,
						center: new google.maps.LatLng(location1.lat(),location1.lng()),
						//center: new google.maps.LatLng(44.0491,-79.430834),
						mapTypeId: google.maps.MapTypeId.ROADMAP
					}
					map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
					//mapInfoWindow = new google.maps.InfoWindow();	
					 
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
					
						if(  $is_login_validation == 1 ){
							$exclusive = $this->db->get_where("distributor_exclusive_stores", array('url'=>$this->distributor_url))->row();
							 
							if( count($exclusive) > 0 ){
								if( $exclusive->category_id == $this->uri->segment(4) ){
									$this->db->select("store_info.*, cities.name as 'city_name'");
									$this->db->where(' store_info.id IN (', $exclusive->stores.')', false);
									$this->db->join("cities", "cities.id = store_info.city_id", "LEFT OUTER");
									$stores = $this->db->get('store_info')->result();
									
								} 
							}
						}

		
						$counter = 1;
						foreach($stores as $store):  ?> 

					var content<?php echo $counter; ?> = '<div style=" font-size: 13px;padding: 5px; width: 220px; height: 75px;">'+
							'<div style="float:left; margin-right: 10px; width: 77px;"><img width="75" height="75" src="<?php echo base_url().$store->logo; ?>" /></div>'+
							'<div style="float:left; font-weight:bold;color:#191401; width:120px" ><?php echo addslashes($store->company_name); ?><br /><?php echo $store->address; ?><br />'+							
							'<a href="<?php echo 

							isset($_GET['c2']) ? base_url($base_url_val.'deals/'. $cat_id. '/' .$store->id.'/map').'?c2='.$_GET['c2'] : base_url($base_url_val.'deals/'. $cat_id. '/' .$store->id.'/map');

							?>" >view deal</a></div>'+
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
					var index = markers.length-1;
					
					mapLocTitles.push(contentString);
					var index2 = mapLocTitles.length-1;
					 
					var infoBubble  = new InfoBubble({ 		  
						maxWidth: 700, 
						content: mapLocTitles[index2],  
						shadowStyle: 1,
						position: location,
						disableAutoPan: true,
						hideCloseButton: true,
						disableAutoPan: false
					});
					 
					
					<?php if($is_login_validation == 1){ ?>
						google.maps.event.addListener(markers[index], 'mouseover', function(){ 

						newlong = marker.getPosition().lng() + (0.00003 * Math.pow(2, (21 - map.getZoom())));
						infoBubble.setContent(mapLocTitles[index2]);	
						infoBubble.setPosition(marker.getPosition(), newlong); 

						infoBubble.open(map, markers[index]);

						});
						google.maps.event.addListener(markers[index], 'mouseout', function(){
						infoBubble.close(map, markers[index]);
						});  
			        <?php }else if($is_login_validation == 0){ ?>
			            google.maps.event.addListener(markers[index], 'click', function() {
						 $.fancybox({
							  'href': '/welcome/popup_login',
							  'type':'ajax'
							 });
						});

			        <?php } ?>

					
					
				} else {
					//alert("Geocode was not successful for the following reason: " + status);
				}
			});
		} 
		google.maps.event.addDomListener(window, 'load', initialize); 
	</script>	
<div id = "map-wrap" style="width:100%;">
		<div id="map_canvas" style="width:100%; height:750px;"></div>
</div><!-- end of wrap-main-->