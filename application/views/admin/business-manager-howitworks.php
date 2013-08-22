		<!-- Content (Right Column) -->
		<div id="content" class="box">
 
			<h2>Manage Business Manager</h2>
			 
			<div>
				
				<div style="width: 600px ! important;" class="col33">
					<h3>How It Works - <em><?php echo $row->company_name; ?></em></h3>		
					<form name="form1" action="" method="post" >
					<input type="hidden" name="dist_id" value="<?php echo $dist_id; ?>" />
					<table class="nostyle" style="width:100%">
						<tbody>
							<tr>
								<td>Join. Earn. Save.</td> 
							</tr>						
							<tr>
								<td><textarea name="text1" style="width:590px; height:100px"><?php echo $row->text1; ?></textarea></td>
								 
							</tr>
							<tr>
								<td>How much to Join?.</td> 
							</tr>						
							<tr>
								<td><textarea name="text2" style="width:590px; height:100px"><?php echo $row->text2; ?></textarea></td>
								 
							</tr>
							<tr>
								<td>How do I Join?</td> 
							</tr>						
							<tr>
								<td><textarea name="text3" style="width:590px; height:100px"><?php echo $row->text3; ?></textarea></td>
								 
							</tr>
							<tr>
								<td>How do I Earn?</td> 
							</tr>						
							<tr>
								<td><textarea name="text4" style="width:590px; height:100px"><?php echo $row->text4; ?></textarea></td>
								 
							</tr>
							<tr>
								<td>How do I Redeem?</td> 
							</tr>						
							<tr>
								<td><textarea name="text5" style="width:590px; height:100px"><?php echo $row->text5; ?></textarea></td>
								 
							</tr>
							<tr>
								<td>Can I use my Rewards Card at other Businesses?</td> 
							</tr>						
							<tr>
								<td><textarea name="text6" style="width:590px; height:100px"><?php echo $row->text6; ?></textarea></td>
								 
							</tr>
							<tr>
								<td>Terms & Conditions</td> 
							</tr>						
							<tr>
								<td><textarea name="terms" style="width:590px; height:200px"><?php echo $row->terms; ?></textarea></td>
								 
							</tr>
							<tr>
								<td>
									<input type="submit" name="submit" value="Save" class="input-submit">
									<input type="button" name="back" value="Back" class="input-submit" onclick="javascript:window.location='<?php echo base_url()."admin/businessmanager"; ?>';">
								</td>	
							</tr>
							  
						</tbody>
					</table>
					</form>
				</div> 
 
				 
				 
			</div>
			
	 
			<div class="fix"></div>	
		</div> <!-- /content --> 