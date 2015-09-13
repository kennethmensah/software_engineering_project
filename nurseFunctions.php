<?php

$cmd=$_REQUEST['cmd'];
switch($cmd)
{
    
    case 1:
        if(isset($_REQUEST['st']) && isset($_REQUEST['sf'])){
            include_once('nurses.php');
            $obj1 = new nurses();
            
            $search_text = $_REQUEST['st'];
            $search_filter = intval($_REQUEST['sf']);
            
            if($search_filter == 1){
                $result = $obj1->search_nurse_by_name($search_text);
                
            }
            
            
            if($result == true){
                $row = $obj1->fetch();
                $nid = $row['nurse_id'];
                if($nid != 0){
                echo '<table id="tableExample" class="reportTable">';
                echo "<tr class='header'><th>First Name</th><th>Surname </th>
                        <th>Gender </th><th>Department </th><th> </th></tr>";
                $i = 0;
                while($row){
                    $fn = $row['nurse_fname'];
                    $sn = $row['nurse_sname'];
                    $gender = $row['gender'];
                    $dpt = $row['department_name'];
                    

                    if(($i%2) == 0){
                    echo'<tr class="row1"><td><a href="viewNurse.php?id=$nid">'.$fn.'</a></td>
                                    <td>'.$sn.'</td>
                                    <td>'.$gender.'</td>
                                    <td>'.$dpt.'</td>
                                    <td class="modify">
                                    <span class="ti-pencil" onclick=update('.$nid.')></span>
                                    <span class="ti-trash"  onclick=deleteNurse('.$nid.')></span></td></tr>';
                            }
                            else{
                                    echo '<tr class="row2"><td><a href="viewNurse.php?id=$nid">'.$fn.'</a></td>
                                    <td>'.$sn.'</td>
                                    <td>'.$gender.'</td>
                                    <td>'.$dpt.'</td>
                                    <td class="modify">
                                    <span class="ti-pencil" onclick=update('.$nid.')></span>
                                    <span class="ti-trash" onclick=deleteNurse('.$nid.')></span></td></tr>';
                            }
                            $row = $obj1->fetch();
                            $nid = $row['nurse_id'];
                        $i++;
                }
                echo "</table>";
                }
                else{
                    echo 'No records found';
                }
                //echo '</div>';
            }
          
        }
        break;
    case 2:
        if(isset($_REQUEST['fn'])){
            include_once('nurses.php');
            include_once 'users.php';
            
            $fname = $_REQUEST['fn'];
            $sname = $_REQUEST['sn'];
            $gender = $_REQUEST['gender'];
            $department = $_REQUEST['dpt'];
            $username = $_REQUEST['user'];
            $password = $_REQUEST['pass'];
            

            $obj = new nurses();
            $user = new users();
            $admin = 0;
            if(!$obj->add_nurse($sname, $fname, $gender, $department)){
                echo '<div id="divStatus" class="error">
                            Could Not Add Nurse <span class="ti-face-sad" ></span>
                            </span>
                    </div>';
            }
            else{
                $id = $obj->get_insert_id();
                $user->add_users($username, $password, $admin, $id);
                echo '<div id="divStatus" class="success">
			New Nurse Added <span class="ti-face-smile" ></span>
			</span></div> ';
            }
                
        }
        break;
        
    case 3:
            include_once('nurses.php');
            $obj1 = new nurses();
            $obj1->get_nurses();
            
           
                $row = $obj1->fetch();
                $nid = $row['nurse_id'];
                //echo '<div id="divContent">';
                if($nid != 0){
                echo '<table id="tableExample" class="reportTable">';
                echo "<tr class='header'><th>First Name</th><th>Surname </th>
                        <th>Gender </th><th>Department </th><th> </th></tr>";
                $i = 0;
                while($row){
                    $fn = $row['nurse_fname'];
                    $sn = $row['nurse_sname'];
                    $gender = $row['gender'];
                    $dpt = $row['department_name'];
                    
                    
                    if(($i%2) == 0){
                    echo'<tr class="row1"><td><a href="viewNurse.php?id=$nid">'.$fn.'</a></td>
                                    <td>'.$sn.'</td>
                                    <td>'.$gender.'</td>
                                    <td>'.$dpt.'</td>
                                    <td class="modify">
                                    <span class="ti-pencil" onclick=update('.$nid.')></span>
                                    <span class="ti-trash"  onclick=deleteNurse('.$nid.')></span></td></tr>';
                            }
                            else{
                                    echo '<tr class="row2"><td><a href="viewNurse.php?id=$nid">'.$fn.'</a></td>
                                    <td>'.$sn.'</td>
                                    <td>'.$gender.'</td>
                                    <td>'.$dpt.'</td>
                                    <td class="modify">
                                    <span class="ti-pencil" onclick=update('.$nid.')></span>
                                    <span class="ti-trash" onclick=deleteNurse('.$nid.')></span></td></tr>';
                            }
                            $row = $obj1->fetch();
                            $nid = $row['nurse_id'];
                        $i++;
                }
                echo "</table>";
                }
                else 
                echo 'No records for nurses';
            
        break;
    case 4:
        if(isset($_REQUEST['fn'])){
            include_once("nurses.php");
            
            $fname = $_REQUEST['fn'];
            $sname = $_REQUEST['sn'];
            $gender = $_REQUEST['gender'];
            $department = $_REQUEST['dpt'];
            $nid = $_REQUEST['nid'];
            
           
            $obj = new nurses();
            if(!$obj->edit_nurse($nid, $sname, $fname, $gender, $department)){
                echo '<div id="divStatus" class="error">
			Could Not Update Nurse Information <span class="ti-face-sad" ></span>
                        </span>
                    </div>';
            }
            else{
                 echo '<div id="divStatus" class="success">
			Nurse Information Updated <span class="ti-face-smile" ></span>
                        </span>
                    </div> ';
            }
                
        }
        break;
    case 5:
        include_once 'nurses.php';
        include_once 'users.php';
        if(isset( $_REQUEST["id"])){
            $nid = intval($_REQUEST['id']);
            
            $user = new users();
            $obj = new nurses();
            if(!$obj->delete_nurse($nid)){
                echo '<div id="divStatus" class="error"  onclick=hideStatus()>
                    Could Not Delete <span class="ti-face-sad" ></span>
                    </span></div>';

            }
            else {
                $user->delete_user($nid);
                echo '<div id="divStatus" class="success">
                    Delete Successful <span class="ti-face-smile" >
                    </span></span></div> ';

            }
        }
        break;
}
?>
