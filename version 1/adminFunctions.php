
<?php

$cmd=$_REQUEST['cmd'];
switch($cmd)
{
    
    case 1:
        if(isset($_REQUEST['st']) && isset($_REQUEST['sf'])){
            include_once('administrator.php');
            $obj1 = new administrator();
            
            $search_text = $_REQUEST['st'];
            $search_filter = intval($_REQUEST['sf']);
            
            if($search_filter == 1){
                $result = $obj1->search_admin_by_name($search_text);
                
            }
            
            if($result == true){
                $row = $obj1->fetch();
                $nid = $row['admin_id'];
                
                if($nid != 0){
                echo '<div id="divContent">';
                echo '<table id="tableExample" class="reportTable">';
                echo "<tr class='header'><th>First Name</th><th>Surname </th>
                        <th>Gender </th><th>Department </th><th> </th></tr>";
                $i = 0;
                
                while($row){
                    $fn = $row['admin_fname'];
                    $sn = $row['admin_sname'];
                    $gender = $row['gender'];
                    $dpt = $row['department_name'];
                    
                    if(($i%2) == 0){
                    echo'<tr class="row1"><td>'.$fn.'</td>
                                    <td>'.$sn.'</td>
                                    <td>'.$gender.'</td>
                                    <td>'.$dpt.'</td>
                                    <td class="modify">
                                    <span class="ti-pencil" onclick=update('.$nid.')></span>
                                    <span class="ti-trash"  onclick=deleteAdmin('.$nid.')></span></td></tr>';
                            }
                            else{
                                    echo '<tr class="row2"><td>'.$fn.'</td>
                                    <td>'.$sn.'</td>
                                    <td>'.$gender.'</td>
                                    <td>'.$dpt.'</td>
                                    <td class="modify">
                                    <span class="ti-pencil" onclick=update('.$nid.')></span>
                                    <span class="ti-trash" onclick=deleteAdmin('.$nid.')></span></td></tr>';
                            }
                            $row = $obj1->fetch();
                            $nid = $row['admin_id'];
                        $i++;
                }
                echo "</table>";
                }
                else 
                echo 'No records found';
            }
          
        }
        break;
    case 2:
        if(isset($_REQUEST['fn'])){
            include_once('administrator.php');
            include_once 'users.php';
            
            $fname = $_REQUEST['fn'];
            $sname = $_REQUEST['sn'];
            $gender = $_REQUEST['gender'];
            $department = $_REQUEST['dpt'];
            $username = $_REQUEST['user'];
            $password = $_REQUEST['pass'];

            $obj = new administrator();
            $user = new users();
            $admin = 1;
            if(!$obj->add_admin($sname, $fname, $gender, $department)){
                echo '<div id="divStatus" class="error">
                            Could Not Add Admin <span class="ti-face-sad" ></span>
                    </div>';
            }
            else{
                $id = $obj->get_insert_id();
                $user->add_users($username, $password, $admin, $id);
                echo '<div id="divStatus" class="success">
			New Admin Added <span class="ti-face-smile" ></span>
                    </div> ';
            }
                
        }
        break;
        
    case 3:
            include_once('administrator.php');
            $obj1 = new administrator();
            $obj1->get_administrators();
            
           
                $row = $obj1->fetch();
                $nid = $row['admin_id'];
                
                if($nid != 0){
                echo '<table id="tableExample" class="reportTable">';
                echo "<tr class='header'><th>First Name</th><th>Surname </th>
                        <th>Gender </th><th>Department </th><th> </th></tr>";
                $i = 0;
                while($row){
                    $fn = $row['admin_fname'];
                    $sn = $row['admin_sname'];
                    $gender = $row['gender'];
                    $dpt = $row['department_name'];
                    
                    
                    if(($i%2) == 0){
                    echo'<tr class="row1"><td>'.$fn.'</td>
                                    <td>'.$sn.'</td>
                                    <td>'.$gender.'</td>
                                    <td>'.$dpt.'</td>
                                    <td class="modify">
                                    <span class="ti-pencil" onclick=update('.$nid.')></span>
                                    <span class="ti-trash"  onclick=deleteAdmin('.$nid.')></span></td></tr>';
                            }
                            else{
                                    echo '<tr class="row2"><td>'.$fn.'</td>
                                    <td>'.$sn.'</td>
                                    <td>'.$gender.'</td>
                                    <td>'.$dpt.'</td>
                                    <td class="modify">
                                    <span class="ti-pencil" onclick=update('.$nid.')></span>
                                    <span class="ti-trash" onclick=deleteAdmin('.$nid.')></span></td></tr>';
                            }
                            $row = $obj1->fetch();
                            $nid = $row['admin_id'];
                        $i++;
                }
                echo "</table>";
                }else{
                    echo 'No records found';
                }
                
            
        break;
    case 4:
        if(isset($_REQUEST['fn'])){
            include_once("administrator.php");
           
            $fname = $_REQUEST['fn'];
            $sname = $_REQUEST['sn'];
            $gender = $_REQUEST['gender'];
            $department = intval($_REQUEST['dpt']);
            $nid = intval($_REQUEST['nid']);
            
           
            $obj = new administrator();
            if(!$obj->edit_administrator($nid, $sname, $fname, $gender, $department)){
                echo '<div id="divStatus" class="error">
			Could Not Update Admin Information <span class="ti-face-sad" ></span>
                    </div>';
            }
            else{
                 echo '<div id="divStatus" class="success">
			Admin Information Updated <span class="ti-face-smile" ></span>
                    </div> ';
            }
                
        }
        break;
    case 5:
        include_once 'administrator.php';
        include_once 'users.php';
        if(isset( $_REQUEST["id"])){
            $nid = intval($_REQUEST['id']);
            
            $user = new users();
            $obj = new administrator();
            if(!$obj->delete_admin($nid)){
                echo '<div id="divStatus" class="error"  onclick=hideStatus()>
                    Could Not Delete <span class="ti-face-sad" ></span></div>';

            }
            else {
                $user->delete_user($nid);
                echo '<div id="divStatus" class="success">
                    Delete Successful <span class="ti-face-smile" ></span></div> ';

            }
        }
        break;

}
?>
