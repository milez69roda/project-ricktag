<!--body content starts here-->                         
 <?php
    if(empty($this->distributor_url)){
        $base_url_val = '/learn/guest/';
    }else{
        $base_url_val = '/'.$this->distributor_url.'/members/';
    }
    ?>

<script>
function initialize()
{

  geocoder = new google.maps.Geocoder();
      var lat = 0
      var lng = 0; 
      address = "<?php echo $stores->address.', '.$stores->city_name; ?>, CA";
      geocoder.geocode( { 'address': address}, function(results, status) {      
        if (status == google.maps.GeocoderStatus.OK) {
          var location1 = results[0].geometry.location ; 
          lat = location1["Ya"];
          lng = location1["Za"];
           
          var mapOptions = {
            zoom: 12,
            center: new google.maps.LatLng(location1.lat(),location1.lng()),
            mapTypeId: google.maps.MapTypeId.ROADMAP
          }

          var map = new google.maps.Map(document.getElementById("map"), mapOptions);

          var location = results[0].geometry.location 
          var marker = new google.maps.Marker({
            map: map,
            position: location,
            icon: '<?php echo base_url()?>static/new_member/images/marker.png',
          });
           
          
          markers.push(marker); 
        }
      }); 
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div class="guest_list_container">
  <div class="guest_list_content">
    
                  <div class="guest_list_details_content_top">
                    
                        <div class="guest_list_details_content_top_right">
                        
                        <h1><?php echo $stores->company_name; ?><br/></h1>
                         <div class="percentage"><?php echo $stores->discount; ?></div>
                         <div class="yousave"><p>you save </p></div>
                      
                      <?php if( $this->session->userdata("ISLOGIN") && !empty($this->distributor_url) ){ ?>
                         <div class="active_holder">
                           <?php if(in_array($stores->id, explode(",",$this->activated_deals_id))){ ?>
                            <span class="want_a_card" style="margin-left: 150px;">Deals Activated</span>
                           <?php }else{ ?>
                            <span class="want_a_card">Want this deal?</span>
                            <a style="float: left;" class="actv_your_card_btn" href="javascript:void(0);"></a>
                           <?php } ?>
                          </div>
                         <input type="hidden" name="user_id_val" id="user_id_val" value="<?php echo $this->card_id; ?>"/>
                         <input type="hidden" name="deal_id_val" id="deal_id_val" value="<?php echo $stores->id; ?>"/>
                      <?php }else{ ?>

                        <a class="reg_your_card_btn" href="<?php echo base_url('/guest/register'); ?>"></a>
                        <?php echo isset($_GET['c2']) ? '<a href="'. base_url('/welcome/popup_login').'?c2='.$_GET['c2'] .'" class = "get_a_card fancybox fancybox.ajax hover" id="button1">Login</a>' : '<a class="get_a_card hover" href="'.base_url("getacard").'">Get a card</a>'; ?>
                      <?php } ?>
                      
                        <div class="clearfix"></div> 
                        <p><span class="featured_val"><?php echo $stores->featured; ?></span> Ricktaggers activated this deal</p>
                  
                        </div>
                        
                        <div class="guest_list_details_content_top_left">
                        
                        <img class="rounded" src="<?php echo $stores->small_banner; ?>" alt="<?php echo $stores->company_name; ?> logo">
                        
                        </div>
                    
                  </div>
      
    <div class="guest_list_details_center_content">  
    <div class="guest_list_details_center_content_left"> 
                
                <h1>Details</h1>
                
                <p><?php echo $stores->offer_details; ?></p>

                <h1>The Fine Print</h1>
                
                <p><?php echo $stores->fine_print; ?></p>

                <h1>How The Deal Works?</h1>
                
                <ol style="margin-left: 30px;">
                  <li><p>Login or Register Card</p></li>
                  <li><p>Find Discounts that you like</p></li>
                  <li><p>Click on the Activate Deal button</p></li>
                  <li><p>Visit store and show your card to redeem!</p></li>
                </ol>
                
                </div>
                
                <div class="guest_list_details_center_content_right"> 
                
                
                  <img class="rounded" width="150px" height="150px" src="<?php echo base_url($stores->logo); ?>" alt="<?php echo $stores->company_name; ?> logo">
                  
                  <p> <img src="<?php echo base_url();?>static/ricktag/images/address_icon.png" alt="address icon"><?php echo $stores->address; ?><br/><?php echo $stores->city_name; ?> , <?php echo $stores->postal_code; ?></p>
                
            
                <p> <img src="<?php echo base_url();?>static/ricktag/images/phone_icon.png" alt="phone icon"><?php echo $stores->phone; ?></p>
                


                <div id="map" style="width: 300px; height: 190px">MAP HOLDER</div>
                
                
                    <div class="social_network_btns">
                            <ul>
                            <li><a class="facebook" href="<?php echo $stores->facebook_link; ?>"></a></li>
                            <li><a class="tweet" href="<?php echo $stores->twitter_link; ?>"></a></li>
                            <li><a class="email" href="mailto:<?php echo $stores->email; ?>"></a></li>
                            <li><a class="visit" href="<?php echo $stores->website; ?>"></a></li>
                            </ul>
                    </div>
          
     </div>
   </div>
    
   <div class="clearfix"></div> 
    
      <div class="guest_list_content_bottom">
      
      
         <div class="nearby_deals"> 
         
         <div class="view_more"><p><a href="<?php echo base_url($base_url_val.'category/'.$cat_id); ?>">View More »</a></p></div>
      <h1>Nearby Deals</h1>  
      
      
      </div>
      
             
            <div class="deals_data">
              <ul>
        <?php foreach ($stores_list as $key => $value) { ?>
        <?php if($key <= 3){ ?>
        <?php if($key != 0){ ?>
              <li>
                <div class="widget widget-one rounded">
                  <a class="deal" href="#">
                    <div class="guest_list_image">
                      <img class=" rounded_top" width="274px" height="164px" src="<?php echo $value->small_banner; ?>" alt="<?php echo isset($value->company_name) ? $value->company_name : '' ; ?>">
                    </div>
                    <div class="guest_list_text">
                      <h3><?php echo isset($value->company_name) ? $value->company_name : '' ; ?></h3>
                      <p><?php echo isset($cat_text) ? substr($cat_text,0,-2) : '' ; ?></p>
                    </div>
                  </a>
                  <input type="hidden" class="view_id" value="<?php echo $value->id; ?>" />
                </div>
              </li>
      <?php } } }?>
                  </ul>            
          </div>
              
              
<div class="clearfix"></div>
        
      </div>
  </div>  
</div>
<!--body content ends here-->