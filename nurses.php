
<?php

include_once("adb.php");

class nurses extends adb{
    
    function nurses(){
        
    }
    
    function add_nurse($sname, $fname, $gender, $department){
        
        $str_query = "insert into webPro_nurses set "
                . "nurse_fname = '$fname',"
                . "nurse_sname = '$sname',"
                . "gender = '$gender',"
                . "department = $department";
       
        return $this->query($str_query);
    }
    
    function edit_nurse($id, $sname, $fname, $gender, $department ){
        $str_query = "update webPro_nurses set nurse_fname = '$fname',
                nurse_sname = '$sname', gender = '$gender', department = $department
                where nurse_id = $id ";
        return $this->query($str_query);
    }
    
    function get_nurse($id){
        
        $str_query = "select nurse_id, nurse_fname, nurse_sname, gender,
            department, department_id, department_name
            from webPro_department, webPro_nurses where department=department_id and nurse_id = $id";
        return $this->query($str_query);
    }
    
    
    function get_nurses(){
        $str_query = "select nurse_id, nurse_fname, nurse_sname, gender,
            department, department_id, department_name
            from webPro_department, webPro_nurses where department=department_id";
        
        return $this->query($str_query);
    }
    
    function delete_nurse($id){
        $str_query = "delete from webPro_nurses where nurse_id = $id";
        return $this->query($str_query);
    }
    
    function search_nurse_by_name($sn){
        $str_query = "select nurse_id, nurse_fname, nurse_sname, gender,
            department, department_id, department_name
            from webPro_department, webPro_nurses where nurse_fname like '%$sn%' 
                and department=department_id or 
            nurse_sname like '%$sn%' and department=department_id";
        return $this->query($str_query);
    }
    
    function search_nurse_by_department($sn){
        $str_query = "select nurse_id, nurse_fname, nurse_sname, gender,
            department, department_id, department_name
            from webPro_department, webPro_nurses where
            department_name like '%$sn%' and department=department_id";
        return $this->query($str_query);
    } 
}
?>




