	
	<link rel="stylesheet" type="text/css" href="static/css/demo_table_jui.css" />
	<script src="static/js/jquery.dataTables.min.js"></script>
 
	<script type="text/javascript">
	$(document).ready(function() {
		var oTable = $('#example').dataTable( {
			"bProcessing": true,
			"bServerSide": true,		
			"bPaginate": true,		
			"sPaginationType": "full_numbers",
			"sDom": 'T<"clear">flrtip',
			"sAjaxSource": "admin/ajax_cardholders",
			/* "fnDrawCallback": function ( oSettings ) {
				//Need to redo the counters if filtered or sorted
				if ( oSettings.bSorted || oSettings.bFiltered )
				{
					for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
					{
						$('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
					}
				}
			} , */
			"aoColumns": [ 
				{ "bSortable": false }, 
				null,  
				null,  
				null,  
				null,  
				null,  
				null,  
				null,  
				null,  
				null,  
				null,  
				null,  
				null,  
				{ "bSortable": false }
			],
			"aaSorting": [[ 1, 'desc' ]]		
		});
		//oTable.fnSort( [ [1,'desc']] );
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
		
		$("#example_length").after('<div id="example_export" style="float: right;  width: 40%; text-align:right; padding-right: 10px"><a href="admin/exportcardholders"> EXPORT TO EXCEL</a></div>');
	});	
	</script>
	<style>
		table{
			width: 100%;
		}
		
		.rbox{
			float:left; 
			padding: 0px 20px;
		}
		
		.rbox h3{
			text-align:center !important;
			border-bottom: 1px solid #000000; 		
		}
		
		.rbox table{
			border:0 !important;
		}
		.rbox table td{
			border:0 !important;
		}
	</style>	
		<!-- Content (Right Column) -->
		<div id="content" class="box">
 
			<h2>Registered Card-Members</h2>
			
			<div>
				<div id="div_registered" class="rbox">
					<h3>Total Registered</h3>
					<p style="text-align:center; font-size: 16px; font-weight: bold;"><?php echo $registered->num;  ?><p>
					<p> Total Confirmed - <?php echo $registered->confirm;  ?><p> 					
				</div>
				<div class="rbox">		
					<h3>Gender</h3>
					<table>
						<tr style="text-decoration: underline;">
							<td>Male</td>
							<td>Female</td>
						</tr>
						<?php $gender_total = ($gender->Male+$gender->Female); ?>
						<tr>
							<td><?php echo $gender->Male; ?></td>
							<td><?php echo $gender->Female ?></td>
						</tr>
						<tr>
							<td><?php echo round( ($gender->Male/$gender_total)*100, 2 ); ?> %</td>
							<td><?php echo round( ($gender->Female/$gender_total)*100, 2 ); ?> %</td> 
						</tr>
					</table>
				</div>
				<div class="rbox">	
					<h3>Registered Users</h3>	
					<table>
						
						<?php foreach( $cities as $row ): ?>
						<tr>
							<td><?php echo $row->name ?></td>
							<td><?php echo $row->num ?></td>
							
						</tr>
						<?php endforeach; ?>
					
					</table>
				</div>
				<div class="rbox">	
					<h3>Top Distributors</h3>	
					<table>
						
						<?php foreach( $total_sales as $row ): ?>
						<tr>
							<td><?php echo $row->company_name; ?></td>
							<td><?php echo $row->total; ?></td>
							
						</tr>
						<?php endforeach; ?>
					
					</table>
				</div>				
			</div>
			<br clear="both" />
			<div> 
				<table id="example">
					<thead>
						<tr>
							<th></td>
							<th>Date</th>  
							<th>CARD ID</th>
							<th>Points</th> 
							<th>City</th>    
							<th>Name</th>    
							<th>Email</th>  							
							<th>Phone</th>  							
							<th>Gender</th>   
							<th>Confirmed</th>   
							<th>Active</th>   
							<th>Distributor</th>    
							<th>Operator</th>    
							<th>Verification Code</th>   
							 
						</tr> 
					</thead>	
					<tbody>	
						  
					</tbody>
				</table>
			</div>
		</div> <!-- /content --> 