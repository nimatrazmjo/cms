<div id="content_list">
<fieldset>
    <legend><strong>Content List</strong></legend>
    <input type="button" value="Add New Content" onclick="parent.location='<?=base_url()?>content/home/addRecords'">
     <?php
    //check for the success
    if($this->session->flashdata('msg'))
    {  
       echo $this->session->flashdata('msg');
    }
    ?> 
<table width="100%" cellpadding="0" cellspacing="0" class="tablesorter">
      <tr>
            <td>
                <?=$total?>
            </td>
            <td>
                <?=$links?>
            </td>
            
      </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" class="tablesorter">
<thead>
      <tr>
            <th>
                No
            </th>
            <th>
                tital
            </th>
            <th>
                Status
            </th>
            <th>
                Action
            </th>
            
            
      </tr>
  </thead>
  <tbody>
  <?php
  $i=$page;
  if($records)
  {
      if($records->num_rows()>0)
      {
          foreach($records->result() as $item): $i++;
  ?>
  <tr>
        <td>
        <?=$i?>
        </td>
        <td>
        <?=$item->title?>
        </td>
          <?php
                if($item->status == 'a')
                {
            ?>
            <td bgcolor="#0099FF">
               Active
            </td>
            <?php
                }else{
                    
            ?>
             <td bgcolor="#CCCC66">
                Not Active
            </td>
            <?php
                }  
            ?>
        <td>
             <a href="<?=base_url()?>content/home/updatecontent/<?=$item->id?>" ><input type="image" src="<?=base_url()?>images/icn_edit.png" title="Edit"></a>
             <a href="<?=base_url()?>content/home/readcontent/<?=$item->id?>" ><input type="image" src="<?=base_url()?>images/icn_edit.png" title="View"></a>
             <a href="<?=base_url()?>content/home/deletecontent/<?=$item->id?>" ><input type="image" src="<?=base_url()?>images/icn_trash.png" title="Delete"></td> </a>
        </td>
  </tr>
  <?php
  endforeach;
      }
  }
  ?>
  </tbody>
</table>
</fieldset>
</div>