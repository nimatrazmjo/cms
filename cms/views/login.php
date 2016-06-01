<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard Admin Login Page</title>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/styles.css" />

</head>

<body>
 <div id="main">
<div id="carbonForm">
	<h1>Sign in</h1>
     <?php
          if($this->session->flashdata('msg'))
          {
             echo $this->session->flashdata('msg');
          }
        ?>
  <?php
  $arr=array("name" => "login_form","id" => "login_form");
  echo form_open("home",$arr);
    ?>
    <div class="fieldContainer">

        <div class="formRow">
            <div class="label">
                <label for="name">Name:</label>
            </div>
            <div class="field">
                <input type="text" name="name" id="name" />
            </div>
             <?=form_error("name")?>
        </div>
        <div class="formRow">
            <div class="label">
                <label for="pass">Password:</label>
            </div>
            
            <div class="field">
                <input type="password" name="pass" id="pass" />
            </div>
            <?=form_error("pass")?>
        </div>
        
        
    </div> <!-- Closing fieldContainer -->
    
    <div class="signupButton">
        <input type="submit" name="submit" id="submit" />
    </div>
</form>
       
</div>
</div>
</body>
</html>
