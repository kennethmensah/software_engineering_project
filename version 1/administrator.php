<?php

include_once("adb.php");

class administrator extends adb{
    
    function administrator(){
        
    }
    
    function add_admin($sname, $fname, $gender, $department){
        
        $str_query = "insert into webPro_administrators set "
                . "admin_fname = '$fname',"
                . "admin_sname = '$sname',"
                . "gender = '$gender',"
                . "department = $department,"
                . "position = 'administrator'";
        return $this->query($str_query);
    }
    
    function edit_administrator($id, $sname, $fname, $gender, $department ){
        $str_query = "update webPro_administrators set "
                . "admin_fname = '$fname',"
                . "admin_sname = '$sname',"
                . "gender = '$gender',"
                . "department = $department "
                ."where admin_id = $id";
        return $this->query($str_query);
    }
    
    function get_administrator($id){
        $str_query = "select admin_fname, admin_sname, gender, department
                from webPro_administrators
                where admin_id = $id";
        return $this->query($str_query);
    }
    
    function get_administrators(){
        $str_query = "select admin_id, admin_fname, admin_sname, gender,
            department, department_id, department_name
            from webPro_department, webPro_administrators where department=department_id";
        
        return $this->query($str_query);
    }
    
    function delete_admin($id){
        $str_query = "delete from webPro_administrators where admin_id = $id";
        return $this->query($str_query);
    }
    
    function search_admin_by_name($sn){
        $str_query = "select admin_id, admin_fname, admin_sname, gender,
            department, department_id, department_name
            from webPro_department, webPro_administrators where admin_fname like '%$sn%' 
            and department=department_id or 
            admin_sname like '%$sn%' and department=department_id";
        return $this->query($str_query);
    }
    
}



?>
