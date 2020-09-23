<!DOCTYPE html>
<html>
  <head>
    <title>View Records</title>
    <meta http-equip="Content-Type" content="text/html" charset="UTF-8">
  </head>
  <body>
    
    <h1>View Records</h1>
    
    <?php
      
      include('connect-db.php');

      $per_page = 3;
	  if($result = $mysqli->query('SELECT*FROM players ORDER BY id')){
		  if($result->num_rows!=0){
			  $total_results=$result->num_rows;
			  $total_pages=ceil($total_results/$per_page);
			  if(isset($_GET['page'])&&is_numeric($_GET['page'])){
				  $show_page=$_GET['page'];
				  
				  if($show_page>0&&$show_page<=$total_pages){
					  
					  $start=($show_page<=$total_pages);
					  $end=$start+$per_page;
				  }else{
						$start=0;
						$end=$per_page;
				  }
			  }else{
				  $start=0;
				  $end=$per_page;
			  }
			  
			  //display pagination
			  echo "<p><a href='view.php'>View All</a> | <b>View Page: </b>";
			  for($i=1; $i<=$total_pages; $i++){
				  if(isset($_GET['page'])&&$_GET['page']==$i){
					  echo $i . " ";
				  }else{
					  echo "<a href='view-paginated.php?page=$i'>" . $i . "</a>";
				  }
			  }
			  echo "</p>";
			  //display records table
			  echo "<table border='1' cellpadding='10'";
			  echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th></th><th></th><th></th></tr>";
			  
			  for($i=$start; $i<$end;$i++){
				  if($i==$total_results){
					  break;
					  }
					  
					$result->data_seek($i);
					$row=$result->fetch_row();
					
					echo "<tr>";
					echo "<td>". $row[0]."</td>";
					echo "<td>". $row[1]."</td>";
					echo "<td>". $row[2]."</td>";
					echo "<td><a href='edit.php?id='".$row[0]."'>Edit</a></td>";
					echo "<td><a href='delete.php?id='".$row[0]."'>Delete</a></td>";
					echo "</tr>";
			  }

			  
			  echo "</table>";
		  }else{
			  echo "No results to display";
		  }
	  }else{
		  echo "ERROR: ".$mysqli->error;
	  }
      
      $mysqli->close();

    ?>
    <a href="records.php">Add New Record</a>
  </body>
</html>
