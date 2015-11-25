<!DOCTYPE HTML>
<html>
    <head>
        <title></title>
        <link type="text/css" rel="stylesheet" href="../assets/css/materialize.min.css"  media="screen,projection"/>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="version_2/assets/js/materialize.min.js"></script>
    </head>
    <body>
        <script type="text/javascript" src="../assets/js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="../assets/js/materialize.js"></script>
        <nav class="teal lighten-2">
            <div class="nav-wrapper" class="teal lighten-2">
                <a href="#" class="brand-logo">Task Management</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="view_district_tasks.php" onclick="">View District Tasks</a></li>
                    <li><a href="">Assign Tasks</a></li>
                </ul>
            </div>
        </nav>
        
        <?php
        
        include_once '../model/adb.php';
        include_once '../model/supervisor.php';
        $obj=new supervisors();
        $obj->view_admin_tasks();
        
        if(!$row=$obj->fetch()){
            echo"there are no tasks currently";
        }
        
        echo "<table>";
            echo "<thead>";
            echo "<tr>";
              echo "<th data-field='id'>Task ID</th>";
              echo "<th data-field='task_title'>Task Subject</th>";
              echo "<th data-field='task_desc'>Task Description</th>";
              echo "<th data-field='clinic'>Clinics</th>";
              echo "<th data-field='due_date'>Due Date</th>";
            echo "</tr>";
            echo "</thead>";
        
        while($row){
            echo "<tbody>";
            echo "<tr>";
                echo "<td>{$row["task_id"]}</td>";
                echo "<td>{$row["task_title"]}</td>";
                echo "<td>{$row["task_desc"]}</td>";
                echo "<td>{$row["clinics"]}</td>";
                echo "<td>{$row["due_date"]}</td>";
            echo "</tr>";
            echo "</tbody>";
                
            $row=$obj->fetch();
        }
        echo "</table>";
        ?>
<!--
			include("supervisor.php");
				 
			$obj=new supervisor();
			// 	if(!$obj->display_task()){
			// 		echo " Error displaying".mysql_error(); 
			// 	}
			// 	else{
			// 		echo " displaying";
			// 	}	
			$obj->view_admin_tasks();
			if(!$row=$obj->fetch()){
				echo"there are no tasks currently";
			}
			echo"<table border='2'>";
            echo"<tr><td>TASK ID</td><td>TASK NAME</td><td>TASK DESCRIPTION</td><td>START DATE</td>
                 <td>END DATE</td><td>LOCATION</td></tr>";
            while($row) {
                  echo "<tr><td>{$row["task_id"]}</td><td><a href=tasksdisplayselected.php?id=".$row["task_name"].">{$row["task_name"]}</td>";
                  echo"<td>{$row["task_description"]}</td><td>{$row["start_date"]}</td>
                  <td>{$row["end_date"]}</td><td>{$row["location"]}</td>";
                  $row=$obj->fetch();
            }
            echo"</table>";
		?>
-->
    </body>
</html>