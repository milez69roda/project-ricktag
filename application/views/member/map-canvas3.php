 
	<script type="text/javascript">
		var markers = [];
		var mapInfoWindow;
		var mapLocTitles = [];
		var loctitle = '';
		var infoBubble;
		var geocoder;
		
		function initialize() {
			geocoder = new google.maps.Geocoder();
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
			  
			geocoder = new google.maps.Geocoder();

			<?php 
			$ictr = 1;
			foreach($stores as $store): 
				 
		
			?>  
			
			if (geocoder) {
				geocoder.geocode( '<?php echo $store->address.', '.$store->city_name.' '.$store->postal_code; ?>',
					function(results, status) {
						console.log(results[0].geometry.location);	
						if (status == google.maps.GeocoderStatus.OK) {
							addMarker(results[0].geometry.location, "<?php echo $store->city_name; ?>",content<?php echo $ictr; ?>,map);
						}
					}
				);
			}			 
						
			<?php 
				$ictr++; 
				 
			endforeach; ?>
			 
			
		}
		function addMarker(location,title,contentString,map){
			//var location= new google.maps.LatLng(lat,lng);
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

<div id = "map-wrap" style="float:left;width:100%; margin-top: -35px;">
		<div id="map_canvas" style="width:100%; height:750px;"></div>
	</div><!-- end of wrap-main-->