<div class="container">
	<div class="content">
        <?php
        if(empty($this->distributor_url)){
            $get_link = base_url('guest/register');
            $home_link = base_url('/learn');
        }else{
            $get_link = isset($_GET['c2']) ? base_url($this->distributor_url.'/register').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/register');
            $home_link = isset($_GET['c2']) ? base_url($this->distributor_url).'?c2='.$_GET['c2'] : base_url($this->distributor_url);
        }
        ?>
    <div class="topright content_text">Pick up your Free Ricktag Card at one of the following locations<br/>or send us a request and we will mail you one</div>
    <div class="topleft" style="height:35px;"> Get A Card</div>
    <div class="topleft_secondary"><a href="<?php echo $home_link; ?>">Home</a> <img src="<?php echo base_url();?>static/ricktag/images/arrow.gif" alt="next"> Get A Card</div>

             <div class="giftcardsrightcontent">  
  
             <div class="freecardcontentbox1">
                
                <div class="ordercards get_a_card_order"><h2>Midas<sup><span style="font-size:12px;">&reg;</span></sup> Rewards & More<br/>
    				Card Plus Earn 5%</h2>
                 <p class="_location">Multiple locations <img class="arrw" src="<?php echo base_url();?>static/ricktag/images/drop_don_icon.png" alt="arrow"></p>

                 <ul class="gift_card_locations">
                    <li><u>Barrie</u></li>
                    <li>221 Mapleview Dr.West</li>
                    <li>(705) 722-7576</li>
                    <li>341 Yonge St.</li>
                    <li>(705) 722-3113</li>
                    <li>&nbsp;</li>
                    <li><u>Bradford</u></li>
                    <li>303 Holland St. West</li>
                    <li>(095) 775-3442</li>
                    <li>&nbsp;</li>
                    <li><u>Newmarket</u></li>
                    <li>1095 Ringwell Dr.</li>
                    <li>(095) 830-9920</li>
                    <li>&nbsp;</li>
                    <li><u>Pickering</u></li>
                    <li>1650 Kingston Rd.</li>
                    <li>(095) 686-3707</li>
                </ul>
                 <p class="free_card_link_holder"><a href="<?php echo $get_link; ?>" class="free_card_link hover">Request A Free Card »</a></p>
                 </div>
                 </div>
                 <div class="freecardcontentbox2">
                 <div class="ordercards get_a_card_order"><h2>Newmarket Infiniti Nissan<br/>
    				Friends with Benefits</h2>
                 <p>17385 Leslie Street, Newmarket, ON <br/>(866) 980-9412</p>
                 <p class="free_card_link_holder"><a href="<?php echo $get_link; ?>" class="free_card_link hover">Request A Free Card »</a></p>
                 </div>
                 </div>
                 <div class="freecardcontentbox3">
                 <div class="ordercards get_a_card_order"><h2>NewRoads<br/>
    				Advantage Card</h2>
                 <p>18100 Yonge Street, Newmarket, <br/>ON (877) 273-1380</p>
                 <p class="free_card_link_holder"><a href="<?php echo $get_link; ?>" class="free_card_link hover">Request A Free Card »</a></p>
                 </div>
                 </div>
                 <div class="freecardcontentbox4">
                 <div class="ordercards"><h2>Century 21 B.J. Roth<br/>
    				Igor Vujovic Card</h2> 
                 <p>888 Innisfil Beach Road, Innisfil, <br/> ON (888) 712-9994</p>
                 <p class="free_card_link_holder"><a href="<?php echo $get_link; ?>" class="free_card_link hover">Request A Free Card »</a></p>
                 </div>
                 </div>
   			 </div>
             
             <div class="giftcardsleftcontent">                  
                 <div class="ordernow"><a href="//ricktagworks.ca/get-quote"><div class="ordernowbtn"></div></a></div>
             </div>

<div class="clearfix"></div>
   
   </div>  
</div>