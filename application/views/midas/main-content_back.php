<div id = "main_content">
	<!--<h1>Shop with your Ricktag card and save at these local businesses.</h1>-->
	<h1>Get Exclusive Savings and Earn Point at participating Ricktag Merchants. Check out a preview of offers or <a href = "<?php echo base_url().(@$this->distributor_url);  ?>#reg">Register Your Card</a></h1>
	<div class = "_select_form">
	<label>Change Location</label>
	<span class = "_s_btn"><img src = "<?php echo base_url().'static/midas/images/btn_s.png'?>" alt = "" /></span>
	<select name="content-city" id="content-city" onchange="Midas.stores(this.value)">
		<!--<option value="">Select City</option>-->
		
		<?php foreach( $cities as $city ): 
			$selected = '';
			if( $city->id == $this->distributor_city )
				$selected = 'selected = "selected"';
		?>
		
		<option value="<?php echo $city->id; ?>" <?php echo $selected; ?>><?php echo $city->name; ?></option> 
		<?php 
			
			endforeach; 
		?>
	</select>
	
	</div>	
	<div id = "list">
		<ul id="stores_list">
			 
		</ul>
	</div>
</div>
