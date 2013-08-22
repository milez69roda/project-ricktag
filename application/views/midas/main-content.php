
    
    <div class="container">
    
<div class="content">
    
   
   
      <div class="top_content">
        
          <h2>FEATURED SAVINGS</h2>
            
<div class="top_content_right"> 
            
               <div class="register_now">
               
               <div class="r_register_now"><img src="<?php echo base_url('/static/ricktag/images/Register.gif');?>" width="113" height="83"></div>
               
               <div class="l_register_now"><p><span style="font-size:16px; font-weight:bold;">REGISTER YOUR CARD</span></br>
               Join our free loyalty and rewards program and get exclusive local savings and valuable rewards.</br></br>
               </p>
               <a class="register_now_a common_button " href="<?php echo isset($_GET['c2']) ? base_url($this->distributor_url.'/register').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/register'); ?>">Register Now</a>
             </div>
                
               </div>
      <div class="register_now_r">
 
      <div class="l_register_now"><p><span style="font-size:16px; font-weight:bold;">USE YOUR CARD</span></br>
               Save money right in your Neighbourhood on shops, restaurants, salons, groceries, hotels and more.<br><br><br>
               </p>
            <a class="register_now_a common_button " style="bottom: 15px;" href="<?php echo isset($_GET['c2']) ? base_url($this->distributor_url.'/register').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/register'); ?>">Register Now</a>
             </div>
               
        <div class="fl_register_now"><img src="<?php echo base_url('/static/ricktag/images/Use.gif');?>" width="113" height="83"></div>

      </div>
      <div class="register_now">
               
        <div class="r_register_now"><img src="<?php echo base_url('/static/ricktag/images/Save.gif');?>" width="113" height="83"></div>
               
  <div class="l_register_now"><p><span style="font-size:16px; font-weight:bold;">EVERYONE SAVES</span></br>
               We know that saving for the future is important and with your Ricktag card you save for the whole family.</br></br>
               </p>

             <a class="register_now_a common_button " href="<?php echo isset($_GET['c2']) ? base_url($this->distributor_url.'/register').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/register'); ?>">Register Now</a>
           </div>
               
</div>
            
            
            </div>
                    <div id="banner" class="image_slider flexslider">
         
          <ul class="slides">
                    <?php
                      foreach( $this->header_card_slides as $img ):
                    ?>  
                      <li><a href="<?php echo base_url($this->distributor_url);  ?>#"><img src="<?php echo $img; ?>"  width="515" height="310" alt="" /></a></li>
                    <?php endforeach; ?>                  
          </ul>
                </div>
    <div class="bottom_content"> 
    
        <h2>USE YOUR CARD & SAVE</h2>
            
          <div class="bottom_content_right">
            <ul>
                        
                        <li><img style="width: 85px; height: 105px;margin-top: 5px;" src="<?php echo base_url('/static/ricktag/images/restaurant.jpg');?>"> 
                        
                        <div class="text">
                        
                        <p style="text-align:left;"><span style="font-size:14px; font-weight:bold;">LOCAL RESTAURANT <br>DISCOUNTS</span><br/>
                        Use your card and save money at participating restaurants.<br/><br/>
                        
                        <a href="<?php echo isset($_GET['c2']) ? base_url('/learn/guest/category').'?c2='.$_GET['c2'] : base_url('/learn/guest/category'); ?>">CHECK DEALS »</a></p>
                        </div>
                        
            </li>
                        
                        <li><img style="width: 85px; height: 105px;margin-top: 5px;"  src="<?php echo base_url('/static/ricktag/images/pets.jpg');?>">
                        
                        <div class="text">
                        
                        <p style="text-align:left;"><span style="font-size:14px; font-weight:bold;">LOCAL PET <br>DISCOUNTS</span><br/>
                        Use your card and save money when you shop at participating pet stores.<br/>
                        
                        <a href="<?php echo isset($_GET['c2']) ? base_url('/learn/guest/category').'?c2='.$_GET['c2'] : base_url('/learn/guest/category'); ?>">CHECK DEALS »</a></p>
                        </div>
                        
            </li>
                        
                        <li><img style="width: 85px; height: 105px;margin-top: 5px;"  src="<?php echo base_url('/static/ricktag/images/grocery.jpg');?>"> 
                        
                        <div class="text">
                        
                        <p style="text-align:left;"><span style="font-size:14px; font-weight:bold;">LOCAL GROCERY <br>DISCOUNTS</span><br/>
                        Use your card and save money on fresh meats and ready to serve homemade meals.<br/>
                        
                        <a href="<?php echo isset($_GET['c2']) ? base_url('/learn/guest/category').'?c2='.$_GET['c2'] : base_url('/learn/guest/category'); ?>">CHECK DEALS »</a></p>
                        </div>
                        
            </li>
                        
                        <li><img style="width: 85px; height: 105px;margin-top: 5px;"  src="<?php echo base_url('/static/ricktag/images/beauty.jpg');?>"> 
                        
                        <div class="text">
                        
                        <p style="text-align:left;"><span style="font-size:14px; font-weight:bold;">LOCAL BEAUTY <br>DISCOUNTS</span><br/>
                        Use your card and get more value for your dollar on participating beauty supplies.<br/>
                        
                        <a href="<?php echo isset($_GET['c2']) ? base_url('/learn/guest/category').'?c2='.$_GET['c2'] : base_url('/learn/guest/category'); ?>">CHECK DEALS »</a></p>
                        </div>
                        
            </li>
                        
            </ul>
          </div>
  
       
        <div class="bottom_content_left">
        
        
          <p><img style="margin-bottom: 8px;" src="<?php echo $this->header_card_image; ?>">
            <?php echo $this->session->userdata("ISLOGIN"); ?>
          <a style="font-size: 20px;" class="common_button" href="<?php echo isset($_GET['c2']) ? base_url($this->distributor_url.'/register').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/register'); ?>">Register Now</a><br><br>
          
          <a href="<?php echo isset($_GET['c2']) ? base_url('/learn/guest/category').'?c2='.$_GET['c2'] : base_url('/learn/guest/category'); ?>">CHECK OUT THE DEALS »</a></p>
          </div>
        
          </div>
            

            
            
            
            
            
            
  <!-- end .content --></div>
  <!-- end .container --></div>


<div class="clearfix"></div>
</div>