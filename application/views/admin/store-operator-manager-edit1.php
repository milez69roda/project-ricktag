<style>
 	
</style>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
  
			<h2><a href="admin/storemanager">Manage Store</a> > Update Store Info</h2> 
			<div>
				<?php $status = array("1"=>"Active", "0"=>"Inactive"); ?> 
				<h3>Basic Info</h3>
				<form name="basic_info" method="post" action=""  enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $operators->ID; ?>" />
				<div>
				<div class="col33" style="width: 450px">
					<table class="nostyle">
						<tbody>
							<tr>
								<td style="width:100px;">ID:</td>
								<td><?php echo $operators->ID; ?></td>
							</tr>	 
							<tr>
								<td style="width:100px;">Store:</td>
								<td>
								<select name="Store_ID">
								<?php foreach( $stores  as $store ): 
									$selected = ($operators->Store_ID == $store->id)?"selected='selected'":"";
								?>								
									<option value="<?php echo $store->id; ?>" <?php echo $selected; ?>><?php echo $store->company_name." - ".$store->address; ?></option>
								<?php endforeach; ?>
								</select>
								</td>
							</tr>
							<tr>
								<td>Username:</td>
								<td><?php echo $operators->Username; ?></td>
							</tr>
							<tr>
								<td>Name:</td>
								<td><input type="text"  class="input-text" name="fullname" size="40" value="<?php echo $operators->fullname; ?>"></td>
							</tr>
							<tr>
								<td>Password:</td>
								<td><input type="text"  class="input-text" name="password" size="40" value=""></td>
							</tr>							
							<tr>
								<td>Status</td>
								<td><?php echo form_dropdown("Status", $status, $operators->Active); ?></td>
							</tr>	
							<tr>
								<td>Gender</td>
								<td><?php echo form_dropdown("gender", array("M"=>"Male", "F"=>"Female"), $operators->Gender ); ?></td>
							</tr>								
							<tr>
								<td></td>
								<td><input type="submit" value="Update" class="input-submit"></td>
							</tr>	
							 
						</tbody> 
						
					</table>
				</div>
		 
				</div>
				
				</form>
				
				<div class="fix"></div>	
		 
				
			</div> 
			 
			<div class="fix"></div>	
		</div> <!-- /content --> 