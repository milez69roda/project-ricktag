<style>
form .upload{
 
}	
</style>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
 
			 
			<h2><a href="admin/businessmanager">Manage Distributor</a> > Add New Distributor</h2> 
			<div>
				<div style="width: 450px ! important;" class="col33">
					
					<h3>Basic Info</h3>
					<form name="basic_info" method="post" action="" onsubmit="return Admin.BMupdatebasic(this);">
					<input type="hidden" name="bmstatus" id="bmstatus" value="new" />
					<table class="nostyle">
						<tbody> 						
							<tr>
								<td style="width:100px;">Company Name:</td>
								<td><input type="text" class="input-text" name="company_name" size="40" value=""></td>
							</tr>
							<tr>
								<td style="width:100px;">Category:</td>
								<td><?php 
									$categories[0] = '---select---';									
									ksort($categories);
									
									echo form_dropdown('category_id', $categories, '', 'id="category_id"'); 
								?>
								</td>
							</tr>
							<tr>
								<td style="width:100px;">Name:</td>
								<td><input type="text" class="input-text" name="first_name" size="15" value="">
									<input type="text" class="input-text" name="last_name" size="20" value="">
								</td>
							</tr>
							<tr>
								<td>Address:</td>
								<td><input type="text"  class="input-text" name="address" size="40" value=""></td>
							</tr>
							<tr>
								<td class="va-top">Postal:</td>
								<td><input type="text"  class="input-text" name="postal_code" size="40" value=""></td>
							</tr>
							<tr>
								<td class="va-top">Phone:</td>
								<td><input type="text"  class="input-text" name="phone" size="40" value=""></td>
							</tr>						
							<tr>
								<td class="va-top">City:</td>
								<td><?php echo form_dropdown('city_id', $cities, ''); ?></td>
							</tr>						
							<tr>
								<td class="va-top">Email:</td>
								<td><input type="text"  class="input-text" name="email" size="40" value=""></td>
							</tr>						
							<tr>
								<td class="va-top">Website:</td>
								<td><input type="text"  class="input-text" name="website" size="40" value=""></td>
							</tr> 
							<tr>
								<td class="va-top">Points Earner:</td>
								<td> 
									<input  name="points_earner" type="checkbox" value="1"   /> 
								</td>
							</tr> 							
							<tr>
								<td class="t-right" colspan="2"><input type="submit" value="Add" class="input-submit"></td>
							</tr>
						</tbody>
					</table>
					</form>
				</div> 

			<div class="fix"></div>	
		</div> <!-- /content --> 