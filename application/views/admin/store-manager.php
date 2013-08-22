	
	<link rel="stylesheet" type="text/css" href="static/css/demo_table_jui.css" />
	<script src="static/js/jquery.dataTables.min.js"></script>
	<!--<script src="static/js/jquery.dataTables.columnFilter.js"></script>-->
	<script type="text/javascript">
	$(document).ready(function() {
		var oTable = $('#example').dataTable( {"bPaginate": false,"sDom": 'T<"clear">flrt', "aaSorting": [[ 1, "desc" ]]});
		
		var cd = $('<span style="float:left"></span>').load("admin/ajax_cities"); 
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
		});
		
		
		$(".st_isactive").click(function(){
			var d = new Date().getTime();
			var ischeck = 0;
			var id = $(this).val();
			if( $(this).is(':checked') ){
				ischeck = 1;				
			} 
			
			$.ajax({
				type: 'post',
				url: 'admin/ajax_storemanager_update_isactive/?='+d ,
				data: 'i='+id+'&v='+ischeck,
				dataType: 'json',
				success: function(){
										
				}
			});
		})
		
	});	
	</script>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
 
			<h2>Manage Store</h2>
			<a href="admin/storemanager_new">Create New Store</a>					
			<div> 
				<table id="example">
					<thead>
						<tr>
							<th>logo</th>
							<th>Active</th>   
							<!--<th>Featured</th>-->
							<th>Action</th>   
							<th>ID</th>
							<th>Company Name</th>
							<th>City</th>    
							<th>Address</th>    
							<th>Contact Name</th>  							
							<th>Phone</th>  							
							<th>Email</th>  							
							<th>Website</th>   
						</tr> 
					</thead>	
					<tbody>	
						<?php 
							 
							foreach($stores->result() as $row):
								$class = "disable";
								if( $row->featured) $class = "enable";
						?>	 
						<tr id="store_tr_<?php echo $row->id; ?>">
							<td><img width="70" height="50" alt=" " src="<?php echo @$row->logo; ?>" /> <br /></td>
							<td> <strong style="color:#fff; display:none"><?php echo $row->isactive ?></strong>
								<input type="checkbox" class="st_isactive" name="isactive" id="isactive_<?php echo $row->id; ?>" value="<?php echo $row->id; ?>" <?php echo ($row->isactive)?'checked="checked"':''; ?>  />
							</td> 
							<!--<td id="store_td_<?php echo $row->id; ?>" class="<?php echo $class; ?>"><?php echo form_dropdown('featured', $features, $row->featured, "onchange='Admin.storefeatured(".$row->id.",this)'"); ?></td> -->
							<td><a href="admin/storemanager_update/<?php echo $row->id; ?>">Edit</a>  <a href="admin/storemanager_view/<?php echo $row->id; ?>">View</a></td>
						
							<td><?php echo $row->id; ?></td>
							<td><?php echo $row->company_name; ?></td>
							<td><?php echo $row->city_name; ?></td>
							<td><?php echo $row->address; ?></td>
							<td><?php echo $row->contact_name; ?></td>
							<td><?php echo $row->phone; ?></td>
							<td><?php echo $row->email; ?></td>
							<td><?php echo $row->website; ?></td> 
						</tr>	
						<?php endforeach; ?>					
 
							 
					</tbody>
				</table>
			</div>
		</div> <!-- /content --> 