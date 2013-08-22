<!--<link rel="stylesheet" href="<?php echo base_url(); ?>static/css/common.css" />-->
<?php
    if(empty($this->distributor_url)){
        $forgot_link = base_url('/guest/forgot');
        $reg_link = isset($_GET['c2']) ? base_url('/guest/register').'?c2='.$_GET['c2'] : base_url('/guest/register');
    }else{
        $forgot_link = isset($_GET['c2']) ? base_url($this->distributor_url.'/forgot').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/forgot');
        $reg_link = isset($_GET['c2']) ? base_url($this->distributor_url.'/register').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/register');
    }
?>
<div id="popup_login">
    <div id="popup">
        <!--<a href="<?php echo isset($_GET['c2']) ? base_url($this->distributor_url).'?c2='.$_GET['c2'] : base_url($this->distributor_url); ?>#"><img class="close_button" src="<?php echo base_url();?>static/ricktag/images/close_button.png" alt="close button"/></a>-->
        <h3>Please Enter Your Ricktag<br/>Card Number To Check Out<br/>This Great Deal</h3>  
        <form class="login" name="loginform" action="<?php echo current_url(); ?>" method="post" onsubmit="return Midas.login(this);">
              <input type="text" class="input" name = "card2" value="<?php echo isset($_GET['c2']) ? $_GET['c2'] : ''; ?>" maxlength = "8" placeholder="enter number" tabindex="1" required />
              <input type = "password" class="input" name ="pwd" id="pwd" value = "" tabindex="2" placeholder="enter password" required /> 
              <a href="<?php echo $forgot_link; ?>">forgot password?</a> <input type="submit" id="submitbtn" value="Login">
        </form>

        <div id="popupleft">
        Have a card and not registered yet?<br/>
		    <a href="<?php echo $reg_link; ?>">Register a Card »</a>
        </div>
        <br/>
        <div id="popupleft">
        I dont have a card and not register yet?<br/>
        <a href="<?php echo base_url('getacard') ?>">Get a Card »</a>
        </div>
		<div id="popupleft" style="overflow:hidden">
			<div id="verasafescript" style="float:left; overflow:hidden">
			<script type="text/javascript" language="javascript" src="https://www.verasafe.com/trustseal/seal.js"></script>
			<input type="image" onclick="getInstantVerification('A9BC1F2F00E4978', 'https://www.verasafe.com/');" src="https://www.verasafe.com/images/seals/trust-seal-classic-170px-black-trans.png" alt="VeraSafe Trust Seal" /></div>						  
			<script>
				$("#sseal").html($("#siteseal").html());
			</script>
			<div id="sseal" style="margin-left:-10px">
			
			</div>			
		</div>  		
    </div>
</div>   