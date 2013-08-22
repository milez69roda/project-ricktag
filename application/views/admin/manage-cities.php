		<!-- Content (Right Column) -->
		<div id="content" class="box">
 
			<h2>Manage Cities</h2>
			<?php
				$options = array("1"=>"Active", "0"=>"Not-Active", "2"=>"Pending");
			?>				
			<div style="width: 250px !important" class="col33">
				<table>
					<tbody>
						<tr>
							<th>Id</th>
							<th>City</th>
							<th>Status</th>  
						</tr> 
						<?php 
							foreach($cities as $city):
								$class = "not-active";
								if( $city->hidden == 0) $class = "inactive";
								if( $city->hidden == 1) $class = "active";
								if( $city->hidden == 2) $class = "pending";
						?>	 
						
						<tr id="city_tr_<?php echo $city->id; ?>" class="<?php echo $class; ?>">
							<td><?php echo $city->id; ?></td>
							<td><?php echo $city->name; ?></td>
							<td><?php echo form_dropdown('hidden', $options, $city->hidden, "onchange='Admin.enableCity(".$city->id.",this)'"); ?></td> 
							
							<!--<td>
							
							<button id="city_btn_<?php echo $city->id ?>" onclick="Admin.enableCity(<?php echo $city->id ?>)" data="<?php echo $city->hidden; ?>">Change</button>
							
							</td>-->
						</tr>				
						<?php endforeach; ?>					
	  
					</tbody>
				</table>
			</div>
			
			<div class="col33">	
				<form name="form-city" action="" method="post" onsubmit="return Admin.createCity(this);">
				<table>
					<tbody>
						<tr>
							<td>City</td>
							<td><input type="text" class="input-text" name="city-name" size="20" value=""></td>  
							<td><input type="submit" name="submit" value="Create" /></td>
						</tr> 		
					</body>
				</table>	
				</form>	
			</div>
			
		</div> <!-- /content --> 