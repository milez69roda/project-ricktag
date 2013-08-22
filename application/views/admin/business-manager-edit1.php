<style>
form .upload{
 
}	
</style>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
 
			 
			<h2><a href="admin/businessmanager">Manage Distributor</a> > Update Distributor Info</h2> 
			<div>
				<div style="width: 450px ! important;" class="col33">
					<h3>Basic Info</h3>
					<form name="basic_info" method="post" action="" onsubmit="return Admin.BMupdatebasic(this);">
					<input type="hidden" name="id" value="<?php echo $dist->dist_id ?>" />	
					<table class="nostyle">
						<tbody>
							<tr>
								<td style="width:100px;">ID:</td>
								<td><?php echo $dist->dist_id ?>
							</tr>						
							<tr>
								<td style="width:100px;">Company Name:</td>
								<td><input type="text" class="input-text" name="company_name" size="40" value="<?php echo $dist->company_name ?>"></td>
							</tr>						
							<tr>
								<td style="width:100px;">Name:</td>
								<td><input type="text" class="input-text" name="first_name" size="15" value="<?php echo $dist->first_name ?>">
									<input type="text" class="input-text" name="last_name" size="20" value="<?php echo $dist->last_name ?>">
								</td>
							</tr>
							<tr>
								<td>Address:</td>
								<td><input type="text"  class="input-text" name="address" size="40" value="<?php echo $dist->address ?>"></td>
							</tr>
							<tr>
								<td class="va-top">Postal:</td>
								<td><input type="text"  class="input-text" name="postal_code" size="40" value="<?php echo $dist->postal_code ?>"></td>
							</tr>
							<tr>
								<td class="va-top">Phone:</td>
								<td><input type="text"  class="input-text" name="phone" size="40" value="<?php echo $dist->phone ?>"></td>
							</tr>						
							<tr>
								<td class="va-top">City:</td>
								<td><?php echo form_dropdown('city_id', $cities, $dist->city_id); ?></td>
							</tr>						
							<tr>
								<td class="va-top">Email:</td>
								<td><input type="text"  class="input-text" name="email" size="40" value="<?php echo $dist->email ?>"></td>
							</tr>						
							<tr>
								<td class="va-top">Website:</td>
								<td><input type="text"  class="input-text" name="website" size="40" value="<?php echo $dist->website ?>"></td>
							</tr> 
							<tr>
								<td class="t-right" colspan="2"><input type="submit" value="Update" class="input-submit"></td>
							</tr>
						</tbody>
					</table>
					</form>
				</div>
				<!--
				<div style="width:700px ! important;" class="col33">
					<h3>Card Info</h3>
					
					<table>	
						<tbody>
						<tr id="card_input_tr_new">
							<td> <?php echo form_dropdown('card_input_type_new', array("GC"=>"GC","RC"=>"RC"), '', "id='card_input_type_new'"); ?> </td>
							<td> <input type="text"  class="input-text" name="card_input_start_new" id="card_input_start_new" size="5" value=""> </td>
							<td> <input type="text"  class="input-text" name="card_input_end_new" id="card_input_end_new" size="5" value=""> </td>
							<td> <input type="text"  class="input-text" name="card_input_val_new" id="card_input_val_new" size="2" value=""> </td>								
							<td> <?php echo form_dropdown('card_input_reset_new', array("1"=>"Yes","0"=>"No"), '', " id='card_input_reset_new'"); ?> </td>
							<td> <input type="text"  class="input-text" name="card_input_url_new" id="card_input_url_new" size="40" value=""></td>
							<td> <button onclick="Admin.CardInfoCreate(<?php echo $dist->dist_id ?>)">Add</button> </td>		
						</tr>
						</tbody>						
					</table>	
					<div class="fix"></div>		
					
					<table>
						<tbody>
							<tr>
								<th>ID</th>
								<th>Type</th>
								<th>Start</th>
								<th>End</th>
								<th>Value</th>
								<th><span title="Reset After Usage">RAU</span></th>
								<th>Url</th>
								 
								<th>Action</th>
							</tr>
							<?php foreach($card as $row): ?>
							 
							<tr id="card_input_tr_<?php echo $row->card_id; ?>" >
								<td><?php echo $row->card_id; ?></td>
								<td><?php echo form_dropdown('card_input_type_'.$row->card_id, array("GC"=>"GC","RC"=>"RC"), $row->card_type, " id='card_input_type_".$row->card_id."'"); ?></td>
								<td><input type="text"  class="input-text" name="card_input_start_<?php echo $row->card_id; ?>" id="card_input_start_<?php echo $row->card_id; ?>" size="5" value="<?php echo $row->card_start; ?>"></td>
								<td><input type="text"  class="input-text" name="card_input_end_<?php echo $row->card_id; ?>" id="card_input_end_<?php echo $row->card_id; ?>" size="5" value="<?php echo $row->card_end; ?>"></td>
								<td><input type="text"  class="input-text" name="card_input_val_<?php echo $row->card_id; ?>" id="card_input_val_<?php echo $row->card_id; ?>" size="2" value="<?php echo $row->card_value; ?>"></td>								
								<td><?php echo form_dropdown('card_input_reset_'.$row->card_id, array("1"=>"Yes","0"=>"No"), $row->reset_after_usage, " id='card_input_reset_".$row->card_id."'"); ?></td>
								<td><input type="text"  class="input-text" name="card_input_url_<?php echo $row->card_id; ?>" id="card_input_url_<?php echo $row->card_id; ?>" size="40" value="<?php echo $row->card_url; ?>"></td>								 
								<td><button onclick="Admin.CardInfoUpdate(<?php echo $row->card_id; ?>)">Update</button> 
									<button onclick="Admin.CardInfoDelete(<?php echo $row->card_id; ?>)">Delete</button>									 
								</td>		
							</tr>
							 
							<tr>
								<td colspan="7">									 
									<form name="card_form_upload_<?php echo $row->card_id; ?>" method="post" action="admin/businessmanager_cards_upload" enctype="multipart/form-data">
										<input type="hidden" name="dist_id" value="<?php echo $dist->dist_id; ?>" />
										<div style="float:left; width: 50%">
											<fieldset>
											<legend>Slider</legend>
											<input type="hidden" name="id" value="<?php echo $row->card_id; ?>" />
											<input type="file" name="userfile_1" class="upload"><img width="10%" height="10%" src="<?php echo $row->slider_image1?>" />  <br />  
											<input type="file" name="userfile_2" class="upload"><img width="10%" height="10%" src="<?php echo $row->slider_image2?>" />  <br /> 							
											<input type="file" name="userfile_3" class="upload"><img width="10%" height="10%" src="<?php echo $row->slider_image3?>" />  <br /> 							
											<input type="file" name="userfile_4" class="upload"><img width="10%" height="10%" src="<?php echo $row->slider_image4?>" />  <br />
											</fieldset>
										</div>
										<div style="float:left; width: 50%">
											<fieldset>
											<legend>Banner</legend>
											<input type="file" name="userfile_5" class="upload"><img width="10%" height="10%" src="<?php echo $row->card_image?>" />  <br />
											</fieldset>
										</div>
										<div class="fix"></div>
										<input type="submit" value="Upload" /> 
									</form>									
								</td>
							</tr>
							<tr><td colspan="8">&nbsp;</td></tr>							
							<?php endforeach;?>
						</tbody>
					</table>
				</div>	
			</div>
			<div class="fix"></div>
			-->
			 

			<div class="fix"></div>	
		</div> <!-- /content --> 