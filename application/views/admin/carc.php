	
	<link rel="stylesheet" type="text/css" href="static/css/demo_table_jui.css" />
	<script src="static/js/jquery.dataTables.min.js"></script>
	<!--<script src="static/js/jquery.dataTables.columnFilter.js"></script>-->
	<script type="text/javascript">
	$(document).ready(function() {
	
		var oTable = $('#example').dataTable( {	
			"bProcessing": true,
			"bServerSide": true,		
			"bPaginate": true,
			"sPaginationType": "full_numbers",
			"sDom": 'T<"clear">lrftip',
			"sAjaxSource": "admin/ajax_carc",
			"aaSorting": [[ 0, "DESC" ]],
		});
		
		/* var cd = $('<span style="float:left"></span>').load("admin/ajax_cities"); 
		$("#example_filter").append(cd); */

		/* $.fn.dataTableExt.afnFiltering.push(
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
		); */

		/* $("#head_cities").live("change", function(){
			oTable.fnDraw();
		}); */
		
	} );	
	

	</script>
	
	<style>
		table{
			width: 100%;
		}
	</style>	
		<!-- Content (Right Column) -->
		<div id="content" class="box">
 
			<h2>Card Activity - Reward Card</h2>
			 			
			<div> 
				<table id="example">
					<thead>
						<tr>
							<th>Date/Time</th>
							<th>Store</th>
							<th>Store City</th>
							<th>Invoice #</th>    
							<th>Card ID</th>    
							<th>Name</th>  							
							<th>Email</th>  							
							<th>City</th>  							
							<th>Gender</th>    
							<th>Confirmed</th>   
							<th>Purchases</th>   
							<th>Redeemed</th>   
							<th>Points</th>   
						</tr> 
					</thead>	 
				</table>
			</div>
		</div> <!-- /content --> 