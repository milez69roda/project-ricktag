	
	<link rel="stylesheet" type="text/css" href="static/css/demo_table_jui.css" />
	<script src="static/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#example').dataTable( {"bPaginate": false,"sDom": 'T<"clear">flrt',});
	} );	
	</script>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
 
			<h2>Manage Store Manager</h2>
			<a href="admin/storemanager_new">Create New Store</a>					
			<div> 
				<table id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Company Name</th>
							<th>City</th>    
							<th>Address</th>    
							<th>Email</th>  							
							<th>Website</th>   
							<!--<th>Featured</th>-->
							<th>Action</th>   
						</tr> 
					</thead>	
					<tbody>	
						<?php 
							 
							foreach($stores->result() as $row):
								$class = "disable";
								if( $row->featured) $class = "enable";
						?>	 
						<tr id="store_tr_<?php echo $row->id; ?>">
							<td><?php echo $row->id; ?></td>
							<td><?php echo $row->company_name; ?></td>
							<td><?php echo $row->city_name; ?></td>
							<td><?php echo $row->address; ?></td>
							<td><?php echo $row->email; ?></td>
							<td><?php echo $row->website; ?></td> 
							<!--<td id="store_td_<?php echo $row->id; ?>" class="<?php echo $class; ?>"><?php echo form_dropdown('featured', $features, $row->featured, "onchange='Admin.storefeatured(".$row->id.",this)'"); ?></td> -->
							<td><a href="admin/storemanager_update/<?php echo $row->id; ?>">Edit</a>  <a href="admin/storemanager_view/<?php echo $row->id; ?>">View</a></td>
						</tr>	
						<?php endforeach; ?>					
 
							 
					</tbody>
				</table>
			</div>
		</div> <!-- /content --> 