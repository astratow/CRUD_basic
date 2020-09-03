<?php

function renderForm($first = '', $last = '', $error = '', $id = '')
{?>
<html lang="en">
  <head>
    <title>
      <?php if($id !='') {echo "Edit Record";}else{echo "New Record";} ?>
    </title>
    <meta charset="UTF-8"/>
  </head>
  <body>
    <h1><?php if($id !='') {echo "Edit Record";}else{echo "New Record";} ?>
</h1> 
    <?php if($error != ''){
      echo "<div style='padding:4px; border=1px solid red; color:red'>" . $error . "</div>";  
}?>
  <form action="" method="post">
  <div>
    <?php if($id !=''){?>
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <p>ID <?php echo $id; ?> </p>
    <?php } ?>

    <strong>First Name: *</strong> <input type="text" name="fistrname" value="<?php echo $first; ?>"/>
    <strong>Last Name: *</strong> <input type="text" name="lastname" value="<?php echo $last; ?>"/>
    <p? * required</p>
    <input type="submit" name="submit" value="Submit"/>
  </body>
</html>
<?php
}
if(isset($_GET['id'])){
  renderForm(NULL, NULL, NULL, $_GET['id']);
}else{
  //create new record
  if(isset($_POST)){
    echo "Form submitted";
  }else{
  renderForm();
  }
  


}

?>
