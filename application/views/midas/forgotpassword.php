<style>
	#forgot_pass_form_area img{
		margin-bottom: -13px !important;
	}
</style>
<div id = "forgot_wrap">
	<div id = "forgotmain_content">
		
		<h2>Forgot your password?</h2>
		
		<div id = "forgotmain-context">
			<p class = "forgot_p">To reset your Ricktag password, please fill out the form below.<br />
			Be sure to use the same email that you signed up with.</p>
			
			<div id = "forgot_pass_form_area">
				<form action = "" method = "POST" onsubmit="return Midas.forgotpassword(this);">
					<p>
						<label>Email</label>
						<input type = "text" name = "text-email" />
					</p>
					<p>
						<label>Security Check</label>
						<input type = "text" name = "text-code" style = "width:160px;" placeholder = "enter code here" /> 
						<img src="<?php echo base_url().$this->distributor_url; ?>/captcha" title="Captcha" alt="Catcha" style="vertical-align: middle;margin-top:-20px;padding: 3px 1px;border: 1px solid #BCBCBC;border-radius: 4px 4px 4px 4px;box-shadow: 1px 1px 3px 0 rgba(0, 0, 0, 0.3);"/>
					</p>
					<p style = "margin-left:148px; margin-top:20px;">
						<input type="image" src="<?php echo base_url()?>static/member/images/submit.png" name="submit" onmouseout="this.src='<?php echo base_url()?>static/member/images/submit.png'" onmouseover="this.src='<?php echo base_url()?>static/member/images/submit1_hover.png'">
					</p>
				</form>
			</div>
		</div>
		
		
	</div>
</div><!-- end of forgot_wrap-->