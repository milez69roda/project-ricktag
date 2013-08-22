

<script type="text/javascript">
	$(document).ready(function(){
		$("#ppbday").datepicker({"dateFormat":"yy-mm-dd"});
	});
</script>

<div id = "wrap1">
	<div id = "main_content">
		
		
		
		<div id = "main-context">
			<div id = "main_context_top">
				<div id = "m_top_left">
					<ul>
						<li><a href = "">My Special Offers </a></li>
						<li><a href = "">My Rewards Bucks</a></li>
						<li><a href = "">My Subscriptions</a></li>
						<li><a href = "">My Card History</a></li>
					</ul>
				</div>
				
				<a href="<?php echo base_url().$this->distributor_url."/members/editaccount/"?>">Update Account Information</a>
			</div>
			<div id = "main_context_content">
				
				<form action = "" method = "POST">
				<div id = "main_con_sideleft">
					<div id = "personal_info_area">
						<h2>Personal Information</h2>
						<div id = "personal_info">
							<!--<p>
								<label>Choose A Password</label>
								<input type = "password" name = "ppwd" value = "xxxxxx" style="border: medium none !important" />  
							</p>-->
							<p>
								<label>Birthday</label>
								<input type = "text" name = "ppbday" readonly="readonly" value = "<?php echo date("m/d/Y", strtotime($info->BIRTHDAY) ); ?>" style="border: medium none !important"/> 
							</p>
							<p>
								<label>Name</label>
								<input type = "text" name = "ppname" readonly="readonly" value = "<?php echo $info->FIRSTNAME ?>" style="border: medium none !important"/> 
							</p>
							<p>
								<label>Email</label>
								<input type = "text" name = "ppemail"  readonly="readonly" value = "<?php echo $info->EMAIL ?>" style="border: medium none !important"/>  
							</p>
							<p>
								<label>Preferred Deal City</label>
								<input type = "text" name = "ppcity" readonly="readonly" value = "<?php echo $info->city_name ?>" style="border: medium none !important"/>  
							</p>
						</div>
					</div>
				</div>
				<div id = "main_con_sideright"> 
					<div id = "sideright_box1" class = "r_box">
						<h2>Your Address</h2>
						<div class = "rbox">
							<p>
								<label>Address</label>
								<input type = "text" name = "ppaddress" readonly="readonly" value = "<?php echo $info->STREET_UNIT ?>" style="border: medium none !important"/> 
							</p>
							<p>
								<label>Postal Code</label>
								<input type = "text" name = "pppostal" readonly="readonly" value = "<?php echo $info->POSTAL_CODE ?>" style="border: medium none !important"/> 
							</p>
						</div>
					</div>
					<div id = "sideright_box2" class = "r_box">
						<h2>Email Notifications</h2>
						<div class = "rbox">
							<!--<p style = "color:#878686; float:left;">Unless you click "no", we will notify you when</p>-->
							<ul>
								<li>
									A new exciting business has joined Ricktag
									 
									<p><?php echo ($notify->joined)?"Yes":"No"; ?></p>
								</li>
								<li>
									Exclusive Midas & Partner saving offers
									 
									<p><?php echo ($notify->offers)?"Yes":"No"; ?></p>
								</li>
								<li>
									A free gift offer from our sponsors
									 
									<p><?php echo ($notify->sponsors)?"Yes":"No"; ?></p>
								</li>
								<li>
								A free gift on your birthday
									 
									<p><?php echo ($notify->bdaygift)?"Yes":"No"; ?></p>
								</li>
								
							</ul>
							
						</div>
						<!--<p style = "float:right; margin-top:20px;"><input type="image" src="<?php echo base_url();?>static/member/images/save_btn.png" name="submit" onmouseout="this.src='<?php echo base_url();?>static/member/images/save_btn.png'" onmouseover="this.src='<?php echo base_url();?>static/member/images/save_btn_hover.png'"></p>-->
					</div>
					
				</div>
				</form>
			</div>
		</div>
		
		
	</div><!-- end of main-content-->
</div>

