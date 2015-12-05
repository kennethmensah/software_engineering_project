<html>
	<head>
		<title>Search For Tasks</title>
	</head>
	<body>
		<form action="search_district_task.php" method="GET">
		<div style='font-family:Georgia'>Search Text : <input type="text" name="st" size="30" >
		<input type="submit" value="search"></div>
</form>
<?php	
	
	$search_text=$_REQUEST['st'];
	 include("../model/district_task.php");
	  $obj = new district_task();
	  $result = $obj->search_task_by_name($search_text);
	  if ($result==false) {
        echo "Error querying for task :" . mysql_error();
        exit();
    } else {
        echo "Query Successful";
    }
	

	
	echo "<table border='1'>";
	echo "<tr style='background-color:olive; color:white; text-align:center'><td>Task Id</td><td>Title</td><td>Description</td><td>Clinics</td><td>Due Date</td></tr>";
	
	$style="";
	$i=0;
    $row= $obj->fetch($result);
	while($row){
		if($i%2==0){
			$style="style='background-color:Khaki'";
		}else{
			$style="";
		}
		
		echo "<tr $style >";
		echo "<td>{$row['task_id']}</td>";
		echo "<td>{$row['task_title']}</td>";
		echo "<td>{$row['task_desc']}</td>";
		echo "<td>{$row['clinics']}</td>";
		echo "<td>{$row['due_date']}</td>";
		echo "</tr>";
		$row= $obj->fetch($result);
		$i++;
	
}



	
?>
<a href = 'login.html' >go to login</a>
	</body>
</html>




