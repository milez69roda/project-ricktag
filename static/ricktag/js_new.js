//fucntions
function marquee(a, b) {
    var width = b.width();
    var start_pos = a.width();
    var end_pos = -width;

    function scroll() {
        if (b.position().left <= -width) {
            b.css('left', start_pos);
            scroll();
        }
        else {
            time = (parseInt(b.position().left, 10) - end_pos) *
                (20000 / (start_pos - end_pos)); // Increase or decrease speed by changing value 10000
            b.animate({
                'left': -width
            }, time, 'linear', function() {
                scroll();
            });
        }
    }

    b.css({
        'width': width,
        'left': start_pos
    });
    scroll(a, b);
    
    b.mouseenter(function() {     // Remove these lines
        b.stop();                 //
        b.clearQueue();           // if you don't want
    });                           //
    b.mouseleave(function() {     // marquee to pause
        scroll(a, b);             //
    });                           // on mouse over
    
}


var $el, $tempDiv, $tempButton, divHeight = 0;

$.fn.middleBoxButton = function(text) {
    
    return this.hover(function(e) {
    
        $el = $(this).css("border-color", "white");
        divHeight = $el.height() + parseInt($el.css("padding-top")) + parseInt($el.css("padding-bottom"));
                
        $tempDiv = $("<div />", {
            "class": "overlay rounded"
        });

        cat_id = $('#category_val').val();

        if(cat_id == ""){
            cat_id = 0;
        }

        view_id = $(this).children('.view_id').val();
                
        if($('#is_login_validation').val() == 1){
            $tempButton = $("<a />", {
                "href": $('#base_url_val').val() + 'deals/' + cat_id + '/' + view_id + $('#crd_num_val').val(),
                "text": text,
                "class": "widget-button rounded",
                "css": {
                    "top": (divHeight / 2) - 7 + "px"
                }
            }).appendTo($tempDiv);
        }else if($('#is_login_validation').val() == 0){
            $tempButton = $("<a />", {
                "href": '/welcome/popup_login' + $('#get_param').val(),
                "text": text,
                "class": "fancybox fancybox.ajax widget-button rounded",
                "css": {
                    "top": (divHeight / 2) - 7 + "px"
                }
            }).appendTo($tempDiv);
        }

        $tempDiv.appendTo($el);
        
    }, function(e) {
    
        $el = $(this).css("border-color", "#999");
    
        $(".overlay").fadeOut("fast", function() {
            $(this).remove();
        })
    
    });
    
}

//json functions
var ricktag = {
    base_url: '',
    check_balance: function( form ){ 
        var data = $(form).serialize();        
        $.ajax({
            type:"post",
            data: data,
            url:this.base_url+"/ajax/check_balance",
            dataType: "json",
            success: function(json){
                if(json.status == 'success'){  
                    $('#balance').val(json.balance);
                    
                }else if(json.status == 'failed'){
                    var modal = $('<div>'+json.message+'</div>');                   
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
    }
}


$(document).ready(function() {

    $(".actv_your_card_btn").click(function(){
        var user_id_val = $("#user_id_val").val();
        var deal_id_val = $("#deal_id_val").val();

        $.ajax({
            type:"post",
            data: { user_id: user_id_val, deal_id: deal_id_val },
            url: "/ajax/activatedeals",
            dataType: "json",
            success: function(json){
                if(json.status == 'success'){  
                    $(".featured_val").text(json.featured_val);
                    $(".active_holder").html('<span style="margin-left: 150px;" class="want_a_card">Deals Activated</span>');

                }else if(json.status == 'failed'){
                    //nothing to do here
                }
            }
        }); 

        return false;
    });

    $(".widget-one").middleBoxButton("view deal");

    $('.changelocation').change(function() {
        var url_val = $(this).val();
          if (url_val) {
              window.location = $('#base_url_val').val() + $('#page_name_val').val() + "/"+ $('#category_val').val() +"/"+ url_val + $('#crd_num_val').val();
          }
        return false;
    });

    $(".settings_arrow").click(function(){
        $("#settings_info").slideToggle();
    });


    //marquee($('#display'), $('#text'));  //Enter name of container element & marquee element

    $(".login_field").click(function() {
      $('#card1').focus();
    });

    $('._this').mouseover(function(){
        $('.this_pop_holder').fadeIn();
        
    }).mouseout(function(){
        $('.this_pop_holder').fadeOut();
    });

    $('._location').click(function(){
        if ($('.gift_card_locations').is(":hidden")){
            $('.gift_card_locations').slideDown();
            $(".arrw").attr("src","/static/ricktag/images/up_don_icon.png");
        }else{
            $('.gift_card_locations').slideUp();
            $(".arrw").attr("src","/static/ricktag/images/drop_don_icon.png");
        }
    });

    $("input[name='card']").click(function() {
        if ($("#card_yes:checked").val()) {
           $(".display_crd").slideDown();
           $(".no").removeClass('no_selected');
           $(".yes").addClass('yes_selected');

        }else if($("#card_no:checked").val()){
            $(".display_crd").slideUp();
            $(".yes").removeClass('yes_selected');
            $(".no").addClass('no_selected');
        }
    });


    $('.date_text').mouseover(function(){
        $('.dob_register').fadeIn();
        
    }).mouseout(function(){
        $('.dob_register').css('display', 'none','important');
    });

   /* 
    $(".no").hover(function () {
        $(".yes").removeClass('yes_selected');
        $(".no").addClass('no_selected');
    });

    $(".yes").hover(function () {
        $(".no").removeClass('no_selected');
           $(".yes").addClass('yes_selected');
    });
    */

    // On DOM ready, hide the real password
    //$('#pwd').hide();

    // Show the fake pass (because JS is enabled)
    //$('#fake_pwd').show();

    // On focus of the fake password field
    //$('#fake_pwd').focus(function(){
    //    $(this).hide(); //  hide the fake password input text
    //    $('#pwd').show().focus(); // and show the real password input password
    //});

    // On blur of the real pass
    //$('#pwd').blur(function(){
    //    if($(this).val() == ""){ // if the value is empty, 
    //        $(this).hide(); // hide the real password field
    //        $('#fake_pwd').show(); // show the fake password
    //    }
        // otherwise, a password has been entered,
        // so do nothing (leave the real password showing)
    //});
});