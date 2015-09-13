<?php
include_once 'adb.php';

class users extends adb{
    
    function users(){
        
    }
    
    function add_users($user, $pass, $admin, $id){
        $token = $this->encrypt($pass);
        $str_query = "insert into webPro_users values('$user', '$token',$admin,$id)";
        
        return $this->query($str_query); 
    }
    
    function change_password($user, $pass){
        $str_query = "update webPro_users set password = '$pass'
                where user = $user ";
        
        return $this->query($str_query); 
    }
    
    function get_user($user){
        $str_query = "select user,password, admin, id from webPro_users"
                . " where user = '$user'";
        return $this->query($str_query);
    }
    
    function delete_user($id){
        $str_query = "delete from webPro_users where id = $id";
        return $this->query($str_query);
    }
    
    function edit_user($id, $username, $pass, $admin){
        $str_query = "update webPro_users set "
                . "username = $username, "
                . "password = $pass, "
                . "admin = $admin from webPro_users where id = $id";
        
         return $this->query($str_query);       
    }
}

?>
