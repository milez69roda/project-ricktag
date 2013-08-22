		<!-- Content (Right Column) -->
		<div id="content" class="box">
 
			<h2>Manage Business Manager</h2>
			 
			<div>
				
				<div style="width: 450px ! important;" class="col33">
					<h3>Basic Info</h3>				 
					<input type="hidden" name="id" value="<?php echo $dist->dist_id; ?>" />	
					<table class="nostyle">
						<tbody>
							<tr>
								<td style="width:100px;">Company Name:</td>
								<td><?php echo $dist->company_name; ?></td>
							</tr>						
							<tr>
								<td style="width:100px;">Name:</td>
								<td><?php echo $dist->first_name." ".$dist->last_name; ?> 
								</td>
							</tr>
							<tr>
								<td>Address:</td>
								<td><?php echo $dist->address; ?> </td>
							</tr>
							<tr>
								<td class="va-top">Postal:</td>
								<td><?php echo $dist->postal_code; ?></td>
							</tr>
							<tr>
								<td class="va-top">Phone:</td>
								<td><?php echo $dist->phone; ?></td>
							</tr>						
							<tr>
								<td class="va-top">City:</td>
								<td><?php echo $dist->name; ?></td>
							</tr>						
							<tr>
								<td class="va-top">Email:</td>
								<td><?php echo $dist->email; ?></td>
							</tr>						
							<tr>
								<td class="va-top">Website:</td>
								<td><?php echo $dist->website; ?></td>
							</tr>  
						</tbody>
					</table>
				</div> 
 
				 
				<div style="width: 700px ! important;" class="col33">
					<h3>Card Info</h3>
					<table>
						<tbody>
							<tr>
								<th>Type</th>
								<th>Start</th>
								<th>End</th>
								<th>Value</th>
								<th><span title="Reset After Usage">RAU</span></th>
								<th>Url</th>
							</tr>
							<?php foreach($card as $row): ?>
							<tr>
								<td><?php echo $row->card_type; ?></td>
								<td><?php echo $row->card_start; ?></td>
								<td><?php echo $row->card_end; ?></td>
								<td><?php echo $row->card_value; ?></td>
								<td><?php echo ($row->reset_after_usage)?'Yes':'No'; ?></td>
								<td><?php echo $row->card_url; ?></td>								 
							</tr>
							<tr>
								<td colspan="7">				 
										<img width="10%" height="10%" src="<?php echo $row->slider_image1?>" />    
										<img width="10%" height="10%" src="<?php echo $row->slider_image2?>" />  					
										<img width="10%" height="10%" src="<?php echo $row->slider_image3?>" />    							
										<img width="10%" height="10%" src="<?php echo $row->slider_image4?>" />   
								</td>
							</tr>
							<tr><td colspan="7">&nbsp;</td></tr>								
							<?php endforeach;?>
						</tbody>
					</table>
				 			
				</div>
			</div>
			
			<div class="fix"></div>
			 
			<h3>Card Image</h3>
			<div> 
				<img src="<?php echo $dist->card_image; ?>"></img>
				 
			</div>
			<div class="fix"></div>
			
			<h3>Banner Image</h3>
			<div>
				
				<img src="<?php echo $dist->banner_image; ?>"></img>
							
			</div>	

			<div class="fix"></div>	
		</div> <!-- /content --> 