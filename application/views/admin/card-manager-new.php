<style>
form .upload{
 
}	
</style>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
 
			<h2><a href="admin/cardmanager">Manage Cards</a> > Create New Card</h2>
			 
			<div>
				<form name="basic_info" method="post" action=""  enctype="multipart/form-data">
				<input type="hidden" name="form_type" value="new" />	
				<div style="width: 600px ! important;" class="col33">
					<h3>Basic Info</h3> 
					<table class="nostyle">
						<tbody>
							  	
							<tr>
								<td style="width:150px;">Company Name:</td>
								
								<td><?php echo form_dropdown('dist_id', $distributors,""); ?></td>
							</tr> 								
							<tr>
								<td>Type:</td>
								<td><?php echo form_dropdown('card_type', array("GC"=>"Gift Card", "RC"=>"Reward Card"), ""); ?></td>
							</tr>
							<tr>
								<td class="va-top">Card URL:<br/>
								http://ricktag.ca/ </td>
								<td><br/><input type="text"  class="input-text" name="card_url" size="20" value=""></td>
							</tr>							
							<tr>
								<td class="va-top">Start:</td>
								<td><input type="text"  class="input-text" name="card_start" size="20" value=""></td>
							</tr>
							<tr>
								<td class="va-top">End:</td>
								<td><input type="text"  class="input-text" name="card_end" size="20" value=""></td>
							</tr>	 					
							<tr>
								<td class="va-top">Value:</td>
								<td><input type="text"  class="input-text" name="card_value" size="20" value=""></td>
							</tr> 							<tr>
								<td class="va-top">Max Value:</td>
								<td><input type="text"  class="input-text" name="card_max_value" size="20" value=""></td>
							</tr> 
							<tr>
								<td>Card Image</td>
								<td><input type="file" name="userfile_5" class="upload"></td>
							</tr>
		
							<tr>
								<td>Slider Image 1</td>
								<td><input type="file" name="userfile_1" class="upload"></td>
							</tr>
				
							<tr>
								<td>Slider Image 2</td>
								<td><input type="file" name="userfile_2" class="upload"></td>
							</tr>
						
							<tr>
								<td>Slider Image 3</td>
								<td><input type="file" name="userfile_3" class="upload"></td>
							</tr>
							 
							<tr>
								<td>Slider Image 4</td>
								<td><input type="file" name="userfile_4" class="upload"></td>
							</tr>							
							<tr>
								<td class="t-left colspan="2"><input type="submit" value="Save" class="input-submit"></td>
							</tr>
						</tbody>
					</table>
				 
				</div>
			 
				</form>
			</div>
			<div class="fix"></div>
			  
		</div> <!-- /content --> 