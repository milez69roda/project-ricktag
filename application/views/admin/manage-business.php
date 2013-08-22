 
<style>
	#content #accordion {
		font-size: 80% !important;
	}
</style>	
		
<script>
	$(function() {
		$( "#accordion" ).accordion({
			autoHeight:false,
			clearStyle: true
		});
	});
</script>	
		
<!-- Content (Right Column) -->
<div id="content" class="box">

	<h2>Manage Business in Cities</h2>
	  
	<div id="accordion">
	<?php foreach($cities as $city): ?>	 

		<h3><a href="#"><?php echo $city->name." (".@count($business[$city->name]).")" ?></a></h3>
		<div>
			<table>
				<tbody>
					<tr>
						<th>Business Name</th>
						<th>Featured</th>  
					</tr> 
					<?php 
						if( @count($business[$city->name]) > 0):
						foreach($business[$city->name] as $busi):
						
							//print_r($busi);
							$class = "city-disable";
							$btn_name = "enable";
							if( $busi->featured_city){							
								$class = "city-enable";
								$btn_name = "disable";
							}
					?>	 
					
					<tr id="featured_tr_<?php echo $busi->ID; ?>" class="<?php echo $class; ?>">
						<td><?php echo $busi->name; ?></td>
						<td><button id="featured_btn_<?php echo $busi->ID; ?>" data="<?php echo $busi->featured_city; ?>" onclick="Admin.enableFeatureBusiness(<?php echo $busi->ID; ?>)"><?php echo $btn_name; ?></button></td> 
					</tr>				
					<?php endforeach; endif; ?>					
  
				</tbody>
			</table>		
		
		</div>			
	
	<?php endforeach; ?>					

	</div>	

</div> <!-- /content --> 
		
		


