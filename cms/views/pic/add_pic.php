<fieldset>
<legend><strong>Admin Panel Of The Website</strong></legend>
<?php
 $arr=array('id' => 'add_pic' , 'name' =>'add_pic');
 echo form_open_multipart('pic/home/addPicture',$arr);
?>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
        <td>
           I Mage Tyle
        </td>
        <td>
          <select name="pic_type" id="pic_type">
          <?=$pictures?>
          </select>
          <?=form_error('name')?>
        </td>
  </tr> 
  
  <tr>
        <td>
            Images
        </td>
        <td>
          <input type="file" id="image" name="image"  size="25" maxlength="20" value="<?=set_value('image')?>"/>
          <?=form_error('image')?>
        </td>
  </tr>
  <tr>
        <td colspan="2">
             <input type="button" value="Cancel" onclick="parent.location='<?=base_url()?>cms/home'"> 
             <input type="submit" value="Save" > 
        </td>
  </tr>
  
</table>
<?=form_close()?>
</fieldset>
