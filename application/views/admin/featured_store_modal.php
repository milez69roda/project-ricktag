 <style>
#sortable { 
	list-style-type: none !important; 
	margin: 0; 
	padding: 0; 
	width: 98%; 
}

#sortable li { 
	margin: 3px 3px 3px 0; 
	padding: 1px; 
	float: left; 
	width: 120px; 
	height: 140px; 
	font-size: 4em; 
	text-align: center; 
	font-size: 10px;
	cursor: pointer; 
	
}

#sortable li:hover{
	border: 1px solid orange;
	box-shadow: 5px 5px 5px #888888;
}

#sortable .selected{
	border: 1px solid orange;
	box-shadow: 5px 5px 5px #888888;
}

#sortable span{
	border: 1px solid #ccc;
	clear: both;
	float:left;
	width: 100%;
	color: #000;
	background-color: #FFFFCC;
}


#storeDiv{
	/*border:1px solid red; */
	display: block; 
	height: 320px; 
	overflow: auto;
	padding: 10px;
}
</style>
 <script>
$(function() {
/* $( "#sortable" ).sortable();
$( "#sortable" ).disableSelection(); */

	$('.store').click( function(){
		$('.store').each( function(){
			$(this).removeClass('selected');
		});
		$(this).addClass('selected');
		 
	});
	
	 
});
</script>
 
 
	<div id="storeDiv">
		<ul id="sortable">
			<?php foreach( $stores as $row ): ?>
			<li class="ui-state-default store" id="store_<?php echo $row->id; ?>">
				<img width="100" height="70" alt=" " src="<?php echo $row->logo; ?>" /> <br />
				<span title="<?php echo $row->address; ?>"><strong><?php echo $row->company_name; ?></strong><hr />
				<?php echo $row->address; ?></span>
			</li>
			<?php endforeach; ?>
		</ul>
		<br style="clear:both"/>	
	</div>
 