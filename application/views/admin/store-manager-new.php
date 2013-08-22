<style>
	.form_errors p{
			margin:0px !important;
			color:red;
		}
	}	
</style>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
  
			<h2><a href="admin/storemanager">Manage Store</a> > Create New Store</h2> 
			<div class="form_errors">	
			<?php
				if( validation_errors() != "" ) {
					echo validation_errors();
				} 
			?>	
			</div>
			<div>
				 
				<h3>Basic Info</h3>
				<form name="basic_info" method="post" action=""  enctype="multipart/form-data">
				 
				<div>
				<div class="col33" style="width: 450px">
					<table class="nostyle">
						<tbody>
							 							
							<tr>
								<td style="width:100px;">Company Name:</td>
								<td><input type="text" class="input-text" name="company_name" size="40" value="<?php echo set_value('company_name'); ?>"></td>
							</tr>						
							<tr>
								<td style="width:100px;">City: </td>
								<td><?php echo form_dropdown('city_id', $cities,  set_value('city_id') ); ?>
								</td>
							</tr>
							<tr>
								<td style="width:100px;">Category:</td>
								<td><?php echo form_dropdown('category_id', $categories,  set_value('category_id') ); ?>
								</td>
							</tr>
							<tr>
								<td>Address:</td>
								<td><input type="text"  class="input-text" name="address" size="40" value="<?php echo set_value('address'); ?>"></td>
							</tr>
							<tr>
								<td class="va-top">Phone:</td>
								<td><input type="text"  class="input-text" name="phone" size="40" value="<?php echo set_value('phone'); ?>"></td>
							</tr>								
							<tr>
								<td class="va-top">Postal:</td>
								<td><input type="text"  class="input-text" name="postal_code" size="40" value="<?php echo set_value('postal_code'); ?>"></td>
							</tr>											
							<tr>
								<td class="va-top">Email:</td>
								<td><input type="text"  class="input-text" name="email" size="40" value="<?php echo set_value('email'); ?>"></td>
							</tr>										
							<tr>
								<td class="va-top">Contact Name:</td>
								<td><input type="text"  class="input-text" name="contact_name" size="40" value="<?php echo set_value('contact_name'); ?>"></td>
							</tr>						
							<tr>
								<td class="va-top">Website:</td>
								<td><input type="text"  class="input-text" name="website" size="40" value="<?php echo set_value('website'); ?>"></td>
							</tr> 						
							<tr>
								<td class="va-top">Discount:</td>
								<td><input type="text"  class="input-text" name="discount" size="40" value="<?php echo set_value('discount'); ?>"></td>
							</tr> 							
							<tr>
								<td class="va-top">Facebook:</td>
								<td><input type="text"  class="input-text" name="facebook_link" size="40" value="<?php echo set_value('facebook_link'); ?>"></td>
							</tr> 	 
							<tr>
								<td class="va-top">Twitter:</td>
								<td><input type="text"  class="input-text" name="twitter_link" size="40" value="<?php echo set_value('twitter_link'); ?>"></td>
							</tr> 
							<tr>
								<td class="va-top">Offer Details:</td>
								<td><textarea name="offer_details" class="input-text" rows="7" cols="50"><?php echo set_value('offer_details'); ?></textarea></td>
							</tr> 
							<tr>
								<td class="va-top">Fine Print:</td>
								<td><textarea name="fine_print" class="input-text" rows="7" cols="50"><?php echo set_value('fine_print'); ?></textarea></td>
							</tr> 
							<tr>
								<td class="va-top">Google Map Lat Long:</td>
								<td><input type="text"  class="input-text" name="google_map_lat_long" size="40" value="<?php echo set_value('google_map_lat_long'); ?>"></td>
							</tr>  	
							<tr>
								<td class="va-top">Featured Big Banner:</td>
								<td> 
									<?php echo form_checkbox('featured_big_banner', '1', set_value('featured_big_banner')); ?>
								</td>
							</tr>
							<tr>
								<td class="va-top">Featured Short Description:</td>
								<td><textarea name="featured_short_desc" class="input-text" rows="7" cols="35"><?php echo set_value('featured_short_desc'); ?></textarea></td>
							</tr>							
							<tr>
								<td class="t-right" colspan="2"><input type="submit" value="Save" class="input-submit"></td>
							</tr>
						</tbody> 
						
					</table>
				</div>
				<div class="col33" style="width: 450px">
					<table class="nostyle" style="float:left">
						<tbody>
							<tr>
								<td>Logo:</td>
								<td><input type="file" name="logo" /></td> 
							</tr>
							<tr>
								<td>Small Banner:</td>
								<td><input type="file" name="small_banner" /></td> 
							</tr>
							<tr>
								<td>Large Banner:</td>
								<td><input type="file" name="large_banner" /></td> 
							</tr>
						</tbody>
					</table>
					 
				</div>
				</div>
				
				</form>
				 					
			</div> 
			 
			<div class="fix"></div>	
		</div> <!-- /content --> 