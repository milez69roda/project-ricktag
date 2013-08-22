<style>
form .upload{
 
}	
</style>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
 
			<h2><a href="admin/cardmanager">Manage Cards</a> > Update Card Info</h2>
			 
			<div>
				<form name="basic_info" method="post" action=""  enctype="multipart/form-data">
				<input type="hidden" name="form_type" value="edit" />	
				<div style="width: 350px ! important;" class="col33">
					<h3>Basic Card Info</h3>
					
					<input type="hidden" name="id" value="<?php echo $cards->card_id ?>" />	
					<table class="nostyle">
						<tbody>
							<tr>
								<td style="width:100px;">Card ID:</td>
								<td><?php echo $cards->card_id; ?> </td>
							</tr>						
							<tr>
								<td style="width:100px;">Company Name:</td>
								<td><?php echo $cards->company_name ?></td>
							</tr>						
							<tr>
								<td style="width:100px;">Name:</td>
								<td><?php echo $cards->first_name." ".$cards->last_name ?> </td>
							</tr>
							<tr>
								<td class="va-top">City:</td>
								<td><?php echo $cards->city_name ?></td>
							</tr>								
							<tr>
								<td>Type:</td>
								<td><?php echo form_dropdown('card_type', array("GC"=>"Gift Card", "RC"=>"Reward Card"), $cards->card_type); ?></td>
							</tr>
							<tr>
								<td class="va-top">Card URL: <br/>http://ricktag.ca/</td>
								<td><br/><input type="text"  class="input-text" name="card_url" size="20" value="<?php echo $cards->card_url ?>"></td>
							</tr>							
							<tr>
								<td class="va-top">Start:</td>
								<td><input type="text"  class="input-text" name="card_start" size="20" value="<?php echo $cards->card_start ?>"></td>
							</tr>
							<tr>
								<td class="va-top">End:</td>
								<td><input type="text"  class="input-text" name="card_end" size="20" value="<?php echo $cards->card_end ?>"></td>
							</tr>	 					
							<tr>
								<td class="va-top">Value:</td>
								<td><input type="text"  class="input-text" name="card_value" size="20" value="<?php echo $cards->card_value ?>"></td>
							</tr> 	 					
							<tr>
								<td class="va-top">Max Value:</td>
								<td><input type="text"  class="input-text" name="card_max_value" size="20" value="<?php echo $cards->card_max_value ?>"></td>
							</tr> 
							<tr>
								<td class="va-top"><input type="checkbox" name="notification" value="<?php echo $cards->notification ?>" <?php echo ($cards->notification == 1)? 'checked="checked"':'';?>></td>
								<td>Would you like to be notified by email for new registrations?</td>
							</tr>
							<tr>
								<td class="t-left" colspan="2"><input type="submit" value="Update" class="input-submit"></td>
							</tr>
						</tbody>
					</table>
				 
				</div>
				<div style="width: 450px ! important;" class="col33">
					<h3>Images</h3>
					<table class="nostyle">
						<tr>
							<td>Card Image</td>
							<td><input type="file" name="userfile_5" class="upload"></td>
						</tr>
						<tr>
							<td colspan="2"><img width="264" height="171" src="<?php echo $cards->card_image?>" /> </td>
						</tr>
						<tr>
							<td>Slider Image 1</td>
							<td><input type="file" name="userfile_1" class="upload"></td>
						</tr>
						<tr>
							<td colspan="2"><img width="516" height="310" src="<?php echo $cards->slider_image1?>" /> </td>
						</tr>
						<tr>
							<td>Slider Image 2</td>
							<td><input type="file" name="userfile_2" class="upload"></td>
						</tr>
						<tr>
							<td colspan="2"><img width="516" height="310" src="<?php echo $cards->slider_image2?>" /> </td>
						</tr>
						<tr>
							<td>Slider Image 3</td>
							<td><input type="file" name="userfile_3" class="upload"></td>
						</tr>
						<tr>
							<td colspan="2"><img width="516" height="310" src="<?php echo $cards->slider_image3?>" /> </td>
						</tr>
						<tr>
							<td>Slider Image 4</td>
							<td><input type="file" name="userfile_4" class="upload"></td>
						</tr>
						<tr>
							<td colspan="2"><img width="516" height="310" src="<?php echo $cards->slider_image2?>" /> </td>
						</tr>						
					</table>
				</div> 
				</form>
			</div>
			<div class="fix"></div>
			  
		</div> <!-- /content --> 