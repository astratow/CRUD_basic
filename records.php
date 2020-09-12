<?php
include 'connect-db.php';
function renderForm($first= '', $last= '', $error = '', $id = '')
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
      <p>ID: <?php echo $id; ?> </p>
    <?php } ?>

    <strong>First Name: *</strong> <input type="text" name="firstname" value="<?php echo $first; ?>"/>
      <br>
    <strong>Last Name: *</strong> <input type="text" name="lastname" value="<?php echo $last; ?>"/>
    <br>
    <p> * required</p>
    <br>
    <input type="submit" name="submit" value="Submit"/>
  </body>
</html>
<?php
}
if(isset($_GET['id'])){
  //editing existing record
  if(is_numeric($_GET['id']) && $_GET['id']>0)
  {
    //query database 2:45
	$id=$_GET['id'];
	if($stmt =$mysqli->prepare ("SELECT * FROM players WHERE id=?")){
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($id, $firstname, $lastname);
		$stmt->fetch();
		renderForm($firstname, $lastname, NULL, $id);
		$stmt->close();
	}else{
		echo "ERROR: could not prepare SQL statement";
	}
  }
  else{
    header("Location: view.php");
  }
  //renderForm(NULL, NULL, NULL, $_GET['id']);
}else{
  //create new record
  if(isset($_POST['submit'])){
    $firstname = htmlentities($_POST['firstname'], ENT_QUOTES);
    $lastname = htmlentities($_POST['lastname'], ENT_QUOTES);
    
    if($firstname == ''||$lastname =='')
    {
      $error = 'ERROR: Please fill in all required fields!';
      renderForm($firstname, $lastname, $error);
    }else{
      if($stmt=$mysqli->prepare("INSERT players (firstname, lastname) VALUES(?, ?)")){
        $stmt->bind_param("ss", $firstname, $lastname);
        $stmt->execute();
        $stmt->close();
      }else{
        echo "ERROR: Could not prepare SQL statement.";
      }
      header("Location: view.php");
    }

  }else{
    
    renderForm();
  }
  


}
$mysqli->close();
?>
