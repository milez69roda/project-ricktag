<div class="container">
    <div class="content">
    <?php
    $no_chk = '';
    $no_selected = '';
    $yes_chk = '';
    $yes_selected = '';
    $display_crd = '';
    if(empty($this->distributor_url)){
        $no_chk = 'checked="checked"';
        $no_selected = 'no_selected';
        $display_crd = 'display:none;';
        $home_link = base_url('/learn');
        $terms_link = base_url('termsandconditions');
    }else{
        $yes_chk = 'checked="checked"';
        $yes_selected = 'yes_selected';
        $home_link = isset($_GET['c2']) ? base_url($this->distributor_url).'?c2='.$_GET['c2'] : base_url($this->distributor_url);
        $terms_link = isset($_GET['c2']) ? base_url($this->distributor_url.'/termsandconditions').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/termsandconditions');
    }
    ?>
    <!--body content starts here-->
    <div class="top"><h1>Register Your Card</h1><br/><a href="<?php echo $home_link;?>">Home</a> <img src="<?php echo base_url();?>static/ricktag/images/arrow.gif" alt="next"> Register Your Card</div>
    <div class="joinnow"><img src="<?php echo base_url();?>static/ricktag/images/Ricktag-Register-Ur-Card-Banner.jpg"alt="join now"></div>
    <form action = "<?php echo current_url(); ?>"  method = "post" onsubmit="return Midas.register(this)">          
    <div class="registeryourcardformtop"> 
        <h3>Got a Ricktag Card in your wallet?</h3>
        <div class="line">LET US KNOW IF YOU'VE ALREADY PICKED UP A RICKTAG CARD FROM ONE OF OUR PARTNERS</div>
        <div class="wrapradio">
            <div class="no <?php echo $no_selected; ?>"><input type="radio" id="card_no" name="card" value="no" <?php echo $no_chk; ?>>No, not yet</div>
            <div class="yes <?php echo $yes_selected; ?>"><input type="radio" id="card_yes" name="card" value="yes" <?php echo $yes_chk; ?>>Yes, I've got one now</div>
        </div>
        <span style="margin-left:-55px;">Do you have a Ricktag Card now? </span>       
    </div>         
    <div class="clearfix"></div>
     <div class="registeryourcardform"> 
     <div class="display_crd" style=" <?php echo $display_crd; ?>">   
        Please Enter Your Ricktag Card Number 
        <input type = "text" name = "card_number" id = "card_number" value="<?php echo isset($_GET['c2']) ? $_GET['c2'] : ''; ?>" />
        <span class="_this">whats this?</span>
        <div class="this_pop_holder"><img class = "register_this_pop this_pop" src = "static/midas/images/what_this_img.png" alt = "" /></div>
    </div>
        <h3>Your Personal Info</h3>
        <div class="line">TELL US A LITTLE ABOUT YOURSELF </div>
        <div class="formalign">  

            <div class="reg_item_holder">Email</div>
            <input type = "text" name = "email" id = "email" value="" required/><br/>

            <?php /*Password 
            <input type="password" name="pwd" value=""required><br/>
            */ ?>

            <div class="reg_item_holder">Full Name </div>
            <input id="fullname" type="text" name="name" value="" required/><br/>

            <div class="reg_item_holder add_text">Address</div>
            <textarea class="register_textarea" name = "address" id = "address" required></textarea><br/>

            <div class="reg_item_holder">Postal Code </div>
            <input type = "text" name = "postal" id = "postal" value="" required/><br/>

            <div class="reg_item_holder">Date of Birth </div>
            <input type="text" name="dateofbirth" id="dateofbirth" placeholder="mm/dd/yyyy" value="" required>
            <span class="date_text">Why?</span>
            <img class="dob_register" src="<?php echo base_url();?>static/ricktag/images/dob.png" alt="next"> 

            <div class="clearfix"></div>
            <div class="reg_item_holder">City </div>
            <select name = "city" id = "city" required> 
                <option value="" selected>--Select closest city--</option>
                <?php foreach( $cities as $city ){ ?>
                    <option value="<?php echo $city->id; ?>"><?php echo $city->name; ?></option> 
                <?php } ?>
            </select>
            <br/>

            <div class="reg_item_holder">Gender </div>
            <input type="radio" name="gender" value="male" checked="checked">Male 
            <input type="radio" name="gender" value="female"> Female
            <br/>   
        </div>
        <p >          
        <input type="checkbox" name="offers" id="offers" value="1" checked="checked"/>Yes, I would like to receive exclusive offers, special promotions,<br/>
        and contest entries from Ricktag Rewards.</p>
        <p class="register_chk_box">  
        <input type="checkbox" name="terms" id="terms" value="1" checked="checked"/>Yes, I agree to the <a href = "<?php echo $terms_link; ?>" title = "Terms and Conditions">terms and conditions</a></p>
        </p>
        <div class="space"></div>
        <input type="submit" value="Register Now">
    </div>
     </form>
        
<!--body content ends here-->
    </div>  
</div>