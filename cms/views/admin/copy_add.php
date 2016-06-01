<fieldset>
<legend><strong>Add Copy</strong></legend>
<div class="tab_container">
    <div id="tab1" class="tab_content">
    <?php
    $arr=array('id' => 'add_form', 'name' => 'add_form');
    echo form_open('admin/home/addCopyRight',$arr);
    ?>
    <strong>
    <table width="100%" cellpadding="0" cellspacing="0" class="tablesorter">
        <tr>
            <th>
                Name
            </th> 
            <th>
                <input type="text" name="name" id="name" size="30px" />
            </th>
            <th>
                <input type="submit" value="Save">
            </th>
        </tr>

    </table>
    </strong>
    <?php
    form_close();
    ?>
    </div>
    </div>
</fieldset>