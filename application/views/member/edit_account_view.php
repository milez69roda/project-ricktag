<script tytpe="text/javascript">
	$(document).ready(function(){
		/* $("#ppbday").datepicker({
					dateFormat:"yy-mm-dd",
					changeMonth: true,
					changeYear: true
		}); */
	});
</script>

<style>
	#form1 input{
		border: 1px inset #CCCCCC !important;
	}
</style>

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
				<!--<div id = "m_top_right">
					<p>Member Since: 04/12/11</p>
					<p>Ricktag Card Number: 10016549</p>
					<a href = "<?php //echo base_url().$this->distributor_url?>/members"><p class = "_rick_home_button"></p></a>
				</div>
				<div class = "clear"></div>-->
			</div>
			<div id = "main_context_content">
				<?php 
					$new = '';
					if( $info->CREATE_DATE == $info->MODIFY_DATE ){
						$new = 'style="border: 1px solid red !important;"';
					}
				
				?>
				<form id="form1" action = "" method = "POST" onsubmit="return Member.updateAccount(this);">
				<div id = "main_con_sideleft">
					<div id = "personal_info_area">
						<h2>Personal Information</h2>
						<div id = "personal_info">
							<p>
								<label>Choose A Password</label>
								<input type = "password" name = "ppwd" value = "" <?php echo $new; ?> /> <br/>
								<span style="color:red">Note:Leave blank if your not updating password</span>		
							</p>
							<p>
								<label>Birthday</label>
								<input type = "text" name = "ppbday" id = "ppbday" value = "<?php echo date("m/d/Y", strtotime($info->BIRTHDAY) ); ?>" <?php echo $new; ?> placeholder="mm/dd/yyyy" /> <span style="color:orange">mm/dd/yyyy</span>
							</p>
							<p>
								<label>Name</label>
								<input type = "text" name = "ppname" value = "<?php echo $info->FIRSTNAME ?>" />  
							</p>
							<p>
								<label>Email</label>
								<input type = "text" name = "ppemail"  value = "<?php echo $info->EMAIL ?>" /> 
							</p>
							<p>
								<label>Preferred Deal City</label> 
								<?php echo form_dropdown('ppcity', $cities, $info->CITY_ID); ?>
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
								<input type = "text" name = "ppaddress" value = "<?php echo $info->STREET_UNIT ?>" <?php echo $new; ?>/>  
							</p>
							<p>
								<label>Postal Code</label>
								<input type = "text" name = "pppostal" value = "<?php echo $info->POSTAL_CODE ?>" <?php echo $new; ?>/>
							</p>
						</div>
					</div>
					<div id = "sideright_box2" class = "r_box">
						<h2>Email Notifications</h2>
						<?php
							
						 
							if( count($notify) == 0 ){
								$notify  = (object)'1';
								$notify->joined 	= 1;
								$notify->offers 	= 1;
								$notify->sponsors 	= 1;
								$notify->bdaygift 	= 1;
							}
						
						?>
						<div class = "rbox">
							<p style = "color:#878686; float:left;">Unless you click "no", we will notify you when</p>
							<ul>
								<li>
									A new exciting business has joined Ricktag
									<p>
									
									<?php  echo form_radio('joined', '1', ($notify->joined==1)?TRUE:FALSE); ?>Yes
									<?php  echo form_radio('joined', '0', ($notify->joined==0)?TRUE:FALSE); ?>No
									
									</p>
								</li>
								<li>
									Exclusive Midas & Partner saving offers
									<p>
									<!--<input type="radio" name="offers" value="1">Yes <input type="radio" name="offers" value="0">No-->
									<?php  echo form_radio('offers', '1', ($notify->offers==1)?TRUE:FALSE); ?>Yes
									<?php  echo form_radio('offers', '0', ($notify->offers==0)?TRUE:FALSE); ?>No									
									</p>
								</li>
								<li>
									A free gift offer from our sponsors
									<p>
									<!--<input type="radio" name="sponsors" value="1">Yes <input type="radio" name="sponsors" value="0">No-->
									<?php  echo form_radio('sponsors', '1', ($notify->sponsors==1)?TRUE:FALSE); ?>Yes
									<?php  echo form_radio('sponsors', '0', ($notify->sponsors==0)?TRUE:FALSE); ?>No											
									</p>
								</li>
								<li>
								A free gift on your birthday
									<p>
									<!--<input type="radio" name="birthdaygift" value="1">Yes <input type="radio" name="birthdaygift" value="0">No-->
									<?php  echo form_radio('bdaygift', '1', ($notify->bdaygift==1)?TRUE:FALSE); ?>Yes
									<?php  echo form_radio('bdaygift', '0', ($notify->bdaygift==0)?TRUE:FALSE); ?>No											
									</p>
								</li>
								
							</ul>
							
						</div>
						<p style = "float:right; margin-top:20px;"><input type="image" src="<?php echo base_url();?>static/member/images/save_btn.png" name="submit" onmouseout="this.src='<?php echo base_url();?>static/member/images/save_btn.png'" onmouseover="this.src='<?php echo base_url();?>static/member/images/save_btn_hover.png'"></p>
					</div>
					
				</div>
				</form>
			</div>
		</div>
		
		
	</div><!-- end of main-content-->
</div>

