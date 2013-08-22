var Member = {
	base_url:'',
	setCity: function(d){
		 
		$.ajax({
			type:"post",
			data:"c="+d,
			url:this.base_url+"/members/setCity",
			success: function(x){
			} 
		}); 	
	},
	updateAccount: function(f){
		data = $(f).serialize();
		
		$.ajax({
			type:"post",
			data:data,
			url:this.base_url+"/members/saveaccount",
			dataType: "json",
			success: function(x){
			
				if(x.status){
					var modal = $('<div title="Update My Account">'+x.text+'</div>');					
					modal.dialog( "destroy" );				
					modal.dialog({ 
							modal: true,						 
							width: 300,
							height: 200,
							buttons: {
							Ok: function() {
								$( this ).dialog( "close" );
								window.location = x.url;
							}
						}   
					});					
					
				}else{
					var modal = $('<div title="Update My Account">'+x.text+'</div>');					
					modal.dialog( "destroy" );				
					modal.dialog({ 
							modal: true,						 
							width: 300,
							height: 200,
							buttons: {
							Ok: function() {
								$( this ).dialog( "close" );
							}
						}  
						 
					});				
				} 
			} 
		}); 
		return false;		
	}
}


 $(function(){
		
	Member.base_url = $("#distributor_url").val();
	$('.fancybox').fancybox();   
});