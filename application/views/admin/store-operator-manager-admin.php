	
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
			<h2> Manage <a href="admin/operators">Operators</a> / <a href="admin/operators_admin" style="color:red">Distributors - card activity login</a></h2>
			<a href="admin/operators_new/admin">Create New Operator</a> 		
			<div> 
				<table id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>							
							<th>Username</th>    
							<th>Email</th>    
							<th>Company</th>    
							<th>Gender</th>    
							<th>Staus</th>   
							<th>Action</th>   
						</tr> 
					</thead>	
					<tbody>	
						<?php  
							foreach($operators as $row): 
						?>	 
						<tr id="optr_in_tr_<?php echo $row->ID; ?>">
							<td><?php echo $row->ID; ?></td>
							<td><?php echo $row->fullname; ?></td>
							<td><?php echo $row->Username; ?></td>
							<td><?php echo $row->email; ?></td>
							<td><?php echo $row->company_name; ?></td>  
							<td><?php echo $row->Gender;  ?></td> 
							<td><?php  echo ($row->Active)?"Active":"Inactive";  ?></td> 
							<td><a href="admin/operators_edit/admin/<?php echo $row->ID; ?>">Edit</a></td>
						</tr>	
						<?php endforeach; ?>					
 
							 
					</tbody>
				</table>
			</div>
		</div> <!-- /content --> 