
<?php

$cmd=$_REQUEST['cmd'];
switch($cmd)
{
    
    case 1:
        if(isset($_REQUEST['st'])){
            include_once('department.php');
            $obj1 = new departments();
            
            $search_text = $_REQUEST['st'];
            
            $result = $obj1->search_department($search_text);
                
            if($result == true){
                $row = $obj1->fetch();
                $did = $row['department_id'];
                if($did != 0 ){
                
                echo '<table id="tableExample" class="reportTable">';
                echo "<tr class='header'><th>Department Name</th>
                        <th> </th></tr>";
                $i = 0;
                while($row){
                    $dn = $row['department_name'];
                    
                    

                    if(($i%2) == 0){
                    echo'<tr class="row1">
                                    <td>'.$dn.'</td>
                                    <td class="modify">
                                    <span class="ti-pencil" onclick=update('.$did.')></span>
                                    <span class="ti-trash"  onclick=deleteDepartment('.$did.')></span></td></tr>';
                            }
                            else{
                                   echo'<tr class="row2">
                                    <td>'.$dn.'</td>
                                    <td class="modify">
                                    <span class="ti-pencil" onclick=update('.$did.')></span>
                                    <span class="ti-trash"  onclick=deleteDepartment('.$did.')></span></td></tr>';
                            }
                            $row = $obj1->fetch();
                        $i++;
                }
                echo "</table>";
                
                }
                else{
                    echo 'No records found';
                }
            }
          
        }
        break;
    case 2:
        if(isset($_REQUEST['dn'])){
            include_once 'department.php';
            
            $name = $_REQUEST['dn'];
            $obj = new departments();
            if(!$obj->add_department($name)){
                echo '<div id="divStatus" class="error">
                            Could Not Add Department <span class="ti-face-sad" ></span>
                    </div>';
            }
            else{
      
            echo '<div id="divStatus" class="success">
                          New Department Added <span class="ti-face-smile" ></span>
                      </div> ';
            }
                
        }

        break;
        
    case 3:
            include_once('department.php');
            $obj1 = new departments();
            $obj1->get_all_departments();
            
           
                $row = $obj1->fetch();
                
                echo '<table id="tableExample" class="reportTable">';
                echo "<tr class='header'><th>Department ID</th><th>Department Name</th>
                        <th> </th></tr>";
                $i = 0;
                while($row){
                    $did = $row['department_id'];
                    $dn = $row['department_name'];
                    
                    if(($i%2) == 0){
                    echo'<tr class="row1"><td>'.$did.'</td>
                                    <td>'.$dn.'</td>
                                    <td class="modify">
                                    <span class="ti-pencil" onclick=update('.$did.')></span>
                                    <span class="ti-trash"  onclick=deleteDepartment('.$did.')></span></td></tr>';
                    }
                    else{
                            echo'<tr class="row2"><td>'.$did.'</td>
                            <td>'.$dn.'</td>
                            <td class="modify">
                            <span class="ti-pencil" onclick=update('.$did.')></span>
                            <span class="ti-trash"  onclick=deleteDepartment('.$did.')></span></td></tr>';
                    }
                            $row = $obj1->fetch();
                        $i++;
                }
                echo "</table>";
               
            
        break;
    case 4:
        if(isset($_REQUEST['dn']) && isset($_REQUEST['did'])){
            include_once("department.php");
            
            $dn = $_REQUEST['dn'];
            $did = $_REQUEST['did'];
            
            $obj = new departments();
            if(!$obj->edit_department($dn, $did)){
                echo '<div id="divStatus" class="error">
			Could Not Update Department Information <span class="ti-face-sad" ></span>
                    </div>';
            }
            else{
                 echo '<div id="divStatus" class="success">
			Department Information Updated <span class="ti-face-smile" ></span>
                    </div> ';
            }
                
        }
        break;
    case 5:
        include_once 'department.php';
        if(isset( $_REQUEST["id"])){
            $did = intval($_REQUEST['id']);

            $obj = new departments();
            if(!$obj->delete_department($did)){
                echo '<div id="divStatus" class="error"  onclick=hideStatus()>
                    Could Not Delete <span class="ti-face-sad" ></span></div>';

            }
            else {
                echo '<div id="divStatus" class="success">
                    Delete Successful <span class="ti-face-smile" ></span></div> ';

            }
        }
        break;

}
?>
