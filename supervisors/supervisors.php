
<?php

include_once("adb.php");

class supervisors extends adb{
    
    function supervisors(){
        
    }
    
    function add_supervisor($sname, $fname, $gender, $nID, $tID){
        
        $str_query = "insert into supervisors set "
                . "supervisor_fname = '$fname',"
                . "supervisor_sname = '$sname',"
                . "gender = '$gender',"
                . "nurse_ID = $nID,"
                . "task_ID = $tID";
       
        return $this->query($str_query);
    }
    
    function edit_supervisor($id, $sname, $fname, $gender, $nID, $tID ){
        $str_query = "update supervisors set supervisor_fname = '$fname',
                supervisor_sname = '$sname', gender = '$gender', nurse_ID = $nID,
                task_ID = $tID
                where supervisor_ID = $id ";
        return $this->query($str_query);
    }
    
    function get_supervisor($id){
        
        $str_query = "select supervisor_ID, supervisor_fname, supervisor_sname, gender,
            task_ID, nurse_ID from supervisors where supervisor_ID = $id";
        return $this->query($str_query);
    }
    
    function delete_supervisor($id){
        $str_query = "delete from supervisors where supervisor_ID = $id";
        return $this->query($str_query);
    }
    
    function search_supervisor_by_name($sn){
        $str_query = "select supervisor_ID, supervisor_fname, supervisor_sname, gender,
            nurse_ID, task_ID from supervisors where supervisor_fname like '%$sn%' 
            supervisor_sname like '%$sn%'";
        return $this->query($str_query);
    }
}
?>




