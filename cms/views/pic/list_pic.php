<fieldset>
    <legend><strong>List Picture</strong></legend>
    <input type="button" value="Add Picture" onclick="parent.location='<?=base_url()?>pic/home/addPicture'" />
    <table class="tablesorter" cellspacing="0" cellpadding="0" width="100%">
    <tr>
         <td>
           
            <strong>Logo Images</strong>
             <br/>
             <?=$logo?>    
           
         </td>
         <td>
            <strong>Banner Images</strong>
             <br/>
                 <?=$banner?>    
         </td>
         <td>

            <strong>Right Side Images</strong>
            <br />
            <?=$rightSide?>    

         </td>
    </tr> 
    <tr>
        <td colspan="3">
          <h1><center><strong>Slide Images</strong></center></h1> 
        </td>
    </tr>
    <tr>
        <td colspan="3">
           <?=$slideshow?>    
        </td>
    </tr>
    
    </tbody>      
  </table>
</fieldset>