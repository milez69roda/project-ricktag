<style>
	.gmnoprint{
		display:none !important;
	}
	
	
#pop_up{
	float:left;
	width:890px;
	height:285px;
	//background:url('images/pop_bg.png') top left no-repeat;
}
.pop_box{
	    float: left;
    margin-top: 17px;
    //outline: 1px solid silver;
	
}
#pop_box_1{
	 margin-left: 13px;
    width: 313px;
	
}
#pop_box_2{
	width: 161px;
	margin-left:15px;
}
#pop_list{
	float:left;
	width:100%;
}
#pop_list img{
	float:left;
}
#pop_list ul{
	float:left;
}
#pop_list ul li{
	float: left;
    margin-bottom: 5px;
    width: 100%;;
}
.thumbs_info{
    background-color: #262626;
    height: 60px;
    margin-top: -6px;
    width: 100%;
}
#pop_box_3{
	  margin-left: 5px;
    margin-top: 29px;
    width: 350px;
}
#pop_box_3 h2{
color:#262626;
font-size:20px;
font-weight:bold;
line-height:1;
}
#pop_box_3_info{
	 float: left;
    margin-top: 20px;
}
#pop_box_3_info p{
color:#262626;
font-size:12px;
}
</style> 
 
<div id = "pop_up" style="width:890px; height:285px;">
	<div id = "pop_box_1" class = "pop_box">
		<div class = "thumbs">
			<img  width="313" height="188" src = "<?php echo $stores->small_banner; ?>" alt = "<?php echo $stores->company_name; ?>" />
		</div>
		<div class = "thumbs_info">
			<div class = "_info">
				<p style = "color:#fff; font-size:14px;"><?php echo $stores->company_name; ?></p>
				<p style = "color:#83868d;"><?php echo $categories; ?></p>
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
				<?php
					$website1 = explode("http", $stores->website);
					$website = $stores->website;
					 
					if( count($website1) == 1 ){
						$website = 'http://'.$stores->website;
					} 
				?>
				<p><a href="<?php echo $website; ?>" title="<?php echo $stores->website; ?>">Website</a></p></li>
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