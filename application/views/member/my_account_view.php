

<script type="text/javascript">
	
	$(document).ready(function(){

		$("#newPassV").focus();
		 
		Member.step1(<?php echo $info->ispasschanged ?>); 
		 
	});

		
</script>

<style>

	.ui-widget-header {
		background: none !important;
		border: none !important;

	}	

	
	.activeEdit{
		border: 1px solid #ccc !important;
		padding: 5px;
	}
	
	.changepassword_btn{
		text-decoration: none; 
		border: 1px #666666 solid;
		padding: 3px;	
		background: #FF6600; /* Old browsers */
		background: -moz-linear-gradient(top,  #feccb1 0%, #f17432 50%, #ea5507 51%, #fb955e 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#feccb1), color-stop(50%,#f17432), color-stop(51%,#ea5507), color-stop(100%,#fb955e)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  #feccb1 0%,#f17432 50%,#ea5507 51%,#fb955e 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  #feccb1 0%,#f17432 50%,#ea5507 51%,#fb955e 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  #feccb1 0%,#f17432 50%,#ea5507 51%,#fb955e 100%); /* IE10+ */
		background: linear-gradient(to bottom,  #feccb1 0%,#f17432 50%,#ea5507 51%,#fb955e 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#feccb1', endColorstr='#FF6600',GradientType=0 ); /* IE6-9 */

	}
	
	#main_context_content {
		margin-top: 0px !important;
		 margin-bottom: 20px;
	}
	
	#wrap-main{
		margin-top: 0px !important;
	}
	
	#newPassV:focus, #renewpassV:focus{
		border: 2px #FD590D solid !important
	}
	
	<!if chrome>
		._top_sec2 span {
			margin-top:-30px;
		}
	<![endif]>	
 
</style>

