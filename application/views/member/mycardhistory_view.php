<style>
  
	#main_context_content {
		margin-top: 0px !important;
		 margin-bottom: 20px;
	}
	
	#wrap-main{
		margin-top: 0px !important;
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
			<div id = "main_context_top">
				<div id = "m_top_left">
					<!--<ul>
						 
						<li><a href = "">My Special Offers </a></li>
						<li><a href = "">My Rewards Bucks</a></li>
						<li><a href = "">My Subscriptions</a></li>
						<li><a href = "">My Card History</a></li>
					</ul>-->
				</div>
				
				<!--<a href="<?php echo base_url().$this->distributor_url."/members/editaccount/"?>">Update Account Information</a>-->
			</div>
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
						
						<div id = "_cardhs_main_area">
							<div class = "cardhs_th">
								<ul>
									<li style="width: 65px; text-align:center;">Date</li>
									<li style="width: 225px;">Merchant</li>
									<li style="width: 180px; text-align:center">Special Offer</li>
									<li style="width: 125px; text-align:center">Purchased <br/>Amount</li>
									<li style="width: 125px; text-align:center">Rewards <br/>Bucks Used</li>
									<li style="width: 125px; text-align:center">Rewards <br/>Bucks Earned</li>
								</ul>
							</div>
							<div class = "cardhs_con">
								<ul>
									<?php foreach( $history as $row ): ?>
									<li>
										<p style = "width:65px; text-align:center;">
											<?php echo date('M d', strtotime($row->Date_Card_ID)); ?> <br/>
											<span><?php echo date('Y', strtotime($row->Date_Card_ID)); ?></span>&nbsp;
										</p>
										<p style="width: 225px;"><?php echo $row->company_name; ?>&nbsp;</p>
										<p style="width: 180px; text-align: center;"><?php echo $row->discount; ?>&nbsp;</p>
										<p style="text-align: center; width: 125px;"><?php echo ($row->Purchased_Amount>0)?'$'.number_format($row->Purchased_Amount, 2,'.',','):''; ?>&nbsp;</p>
										<p style="text-align: center; width: 125px;"><?php echo $row->Amount_Used; ?>&nbsp;</p>
										<p style="text-align: center; width: 125px;"><?php echo $row->Points; ?>&nbsp;</p>
										
									</li>
									<?php endforeach; ?>
									<!--<li>
										<p style = "width:65px; text-align:center;">
											Oct 3 <br/>
											<span>2012</span>
										</p>
										<p style="width: 225px;">Houston Avenue Bar & Grill</p>
										<p style="width: 180px; text-align: center;">$25</p>
										<p style="text-align: center; width: 125px;">$89.63</p>
										<p style="text-align: center; width: 125px;">460</p>
										<p style="text-align: center; width: 125px;">1870</p>
										
									</li>
									<li>
										<p style = "width:65px; text-align:center;">
											Oct 3 <br/>
											<span>2012</span>
										</p>
										<p style="width: 225px;">Houston Avenue Bar & Grill</p>
										<p style="width: 180px; text-align: center;">$25</p>
										<p style="text-align: center; width: 125px;">$89.63</p>
										<p style="text-align: center; width: 125px;">460</p>
										<p style="text-align: center; width: 125px;">1870</p>
										
									</li>
									<li>
										<p style = "width:65px; text-align:center;">
											Oct 3 <br/>
											<span>2012</span>
										</p>
										<p style="width: 225px;">Houston Avenue Bar & Grill</p>
										<p style="width: 180px; text-align: center;">$25</p>
										<p style="text-align: center; width: 125px;">$89.63</p>
										<p style="text-align: center; width: 125px;">460</p>
										<p style="text-align: center; width: 125px;">1870</p>
										
									</li>-->
								</ul>
							</div>
						</div>
			</div>
		</div>
		
		
	</div><!-- end of main-content-->
</div>
