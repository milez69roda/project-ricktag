<div class="container">

	<div class="content">
        <?php
        if(empty($this->distributor_url)){
            $home_link = base_url('/learn');
        }else{
            $home_link = isset($_GET['c2']) ? base_url($this->distributor_url).'?c2='.$_GET['c2'] : base_url($this->distributor_url);
        }
        ?>
    <div class="topright"><a href="<?php echo $home_link; ?>">Home</a> <img src="<?php echo base_url();?>static/ricktag/images/arrow.gif" alt="next"> Gift Cards</div>
    <div class="topleft">Gift Cards</div>
    
             <div class="giftcardsrightcontent">  
  
             <div class="rightcontentbox1">
            <div class="ordercards"><h2>Midas<sup><span style="font-size:12px;">&reg;</span></sup> Auto Experts<br/>
				$25 Gift Card</h2>
             <p>Earn travel rewards up to 4x faster, enjoy peace of mind with comprehensive travel insurance and much more.</p>
             <a class="common_button" href="//ricktagworks.ca/get-quote">Order Cards</a>
             </div>
             </div>
             <div class="rightcontentbox2">
             <div class="ordercards"><h2>Midas<sup><span style="font-size:12px;">&reg;</span></sup> Auto Experts<br/>
				Re-loadable Gift Card</h2>
             <p>Earn travel rewards up to 4x faster, enjoy peace of mind with comprehensive travel insurance and much more.</p>
             <a class="common_button" href="//ricktagworks.ca/get-quote">Order Cards</a>
             </div>
             </div>
             <div class="rightcontentbox3">
             <div class="ordercards"><h2>Boston Pizza<br/>
				$50 Gift Card</h2>
             <p>Earn travel rewards up to 4x faster, enjoy peace of mind with comprehensive travel insurance and much more.</p>
             <a class="common_button" href="//ricktagworks.ca/get-quote">Order Cards</a>
             </div>
             </div>
             <div class="rightcontentbox4">
             <div class="ordercards"><h2>Home Hardware<br/>
				$50 Gift Card</h2>
             <p>Earn travel rewards up to 4x faster, enjoy peace of mind with comprehensive travel insurance and much more.</p>
             <a class="common_button" href="//ricktagworks.ca/get-quote">Order Cards</a>
             </div>
             </div>
             
	
   			 </div>
             
             <div class="giftcardsleftcontent">  
                <div class="getyourbalance"><p><h3>CHECK YOUR <br/>CARD BALANCE</h3>
                <span class="_this">whats this?</span>
                <div class="this_pop_holder"><img class = "this_pop" src = "static/midas/images/what_this_img.png" alt = "" /></div>
                
                        <form name="check_balance_form" action="<?php echo base_url(); ?>ajax/check_balance" method="post" onsubmit="return ricktag.check_balance(this);">
    						<input type="text" name="card_number" placeholder="Enter your Card Number">
    						<input type="submit" class="common_button" value="Check Balance">
                            <div class="balance">
    						  <input type="text" name="balance" id="balance" placeholder="$ 00.00">
                            </div>
						</form> 
                </div>
                
                
                
                
                <div class="space"></div>  
                
             <div class="ordernow"><a href="//ricktagworks.ca/get-quote"><div class="ordernowbtn"></div></a></div>
             

             </div>
   
<div class="clearfix"></div>
   
   </div>  
</div>