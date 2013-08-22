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
								
								if( xhr.bmstatus == 'update' && xhr.status ){
									window.location = 'admin/businessmanager_update/'+xhr.id;
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
	},
	
	cardpaloption: function(store_id, opt ){
		var id;
		if( opt == 'gc' ){
			id = 'carpal_gc_'+store_id;
		}
		
		if( opt == 'rc' ){
			id = 'carpal_rc_'+store_id;
		}

		if( opt == 'reg' ){
			id = 'carpal_reg_'+store_id;
		}		
		
		var getVal = $('#'+id).attr("value");
		var uVal;
		if(getVal == 1){
			$('#'+id).val('0');
			uVal = 0;
		}else{
			$('#'+id).val('1');
			uVal = 1;
		}
		 
		$.ajax({
				type:"post",
				data: {id:store_id,t:opt,v:uVal},
				url:"admin/store_update_cardpal_option", 
				dataType: "json",
				success: function(xhr){ 		
				}
		});
		  
	},
	
	featuredStoreModal: function(x){
		var d = new Date().getTime();
		var modal = $('<div></div>').load('admin/ajax_featured_stores',{_t:d,center:x});					
		modal.dialog( "destroy" );				
		modal.dialog({ 
			title: 'Stores',
			modal: true,
			width: 800,	
			position: 'top',
			buttons: {
				Cancel: function(){
					$(this).dialog("close");
				},
				Ok: function() {
				
					$('.store').each( function(){
						var storeid = '';
						if ( $(this).hasClass('selected') ){							 
							storeid = $(this).attr('id');
						}
						sid = storeid.split('_');
						if( storeid != '' ){
							
							$.ajax({
								type:'post',
								cache:false,
								url: 'admin/ajax_featured_add_store',
								data:'c='+x+'&st='+sid[1],
								dataType: 'json',
								success: function(xhr){
									if( xhr.status){
										$("#tabsinner-"+xhr.city_id+ " .sortable").append(xhr.store);
										$( modal ).dialog( "close" );
									}else{
										 alert(xhr.msg);
									}
								}
							});
						}
						
					});
					 
				}
			}
		});
		
	},

	featuredStoreMakeMain: function(c){
		
		var d = new Date().getTime();
		var id = '';
		var hasclass =  false;
		var html = '';
		
		
		$("#sortable_"+c+" li").each(function(){
			if( $(this).hasClass('selected') ){
				hasclass = true; 
				html = $(this).html();
				id = $(this).attr("id");
			}
		});
		
		if( hasclass ){
			$("#main-featured-"+c+" ul").html('<li class="ui-state-default">'+html+'</li>').hide().fadeIn('slow');			 
			 
			$("#"+id).fadeOut('normal', function(){
				$("#"+id).remove();
			});			
			
			var i = id.split('_');
			
			$.ajax({
				type: 'post',
				url: 'admin/ajax_featured_makemain_store/?_t='+d,
				data: 'c='+c+'&s='+i[1],
				success: function(xhr){
					
				}
			});
			
			
		}
	},
	
	featuredStoreRemove: function(c){
		var d = new Date().getTime();
		
		var hasclass = false;
		
		$("#sortable_"+c+" li").each(function(){
			if( $(this).hasClass('selected') ){
				hasclass = true; 
				html = $(this).html();
				id = $(this).attr("id");
			}
		});
		
		if( hasclass ){
	 
			var i = id.split('_');
			
			$.ajax({
				type: 'post',
				url: 'admin/ajax_featured_remove_store/?_t='+d,
				data: 'c='+c+'&s='+i[1],
				dataType: 'json',
				success: function(xhr){
					if( xhr.status ){						
						$("#"+id).fadeOut('normal', function(){
							$("#"+id).remove();
						});
					}
				}
			});
		}   	
	},
	
	featuredStoreChangedPosition:function(c){
	
		var d = new Date().getTime();
	
		$.ajax({
			type: 'post',
			url: 'admin/ajax_featured_sort_store/?_t='+d,
			data: c,
			dataType: 'json',
			success: function(xhr){
				/* if( xhr.status ){						
					$("#"+id).fadeOut('normal', function(){
						$("#"+id).remove();
					});
				} */
			}
		});	
	}
	
}

 