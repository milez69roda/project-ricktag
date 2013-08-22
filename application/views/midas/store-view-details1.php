<style>
	.gmnoprint{
		display:none !important;
	}
</style> 
  <script>
  //var address = '<?php echo $stores->address.', '.$stores->city_name; ?>';
    var map = new GMap2(document.getElementById("map"));
       map.addControl(new GSmallMapControl());
       map.addControl(new GMapTypeControl());
    
    geocoder = new GClientGeocoder();
    
       if (geocoder) {
        geocoder.getLatLng(
   '<?php echo $stores->address.', '.$stores->city_name; ?>',
          function(point) {
            if (!point) {
              alert(address + " not found");
            } else {
   
   map.clearOverlays()
   map.setCenter(point, 12);
   var marker = new GMarker(point, {draggable: true});  
   map.addOverlay(marker);
 
            }
          }
        );
      }    
 </script>
<div id = "pop_up">
	<div id = "pop_box_1" class = "pop_box">
		<div class = "thumbs">
			<img  width="313" height="188" src = "<?php echo $stores->small_banner; ?>" alt = "<?php echo $stores->company_name; ?>" />
		</div>
		<div class = "thumbs_info">
			<div class = "_info">
				<p style = "color:#fff; font-size:14px;"><?php echo $stores->company_name; ?><p>
				<p style = "color:#83868d;"><?php  echo $categories; ?><p>
			</div>
			<div class = "_info_price">
				<p style = "color:#fd590d; font-size:20px; margin-bottom:5px;"><?php echo $stores->discount; ?><p>
				
			</div>
			<div class = "clear"></div>
		</div>
	</div>
	<div id = "pop_box_2" class = "pop_box">
		<div class = "custom_logo">
			<img width="142" height="123" src ="<?php echo $stores->logo; ?>" alt="<?php echo $stores->logo; ?>"  />
		</div>
		<div id = "pop_list">
			<ul>
				<li>
					<img src = "static/midas/images/pop_icon1.png" alt = "" />
					<p><?php echo $stores->address; ?>,  
						<?php echo $stores->city_name; ?>, <?php echo $stores->postal_code; ?>
					</p>
				</li>
				<li>
					<img src = "static/midas/images/pop_icon2.png" alt = "" />
					<p><?php echo $stores->phone; ?></p>
				</li>
				<li>
				<img src = "static/midas/images/pop_icon3.png" alt = "" />
				<p>Send Email</p></li>
				<li>
				<img src = "static/midas/images/pop_icon4.png" alt = "" />
				<p><a href="<?php echo $stores->website; ?>" title="<?php echo $stores->website; ?>">Website</a></p></li>
			</ul>
		</div>
	</div>
	<div id = "pop_box_3" class = "pop_box">
		<h2>
			<?php echo $stores->offer_details; ?>
		</h2>
		<div id = "pop_box_3_info">
			 
			<div style="float:right">
				<!--<iframe width="160" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $stores->google_map_lat_long; ?>&amp;aq=&amp;sll=45.274886,-109.423828&amp;sspn=37.863545,107.841797&amp;ie=UTF8&amp;t=m&amp;ll=<?php echo $stores->google_map_lat_long; ?>&amp;spn=0.009254,0.013819&amp;z=14&amp;output=embed"></iframe>-->
				<!--<iframe width="160" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.ph/maps?f=q&amp;source=s_q&amp;hl=fil&amp;geocode=&amp;q=<?php echo $store->google_map_lat_long; ?>&amp;aq=&amp;sspn=0.004033,0.010568&amp;ie=UTF8&amp;t=m&amp;spn=0.018508,0.025749&amp;z=14&amp;output=embed"></iframe>-->				
				<div align="center" id="map" style="width: 190px; height: 150px"><br/></div>
			</div>
			<div>
				Fine Print: <?php echo $stores->fine_print; ?>
			</div> 
		</div>
	</div>
</div>