<div class="container">
<div class="content">
<div id = "main_content">
	<h2>CONTACT US</h2>
	<div id = "content_main">
		<div id = "side_left">
			<form id="contactus_form" name="contactus_form" action="" method="contactus_form" onsubmit="return Midas.contactus_action(this);">
				<p>
					<label>First Name</label>
					<input type = "text" name = "fname" />
					<span class="req_fld">*Required fields</span>
				</p>
				<p>
					<label>Last Name</label>
					<input type = "text" name = "lname" />
					<span class="req_fld">*Required fields</span>
				</p>
				<p>
					<label>Email</label>
					<input type = "text" name = "email" />
					<span class="req_fld">*Required fields</span>
				</p>
				<p>
					<label>Phone Number</label>
					<input type = "text" name = "phone" style = "width:100px !important;" /><input type = "text" name = "phone" style = "width:150px !important; margin-left:10px" />
					<span class = "nmbr">(444)</span><span style = "margin-left:90px; !important">(444-4444)</span>
					
				</p>
				<p>
					<label>How we can help you?</label>
					<select name = "help">
						<option value="I am having trouble registering my card.">I am having trouble registering my card.</option>
						<option value="I would like to suggest a business.">I would like to suggest a business.</option>
						<option value="My card was lost or stolen, how do I get a replacement?">My card was lost or stolen, how do I get a replacement?</option>
						<option value="I would like to get a Ricktag Rewards card.">I would like to get a Ricktag Rewards card.</option>
						<option value="I would like to get my business featured on Ricktag.">I would like to get my business featured on Ricktag.</option>
	
					</select>
				</p>
				<p>
					<label>Message</label>
					<textarea name = "messages"></textarea>
				</p>
				<p class = "_sec">
					<label>Security Check</label>
					<input type = "text" name = "code" placeholder = "enter code here"/>
					<img src="<?php echo base_url(); ?>/welcome/captcha/?_t=<?php echo strtotime('now'); ?>" title="Captcha" alt="Catcha" style="vertical-align: middle;padding: 3px 1px;border: 1px solid #BCBCBC;border-radius: 4px 4px 4px 4px;box-shadow: 1px 1px 3px 0 rgba(0, 0, 0, 0.3);"/>
					 <span class="req_fld">*Required fields</span>
				</p>
				<p style = "margin-left:207px">
					<input type="image" src="<?php echo base_url();?>static/ricktag/images/send_btn.png" name="submit" onmouseout="this.src='<?php echo base_url();?>static/ricktag/images/send_btn.png'" onmouseover="this.src='<?php echo base_url();?>static/ricktag/images/send_btn_hover.png'">
				</p>
			</form>
		</div>
		
		<div id = "side_right">
			<div id = "right_box" class = "rbox">
				<h2>Need some help? <br />
				Talk to our experts:</h2>
				<p>Email Us:<br />
					<span><a href = "mailto:customerservice@ricktag.ca">customerservice@ricktag.ca</a></span>
				</p>
				
				<p>Call Us:<br />
					<span>1.800.560.4135</span>
				</p>
				
				<p>Monday-Friday::<br />
					<span>9am-5pm EST</span>
				</p>
			</div>
		</div>
	</div>
</div>
</div>
</div>