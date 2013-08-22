	<link rel="stylesheet" type="text/css" href="static/css/demo_table_jui.css" />
	<script src="static/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		var oTable = $('#example').dataTable( {"bPaginate": false,"sDom": 'T<"clear">flrt',});
		
		var cd = $('<span style="float:left"></span>').load("admin/ajax_cities"); 
		$("#example_filter").append(cd);

		$.fn.dataTableExt.afnFiltering.push(
			function( oSettings, aData, iDataIndex ){

				var city = aData[5];
				var icity = $("#head_cities option:selected").val();

			    if(  icity == "" ) { 
					return true;
				}else if( city == icity  ) {
					return true; 
				}else{
				}
				return false;
			}
		);

		$("#head_cities").live("change", function(){
			oTable.fnDraw();
		});
  
	});	
	</script>
	
		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h2>Manage Distributor Manager</h2>
			 
			<div> 
				<table id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Company Name</th>
							<th>First Name</th>  
							<th>Last Name</th>  
							<th>Address</th>  
							<th>City</th>  
							<th>Email</th>  							
							<th>Website</th>  
							<th>Action</th>
						</tr> 
					</thead>	
					<tbody>
						<?php 
							//print_r($distributors);
							foreach($distributors as $row):
							  
						?>	 
						<tr id="busi_tr_<?php echo $row->dist_id; ?>">
							<td><?php echo $row->dist_id; ?></td>
							<td><?php echo $row->company_name; ?></td>
							<td><?php echo $row->first_name; ?></td>
							<td><?php echo $row->last_name; ?></td>
							<td><?php echo $row->address; ?></td>
							<td><?php echo $row->name; ?></td>
							<td><?php echo $row->email; ?></td>
							<td><?php echo $row->website; ?></td>
							<td><a href="admin/businessmanager_update/<?php echo $row->dist_id; ?>">Edit</a>  <a href="admin/businessmanager_view/<?php echo $row->dist_id; ?>">View</a></td>
						</tr>	
						<?php endforeach; ?>					
 	 
					</tbody>
				</table>
			</div>
		</div> <!-- /content --> 