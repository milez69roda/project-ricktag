<div class="container">
    <div class="content">
    <?php
    if(empty($this->distributor_url)){
        $home_link = base_url('checkoutdeals');
    }else{
        $home_link = isset($_GET['c2']) ? base_url($this->distributor_url.'/checkoutdeals').'?c2='.$_GET['c2'] : base_url($this->distributor_url.'/checkoutdeals');
    }
    ?>
    <!--body content starts here-->
    <div id = "top_left">   
        <select name = "city" id = "city" required> 
            <option value="" selected></option>
            <?php foreach( $cities as $city ){ ?>
                <option value="<?php echo $city->id; ?>"><?php echo $city->name; ?></option> 
            <?php } ?>
        </select>
    </div>
    <div id = "nav_menu">
        <ul>
            <a href="/members/category/"><li id="menu_1" class = "<?php echo ($this->uri->segment(4)=='')?"current_1":"";  ?>"></li></a>
            <a href="/members/category/1"><li id="menu_2" class = "<?php echo ($this->uri->segment(4)==1)?"current_2":"";  ?>"></li></a>
            <a href="/members/category/2"><li id="menu_3" class = "<?php echo ($this->uri->segment(4)==2)?"current_3":"";  ?>"></li></a>
            <a href="/members/category/3"><li id="menu_4" class = "<?php echo ($this->uri->segment(4)==3)?"current_4":"";  ?>"></li></a>
            <a href="/members/category/4"><li id="menu_5" class = "<?php echo ($this->uri->segment(4)==4)?"current_5":"";  ?>"></li></a>
            <a href="/members/category/5"><li id="menu_6" class = "<?php echo ($this->uri->segment(4)==5)?"current_6":"";  ?>"></li></a>
            <a href="/members/category/6"><li id="menu_7" class = "<?php echo ($this->uri->segment(4)==6)?"current_7":"";  ?>"></li></a>
            <a href="/members/category/7"><li id="menu_8" class = "<?php echo ($this->uri->segment(4)==7)?"current_8":"";  ?>"></li></a>
            <a href="/members/category/8"><li id="menu_9" class = "<?php echo ($this->uri->segment(4)==8)?"current_9":"";  ?>"></li></a>

        </ul>
    </div>
    <div class="clearfix"></div>
    <div id = "details_section">
        <div id = "details_section_left">
        <h1>
            <?php 
                if( ($this->uri->segment(4) == "") OR ($this->uri->segment(4)) == 0 ){
                    echo 'Ricktag Featured Deals'; 
                }else{
                    echo 'Ricktag '.$categories->name.' Deals';
                }
            ?>
        </h1>   
        </div>
        <div id = "details_section_right">
            <ul>
                <a href = "/members/category/"><li id = "list_deals" class = "current"></li></a>
                <a href = "/members/map"> <li id = "map_deals" class = "<?php echo ($this->uri->segment(3)=='map')?"cur_2":"";  ?>"></li></a>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>

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
                            <p><a href="#" class="fancybox fancybox.ajax"> <img src = "<?php echo base_url(); ?>static/member/images/vide_deal_btn.png" alt = "" /> </a><p>
                        </div>
                        <div class = "clear"></div>
                    </div>
                </li>
                <?php endforeach; ?> 
            </ul>
        </div>
    </div>
    <!--body content ends here-->
    </div>  
</div>