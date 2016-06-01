<div id="news">
<fieldset>
<legend><strong>Copy Right List</strong></legend>
<?php
    //check for the success
    if($this->session->flashdata('msg'))
    {  
       echo $this->session->flashdata('msg');
    }
    ?>
<?php
if($isTRUE == FALSE){
?>
<input type="button" value="Add Copy Write" onclick="parent.location='<?=base_url()?>admin/home/addCopyRight'" />
<?php
}else{
    echo "&nbsp;";
}

?>
 
<div class="tab_container">
    <div id="tab1" class="tab_content">
     
    <strong>
    <table width="100%" cellpadding="0" cellspacing="0" class="tablesorter">
        <thead>
        <tr>
            <th>
                Name
            </th> 
            <th>
                Action
            </th>
        </tr>
        </thead>
    <tbody>
    <?php
      if($copy)
      {
      ?>
      <tr>
            <td>
               <?=$copy['name']?>
            </td>
            <td>
            
                <a href="<?=base_url()?>admin/home/updatecopy/<?=$copy['id']?>"> Update</a>
                <a onclick="" href="<?=base_url()?>admin/home/deletecopy/<?=$copy['id']?>"> Delete</a>
            </td>
      </tr>
      <?php
      }
      ?>
      </tbody>
    </table>
    </strong>
    </div>
    </div>
</fieldset>
</div>