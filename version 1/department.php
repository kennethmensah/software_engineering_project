<?php

//Error reading included file Templates/Scripting/Templates/Licenses/license-default.txt
include_once 'adb.php';
class departments extends adb{
    
    function departments(){
        
    }
    
    function add_department($name){
        $str_query = "insert into webPro_department set "
                . "department_name = '$name'";
        return $this->query($str_query);
    }
    
    function edit_department($name, $id){
        $str_query = "update webPro_department set department_name"
                . "='$name' where department_id = $id";
        return $this->query($str_query);
    }
    
    function get_department($id){
        $str_query = "select department_name from webPro_department
                    where department_id = $id ";
        return $this->query($str_query);
    }
    
    function get_all_departments(){
        $str_query = "select department_id, department_name from webPro_department";
        return $this->query($str_query);
    }
    
    function search_department($st){
        $str_query = "select department_name, department_id from webPro_department
                    where department_name like '%$st%' ";
        return $this->query($str_query);
    }
    
    function delete_department($id){
        $str_query = "delete from webPro_department
                 where department_id = $id";
        return $this->query($str_query);
    }
}



?>

