var Admin = {
	enableCity: function( id, v ){ 
		v = v.value;
		$.ajax({
			type:"post",
			data:{id:id, s:v},
			url:"admin/changeCities",
			success: function(x){
				if( v == 1 ){ 
					$("#city_tr_"+id).removeClass("inactive").removeClass("pending").addClass("active");						 
				}else if( v == 0 ){
					$("#city_tr_"+id).removeClass("active").removeClass("pending").addClass("inactive");	
				}else{
					$("#city_tr_"+id).removeClass("inactive").removeClass("active").addClass("pending");	
				}
			}	
		}); 
	},
	createCity: function(form){
		d = $(form).serialize();
		
		$.ajax({
			type:"post",
			data:d,
			url:"admin/createCity",
			success: function(x){
				if( x ){ 
					alert("New City is create");
					window.location = "admin/cities" ;
					
					//return true;
				}else{
					alert("Error") ;
				}
			}	
		}); 	

		return false;		
	},
	enableFeatureBusiness: function( id ){
		var s = $("#featured_btn_"+id).attr("data");	
		$.ajax({
			type:"post",
			data:{id:id, s:s},
			url:"admin/featureBusiness",
			success: function(x){
				if( s == 1 ){ 
					$("#featured_tr_"+id).removeClass("city-enable").addClass("city-disable");	
					$("#featured_btn_"+id).attr("data", 0);	
					$("#featured_btn_"+id).html("enable");
				}else{
					$("#featured_tr_"+id).removeClass("city-disable").addClass("city-enable");	
					$("#featured_btn_"+id).attr("data", 1);	
					$("#featured_btn_"+id).html("disable");
				}
			}	
		}); 		
	},
	BMupdatebasic: function( form ){
		//alert($(form).serialize());
		if( confirm("Please confirm your update.") ){
			$.ajax({
				type:"post",
				data: $(form).serialize(),
				url:"admin/businessmanager_update_basic",
				dataType: "json",
				success: function(xhr){
					
					var modal = $('<div title="Success">'+xhr.txt+'</div>');					
					modal.dialog( "destroy" );				
					modal.dialog({
						modal: true,
						buttons: {
							Ok: function() {
								$( this ).dialog( "close" );
								if( xhr.bmstatus == 'new' && xhr.status ){
									window.location = 'admin/businessmanager/#busi_tr_'+xhr.id;
								}
							}
						}
					});
					
				}	
			}); 
		}
		
		return false;
	}, 
	CardInfoUpdate: function(id){
	
		_type	= $("#card_input_type_"+id).val();
		_start 	= $("#card_input_start_"+id).val();
		_end 	= $("#card_input_end_"+id).val();
		_val 	= $("#card_input_val_"+id).val();
		_reset 	= $("#card_input_reset_"+id).val();
		_url 	= $("#card_input_url_"+id).val();
		
		if( confirm("Please confirm your update.") ){  
		
			$.ajax({
				type:"post",
				data: {type:_type,start:_start,end:_end,val:_val,reset:_reset,url:_url, id:id},
				url:"admin/businessmanager_update_cardinfo", 
				success: function(x){
					if(x) alert("Updated Successfully");					
					else alert("Failed to update");	 
				}  
			}); 
		}	
	},
	CardOnline: function( card ){
		var id = (card.id).split("_")[1];
		var v = card.value;
		
		$.ajax({
			type:"post",
			data: {id:id,v:v},
			url:"admin/createpage", 
			dataType:"json",
			success: function(xhr){
			  
				var modal = $('<div title="Create Card Page">'+xhr.txt+'</div>');					
				modal.dialog( "destroy" );				
				modal.dialog({ 
					modal: true,						 
					width: 300,
					height: 150,
					buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
						}
					} 
				});				
			}  
		});
			
	},
	CardInfoDelete: function(id){
		if( confirm("Please confirm on deleting card.") ){  
		
			$.ajax({
				type:"post",
				data: {id:id},
				url:"admin/businessmanager_delete_cardinfo", 
				success: function(x){
					if(x){
						$("#card_input_tr_"+id).fadeOut("normal");
						alert("Delete Successfully");					
						
					}else alert("Failed to delete");	 
				}  
			}); 
		}	
	},
	CardInfoCreate: function(id){
		_type	= $("#card_input_type_new").val();
		_start 	= $("#card_input_start_new").val();
		_end 	= $("#card_input_end_new").val();
		_val 	= $("#card_input_val_new").val();
		_reset 	= $("#card_input_reset_new").val();
		_url 	= $("#card_input_url_new").val();	
		
		if( confirm("Do you want to create a new card?") ){  
		
			$.ajax({
				type:"post",
				data: {type:_type,start:_start,end:_end,val:_val,reset:_reset,url:_url, id:id},
				url:"admin/businessmanager_create_cardinfo", 
				success: function(x){
					if(x){
						alert("Added Successfully");				
						window.location = "admin/businessmanager_update/"+id;
					}					
					else alert("Added failed");	 
				}  
			}); 
		}		
	},
	uploaddemo: function(id){
		
		new AjaxUpload(id, {
			action: 'admin/test4',
			onSubmit : function(file , ext){
				//$('#button4').text('Uploading ' + file);
				//this.disable();	
			},
			onComplete : function(file){
				alert(file);				
			}		
		});			
		
	},
	/* storefeatured: function( id, x){
			x = x.value; 
			$.ajax({
				type:"post",
				data: {id:id,value:x},
				url:"admin/storemanager_update_featured", 
				success: function(z){
					 
						if( x == 1 ) $("#store_td_"+id).removeClass("disable").addClass("enable");
						if( x == 0 ) $("#store_td_"+id).removeClass("enable").addClass("disable");
				 		
				}  
			});	
	}, */
	storeCityListFeatured: function(x,storeid,cityid, linkid,type){
			var val = (x.checked)?1:0;
			$.ajax({
				type:"post",
				data: {storeid:storeid,linkid:linkid,type:type,val:val,cityid:cityid},
				url:"admin/store_city_list_featured_update", 
				success: function(xhr){
					//alert(xhr)	 
				}  
			});		
	},
	storeCategoryActive: function( x, storeid, categoryid ){
			var val = (x.checked)?1:0;
			$.ajax({
				type:"post",
				data: {storeid:storeid, val:val, categoryid:categoryid},
				url:"admin/store_category_list_active", 
				success: function(xhr){
					 
				}  
			});		
	},
	resendVCode: function(id){
			$.ajax({
				type:"post",
				data: {id:id},
				url:"admin/resendemailverification", 
				dataType: "json",
				success: function(xhr){ 
					alert(xhr.text); 
				}
			});	
	},
	dealsAction: function(a,id,f){
		
		var go = true;
		var v = '';
		if(a == 'save'){
			v = $("#dealstext_"+id).val();
		}else if( a == 'del' ){
			var con = confirm("Do you want to Delete?");
			if(!con){
				go = false;
			}
		}else if( a == 'add' ){
			v = $("#deals_new_txt").val();
			
			var con = confirm("Add a new deal?");
			if(!con){
				go = false;
			}
		}else if( a == 'status' ){
			//v = ($("#deals_active_"+id).checked)?1:0;	
			v = ($("#deals_active_"+id).attr("checked") == 'checked')?1:0;	
		}else{
		}
		
		if( go ){
			$.ajax({
				type:"post",
				data: {act:a,id:id,txt:v},
				url:"admin/stores_deals_action", 
				dataType: "json",
				success: function(xhr){ 
					 
					if(a=='del' && xhr.status ){
						$("#dealstr_"+id).css("background-color","red");
						$("#dealstr_"+id).fadeOut();
					}
					
					if(a=='add' && xhr.status){
					 
						html = '<tr id="dealstr_'+xhr.id+'" style="background-color:orange">';
						html += '<td><input type="text" id="dealstext_'+xhr.id+'" value="'+v+'" /></td>';
						html += '<td><input type="checkbox" id="deals_active_<?php echo $key; ?>" onclick="Admin.dealsAction(\'status\','+xhr.id+',this)" value="1" /></td>';
						html += '<td><button onclick="Admin.dealsAction(\'save\','+xhr.id+',"")" >Save</button>';
						html += '<button onclick="Admin.dealsAction(\'del\','+xhr.id+',"")">Delete</button></td></tr>';
						
						$("#tbl_deals").append(html);
						$("#deals_new_txt").val('');
					}
					
					if(a=='save' && xhr.status){
						$("#dealstr_"+id).css("background-color","orange");
						setTimeout(function(){
							$("#dealstr_"+id).css("background-color","#fff");
						}, 1000);
						
					}
					
					if(a=='status' && xhr.status){
						$("#dealstr_"+id).css("background-color","orange");
						setTimeout(function(){
							$("#dealstr_"+id).css("background-color","#fff");
						}, 1000);
						
					}					
				}
			});
		}	
	}
	
}

 