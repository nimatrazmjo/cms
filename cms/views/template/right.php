        <!-- Right Col Container-->
            <div class="right_col_container">
                
                <!--language-->
                <div class="language"><a href="#">Eng</a> | <a href="#">Dar</a> | <a href="#">Pas</a></div>
        <!-- Date &amp; Time Container-->
                <div class="date_time_contaienr">
                <div class="date"><?=date("F j, Y");?></div>
                <div class="time"><?=date('H:i');?></div>
                </div>
                
                <!-- DONATE Container-->
                <div class="donate_contaienr"><img src="<?=$imagePath?>" width="267px" height="115px" alt="DONATE"/></div>
                
                <!-- Latest News/Events Container-->
                  <div class="latest_ne_contaienr">
                
                    <div class="latest_ne_title">LATEST NEWS/EVENTS</div>
                    
                    <div class="news_container">
                        <marquee direction="up" height="200px" scrollamount="2" onmouseover="this.stop()" onmouseout="this.start()" >
                         <?=$news?>
                        </marquee>
                    <span style="float:right; padding:10px 0px 5px">
                        <a class="viewall" href="<?=base_url()?>cms/home/getAllNews">View All</a>
                    </span>
                        
                    </div>
                    
              </div>
                
                  <div style="clear:both; height:10px;"></div>
                
                <!-- Email Sign In Container-->
                
                
            </div>
            
        
      
                        