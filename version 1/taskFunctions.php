<?php
session_start();
$isadmin = $_SESSION['admin'];
$user_id = $_SESSION['id'];
$cmd=$_REQUEST['cmd'];
switch($cmd)
{
	case 1:
        session_start();
        if( isset($_REQUEST['task']) && 
                isset($_SESSION['user'])){
            include_once('tasks.php');
            
            if($_SESSION['admin'] == 1){
                $nurse = intval($_REQUEST['nurse']);
            }else{
                $nurse = intval($_SESSION['id']);
            }
            
            $task = $_REQUEST['task'];
            $task .="";
            $isadmin = intval($_SESSION['admin']);
            $priority = intval($_REQUEST['priority']);
            $due_date= $_REQUEST['d_date'];
            $due_date.="";
            $obj3 = new tasks();
            
            $assigned_by = intval($_SESSION['id']);
            
            if(!$obj3->add_task($task, $nurse, $assigned_by,
                    $isadmin, $priority, $due_date)){
                echo '<div id="divStatus" class="error">
                            Could Not Add Task <span class="ti-face-sad" ></span>
                    </div>';
            }
            else{
                echo '<div id="divStatus" class="success">
						New Task Added <span class="ti-face-smile" ></span>
					</div> ';
            }
                
        }
        break;
        case 2:
            if(isset( $_REQUEST["id"])){
                include_once('tasks.php');
                $id = intval($_REQUEST['id']);

                $obj = new tasks();
                if(!$obj->delete_task($id)){
                    echo '<div id="divStatus" class="error">
                        Could Not Delete <span class="ti-face-sad" ></span></div>';

                }
                else {
                    echo '<div id="divStatus" class="success">
                        Delete Successful <span class="ti-face-smile" ></span></div> ';

                }
            }
            break;
        case 3:
            session_start();
            if(isset($_SESSION['user'])){
                $user = $_SESSION['user'];
                $user_id = $_SESSION['id'];
                $isadmin = $_SESSION['admin'];
                $fname = $_SESSION['fname'];
                $sname = $_SESSION['sname'];
        }
        if(isset($_REQUEST['st']) && isset($_REQUEST['sf']) ){
                    include_once('tasks.php');
                    $obj1 = new tasks();


                    $search_text = $_REQUEST['st'];
                    $search_filter = intval($_REQUEST['sf']);


                    if ($search_filter == 1 && $isadmin == 1){
                            $obj1->search_tasks($search_text);
                    }else{
                        $obj1->search_tasks($search_text,$user_id);
                    }     
                    $row = $obj1->fetch();       
                    $tid = $row['task_id'];

                    if($tid != 0){

                        echo '<div id="divContent">';
                        echo '<table id="tableExample" class="reportTable">';
                        echo "<tr><th>Task</th><th>Assigned To </th>
                                <th>Task Status </th><th> </th></tr>";
                        $i = 0;
                        while($row){
                            $fn = $row['nurse_fname'];
                            $sn = $row['nurse_sname'];
                            $description = $row['description'];
                            $task_status = $row['task_status'];
                            $nid = $row['nurse_id'];
                            

                            if(($i%2) == 0){
                                if($task_status == 'not started'){
                                echo "<tr class='row1 not_started'>";
                            }elseif ($task_status == 'ongoing') {
                                echo "<tr class='row1 ongoing'>";
                            }
                            else{
                                echo "<tr class='row1 finished'>";
                            }
                            echo "<td><span onclick=viewTask($tid)>
                                {$description}</span></td>
                                <td>{$fn} {$sn}</td>
                                <td>{$task_status}</td>
                                <td class='modify'>
                                <span class='ti-pencil' onclick=update($tid)></span> 
                                <span class='ti-close' onclick=deleteTask($tid)></span>
                                </td></tr>";
                            }
                            else{
                                if($task_status == 'not started'){
                                echo "<tr class='row2 not_started'>";
                            }elseif ($task_status == 'ongoing') {
                                echo "<tr class='row2 ongoing'>";
                            }
                            else{
                                echo "<tr class='row2 finished'>";
                            }
                             echo "<td><span onclick=viewTask($tid)>
                                {$description}</span></td>
                                <td>{$fn} {$sn}</td>
                                <td>{$task_status}</td>
                                <td class='modify'>
                                <span class='ti-pencil' onclick=update($tid)></span> 
                                <span class='ti-close' onclick=deleteTask($tid)></span>
                                </td></tr>";
                            }
                            $row = $obj1->fetch();
                            $i++;
                        }
                        echo "</table>";
                        echo '</div>';
                    }else{
                        echo 'No tasks found';
                    }

                }
        case 4:
            if(isset($_REQUEST['q'])){
                include_once('tasks.php');
                $obj = new tasks();
                
                $sort = intval($_REQUEST['q']);
              if($isadmin == 1){
                if($sort == 1){
                    $obj->sortByDueDate();
                }elseif ($sort == 2) {
                    $obj->sortByPriority();
                }
              }elseif($isadmin == 0){
                if($sort == 1){
                    $obj->sortByDueDate2($user_id);
                }elseif ($sort == 2) {
                    $obj->sortByPriority2($user_id);
                }
              } 
                $row = $obj->fetch();
                $tid = $row['task_id'];
                
                if($tid != 0){
                echo '<div id="divContent">';
                        echo '<table id="tableExample" class="reportTable">';
                        echo "<tr><th>Task</th><th>Assigned To </th><th>Due Date</th>
                                <th>Priority</th><th>Task Status </th><th> </th></tr>";
                        $i = 0;
                        while($row){
                            $fn = $row['nurse_fname'];
                            $sn = $row['nurse_sname'];
                            $description = $row['description'];
                            $task_status = $row['task_status'];
                            $due_date = $row['due_date'];
                            $priority = $row['priority'];
                            $nid = $row['nurse_id'];
                            

                            if(($i%2) == 0){
                                if($task_status == 'not started'){
                                echo "<tr class='row1 not_started'>";
                            }elseif ($task_status == 'ongoing') {
                                echo "<tr class='row1 ongoing'>";
                            }
                            else{
                                echo "<tr class='row1 finished'>";
                            }
                            echo "<td><span onclick=viewTask($tid)>
                                {$description}</span></td>
                                <td>{$fn} {$sn}</td>
                                <td>{$due_date}</td>
                                <td>{$priority}</td>
                                <td>{$task_status}</td>
                                <td class='modify'>
                                <span class='ti-pencil' onclick=update($tid)></span> 
                                <span class='ti-close' onclick=deleteTask($tid)></span>
                                </td></tr>";
                            }
                            else{
                                if($task_status == 'not started'){
                                echo "<tr class='row2 not_started'>";
                            }elseif ($task_status == 'ongoing') {
                                echo "<tr class='row2 ongoing'>";
                            }
                            else{
                                echo "<tr class='row2 finished'>";
                            }
                             echo "<td><span onclick=viewTask($tid)>
                                {$description}</span></td>
                                <td>{$fn} {$sn}</td>
                                <td>{$due_date}</td>
                                <td>{$priority}</td>
                                <td>{$task_status}</td>
                                <td class='modify'>
                                <span class='ti-pencil' onclick=update($tid)></span> 
                                <span class='ti-close' onclick=deleteTask($tid)></span>
                                </td></tr>";
                            }
                            $row = $obj->fetch();
                            $tid = $row['task_id'];
                            $i++;
                        }
                        echo "</table>";
                        echo '</div>';
                }else{
                    echo 'No tasks yet';
                }
            }
            break;
        case 5:
            if(isset($_REQUEST['st'])){
                include_once('tasks.php');
                session_start();
                $isadmin = $_SESSION['admin'];
                $user_id = $_SESSION['id'];
                
                $obj = new tasks();
                
                $date = $_REQUEST['st'];
                $date.="";
                
                
                if($isadmin){
                $obj->get_task_by_date($date);
                }
                else{
                    $obj->get_task_by_date_id($date,$user_id);
                }
                $row = $obj->fetch();
                $tid = $row['task_id'];
                
                if($tid == 0){
                    echo '<div>No Tasks for today</div>';
                }
                else{
                    if($isadmin){
                        echo '<div id="divContent">';
                        echo '<table id="tableExample" class="reportTable">';
                        echo "<tr><th>Task</th><th>Assigned To</th>
                                <th>Priority</th><th>Task Status </th></tr>";
                        $i = 0;
                        while($row){
                            $fn = $row['nurse_fname'];
                            $sn = $row['nurse_sname'];
                            $description = $row['description'];
                            $task_status = $row['task_status'];
                            $priority = $row['priority'];
                            $nid = $row['nurse_id'];
                            

                            if(($i%2) == 0){
                                if($task_status == 'not started'){
                                echo "<tr class='row1 not_started'>";
                            }elseif ($task_status == 'ongoing') {
                                echo "<tr class='row1 ongoing'>";
                            }
                            else{
                                echo "<tr class='row1 finished'>";
                            }
                            echo "<td><span onclick=viewTask($tid)>
                                {$description}</span></td>
                                <td>{$fn} {$sn}</a></td>
                                <td>{$priority}</td>
                                <td>{$task_status}</td>";
                                if($task_status == 'not started'){
                                echo  "<td class='modify'>
                                <span class='ti-plug' onclick=start($tid)>Start</span> 
                                <span class='ti-check' onclick=complete($tid)>Complete</span>
                                </td></tr>";
                                }elseif ($task_status == 'ongoing') {
                                echo "<td class='modify'>
                                    <span class='ti-check' onclick=complete($tid)>Complete</span>
                                </td></tr>";
                            }
                                
                            }
                            else{
                                if($task_status == 'not started'){
                                echo "<tr class='row2 not_started'>";
                            }elseif ($task_status == 'ongoing') {
                                echo "<tr class='row2 ongoing'>";
                            }
                            else{
                                echo "<tr class='row2 finished'>";
                            }
                             echo "<td><span onclick=viewTask($tid)>
                                {$description}</span></td>
                                 <td>{$fn} {$sn}</a></td>
                                <td>{$priority}</td>
                                <td>{$task_status}</td>";
                                if($task_status == 'not started'){
                                echo  "<td class='modify'>
                                <span class='ti-plug' onclick=start($tid)>Start</span> 
                                <span class='ti-check' onclick=complete($tid)>Complete</span>
                                </td></tr>";
                                }elseif ($task_status == 'ongoing') {
                                echo "<td class='modify'>
                                    <span class='ti-check' onclick=complete($tid)>Complete</span>
                                </td></tr>";
                            }
                            }
                            $row = $obj->fetch();
                            $i++;
                        }
                        echo "</table>";
                        echo '</div>';
                    }else{
                echo '<div id="divContent">';
                        echo '<table id="tableExample" class="reportTable">';
                        echo "<tr><th>Task</th>
                                <th>Priority</th><th>Task Status </th></tr>";
                        $i = 0;
                        while($row){
                            $description = $row['description'];
                            $task_status = $row['task_status'];
                            $priority = $row['priority'];
                            $nid = $row['nurse_id'];
                            $tid = $row['task_id'];
                            

                            if(($i%2) == 0){
                                if($task_status == 'not started'){
                                echo "<tr class='row1 not_started'>";
                            }elseif ($task_status == 'ongoing') {
                                echo "<tr class='row1 ongoing'>";
                            }
                            else{
                                echo "<tr class='row1 finished'>";
                            }
                            echo "<td><span onclick=viewTask($tid)>
                                {$description}</span></td>
                                <td>{$priority}</td>
                                <td>{$task_status}</td>";
                                if($task_status == 'not started'){
                                echo  "<td class='modify'>
                                <span class='ti-plug' onclick=start($tid)>Start</span> 
                                <span class='ti-check' onclick=complete($tid)>Complete</span>
                                </td></tr>";
                                }elseif ($task_status == 'ongoing') {
                                echo "<td class='modify'>
                                    <span class='ti-check' onclick=complete($tid)>Complete</span>
                                </td></tr>";
                            }
                            }
                            else{
                                if($task_status == 'not started'){
                                echo "<tr class='row2 not_started'>";
                            }elseif ($task_status == 'ongoing') {
                                echo "<tr class='row2 ongoing'>";
                            }
                            else{
                                echo "<tr class='row2 finished'>";
                            }
                             echo "<tr class='row2'><td><span onclick=viewTask($tid)>
                                {$description}</span></td>
                                <td>{$priority}</td>
                                <td>{$task_status}</td>";
                                if($task_status == 'not started'){
                                echo  "<td class='modify'>
                                <span class='ti-plug' onclick=start($tid)>Start</span> 
                                <span class='ti-check' onclick=complete($tid)>Complete</span>
                                </td></tr>";
                                }elseif ($task_status == 'ongoing') {
                                echo "<td class='modify'>
                                    <span class='ti-check' onclick=complete($tid)>Complete</span>
                                </td></tr>";
                            }
                            }
                            $row = $obj->fetch();
                            $i++;
                        }
                        echo "</table>";
                        echo '</div>';
                }
                }
            }
            break;
        case 6:
            if(isset($_REQUEST['id'])){
            include_once('tasks.php');
                    $obj1 = new tasks();
                    $tid = intval($_REQUEST['id']);
                    
                    $obj1->get_task($tid);
                    
                    echo '<div id="divContent">';
                        echo '<table id="tableExample" class="reportTable">';
                        echo "<tr><th>Task</th><th>Assigned To </th>
                                <th>Task Status </th><th> </th></tr>";
                        $i = 0;
                        $row = $obj1->fetch();
                            $fn = $row['nurse_fname'];
                            $sn = $row['nurse_sname'];
                            $description = $row['description'];
                            $task_status = $row['task_status'];
                            $nid = $row['nurse_id'];
                            $tid = $row['task_id'];
                            
                            if($task_status == 'not started'){
                                echo "<tr class='row1 not_started'>";
                            }elseif ($task_status == 'ongoing') {
                                echo "<tr class='row1 ongoing'>";
                            }
                            else{
                                echo "<tr class='row1 finished'>";
                            }
                           
                            echo "<td><span onclick=viewTask($tid)>
                                {$description}</span></td>
                                <td>{$fn} {$sn}</td>
                                <td>{$task_status}</td>";
                                if($task_status == 'not started'){
                                echo  "<td class='modify'>
                                <span class='ti-plug' onclick=start($tid)>Start</span> 
                                <span class='ti-check' onclick=complete($tid)>Complete</span>
                                </td></tr>";
                                }elseif ($task_status == 'ongoing') {
                                echo "<td class='modify'>
                                    <span class='ti-check' onclick=complete($tid)>Complete</span>
                                </td></tr>";
                            }
                        
                        echo "</table>";
                        echo '</div>';
            }
            break;
        case 7:
            if(isset($_REQUEST['id'])){
            include_once('tasks.php');
                    $obj1 = new tasks();
                    $tid = intval($_REQUEST['id']);
                    
                    $obj1->start_task($tid);
                    
                    echo '<div id="divStatus" class="success">
                        Task Started <span class="ti-stats-up" ></span></div> ';
                    
            }
            break;
        case 8:
            if(isset($_REQUEST['id'])){
            include_once('tasks.php');
                    $obj1 = new tasks();
                    $tid = intval($_REQUEST['id']);
                    
                    $obj1->finish_task($tid);
                    
                    echo '<div id="divStatus" class="success">
                        Task Completed <span class="ti-check-box" ></span></div> ';
                    
            }
            break;
        case 9:
            if(isset($_REQUEST['st'])){
                include_once('tasks.php');
                session_start();
               
                
                $obj = new tasks();
                
                $status= $_REQUEST['st'];
                $status.="";
                
                
                if($isadmin){
                $obj->get_task_by_status($status);
                }
                else{
                    $obj->get_task_by_status_id($status,$user_id);
                }
                $row = $obj->fetch();
                $tid = $row['task_id'];
                if($tid == 0 ){
                    echo '<div>No Tasks </div>';
                }
                else{
                    if($isadmin){
                        echo '<div id="divContent">';
                        echo '<table id="tableExample" class="reportTable">';
                        echo "<tr><th>Task</th><th>Assigned To</th>
                                <th>Priority</th><th>Task Status </th>
                                <th>Due Date</th></tr>";
                        $i = 0;
                        while($row){
                            $fn = $row['nurse_fname'];
                            $sn = $row['nurse_sname'];
                            $description = $row['description'];
                            $task_status = $row['task_status'];
                            $priority = $row['priority'];
                            $nid = $row['nurse_id'];
                            
                            $due = $row['due_date'];

                            if(($i%2) == 0){
                                if($task_status == 'not started'){
                                echo "<tr class='row1 not_started'>";
                            }elseif ($task_status == 'ongoing') {
                                echo "<tr class='row1 ongoing'>";
                            }
                            else{
                                echo "<tr class='row1 finished'>";
                            }
                            echo "<td><span onclick=viewTask($tid)>
                                {$description}</span></td>
                                <td>{$fn} {$sn}</a></td>
                                <td>{$priority}</td>
                                <td>{$task_status}</td>
                                <td>{$due}</td>";
                                if($task_status == 'not started'){
                                echo  "<td class='modify'>
                                <span class='ti-plug' onclick=start($tid)></span> 
                                <span class='ti-check' onclick=complete($tid)></span>
                                </td></tr>";
                                }elseif ($task_status == 'ongoing') {
                                echo "<td class='modify'>
                                    <span class='ti-check' onclick=complete($tid)></span>
                                </td></tr>";
                                }
                            }
                            else{
                                if($task_status == 'not started'){
                                echo "<tr class='row2 not_started'>";
                            }elseif ($task_status == 'ongoing') {
                                echo "<tr class='row2 ongoing'>";
                            }
                            else{
                                echo "<tr class='row2 finished'>";
                            }
                             echo "<td><span onclick=viewTask($tid)>
                                {$description}</span></td>
                                 <td>{$fn} {$sn}</a></td>
                                <td>{$priority}</td>
                                <td>{$task_status}</td>
                                <td>{$due}</td>";
                                if($task_status == 'not started'){
                                echo  "<td class='modify'>
                                <span class='ti-plug' onclick=start($tid)></span> 
                                <span class='ti-check'onclick=complete($tid)></span>
                                </td></tr>";
                                }elseif ($task_status == 'ongoing') {
                                echo "<td class='modify'>
                                    <span class='ti-check' onclick=complete($tid)></span>
                                </td></tr>";
                                }
                            }
                            $row = $obj->fetch();
                            $tid = $row['task_id'];
                            $i++;
                        }
                        echo "</table>";
                        echo '</div>';
                    }
                    else{
                echo '<div id="divContent">';
                        echo '<table id="tableExample" class="reportTable">';
                        echo "<tr><th>Task</th>
                                <th>Priority</th><th>Task Status </th>
                                <th>Due</th></tr>";
                        $i = 0;
                        while($row){
                            $description = $row['description'];
                            $task_status = $row['task_status'];
                            $priority = $row['priority'];
                            $due = $row['due_date'];
                            $nid = $row['nurse_id'];
                            
                            

                            if(($i%2) == 0){
                                if($task_status == 'not started'){
                                echo "<tr class='row1 not_started'>";
                            }elseif ($task_status == 'ongoing') {
                                echo "<tr class='row1 ongoing'>";
                            }
                            else{
                                echo "<tr class='row1 finished'>";
                            }
                            echo "<td><span onclick=viewTask($tid)>
                                {$description}</span></td>
                                <td>{$priority}</td>
                                <td>{$task_status}</td>
                                <td>{$due}</td>";
                                if($task_status == 'not started'){
                                echo  "<td class='modify'>
                                <span class='ti-plug' onclick=start($tid)> </span> 
                                <span class='ti-check' onclick=complete($tid)> </span>
                                </td></tr>";
                                }elseif ($task_status == 'ongoing') {
                                echo "<td class='modify'>
                                    <span class='ti-check' onclick=complete($tid)> </span>
                                </td></tr>";
                                }
                            }
                            else{
                                if($task_status == 'not started'){
                                echo "<tr class='row2 not_started'>";
                            }elseif ($task_status == 'ongoing') {
                                echo "<tr class='row2 ongoing'>";
                            }
                            else{
                                echo "<tr class='row2 finished'>";
                            }
                             echo "<tr class='row2'><td><span onclick=viewTask($tid)>
                                {$description}</span></td>
                                <td>{$priority}</td>
                                <td>{$task_status}</td>
                                <td>{$due}</td>";
                                if($task_status == 'not started'){
                                echo  "<td class='modify'>
                                <span class='ti-plug' onclick=start($tid)> </span> 
                                <span class='ti-check' onclick=complete($tid)> </span>
                                </td></tr>";
                                }elseif ($task_status == 'ongoing') {
                                echo "<td class='modify'>
                                    <span class='ti-check' onclick=complete($tid)> </span>
                                </td></tr>";
                                }
                            }
                            $row = $obj->fetch();
                            $tid = $row['task_id'];
                            $i++;
                        }
                        echo "</table>";
                        echo '</div>';
                }
                }
            }
            break;
        case 10:
                    if(isset($_REQUEST['id']) ){
                    include_once('tasks.php');
                    $obj1 = new tasks();
                    $id = intval($_REQUEST['id']);
                    
                    $obj1->get_task($id);
                    $row = $obj1->fetch();

                        echo '<div id="divContent">';
                        echo '<table id="tableExample" class="reportTable">';
                        echo "<tr><th>Task</th><th>Assigned To </th>
                                <th>Task Status </th><th>Date Started</th>
                                <th>Date Finished</th><th>Due Date</th><th>Priority</th>
                                <th> </th></tr>";
                        $i = 0;
                       
                            $fn = $row['nurse_fname'];
                            $sn = $row['nurse_sname'];
                            $description = $row['description'];
                            $task_status = $row['task_status'];
                            $date_started = $row['date_started'];
                            $date_finished = $row['date_finished'];
                            $due = $row['due_date'];
                            $priority = $row['priority'];
                            $nid = $row['nurse_id'];
                            $tid = $row['task_id'];
                            
                            if($task_status == 'not started'){
                                echo "<tr class='row1 not_started'>";
                            }elseif ($task_status == 'ongoing') {
                                echo "<tr class='row1 ongoing'>";
                            }
                            else{
                                echo "<tr class='row1 finished'>";
                            }
                            echo "<td>{$description}</td>
                                <td>{$fn} {$sn}</td>
                                <td>{$task_status}</td>
                                <td>{$date_started}</td>
                                <td>{$date_finished}</td>
                                <td>{$due}</td>
                                <td>{$priority}</td>";
                                if($task_status == 'not started'){
                                echo  "<td class='modify'>
                                <span class='ti-plug' onclick=start($tid)>Start</span> 
                                <span class='ti-check' onclick=complete($tid)>Complete</span>
                                </td></tr>";
                                }elseif ($task_status == 'ongoing') {
                                echo "<td class='modify'>
                                    <span class='ti-check' onclick=complete($tid)>Complete</span>
                                </td></tr>";
                                }
                            
                            
                        echo "</table>";
                        echo '</div>';
                    //}

                }
            break;
        case 11:
            session_start();
            include_once('tasks.php');
            $obj1 = new tasks();
            $isadmin = $_SESSION['admin'];
            
            $id = $_SESSION['id'];
            if($isadmin == 1){
                $obj1->get_all_tasks_overdue();
            }
            else{
                $obj1->get_nurse_overdue($id);
            }
            
            $row = $obj1->fetch();
            $tid = $row['task_id'];
            
            
            
            if($tid != 0){
                echo '<h2>Overdue:</h2>';
                
                while($row){
                    $overdue = $row['overdue'];
                    if($overdue >= 0){
                    echo '<div class="tasks_overdue" onclick=viewTask('.$tid.')>
                    <h3>'.$row["description"]
                            .'<span class="days_overdue">  '.$overdue.' Day(s)</span></h3>
                    <p><span>Due: '.$row['due_date'].'</span><p>
                    </div>';
                    }
                    
                    $row = $obj1->fetch();
                    $tid = $row['task_id'];
                } 
            }else{
                echo '<div class="tasks_overdue"><h3>No Tasks Overdue</h3></div>';
            }
            
            break;
        case 12:
            include_once('tasks.php');
            $date = $_REQUEST['date'];
            $obj1 = new tasks();
            
            if($isadmin){
            $obj1->get_task_by_date($date);
            }else{
                $obj1->get_task_by_date_id($date, $user_id);
            }
           
            $row = $obj1->fetch();
            $tid = $row['task_id'];
            $i = 1;
            if($tid != 0){
                while($row){
                    
                    echo "<div class='cal_task'>".$i.":".$row['description']."</div>";
                    $i++;
                    $row = $obj1->fetch();
                }
            }else{
                echo 'No Task';
            }
            
            break;
        }
        
?>
