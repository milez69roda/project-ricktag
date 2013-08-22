<div id = "main_content">
	<div id = "nav_menu">
		<ul>
			 
			<a href="<?php echo $this->distributor_url; ?>/members/category/"><li id="menu_1" class = "<?php echo ($this->uri->segment(4)=='')?"current":"";  ?>"></li></a>
			<a href="<?php echo $this->distributor_url; ?>/members/category/1"><li id="menu_2" class = "<?php echo ($this->uri->segment(4)==1)?"current_2":"";  ?>"></li></a>
			<a href="<?php echo $this->distributor_url; ?>/members/category/2"><li id="menu_3" class = "<?php echo ($this->uri->segment(4)==2)?"current_3":"";  ?>"></li></a>
			<a href="<?php echo $this->distributor_url; ?>/members/category/3"><li id="menu_4" class = "<?php echo ($this->uri->segment(4)==3)?"current_4":"";  ?>"></li></a>
			<a href="<?php echo $this->distributor_url; ?>/members/category/4"><li id="menu_5" class = "<?php echo ($this->uri->segment(4)==4)?"current_5":"";  ?>"></li></a>
			<a href="<?php echo $this->distributor_url; ?>/members/category/5"><li id="menu_6" class = "<?php echo ($this->uri->segment(4)==5)?"current_6":"";  ?>"></li></a>
			<a href="<?php echo $this->distributor_url; ?>/members/category/6"><li id="menu_7" class = "<?php echo ($this->uri->segment(4)==6)?"current_7":"";  ?>"></li></a>
			<a href="<?php echo $this->distributor_url; ?>/members/category/7"><li id="menu_8" class = "<?php echo ($this->uri->segment(4)==7)?"current_8":"";  ?>"></li></a>
			<a href="<?php echo $this->distributor_url; ?>/members/category/8"><li id="menu_9" class = "<?php echo ($this->uri->segment(4)==8)?"current_9":"";  ?>"></li></a>
		</ul>
	</div>
	<h1>
	<?php 
		 
		if( ($this->uri->segment(4) == "") OR ($this->uri->segment(4)) == 0 ){
			echo 'Ricktag Featured Deals'; 
		}else{
			echo 'Ricktag '.$categories->name.' Deals';
		}
	?>
	 
	<span> in <?php echo $this->session->userdata("CUR_CITY")->name; ?></span></h1> 
	
	<div id = "list">
		<ul>
			<?php foreach($stores as $store):  
			
				$this->db->join("categories", "categories.category_id = store_category_link.category_id");
				$cat = $this->db->get_where("store_category_link", array("store_id"=>$store->id))->result();
				
				$cat_text = '';
				foreach($cat as $c){
					$cat_text .= $c->name.', ';
				}
					
			?>
			
			<li>
				<img width="275" height="165" src="<?php echo $store->small_banner; ?>" alt = "" />
				<div class = "list_info">
					<div class = "_info">
						<p style = "color:#fff; font-size:14px;"><?php echo $store->company_name; ?><p>
						<p style = "color:#83868d;"> <?php echo substr($cat_text,0,-2); ?><p>
					</div>
					<div class = "_info_price">
						<p style = "color:#fedf08; font-size:20px; margin-bottom:5px;"><?php echo $store->discount; ?><p>
						<p><a href="<?php echo base_url().$this->distributor_url.'/members/storesinfo/'.$store->id; ?>" class="fancybox fancybox.ajax"> <img src = "<?php echo base_url(); ?>static/member/images/vide_deal_btn.png" alt = "" /> </a><p>
					</div>
					<div class = "clear"></div>
				</div>
			</li>
			<?php endforeach; ?>
			<!--<li>
				<img src = "<?php echo base_url(); ?>static/member/images/img-2.png" alt = "" />
				<div class = "list_info">
					<div class = "_info">
						<p style = "color:#fff; font-size:14px;"> Sample Test<p>
						<p style = "color:#83868d;"> Category<p>
					</div>
					<div class = "_info_price">
						<p style = "color:#fedf08; font-size:20px; margin-bottom:5px;">$25<p>
						<p><img src = "<?php echo base_url(); ?>static/member/images/vide_deal_btn.png" alt = "" /><p>
					</div>
					<div class = "clear"></div>
				</div>
			</li>
			<li>
				<img src = "<?php echo base_url(); ?>static/member/images/img-3.png" alt = "" />
				<div class = "list_info">
					<div class = "_info">
						<p style = "color:#fff; font-size:14px;"> Sample Test<p>
						<p style = "color:#83868d;"> Category<p>
					</div>
					<div class = "_info_price">
						<p style = "color:#fedf08; font-size:20px; margin-bottom:5px;">$25<p>
						<p><img src = "<?php echo base_url(); ?>static/member/images/vide_deal_btn.png" alt = "" /><p>
					</div>
					<div class = "clear"></div>
				</div>
			</li>
			
			
			
			<li>
				<img src = "<?php echo base_url(); ?>static/member/images/img-1.png" alt = "" />
				<div class = "list_info">
					<div class = "_info">
						<p style = "color:#fff; font-size:14px;"> Sample Test<p>
						<p style = "color:#83868d;"> Category<p>
					</div>
					<div class = "_info_price">
						<p style = "color:#fedf08; font-size:20px; margin-bottom:5px;">$25<p>
						<p><img src = "<?php echo base_url(); ?>static/member/images/vide_deal_btn.png" alt = "" /><p>
					</div>
					<div class = "clear"></div>
				</div>
			</li>
			<li>
				<img src = "<?php echo base_url(); ?>static/member/images/img-2.png" alt = "" />
				<div class = "list_info">
					<div class = "_info">
						<p style = "color:#fff; font-size:14px;"> Sample Test<p>
						<p style = "color:#83868d;"> Category<p>
					</div>
					<div class = "_info_price">
						<p style = "color:#fedf08; font-size:20px; margin-bottom:5px;">$25<p>
						<p><img src = "<?php echo base_url(); ?>static/member/images/vide_deal_btn.png" alt = "" /><p>
					</div>
					<div class = "clear"></div>
				</div>
			</li>
			<li>
				<img src = "<?php echo base_url(); ?>static/member/images/img-3.png" alt = "" />
				<div class = "list_info">
					<div class = "_info">
						<p style = "color:#fff; font-size:14px;"> Sample Test<p>
						<p style = "color:#83868d;"> Category<p>
					</div>
					<div class = "_info_price">
						<p style = "color:#fedf08; font-size:20px; margin-bottom:5px;">$25<p>
						<p><img src = "<?php echo base_url(); ?>static/member/images/vide_deal_btn.png" alt = "" /><p>
					</div>
					<div class = "clear"></div>
				</div>
			</li>
			
			
				<li>
				<img src = "<?php echo base_url(); ?>static/member/images/img-1.png" alt = "" />
				<div class = "list_info">
					<div class = "_info">
						<p style = "color:#fff; font-size:14px;"> Sample Test<p>
						<p style = "color:#83868d;"> Category<p>
					</div>
					<div class = "_info_price">
						<p style = "color:#fedf08; font-size:20px; margin-bottom:5px;">$25<p>
						<p><img src = "<?php echo base_url(); ?>static/member/images/vide_deal_btn.png" alt = "" /><p>
					</div>
					<div class = "clear"></div>
				</div>
			</li>
			<li>
				<img src = "<?php echo base_url(); ?>static/member/images/img-2.png" alt = "" />
				<div class = "list_info">
					<div class = "_info">
						<p style = "color:#fff; font-size:14px;"> Sample Test<p>
						<p style = "color:#83868d;"> Category<p>
					</div>
					<div class = "_info_price">
						<p style = "color:#fedf08; font-size:20px; margin-bottom:5px;">$25<p>
						<p><img src = "<?php echo base_url(); ?>static/member/images/vide_deal_btn.png" alt = "" /><p>
					</div>
					<div class = "clear"></div>
				</div>
			</li>
			<li>
				<img src = "<?php echo base_url(); ?>static/member/images/img-3.png" alt = "" />
				<div class = "list_info">
					<div class = "_info">
						<p style = "color:#fff; font-size:14px;"> Sample Test<p>
						<p style = "color:#83868d;"> Category<p>
					</div>
					<div class = "_info_price">
						<p style = "color:#fedf08; font-size:20px; margin-bottom:5px;">$25<p>
						<p><img src = "<?php echo base_url(); ?>static/member/images/vide_deal_btn.png" alt = "" /><p>
					</div>
					<div class = "clear"></div>
				</div>
			</li>-->
		</ul>
	</div>
</div><!-- end of main-content-->


