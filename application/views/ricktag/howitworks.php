<div class="container">
    <div class="content">
    <?php
    if(empty($this->distributor_url)){
        $get_link = base_url('guest/register');
        $contact_link = base_url('contactus');
        $home_link = base_url('/learn');
    }else{
        $get_link = isset($_GET['c2']) ? base_url($this->distributor_url.'/register').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/register');
        $contact_link = isset($_GET['c2']) ? base_url($this->distributor_url.'/contactus').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/contactus');
        $home_link = isset($_GET['c2']) ? base_url($this->distributor_url).'?c2='.$_GET['c2'] : base_url($this->distributor_url);
    }
    ?>
    <!--body content starts here-->
      <div class="top"><h1>How It Works</h1><br/><a href="<?php echo $home_link; ?>">Home</a> <img src="<?php echo base_url();?>static/ricktag/images/arrow.gif" alt="next"> How It Works</div>
      
             <div class="howitworkscontainer">
                    
             
                     <div class="howitworksbox">
                     <div class="howitworksboxright"><img src="<?php echo base_url();?>static/ricktag/images/ricktag_rewards_image1.jpg" alt="ricktag rewards photo"></div> 
                     <div class="howitworksboxleft"><h1>1. Register your card <span style="color:#fd590d;">(It's Free)</span></h1>
                     <p>Ricktag is a free loyalty and rewards card that will save you money.<br/><br/>

                        <a class="hover" href="<?php echo $get_link; ?>">Register Your Card »</a></p>

                     </div>
                     </div>
                     
                     
                     <div class="howitworksbox">
                     <div class="howitworksboxright">
                     <h1>2. Show your card</h1>
                     <p>Get exclusive savings and valuable rewards when you show your card at participating Ricktag Merchants.<br/><br/>

                        <a class="hover"  href="<?php echo $get_link; ?>">Register Your Card »</a></p>
                     
                     </div> 
                     <div class="howitworksboxleft">
                        <img src="<?php echo base_url();?>static/ricktag/images/ricktag_rewards_image2.jpg" alt="ricktag rewards photo">
                     </div>
                     </div>

                     <div class="howitworksbox">
                     <div class="howitworksboxright"><img src="<?php echo base_url();?>static/ricktag/images/ricktag_rewards_earn.jpg" alt="ricktag rewards photo"></div> 
                     <div class="howitworksboxleft"><h1>3. Earn Rewards Bucks</h1>
                     <p>Earn up to 5% in Rewards Bucks on all eligible purchases at selected Ricktag Sponsors and redeem towards your next purchase. The more you visit the more you earn and save!<br/><br/>

                        <a class="hover" href="<?php echo $get_link; ?>">Register Your Card »</a></p>

                     </div>
                     </div>
                    
                    


                     <div class="howitworksbox">
                     <div class="howitworksboxright"><h1>4. Save money</h1>
                     <p>Save money right in your neighbourhood on shops, restaurants, salons and more. </p> 
                     
                     </div>

                     <div class="howitworksboxleft"><img src="<?php echo base_url();?>static/ricktag/images/ricktag_rewards_image3.jpg" alt="ricktag rewards photo"></div> 
                     </div>
             
             <br/>
             </div>
             <div class="register_now_bottom">
                <a class="common_button" href="<?php echo $get_link; ?>">Register Now (it's free)</a> <span style="margin-left:20px;">Need help? <a class="hover"  href="<?php echo $contact_link; ?>">Contact us</a> anytime.</span>  
                </div>
<!--body content ends here-->
    </div>  
</div>