	
	<link rel="stylesheet" type="text/css" href="static/css/demo_table_jui.css" />
	<script src="static/js/jquery.dataTables.min.js"></script>
	<script src="static/js/jquery.dataTables.columnFilter.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		var oTable = $('#example').dataTable( {"bPaginate": false,"sDom": 'T<"clear">flrt'});
		oTable.fnSort( [ [0,'desc']] );
		/* var cd = $('<span style="float:left"></span>').load("admin/ajax_cities"); 
		$("#example_filter").append(cd);

		$.fn.dataTableExt.afnFiltering.push(
			function( oSettings, aData, iDataIndex ){

				var city = aData[2];
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
		}); */
		
	} );	
	</script>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
 
			<h2>Manage Card Holders</h2>
			
			<div> 
				<table id="example">
					<thead>
						<tr>
							<th>Date</th>  
							<th>CARD ID</th>
							<th>Type</th>
							<th>City</th>
							<th>First Name</th>    
							<th>Last Name</th>    
							<th>Email</th>  							
							<th>Gender</th>   
							<th>Confirmed</th>   
							<th>Active</th>   
							<th>Distributor</th>    
							  
						</tr> 
					</thead>	
					<tbody>	
						<?php  
							foreach($cardholders->result() as $row): 
						?>	 
						<tr id="store_tr_<?php echo $row->CARD_ID; ?>">
							<td><?php echo $row->CREATE_DATE; ?></td> 
							<td><?php echo $row->CARD_ID; ?></td>							
							<td><?php echo $row->CARD_TYPE; ?></td>
							<td><?php echo $row->city_name; ?></td>
							<td><?php echo $row->FIRSTNAME; ?></td>
							<td><?php echo $row->LASTNAME; ?></td> 
							<td><?php echo $row->EMAIL; ?></td> 
							<td><?php echo $row->GENDER; ?></td> 
							<td><?php echo ($row->CONFIRMED)?"Yes":"No"; ?></td> 
							<td><?php echo ($row->ACTIVE)?"Yes":"No"; ?></td> 
							<td><?php echo $row->company_name." - ".$row->first_name." ".$row->last_name; ?></td> 
							
						 </tr>	
						<?php endforeach; ?>	 
					</tbody>
				</table>
			</div>
		</div> <!-- /content --> 