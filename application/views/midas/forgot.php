<div class="container">
	<div class="content">
	<?php
    if(empty($this->distributor_url)){
        $home_link = base_url('/learn');
        $captcha_link = base_url('welcome/captcha');
    }else{
        $home_link = isset($_GET['c2']) ? base_url($this->distributor_url).'?c2='.$_GET['c2'] : base_url($this->distributor_url);
        $captcha_link = base_url($this->distributor_url.'/captcha');
    }
    ?>
    
    <!--body content starts here-->
	  <div class="top"><h1>Forgot Password</h1><br/><a href="<?php echo $home_link;?>">Home</a> <img src="<?php echo base_url();?>static/ricktag/images/arrow.gif" alt="next"> Forgot Password</div>
      
        <div class="registeryourcardformtop forgotyourcardformtop"> 

        	<h3>Got a Ricktag Card in your wallet?</h3>
           
            <div class="line2">To reset your Ricktag password, please fill out the form below. Be sure to use the same email that you signed up with.</div>
            
            <form class="alignleft" action = "" method = "POST" onsubmit="return Midas.forgotpassword(this);">
            <p>Email<span style="margin-left:160px;">Security Check</span></p><br/>
				 <input type="text" name = "text-email" id="text-email" placeholder="enter email here" required/>
				 <input type = "text" name = "text-code" id = "text-code" placeholder = "enter code here" required/> 
				 <img src="<?php echo $captcha_link ?>" title="Captcha" alt="Catcha" style="vertical-align: middle; margin-top: -5px;"/>
                 <div class="space"></div>
            	 <input type="submit" class="resetnowbutton" value="Reset Now">              
            </form>
 		</div>            
<!--body content ends here-->
	</div>  
</div>