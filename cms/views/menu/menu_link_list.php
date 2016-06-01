<div id="menuAjax1">
<?php
//$menu==FALSE ? echo "" : "&nbsp;" ;
?>
<input type="button" value="Add Menu Link" onclick="parent.location='<?=base_url()?>menu/home/menuLink'">                                                                                                                                 
 <?php
//check for the success
if($this->session->flashdata('msg'))
{  
   echo $this->session->flashdata('msg');
}
?> 
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
        <th>Menu Name</th> 
        <th>Link</th> 
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
                    <?=$row->link?>
                </td>
                <td>
                 <?php
                    if(!empty($row->link))
                    {
                    ?>
                    <a href="<?=base_url()?>menu/home/updateLink/<?=$row->id?>" ><input type="image" src="<?=base_url()?>images/icn_edit.png" title="Edit"></a>
                   
                    <a href="<?=base_url()?>menu/home/deleteLink/<?=$row->id?>" ><input type="image" src="<?=base_url()?>images/icn_trash.png" title="Trash"></td> </a>
                    <?php
                    }
                    else
                    {
                        echo "&nbsp;";
                    }
                    ?>
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