<div id = "wrap1">
	<div id = "main_content">
		  
		<div id = "main-context">
			<!--<div id = "main_context_top">
				<div id = "m_top_left">
					<ul>
						 
						<li><a href = "">My Special Offers </a></li>
						<li><a href = "">My Rewards Bucks</a></li>
						<li><a href = "">My Subscriptions</a></li>
						<li><a href = "">My Card History</a></li>
					</ul>
				</div>
				 
			</div>-->
			<div id = "main_context_content">
				<div id = "_top-c">
							<div class = "_top_sec1">
								<ul>
									<li><a href = "<?php echo $this->distributor_url ?>/members/myaccount">My Account</a></li>
									<li><a href = "<?php echo $this->distributor_url ?>/members/mycardhistory">My Card History</a></li>
								</ul>
							</div>
							<div class = "_top_sec2">
								<p>
									Reward <br/> Bucks Used
									<span><?php echo ($rewardused->Amount_Used == '')?0:$rewardused->Amount_Used ; ?></span>
								</p>
								<p>
									Reward <br/> Bucks Balance
									<span><?php echo $info->card_balance; ?></span>
								</p>
							</div>
						</div>
				</div>					
				<form action = "" method = "POST">
				<div id = "main_con_sideleft">
					<div id = "personal_info_area">
						<h2>Personal Information</h2>
						<div id = "personal_info">
							<p id="newPass" <?php echo (!$info->ispasschanged)?'style="display:none"':''; ?> >
								<label>Change Password</label>
								<input type="password" name="asdf" id="asdf" value = "xxxxxx" style="" />
								<a href="javascript:void(0)"><span onclick="javascript:Member.updateAccountInfo(this,'NEWPASS','Choose A Password');">Edit</span></a>
							</p>
							
							<p id="newPass1" <?php echo ($info->ispasschanged)?'style="display:none"':''; ?> >
								<label style="text-decoration: underline !important">Change Password</label>
								<!--<input type="password" name="current_password" id="current_password" value = "xxxxxx" class="activeEdit" />	-->
								<br/>								
								<label>New Password (6-12 Characters long)</label>
								<input type="password" name="newPassV" id="newPassV" value = "" class="activeEdit" style="" />  
								<br/>
								<label>Re-type New Password</label>
								<input type="password" name="renewpassV" id="renewpassV" value = "" class="activeEdit" />  
								<br />	<br />
								<!--<a href="javascript:Member.updateAccountInfo(this,'PASSWORD','Choose A Password')" style="color: #FD590D; font-size: 14px; font-weight: bold; margin-top: 30px; text-decoration:none">Change Password</a>-->	
								<a href="javascript:void(0)" class="changepassword_btn" >
									<span onclick="javascript:Member.updateAccountInfo(this,'PASSWORD','Choose A Password');" style="float:none; color:#fff">Save Password</span>
								</a>
								<br clear="both" />
							</p>
							
							<p>
								<label>Birthday <em>(mm/dd/yyyy)</em></label>
								<input type="text" name="BIRTHDAY" id="BIRTHDAY"  value="<?php echo date("m/d/Y", strtotime($info->BIRTHDAY) ); ?>" style=" "/> 
								<a href="javascript:void(0)"><span onclick="javascript:Member.updateAccountInfo(this,'BIRTHDAY','Birthday');">Edit</span></a>
							</p>
							<p>
								<label>Name</label>
								<input type = "text" name="FIRSTNAME" id="FIRSTNAME"  value = "<?php echo $info->FIRSTNAME ?>" style=""/> 
								<a href="javascript:void(0)"><span onclick="javascript:Member.updateAccountInfo(this,'FIRSTNAME','Name');">Edit</span></a>
							</p>
							<p>
								<label>Email</label>
								<input type = "text" name="EMAIL" id="EMAIL"   value = "<?php echo $info->EMAIL ?>" style=""/>  
								<a href="javascript:void(0)"><span onclick="javascript:Member.updateAccountInfo(this,'EMAIL','Email');">Edit</span></a>
							</p>
							<p>
								<label>Preferred Deal City</label>
								<input type = "text" name="ppcity" id="ppcity"  value = "<?php echo $info->city_name; ?>" style=""/>  
								<?php echo form_dropdown('CITY_ID', $cities,  $info->CITY_ID, " id='CITY_ID' style='display:none'"); ?>
								<a href="javascript:void(0)"><span onclick="javascript:Member.updateAccountInfo(this,'CITY_ID','Preferred Deal City');">Edit</span></a>
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
								<input type = "text" name="STREET_UNIT" id="STREET_UNIT"  value = "<?php echo $info->STREET_UNIT ?>" style=""/> 
								<a href="javascript:void(0)"><span onclick="javascript:Member.updateAccountInfo(this,'STREET_UNIT','Address');">Edit</span></a>
							</p>
							<p>
								<label>Postal Code</label>
								<input type = "text" name="POSTAL_CODE" id="POSTAL_CODE"  value = "<?php echo $info->POSTAL_CODE ?>" style=""/> 
								<a href="javascript:void(0)"><span onclick="javascript:Member.updateAccountInfo(this,'POSTAL_CODE','Postal Code');">Edit</span></a>
							</p>
						</div>
					</div>
					<div id = "sideright_box2" class = "r_box">
						<h2>Email Notifications</h2>
						<?php 
							/* if( count($notify) == 0 ){
								$notify  = (object)'1';
								$info->joined 	= 1;
								$info->offers 	= 1;
								$info->sponsors 	= 1;
								$info->bdaygift 	= 1;
							}  */
						?>						
						<div class = "rbox">
							<p style = "color:#878686; float:left;">Unless you click "no", we will notify you when</p>
							<ul>
								<li>
									New saveing offers from Ricktag.ca<!--A new exciting business has joined Ricktag-->
									<p>
									 
									<?php  echo form_radio('joined', '1', ($info->joined==1)?TRUE:FALSE, ' onclick="Member.updateAccountNot(this)"'); ?>Yes
									<?php  echo form_radio('joined', '0', ($info->joined==0)?TRUE:FALSE, ' onclick="Member.updateAccountNot(this)"'); ?>No
									
									</p>
								</li>
								<li>
									Monthly points balance update.<!--Exclusive <?php echo ($this->distributor_url == 'midas')?'Midas &':''; ?> Partner saving offers-->
									<p>
									 
									<?php  echo form_radio('offers', '1', ($info->offers==1)?TRUE:FALSE, ' onclick="Member.updateAccountNot(this)"'); ?>Yes
									<?php  echo form_radio('offers', '0', ($info->offers==0)?TRUE:FALSE, ' onclick="Member.updateAccountNot(this)"'); ?>No									
									</p>
								</li>
								<li>
									A free gift offer from our sponsors
									<p>
									 
									<?php  echo form_radio('sponsors', '1', ($info->sponsors==1)?TRUE:FALSE, ' onclick="Member.updateAccountNot(this)"'); ?>Yes
									<?php  echo form_radio('sponsors', '0', ($info->sponsors==0)?TRUE:FALSE, ' onclick="Member.updateAccountNot(this)"'); ?>No											
									</p>
								</li>
								<li>
								A free gift on your birthday
									<p>
									 
									<?php  echo form_radio('bdaygift', '1', ($info->bdaygift==1)?TRUE:FALSE, ' onclick="Member.updateAccountNot(this)"'); ?>Yes
									<?php  echo form_radio('bdaygift', '0', ($info->bdaygift==0)?TRUE:FALSE, ' onclick="Member.updateAccountNot(this)"'); ?>No											
									</p>
								</li>
								
							</ul>
							
						</div>
						<!--<p style = "float:right; margin-top:20px;"><input type="image" src="<?php echo base_url();?>static/member/images/save_btn.png" name="submit" onmouseout="this.src='<?php echo base_url();?>static/member/images/save_btn.png'" onmouseover="this.src='<?php echo base_url();?>static/member/images/save_btn_hover.png'"></p>-->
					</div>
 
				</div>
				<style>
					.preferences span{
						float: left;
						padding: 6px;
						width: 180px;
						font-size: 14px;
						font-weight: bold;
					}
					 
				</style>
				<div class="r_box" style="border: 1px solid #DADADA; border-radius: 5px 5px 5px 5px;padding: 10px; width: 89%;">
					<h2>Preferences</h2>
					<p style="color:#878686; border-bottom: 1px solid #DADADA; ">Help us understand what you like to save money on by selecting the options below.</p>
					<div class="preferences">
						<span><input type="checkbox" name="pre_auto" id="pre_auto" <?php echo ($info->pre_auto)?'checked':''; ?> onclick="Member.updateAccountPreferences(this)"/> <label for="pre_auto">Auto</label></span>
						<span><input type="checkbox" name="pre_golf" id="pre_golf" <?php echo ($info->pre_golf)?'checked':''; ?> onclick="Member.updateAccountPreferences(this)"/> <label for="pre_golf">Golf</label></span>
						<span><input type="checkbox" name="pre_pet_supplies_food" id="pre_pet_supplies_food" <?php echo ($info->pre_pet_supplies_food)?'checked':''; ?> onclick="Member.updateAccountPreferences(this)"/> <label for="pre_pet_supplies_food">Pet Supplies & Food</label></span>
						<span><input type="checkbox" name="pre_travel_leisure" id="pre_travel_leisure" <?php echo ($info->pre_travel_leisure)?'checked':''; ?> onclick="Member.updateAccountPreferences(this)"/> <label for="pre_travel_leisure">Travel and Leisure</label></span>
						<br style="clear:both"/>
						<span><input type="checkbox" name="pre_family_fun" id="pre_family_fun" <?php echo ($info->pre_family_fun)?'checked':''; ?> onclick="Member.updateAccountPreferences(this)"/> <label for="pre_family_fun">Family Fun</label></span>
						<span><input type="checkbox" name="pre_health_beauty" id="pre_health_beauty" <?php echo ($info->pre_health_beauty)?'checked':''; ?> onclick="Member.updateAccountPreferences(this)"/> <label for="pre_health_beauty">Health & Beauty</label></span>
						<span><input type="checkbox" name="pre_services" id="pre_services" <?php echo ($info->pre_services)?'checked':''; ?> onclick="Member.updateAccountPreferences(this)"/> <label for="pre_services">Services</label></span>
						<br style="clear:both"/>
						<span><input type="checkbox" name="pre_food_dining" id="pre_food_dining" <?php echo ($info->pre_food_dining)?'checked':''; ?> onclick="Member.updateAccountPreferences(this)"/> <label for="pre_food_dining">Food and dining</label></span>
						<span><input type="checkbox" name="pre_home_garden" id="pre_home_garden" <?php echo ($info->pre_home_garden)?'checked':''; ?> onclick="Member.updateAccountPreferences(this)"/> <label for="pre_home_garden">Home and Garden</label></span>
						<span><input type="checkbox" name="pre_shopping" id="pre_shopping" <?php echo ($info->pre_shopping)?'checked':''; ?> onclick="Member.updateAccountPreferences(this)"/> <label for="pre_shopping">Shopping</label></span>
					</div>
				</div>
				
				</form>
			</div>
		</div>

	 
		<div id="step1" style="display:none" style=""> 
			<div style="width:220px; height:130px;">				 
				<p style="text-align:left">  
					Please choose a password that is 6-12 charcters long. Use this password each time you login to  your account 
				</p>
				<p style="text-align:center"> <a href="javascript:Member.step2()" style="">Next >></a> </p>
			</div>
		</div>
		
		 
		<div id="step2" style="display:none" style=""> 
			<div style="width:330px; height:260px;  "> 
				<p style="text-align:left">  
					Make Sure we have all the correct information here. Just click on the Edit button to make any changes.<br /><br />
					Why do we ask for  your Brithday? Your birthday could be used as a security question and we also want to make sure that we send you a cool gift on that big day.<br /><br />
					It is best address and not your school or work one. This way we will always have an updated email for you.
				</p>
				<p style="text-align:center"> <a href="javascript:Member.step3()" style="">Next >></a> </p>
			</div>
		</div>	
		
		 
		<div id="step3" style="display:none" style=""> 
			<div style="width:330px; height:150px;  "> 
				<p style="text-align:left">  
					This information is completely optional, but helps us understand where we can add more stores close to where  you live. <br />
					And don't worry we never share you information we promise. <a href="termsandconditions#privacypolicy">Privacy Policy</a>
				</p>
				<p style="text-align:center"> <a href="javascript:Member.step4()" style="">Next >></a> </p>
			</div>
		</div>	

		<div id="step4" style="display:none" style=""> 
			<div style="width:330px; height:160px;  "> 
				<p style="text-align:left">  
					Choose your email preferences here. <br />
					We used email to keep you up to date on the new saving offers, your points balances, even free gift offers.<br />
					Don't worry we won't spam you inbox with emails. You will only receive up to 4 a month
				</p> 
			</div>
		</div>	
		
	</div><!-- end of main-content-->
</div>
