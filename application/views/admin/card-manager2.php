	
	<link rel="stylesheet" type="text/css" href="static/css/demo_table_jui.css" />
	<script src="static/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#example').dataTable( {"bPaginate": false,"sDom": 'T<"clear">flrt',});
	} );	
	</script>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<?php
				
				$online = array("0"=>"No", "1"=>"Yes");

			?>
			<h2>Manage Cards</h2>
			<a href="admin/cardmanager_new">Create New Card</a> 		
			<div> 
				<table id="example">
					<thead>
						<tr>
							<th>Card ID</th>
							<th>Company Name</th>							
							<th>First Name</th>    
							<th>Last Name</th>    
							<th>City</th>
							<th>Type</th>    
							<th>URL</th>  	     
							<th>Distributor ID</th>  	     
							<th>Distributor Email</th>  	     
							<th>Online</th>  	     
							<th>Action</th>   
						</tr> 
					</thead>	
					<tbody>	
						<?php 
							//print_r($stores->result());
							foreach($stores->result() as $row):
							 
						?>	 
						<tr id="card_in_tr_<?php echo $row->card_id; ?>">
							<td><?php echo $row->card_id; ?></td>
							<td><?php echo $row->company_name; ?></td>
							<td><?php echo $row->first_name; ?></td>
							<td><?php echo $row->last_name; ?></td>
							<td><?php echo $row->city_name; ?></td>
							<td><?php echo $row->card_type; ?></td>
							<td>
								<?php if( $row->card_type == "RC"): ?>
								<a href="<?php echo base_url().$row->card_url; ?>"><?php echo $row->card_url; ?></a>
								<?php else: ?>
								<?php echo $row->card_url; ?>	
								<?php endif; ?>
							</td>
							<td><?php echo $row->dist_id; ?></td>
							<td><?php echo $row->dist_email; ?></td>
							<td><?php  echo ($row->card_type == "RC")?form_dropdown("ispage",$online,$row->is_page," id='ispage_".$row->card_id."' onchange='Admin.CardOnline(this)'" ):'' ?></td> 
							<td><a href="admin/cardmanager_edit/<?php echo $row->card_id; ?>">Edit</a></td>
						</tr>	
						<?php endforeach; ?>					
 
							 
					</tbody>
				</table>
			</div>
		</div> <!-- /content --> 