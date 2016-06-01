<fieldset>
    <legend><strong>Add Link To each Menu</strong></legend>
    <?php
    $arr=array("name" =>"form_value","id" =>"form_value");
    echo form_open('menu/home/updateLink/'.$id,$arr);
    ?>
    <table ="tablesorter" cellspacing="0" width="100%">
         <tr>
            <td width="30%">
                 <strong> Menu Name  </strong>
            </td>          
            <td width="65%">
                 <select name="menu" id="menu">
                    <option value="">Select A Menu</option>
                    <?=$opt?>
                 </select> 
            </td>          
          </tr>
          <tr>
            <td>
                 <strong>Type Of Content Content </strong>
            </td>            
            <td>
                 <select name="menu_content" id="menu_content" onchange="javascript:bring_page('<?=base_url()?>menu/home/getTypeOfContent','menu_content','menu_id','content','&')">
                    <option value="">Select A Menu</option>                                                                                             
                  <?=$content?>
                 </select> 
            </td>          
        </tr>
        <tr>
        
            <td>
              <strong>Menu Link</strong> 
            </td>
             <td >
                 <div id="content">
                     <select name="lnk" id="lnk">
                        <option value=""> Select An Item </option>
                     </select>    
                 </div>
            </td>
        </tr>
        <tr>
        
            <td colspan="2" bgcolor="#cccccc">
              <input type="submit" value="Save">
              <input type="button" onclick="parent.location='<?=base_url()?>admin/home'" value="Cancel">
            </td>
        </tr>
        
    </table>
    <?=form_close();?>
</fieldset>
<script type="text/javascript">
</script>