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