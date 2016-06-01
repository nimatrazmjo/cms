<div id="artical">
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
        <th>
            No
        </th>
        <th>
            Description
        </th>
  </tr>
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
         <div class="summary_search">
                <a href="<?=base_url()?>cms/home/readNews/<?=$item->id?>">
                   <span class="search_summary_title">
                        <?=$i?>.
             <?=substr($item->desc,0,60)?>...<br />
            <?=$item->registerdate?>
                   </span>
                   <span class="summary_breif">
                       <?//=substr($item->description,0,160)?>...<br />
                        <?//=$item->registerdate?>
                    </span>
                </a>
          </div>
        </td>
  </tr>
  <?php
  endforeach;
      }
  }
  ?>
</table>
</div>