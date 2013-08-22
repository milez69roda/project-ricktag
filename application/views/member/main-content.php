				<div id = "main_content">
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
						</ul>
					</div>
				</div>