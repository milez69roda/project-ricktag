var step1, step2, step3, step4;
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
	},
	updateAccountInfo: function(a,f,fs){
	  
		var x = $(a).html();
		 
		if( x == "Edit" ){
			
			
			if( f == "CITY_ID" ){
				$(a).html("Save");
				$("#ppcity").fadeOut(100, function(){
					$("#CITY_ID").fadeIn(200).addClass("activeEdit");
				}); 
			}else if( f == "NEWPASS" ){
			
				$("#newPass").fadeOut(100, function(){
					$("#newPass1").fadeIn(200);	
				});
			
			}else{ 
				$(a).html("Save");
				$("#"+f).addClass("activeEdit");
			}
		} 
		
		if( x == "Save" || x == "Save Password" ){
			
			var d = new Date();
			var v = $("#"+f).val();
			
			data = {v:v,f:f,fs:fs};
			
			if( f == "PASSWORD" ){
			
				var v1 	= '';//$("#current_password").val();
				var v2 	= $("#newPassV").val();
				var v21 = $("#renewpassV").val();
				
				data = {v:v1,v2:v2,v21:v21,f:f,fs:fs};
			}
			 
			$.ajax({
				type:"post",
				data:data,
				url:this.base_url+"/members/saveFieldsAccount/?_t="+d.getTime(),
				dataType: "json",
				success: function(xhr){
				 
					if( f == "CITY_ID" ){ 
						$(a).html("Edit");
						$("#CITY_ID").fadeOut(100, function(){
							$("#ppcity").val($("#CITY_ID option:selected").text());
							$("#ppcity").fadeIn(200).removeClass("activeEdit");
						}); 					
					}else if (f == "PASSWORD"){
						if( xhr.status ){
							/* alert(xhr.txt, function(){
								$("#newPass1").fadeOut(100, function(){
									$("#newPass").fadeIn(200);	
								});								
							}); */
							alert(xhr.txt);
							$("#newPass1").fadeOut(100, function(){
								$("#newPass").fadeIn(200);	
							});								
							$("#newPassV").val(''); 					
							$("#renewpassV").val(''); 

							Member.step2();		
						}else{
							alert(xhr.txt);
						}
					}else{
						$(a).html("Edit");
						$("#"+f).removeClass("activeEdit");
					}
					
				}
			});
			 
			
		}
		
	},
	updateAccountNot: function(f){ 
		
		var d = new Date();
		var v = f.value;
		var f = f.name; 
		
		$.ajax({
				type:"post",
				data:{value:v,name:f},
				url:this.base_url+"/members/savePreferences/?_t="+d.getTime(),
				dataType: "json",
				success: function(xhr){
					if(xhr.status){
						alert('You have successfully updated your Email Notifications')
					}
				}
		});
	},
	
	updateAccountPreferences: function(f){
		
		var ischeck = $(f).is(':checked');
		var d = new Date();
		var f = $(f).attr('name'); 
		var v = 0;
		 
		if(  ischeck ){ v = 1 }; 
		  
		$.ajax({
				type:"post",
				data:{name:f,value:v},
				url:this.base_url+"/members/savePreferences/?_t="+d.getTime(),
				dataType: "json",
				success: function(xhr){
					if(xhr.status){
						alert('You have successfully updated your Preferences')
					}
				}
		});	
	
	},
	
	step1: function(open){ 
		step1 = $( "#step1" ).dialog({title:'Step 1'}); 
		if(open){
			step1.dialog( "close" );
		}
	},	
	step2: function(){ 
		step1.dialog( "close" );
		step2 = $( "#step2" ).dialog({
					title:'Step 2',
					width: 350}); 
	},	
	step3: function(){ 
		step2.dialog( "close" );
		step3 = $( "#step3" ).dialog({
					title:'Step 3',
					width: 350}); 
	},	
	step4: function(){ 
		step3.dialog( "close" );
		step4 = $( "#step4" ).dialog({	
					title:'Step 4',
					width: 350}); 
	}	
}


 $(function(){
		
	Member.base_url = $("#distributor_url").val();
	$('.fancybox').fancybox();   
});