 <style>
.ui-autocomplete-loading {
	background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat;
}

.ui-autocomplete {
	max-height: 250px;
	overflow-y: auto;
	/* prevent horizontal scrollbar */
	overflow-x: hidden;
}
/* IE 6 doesn't support max-height
* we use height instead, but this forces the menu to always be this tall
*/
* html .ui-autocomplete {
	height: 250px;
}
</
</style>
<script>
$(function() {

	function split( val ) {
		return val.split( /,\s*/ );
	}
	function extractLast( term ) {
		return split( term ).pop();
	}
	
	
	$( "#operators" )
	// don't navigate away from the field on tab when selecting an item
	.bind( "keydown", function( event ) {
		if ( event.keyCode === $.ui.keyCode.TAB &&
			$( this ).data( "ui-autocomplete" ).menu.active ) {
			event.preventDefault();
		}
	})
	.autocomplete({
		source: function( request, response ) {
			$.getJSON( "admin/ajaxOperatorsList/", {
				term: extractLast( request.term )
			}, response );
		},
		search: function() {
			// custom minLength
			var term = extractLast( this.value );
			/* if ( term.length < 1 ) {
			return false;
			} */
		},
		focus: function() {
			// prevent value inserted on focus
			return false;
		},
		select: function( event, ui ) {
			var terms = split( this.value );
			// remove the current input
			terms.pop();
			// add the selected item
			terms.push( ui.item.value );
			// add placeholder to get the comma-and-space at the end
			terms.push( "" );
			this.value = terms.join( ", " );
			return false;
		}
	});

	Messages = {
		new: function(d){
		
			if( $.trim($("#newsubject").val()).length && $.trim($("#newmsg").val()).length ){
				if( confirm('Confirm submit') ){
					
					$.ajax({
						type: 'post',
						url: 'admin/savemessage',
						data: $(d).serialize(),
						dataType: 'json',
						success: function(json){

							alert(json.status_email_text);
							window.location = 'admin/messages';
						}
					}); 
					return false;
				}else{
					return false;
				}
			}else{
				alert("Subject and Message must not be empty");
				return false;
			}	
		}
		
	};
		
});
</script>

<div id="content" class="box">
 
	<h2><a href="admin/messages">Operator's Ticker</a> / New Message</h2>
 
	<br />
	
	<div>
		<form name="form1" id="form1" action="" method="post" onsubmit="return Messages.new(this);" >
			<p><label>Operator:</label></p>
			<!--<p><textarea name="operators" id="operators" style="width: 500px; height: 80px"></textarea></p>-->
			<p><input type="text" id="operators" name="operators" style="border: 1px solid #ccc; width: 500px;" /></p>
			<p><label>Subject:</label></p>
			<p><input type="text" name="newsubject" id="newsubject" value="" maxlength="200"  style="border: 1px solid #ccc; width: 500px; height: 30px" /></p>
			<p><label>Message:</label></p>
			<p><textarea id="newmsg" name="newmsg" style="border: 1px solid #ccc; width: 500px; height: 250px" ></textarea></p>
						
			<p><input type="submit" id="submit-btn" name="submit-btn" value="Submit" /></p>
		</form>		
	</div>
</div>	