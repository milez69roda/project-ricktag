	<link rel="stylesheet" type="text/css" href="static/css/demo_table_jui.css" />
	<script src="static/js/jquery.dataTables.min.js"></script>
	
 <script>
$(function() {

	var oTable = $('#example').dataTable( {
		"bProcessing": true,
		"bServerSide": true,		
		"bPaginate": true,		
		"sPaginationType": "full_numbers",
		"sDom": 'T<"clear">rtip',
		"sAjaxSource": "admin/ajax_messages",				 
		"aaSorting": [[ 5, 'asc'], [ 1, 'desc' ]],
		"aoColumns": [
			{ "bSortable": false },
			null,
			null,
			null,
			{ "bSortable": false },
			{ "bSortable": false },
			null,
			null
		]   			
				
	});
		
	
	Messages = {
		deleteMsg: function(d){
		
			if(confirm('Confirm delete')){
			
				$.ajax({
					type: 'post',
					url: 'admin/deleteMsg',
					data: 'id='+d,
					dataType: 'json',
					success: function(json){
						oTable.fnDraw();
					},
					error: function(xhr){
						alert('Please relogin');
						window.location = 'adminlogin';
						//console.log(xhr);
					}
				});
			}
			
		}
		
	};
});
</script>
<div id="content" class="box">

	<h2>Operator's Ticker</h2>
	
	<a href="admin/newmessage">New</a>
	<br />
	
	<div>
		<table id="example" style="width: 100%">
			<thead>
				<tr>
				 
					<th width="5%">User</th>  
					<th width="10%">Date Updated</th>
					<th width="5%">Unread</th> 
					<th width="5%">Comments</th> 
					<th width="50%">Message</th> 
					<th width="10%">Site</th>       
					<th width="10%">Status</th>       
					<th width="10%">Action</th>       
					 
				</tr> 
			</thead>	
			<tbody>	
				  
			</tbody>
		</table>		
	</div>
</div>	