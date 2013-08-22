<style>
	form .upload{
	 
	}
	
	#storelist li{
		padding: 5px; 
	}
	
</style>

<script>
$(function() {
	$("#tabs").tabs();
	//$(".checkboxstore").button();
	
	$(".exclusivestores").click( function(){
		var id =  $(this).val();
		var url = $("#dist_url").val();
		var type = 0;
		if( $(this).is(":checked") ){
			type = 1
		}
		
		//alert($("#form_stores").serialize());
		
		$.ajax({
			type: 'post',
			url: 'admin/ajax_businessmanager_exclusivestores',
			data: 'url='+url+'&type='+type+"&"+$("#form_stores").serialize(),
			success: function(xhr){
			
			}
		})
		
	});
});
</script>
 
		<!-- Content (Right Column) -->
		<div id="content" class="box">
 
			 
			<h2><a href="admin/businessmanager">Manage Distributor</a> > Update Distributor Info</h2> 
				
			<div id="tabs">
				<ul>
				<li><a href="#tabs-1">Basic Info</a></li>
				<li><a href="#tabs-2">Stores Exclusivity</a></li>  
				</ul>
			
				<div id="tabs-1">
					 
					<h3>Basic Info</h3>
					<form name="basic_info" method="post" action="" onsubmit="return Admin.BMupdatebasic(this);">
					<input type="hidden" name="id" value="<?php echo $dist->dist_id ?>" />	
					<input type="hidden" name="bmstatus" id="bmstatus" value="update" />
					<table class="nostyle">
						<tbody>
							<tr>
								<td style="width:100px;">ID:</td>
								<td><?php echo $dist->dist_id ?>
							</tr>						
							<tr>
								<td style="width:100px;">Company Name:</td>
								<td><input type="text" class="input-text" name="company_name" size="40" value="<?php echo $dist->company_name ?>"></td>
							</tr>	

							<tr>
								<td style="width:100px;">Category:</td>
								<td><?php 
									$categories[0] = '---select---';									
									ksort($categories);
									
									echo form_dropdown('category_id', $categories, $dist->category_id, 'id="category_id"'); 
								?>
								</td>
							</tr>							
							<tr>
								<td style="width:100px;">Name:</td>
								<td><input type="text" class="input-text" name="first_name" size="15" value="<?php echo $dist->first_name ?>">
									<input type="text" class="input-text" name="last_name" size="20" value="<?php echo $dist->last_name ?>">
								</td>
							</tr>
							<tr>
								<td>Address:</td>
								<td><input type="text"  class="input-text" name="address" size="40" value="<?php echo $dist->address ?>"></td>
							</tr>
							<tr>
								<td class="va-top">Postal:</td>
								<td><input type="text"  class="input-text" name="postal_code" size="40" value="<?php echo $dist->postal_code ?>"></td>
							</tr>
							<tr>
								<td class="va-top">Phone:</td>
								<td><input type="text"  class="input-text" name="phone" size="40" value="<?php echo $dist->phone ?>"></td>
							</tr>						
							<tr>
								<td class="va-top">City:</td>
								<td><?php echo form_dropdown('city_id', $cities, $dist->city_id); ?></td>
							</tr>						
							<tr>
								<td class="va-top">Email:</td>
								<td><input type="text"  class="input-text" name="email" size="40" value="<?php echo $dist->email ?>"></td>
							</tr>						
							<tr>
								<td class="va-top">Website:</td>
								<td><input type="text"  class="input-text" name="website" size="40" value="<?php echo $dist->website ?>"></td>
							</tr> 						
							<tr>
								<td class="va-top">Points Earner:</td>
								<td> 
									<input  name="points_earner" type="checkbox" value="1" <?php echo ($dist->points_earner)?'checked="true"':'' ?>   /> 
								</td>
							</tr> 
							<tr>
								<td class="t-right" colspan="2"><input type="submit" value="Update" class="input-submit"></td>
							</tr>
						</tbody>
					</table>
					</form>
				 
				</div>
				<div id="tabs-2"> 
					<p>Distributor Link: <strong><?php echo @$card[0]->card_url; ?></strong></p>
					<p>Full Link: <strong><?php echo base_url().@$card[0]->card_url; ?></strong></p>
					<?php if(!isset($card[0]->card_url)): ?>
					<p style="color:red">Stores will only show after you set the URL of this distributor</p>
					<?php endif; ?>
					<?php if($dist->category_id == '' OR $dist->category_id == 0): ?>
					<p style="color:red">Category is not set</p>
					<?php endif; ?>
					
					<hr />
					<form id="form_stores" name="form_stores">
					<input id="dist_url" type="hidden" value="<?php echo @$card[0]->card_url; ?>" />
					<input name="category_id" id="category_id" type="hidden" value="<?php echo $dist->category_id; ?>" />
					<ul id="storelist">
					<?php 
						if( isset($card[0]->card_url)){
							$url = $card[0]->card_url;
							$exclusive_res	= $this->db->get_where('distributor_exclusive_stores', array('url'=>$url));
							if($exclusive_res->num_rows() == 0){
								$set['url'] = $url;
								$set['category_id'] = $dist->category_id;
								$this->db->insert('distributor_exclusive_stores', $set);
								
								$exclusive_res = $this->db->get_where('distributor_exclusive_stores', array('url'=>$url) );							
							}
							$exclusive_res = $exclusive_res->row();
							$exclusive = explode(',',@$exclusive_res->stores);						
						}
					?>
					<?php 
					if( isset($card[0]->card_url)):
						foreach($stores as $row ): 
							$check = '';
							if( isset($card[0]->card_url)){
								if( in_array($row->id, $exclusive) ) $check = 'checked="checked"';
							}
					?>
					<li>
						<input type="checkbox" name="exclusivestores[]" class="exclusivestores" <?php echo $check; ?>  id="exclusivestores_<?php echo $row->id; ?>" value="<?php echo $row->id ?>" />
						<img width="50" height="50" src="<?php echo $row->logo; ?>" />
						<label> <?php echo $row->company_name.' - '.$row->address; ?></label>									
					</li>
					<?php endforeach; endif; ?>
					</ul>
					</form>
				</div>
				 
			</div>			

			<div class="fix"></div>	
		</div> <!-- /content --> 