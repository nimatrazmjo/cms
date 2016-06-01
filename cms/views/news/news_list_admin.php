<div id="news">
<fieldset>
<legend><strong>Admin Panel Of The Website</strong></legend>
<input type="button" value="Add News" onclick="parent.location='<?=base_url()?>news/home/addNews'" />
<div class="tab_container">
    <div id="tab1" class="tab_content">
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
    <strong>
    <table width="100%" cellpadding="0" cellspacing="0" class="tablesorter">
        <thead>
        <tr>
            <th>
                No
            </th> 
            <th>
                Title
                
            </th>
            <th>
                Featured
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
            <td>
             <?=$item->featured==0 ?"Not Featured":"Featured";?>
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
            
                <a href="<?=base_url()?>news/home/updateNews/<?=$item->id?>"> Update</a>
                <a href="<?=base_url()?>news/home/readNews/<?=$item->id?>"> View</a>
                <a onclick="" href="<?=base_url()?>news/home/deletnews/<?=$item->id?>"> Delete</a>
            </td>
      </tr>
      <?php
      endforeach;
          }
      }
      ?>
      </tbody>
    </table>
    </strong>
    </div>
    </div>
</fieldset>
</div>