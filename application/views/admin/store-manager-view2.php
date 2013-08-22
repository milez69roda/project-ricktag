<style>
 	
</style>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
 
			<h2>Manage Store Manager</h2>
			 
			<div>
				 
				<h3>Basic Info</h3>
				 
				<div>
				<div class="col33" style="width: 450px">
					<table class="nostyle">
						<tbody>
							<tr>
								<td style="width:100px;">ID:</td>
								<td><?php echo $store->id ?></td>
							</tr>							
							<tr>
								<td style="width:100px;">Company Name:</td>
								<td><?php echo $store->company_name ?></td>
							</tr>						
							<tr>
								<td style="width:100px;">City:</td>
								<td><?php echo $store->city_name; ?>
								</td>
							</tr>
							<tr>
								<td style="width:100px;">Category:</td>
								<td><?php echo $store->category_name; ?>
								</td>
							</tr>
							<tr>
								<td>Address:</td>
								<td><?php echo $store->address ?></td>
							</tr>
							<tr>
								<td class="va-top">Phone:</td>
								<td><?php echo $store->phone ?></td>
							</tr>								
							<tr>
								<td class="va-top">Postal:</td>
								<td><?php echo $store->postal_code ?></td>
							</tr>											
							<tr>
								<td class="va-top">Email:</td>
								<td><?php echo $store->email ?></td>
							</tr>						
							<tr>
								<td class="va-top">Website:</td>
								<td><?php echo $store->website ?></td>
							</tr> 						
							<tr>
								<td class="va-top">Discount:</td>
								<td><?php echo $store->discount ?></td>
							</tr> 						
							<tr>
								<td class="va-top">Points:</td>
								<td><?php echo $store->p_points." : ".$store->p_value; ?></td>
							</tr> 							
							<tr>
								<td class="va-top">Facebook:</td>
								<td><?php echo $store->facebook_link ?></td>
							</tr> 	 
							<tr>
								<td class="va-top">Twitter:</td>
								<td><?php echo $store->twitter_link ?></td>
							</tr> 
							<tr>
								<td class="va-top">Offer Details:</td>
								<td><?php echo $store->offer_details ?></td>
							</tr> 
							<tr>
								<td class="va-top">Fine Print:</td>
								<td><?php echo $store->fine_print ?></td>
							</tr> 
							<tr>
								<td class="va-top">Google Map Lat Long:</td>
								<td> 
									<iframe width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.ph/maps?f=q&amp;source=s_q&amp;hl=fil&amp;geocode=&amp;q=<?php echo $store->google_map_lat_long; ?>&amp;aq=&amp;sspn=0.004033,0.010568&amp;ie=UTF8&amp;t=m&amp;spn=0.018508,0.025749&amp;z=14&amp;output=embed"></iframe>
									<br /><small><a href="http://maps.google.com.ph/maps?f=q&amp;source=embed&amp;hl=fil&amp;geocode=&amp;q=<?php echo $store->google_map_lat_long; ?>&amp;aq=&amp;sspn=0.004033,0.010568&amp;ie=UTF8&amp;t=m&amp;spn=0.018508,0.025749&amp;z=14" style="color:#0000FF;text-align:left">View Larger Map</a></small>	
								</td>
							</tr>  									
							<tr>
								<td class="t-right" colspan="2"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col33" style="width: 450px">
					<table class="nostyle" style="float:left">
						<tbody>
							<tr>
								<td style="vertical-align:top;">Logo:</td>
								 
							</tr>
							<tr>
								<td style="vertical-align:top;">Small Banner:</td>
								 
							</tr>
							<tr>
								<td style="vertical-align:top;">Large Banner:</td>
								 
							</tr>
						</tbody>  
					</table>
					<div class="fix"></div>	
					<h3>Logo</h3>
					<img width="142" height="123" src="<?php echo $store->logo?>" />
					<h3>Small Banner</h3>
					<img width="313" height="188" src="<?php echo $store->small_banner?>" />
					<h3>Large Banner</h3>
					<img width="50%" height="50%" src="<?php echo $store->large_banner?>" />						
				</div>
				
				</div>
				<div class="fix"></div>	
				<input type="submit" value="Update" class="input-submit">
				</form>
			 
				 
			</div> 
			 
			<div class="fix"></div>	
		</div> <!-- /content --> 