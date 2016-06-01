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
<table width="100%" cellpadding="0" cellspacing="0">
      <tr>
            <th width="29px">
                id
            </th>
            <th width="180px">
                 Name
            </th>
            <th width="180px">
                parent Name
            </th>
            <th colspan="2">
                    operation
            </th>
      </tr>
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
                <a href="<?=base_url()?>menu/home/updateMenu/<?=$row->id?>" >Update </a>
                <a href="<?=base_url()?>menu/home/deleteMenu/<?=$row->id?>" >Delete </a>
            </td>
            
      </tr>
      <?php
      endforeach;
          }
      }
      ?>
</table>

</div>