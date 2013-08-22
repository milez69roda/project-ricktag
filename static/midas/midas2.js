
var Midas = {
	base_url: '',
	register: function( form ){ 
		var d = $(form).serialize();		
		$.ajax({
			type:"post",
			data: d,
			url:this.base_url+"/register",
			dataType: "json",
			success: function(json){
				if( json.status ){	
				
					var modal = $('<div title="Success">'+json.text+'</div>');					
					modal.dialog( "destroy" );				
					modal.dialog({
						modal: true,
						buttons: {
							Ok: function() {
								$( this ).dialog( "close" );
								window.location = "midas";
							}
						}
					});
					
					
				}else{
				
					var modal = $('<div title="Warning">'+json.text+'</div>');					
					modal.dialog( "destroy" );				
					modal.dialog({ 
						modal: true,						 
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
	},
	login: function(form){
		var formdata = $(form).serialize();
		
		$.ajax({
			type:"post",
			url:this.base_url+"/login",
			data:formdata,
			dataType:"json",
			success: function(xhr){
			
				if(!xhr.status){
					var modal = $('<div title="Login Failed">'+xhr.msg+'</div>');					
					modal.dialog( "destroy" );				
					modal.dialog({
						modal: true,
						buttons: {
							Ok: function() {
								$( this ).dialog( "close" ); 
							}
						}
					});
					
				}else{
					window.location = xhr.url+"/";
				}					
			}
		});	
		return	false;
	},
	giftcard: function( form ){
		var formdata = $(form).serialize();		 
		$.ajax({
			type:"post",
			url:this.base_url+"/giftcard",
			data:formdata,
			dataType:"html",
			success: function(xhr){
				$("#gc_bal_label").html(xhr); 
			}
		});
		
		return false;
	},
	stores: function( c ){
		$.ajax({
			type:"post",
			url:this.base_url+"/stores",
			data:{city:c},
			dataType:"json",
			success: function(xhr){
				var stores = xhr.stores;
				//console.log(stores);
				$("#stores_list").html('');
				for(i=0; i<stores.length; i++){
					$("#stores_list").append(stores[i].replace("\\", ""));	
					$("#strli_"+i).fadeIn('normal');
				}
				
				//$("#stores_list").html(xhr);
			}
		}); 
	},
	storesinfo: function(d){
		$.ajax({
			type:"post",
			url:this.base_url+"/storesinfo",
			data:{id:d},
			dataType:"html",
			success: function(xhr){
				var modal = $('<div title="">'+xhr+'</div>');					
				modal.dialog( "destroy" );				
				modal.dialog({ 
					modal: true,						 
					width: 870,
					height: 280,
					/* buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
						}
					} */
				});
			}
		});		
	},	
	referafriend: function(form){
		var d = $(form).serialize();
		
		$.ajax({
			type:"post",
			url:this.base_url+"/register_referafriend",
			data:d,
			dataType:"json",
			success: function(xhr){
				var txt = '';
				if(xhr.status){
					txt = xhr.text;
				}else{
					txt = xhr.text;
				}
				
				var modal = $('<div title="REFER-A-FRIEND">'+txt+'</div>');					
				modal.dialog( "destroy" );				
				modal.dialog({ 
					modal: true,						 
					width: 300,
					height: 200,
					 
				});
			}
		});
		return false;		
	},
	eclub: function(form){
		var d = $(form).serialize();
		
		$.ajax({
			type:"post",
			url:this.base_url+"/register_eclub",
			data:d,
			dataType:"json",
			success: function(xhr){
				var txt = '';
				if(xhr.status){
					txt = xhr.text;
				}else{
					txt = xhr.text;
				}
				
				var modal = $('<div title="JOIN OUR e-CLUB">'+txt+'</div>');					
				modal.dialog( "destroy" );				
				modal.dialog({ 
					modal: true,						 
					width: 300,
					height: 200,
					 
				});
			}
		});		
		return false;		
	},
	forgotpassword: function(f){
		$.ajax({
			type:"post",
			url:this.base_url+"/forgotpassword_send",
			data:$(f).serialize(),
			dataType:"json",
			success: function(xhr){
				/* var modal = $('<div title="Forgot Password">'+xhr.msg+'</div>');					
				modal.dialog( "destroy" );				
				modal.dialog({ 
					modal: true,						 
					width: 300,
					height: 200
				});	 */	
				if(!xhr.status){
					alert(xhr.msg);
				}else{
					window.location = this.base_url;
				}				
			}			
		});	
		
		return false;
	} 
}

$(function(){
		
	Midas.base_url = $("#distributor_url").val();
	//var ssel = $('#content-city').removeAttr('selected').find('option:first').attr('selected', 'selected');
	var ssel = $('#content-city option:selected').val();
	Midas.stores(ssel);
	 
	$('.fancybox').fancybox();
	
	 
});
 