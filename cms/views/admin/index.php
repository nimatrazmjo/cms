        
       
        <article class="module width_3_quarter">
        <header><h3 class="tabs_involved">Menu Manager</h3>
        </header>
            <?php
    //check for the success
    if($this->session->flashdata('msg'))
    {  
       echo $this->session->flashdata('msg');
    }
    ?> 
            
            <div id="tab2" class="tab_content">
            <div id="menuAjax">
            <input type="button" value="Add New Menu" onclick="parent.location='<?=base_url()?>menu/home/addMenu'">
            <table width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                        <td>
                            <?=$total?>
                        </td>
                        <td>
                            <?=$links?>
                        </td>
                        
                  </tr>
            </table>
            <table class="tablesorter" cellspacing="0"> 
            <thead> 
                <tr> 
                    
                    <th>id</th> 
                    <th>Name</th> 
                    <th>parent Name</th> 
                    <th>Actions</th> 
                </tr> 
            </thead> 
            <tbody> 
            <?php
                  if($records)
                  {
                      $i=$page;
                      if($records->num_rows()>0)
                      {
                          foreach($records->result() as $row):$i++;
                          
                  ?>  
                      <tr>
                            <td idth="29px"> 
                                <?=$i?>
                            </td>
                            <td width="180px">
                                <?=$row->label?>
                            </td>
                            <td width="180px">
                                <?=$this->cms_auth->getParentName($row->parent_id)?>
                            </td>
                            <td>
                                <a href="<?=base_url()?>menu/home/updateMenu/<?=$row->id?>" ><input type="image" src="<?=base_url()?>images/icn_edit.png" title="Edit"></a>
                                <a href="<?=base_url()?>menu/home/deleteMenu/<?=$row->id?>" ><input type="image" src="<?=base_url()?>images/icn_trash.png" title="Trash"></td> </a>
                            </td>
                            
                      </tr>
                   <?php
                  endforeach;
                      }
                  }
                  ?>
            </tbody> 
            </table>
            </div>
            </div><!-- end of #tab2 -->
            
        </div><!-- end of .tab_container -->
        
        </article><!-- end of content manager article -->
        
        <article class="module width_quarter">
            <header><h3>Logo picture</h3></header>
            <div class="message_list">
                <div class="module_content">
                      <?=$logo?>
                </div>
            </div>
           
        </article><!-- end of messages article -->
        
        <article class="module width_quarter">
            <header><h3>Banner picture</h3></header>
            <div class="message_list">
                <div class="module_content">
                   <?=$banner?> 
                </div>
            </div>
           
        </article><!-- end of messages article -->
        
        
        
        <div class="clear"></div>
        
        <article class="module width_full">
            <header><h3>Post New Article</h3></header>
            
            </footer>
        </article><!-- end of post new article -->
        
       
        <div class="spacer"></div>