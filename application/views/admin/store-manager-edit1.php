<style>
	.text-large{
		width: 400px;
	}	
</style>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
  
			<h2><a href="admin/storemanager">Manage Store</a> > Update Store Info</h2> 
			<div>
				 
				<h3>Basic Info</h3>
				<form name="basic_info" method="post" action=""  enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $store->id; ?>" />
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
								<td><input type="text" class="input-text" name="company_name" size="40" value="<?php echo $store->company_name ?>"></td>
							</tr>						
							<tr>
								<td style="width:100px;">City:</td>
								<td><?php echo form_dropdown('city_id', $cities, $store->city_id); ?>
								</td>
							</tr>
							<tr>
								<td style="width:100px;">Category:</td>
								<td><?php echo form_dropdown('category_id', $categories, $store->category_id); ?>
								</td>
							</tr>
							<tr>
								<td>Address:</td>
								<td><input type="text"  class="input-text" name="address" size="40" value="<?php echo $store->address ?>"></td>
							</tr>
							<tr>
								<td class="va-top">Phone:</td>
								<td><input type="text"  class="input-text" name="phone" size="40" value="<?php echo $store->phone ?>"></td>
							</tr>								
							<tr>
								<td class="va-top">Postal:</td>
								<td><input type="text"  class="input-text" name="postal_code" size="40" value="<?php echo $store->postal_code ?>"></td>
							</tr>											
							<tr>
								<td class="va-top">Email:</td>
								<td><input type="text"  class="input-text" name="email" size="40" value="<?php echo $store->email ?>"></td>
							</tr>											
							<tr>
								<td class="va-top">Contact Name:</td>
								<td><input type="text"  class="input-text" name="contact_name" size="40" value="<?php echo $store->contact_name ?>"></td>
							</tr>						
							<tr>
								<td class="va-top">Website:</td>
								<td><input type="text"  class="input-text" name="website" size="40" value="<?php echo $store->website ?>"></td>
							</tr> 						
							<tr>
								<td class="va-top">Special Offer:</td>
								<td><input type="text"  class="input-text" name="discount" size="40" value="<?php echo $store->discount ?>"></td>
							</tr> 							
							<tr>
								<td class="va-top">Points</td>
								<td><input type="text"  class="input-text" name="p_points" size="10" value="<?php echo $store->p_points; ?>"/> : 
								 <input type="text"  class="input-text" name="p_value" size="10" value="<?php echo $store->p_value; ?>"/></td>
							</tr> 								
							<tr>
								<td class="va-top">Facebook:</td>
								<td><input type="text"  class="input-text" name="facebook_link" size="40" value="<?php echo $store->facebook_link ?>"></td>
							</tr> 	 
							<tr>
								<td class="va-top">Twitter:</td>
								<td><input type="text"  class="input-text" name="twitter_link" size="40" value="<?php echo $store->twitter_link ?>"></td>
							</tr> 
							<tr>
								<td class="va-top">Offer Details:</td>
								<td><textarea name="offer_details" class="input-text" rows="7" cols="35"><?php echo $store->offer_details ?></textarea></td>
							</tr> 
							<tr>
								<td class="va-top">Fine Print:</td>
								<td><textarea name="fine_print" class="input-text" rows="7" cols="35"><?php echo $store->fine_print ?></textarea></td>
							</tr> 
							<tr>
								<td class="va-top">Google Map Lat Long:</td>
								<td><input type="text"  class="input-text" name="google_map_lat_long" size="40" value="<?php echo $store->google_map_lat_long ?>"></td>
							</tr>  									
							<tr>
								<td class="t-right" colspan="2"><input type="submit" value="Update" class="input-submit"></td>
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
								<!--<td><img width="30%" height="30%" src="<?php echo $store->logo?>" /></td>-->
							</tr>
							<tr>
								<td>Small Banner:</td>
								<td><input type="file" name="small_banner" /></td>
								<!--<td><img width="30%" height="30%" src="<?php echo $store->small_banner?>" /></td>-->
							</tr>
							<tr>
								<td>Large Banner:</td>
								<td><input type="file" name="large_banner" /></td>
								<!--<td><img width="30%" height="30%" src="<?php echo $store->large_banner?>" /></td>-->
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
				
				</form>
				
				<div class="fix"></div>	
				
				<div>
					<fieldset>
					<label><h2>Stores City Link</h2></label>
					<?php
						//print_r($store_city_link);
					?>
					<table class="nostyle">
						<thead>
							<tr>
								<th>City</th>
								<th>List</th>
								<th>Featured</th>
							</tr>
						</thead>	
						<tbody>	
							<?php foreach($cities  as $key=>$value): 
								$row = @$store_city_link[$key];
								$link_id =  (@$row->link_id)?$row->link_id:'0';
							?>
								
							<tr>
								<td><?php echo $value; ?></td>
								<td><input type="checkbox" id="slist_<?php echo $key."_".$link_id; ?>" onclick="Admin.storeCityListFeatured(this,<?php echo $store->id; ?>, <?php echo $key; ?>, <?php echo $link_id; ?>, 'l')" value="1" <?php echo ( @$row->islist == 1 )? "checked":""; ?>/></td>
								<td><input type="checkbox" id="sfet_<?php echo $key."_".$link_id; ?>"  onclick="Admin.storeCityListFeatured(this,<?php echo $store->id; ?>, <?php echo $key; ?>, <?php echo $link_id; ?>, 'f')" value="1" <?php echo ( @$row->isfeatured == 1 )? "checked":""; ?>/></td>
							</tr>		
							<?php endforeach; ?>
						<tbody>
					</table>
				</div>		

				<div>
					<fieldset>
					<label><h2>Stores Category Link</h2></label>
					<table class="nostyle">
						<thead>
							<tr>
								<th>Category</th>
								<th>Active</th> 
							</tr>
						</thead>	
						<tbody>	
							<?php foreach($categories  as $key=>$value): 
								$row = @$store_category_link[$key]; 
								//$link_id =  (@$row->id)?$row->id:'0';
							?> 
							<tr>
								<td><?php echo $value; ?></td>
								<td><input type="checkbox"  onclick="Admin.storeCategoryActive(this,<?php echo $store->id; ?>, <?php echo $key; ?>)" value="1" <?php echo ( @$row->active == 1 )? "checked":""; ?> /></td> 
							</tr>		
							<?php endforeach; ?>
						<tbody>
					</table>
					</fieldset>
				</div>
				
				
				<div>
					<fieldset>
					<label><h2>Stores Deals List</h2></label>
					<input class="text-large" type="text" id="deals_new_txt" value="" /><button onclick="Admin.dealsAction('add',<?php echo $store->id; ?>)">Add New</button>	
					<table class="nostyle" id="tbl_deals">
						<thead>
							<tr>
								<th>Deals</th>
								<th>Status</th>
								<th>Action</th> 
							</tr>
						</thead>	
						<tbody>	
							<?php foreach($store_deals  as $key=>$row):  
								//$row_deals = @$store_deals[$key]; 
							?> 
							<tr id="dealstr_<?php echo $key; ?>">
								<td><input class="text-large" type="text" id="dealstext_<?php echo $key; ?>" value="<?php echo $row->deals_text; ?>" /></td>
								<td><input type="checkbox" id="deals_active_<?php echo $key; ?>" onclick="Admin.dealsAction('status',<?php echo $key; ?>,this)" value="1" <?php echo ( $row->deals_status == 1 )? "checked":""; ?>/></td>
								<td><button onclick="Admin.dealsAction('save',<?php echo $key; ?>,'')" >Save</button> 
									<button onclick="Admin.dealsAction('del',<?php echo $key; ?>,'')">Delete</button> 
								</td> 
							</tr>		
							<?php endforeach; ?>
						<tbody>
					</table>					
					</fieldset>
					
				</div>				
			</div> 
			 
			<div class="fix"></div>	
		</div> <!-- /content --> 