<?php
$arr= array('id' => 'menu_add','name' => 'menu_add'); 
echo form_open('menu/home/addMenu',$arr); 
?>
<table cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td>
            <strong>Parent Menu</strong>
        </td>
        <td>
            <select name="parent_menu" id="parent_menu">
                     <option value="">Select An Item</option>
                     <?=$menu?>
            </select>
        </td>
        
    </tr>
    <tr>
        <td>
            <strong>New Menu</strong>
        </td>
        <td>
            <input type="text" value="<?=set_value('name')?>" name="name" id="name"  size="26">
        </td>
     </tr>
     <tr>
        <td colspan="2">
              <input type="submit" value="Save">
        </td>
     </tr>

</table>
