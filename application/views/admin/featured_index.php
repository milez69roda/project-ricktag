  <style>
.ui-tabs-vertical { width: 60em; }
.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
.ui-tabs-vertical .ui-tabs-nav li { background:none !important, clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
.ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 45em;}

.sortable, .fsortable  { 
	list-style-type: none !important; 
	margin: 0; 
	padding: 0; 
	width: 98%; 
}

.sortable li, .fsortable li { 
	margin: 3px 3px 3px 0; 
	padding: 1px; 
	float: left; 
	width: 150px; 
	height: 130px; 
	font-size: 4em; 
	text-align: center; 
	font-size: 10px;
	cursor: pointer; 
	
}

.sortable span, .fsortable span{
	border: 0;
	clear: both;
	float:left;
	width: 98%;
	color: #000;
	background-color: #FFFFCC;
	 	
}

.innerstore, .finnerstore{
	z-index: 5;
}

.selected{
	border: 1px solid orange !important;
	box-shadow: 5px 5px 5px #888888;
}

</style>
 <script>
$(function() {

	$( ".sortable" ).sortable({
		update: function( event, ui ) { 
			 
			var order = $(this).sortable('serialize');
			 
			Admin.featuredStoreChangedPosition(order);
			
		} 
	});
	$( ".sortable" ).disableSelection();
 
	$(".innerstore").live('click',function(){
		$( "#"+$(this).parent().attr('id')+" li" ).each(function(){
			$(this).removeClass('selected');
		})
		$(this).addClass('selected');  
		 
	})
	
	
	$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
	$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
	
	
	$(".link_btn").button();
});
</script>
<div id="content" class="box">

	<h2>Featured Stores</h2>
	
	<?php
		//print_r($stores[1]);
		//echo $stores[1]->company_name;
	?>
	<div id="tabs">
		<ul>
		<?php foreach($cities as $city): ?> 
			<li><a href="#tabs-<?php echo $city->id; ?>"><?php echo $city->name; ?></a></li>
		<?php endforeach; ?>
		</ul>
		
		<?php foreach($cities as $city): ?> 
		<div id="tabs-<?php echo $city->id; ?>">
			<h3><?php echo $city->name; ?></h3>
			<div style="padding: 5px">
				<a class="link_btn" href="javascript:Admin.featuredStoreModal(<?php echo $city->id; ?> )">Show Stores</a>
				<a class="link_btn" href="javascript:Admin.featuredStoreMakeMain(<?php echo $city->id; ?>)">Make Main Featured</a>
				<a class="link_btn" href="javascript:Admin.featuredStoreRemove(<?php echo $city->id; ?>)">Delete Store</a>
			</div>
			<div id="tabsinner-<?php echo $city->id; ?>">
				 
					<div id="main-featured-<?php echo $city->id; ?>">
						 
						<ul class="fsortable" id="fsortable_<?php echo $city->main_store ?>" >
							<?php if( $city->main_store != ''):  
									$mainf = $stores[$city->main_store];  
							?>
							<li class="ui-state-default finnerstore" id="finnerstore-<?php echo @$city->id; ?>_<?php echo @$mainf->id; ?>">
								<img width="90" height="70" alt=" " src="<?php echo @$mainf->logo; ?>" /> <br />							 
								<span><strong><?php echo $mainf->company_name; ?></strong><hr />
								<?php echo $mainf->address; ?></span>
							</li>						
							<?php else: ?>
							<li class="ui-state-default finnerstore"></li>
							<?php endif; ?>
						</ul>
					</div>
					 
					<br style="clear:both" />
					<div>
						<ul class="sortable" id="sortable_<?php echo $city->id; ?>">
							<?php
								if( trim($city->stores) != '' ):
								
									$fstore = explode(',', $city->stores);
									 
									foreach( $fstore as $key=>$store_id): 
										$row = $stores[$store_id]; 
							?>
							  
							<li class="ui-state-default innerstore" id="innerstore-<?php echo @$city->id; ?>_<?php echo @$row->id; ?>">
								<img width="90" height="70" alt=" " src="<?php echo @$row->logo; ?>" /> <br />							 
								<span><strong><?php echo $row->company_name; ?></strong><hr />
								<?php echo $row->address; ?></span>
							</li>
							<?php endforeach; endif; ?>
						</ul>
					</div>
				 
			</div>
		</div>
		<?php endforeach; ?> 
		
	</div>
</div>	