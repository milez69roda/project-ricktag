<style>
	.form_errors p{
			margin:0px !important;
			color:red;
		}
	}	 	
</style>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
  
			<h2><a href="admin/operators">Manage Operators</a> > Update Store Operatos</h2> 
			<div class="form_errors">	
			<?php
				if( validation_errors() != "" ) {
					echo validation_errors();
				} 
			?>				
			</div>
			<div>
				<?php $status = array("1"=>"Active", "0"=>"Inactive"); ?> 
				<h3>Basic Info</h3>
				<form name="basic_info" method="post" action=""  enctype="multipart/form-data"> 
				<div>
				<div class="col33" style="width: 450px">
					<table class="nostyle">
						<tbody> 	 
							<tr>
								<td style="width:100px;">Store:</td>
								<td>
								<select name="Store_ID">
								<?php foreach( $stores  as $store ):  
								?>								
									<option value="<?php echo $store->id; ?>"  ><?php echo $store->company_name." - ".$store->address; ?></option>
								<?php endforeach; ?>
								</select>
								</td>
							</tr>
							<tr>
								<td>Username:</td>
								<td><input type="text"  class="input-text" name="username" size="40" value="<?php echo set_value('username'); ?>"></td>
							</tr>
							<tr>
								<td>Password:</td>
								<td><input type="text"  class="input-text" name="password" size="40" value="<?php echo set_value('Password'); ?>"></td>
							</tr>
							<tr>
								<td>Name:</td>
								<td><input type="text"  class="input-text" name="fullname" size="40" value="<?php echo set_value('fullname'); ?>"></td>
							</tr>
							<tr>
								<td>Status</td>
								<td><?php echo form_dropdown("Status", $status, set_value('Status') ); ?></td>
							</tr>
							<tr>
								<td>Gender</td>
								<td><?php echo form_dropdown("gender", array("M"=>"Male", "F"=>"Female"), set_value('gender') ); ?></td>
							</tr>	
							<tr>
								<td></td>
								<td><input type="submit" value="Save" class="input-submit"></td>
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