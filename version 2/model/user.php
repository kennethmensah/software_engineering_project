<?php
    
    include_once 'adb.php';

    class user extends adb{
       
        function user(){}
        
        //add new user
        function add_user($username, $password, $user_type){
            $str_query =  "INSERT into pos_users SET
                   username = '$username',
                   password = '$password',
                   user_type = '$user_type'";
            
            return $this->query($str_query);
        }
        
        
        //function edit user password details
        function edit_password($username, $password){
            $str_query = "UPDATE pos_users SET
                password = '$password'
                WHERE username = '$username'";
            
            return $this->query($str_query);
        }
        
        //function get user 
        function get_user($username, $pass){
            $str_query = "SELECT * FROM pos_users
                WHERE username = '$username' AND password = '$pass'";
            
            return $this->query($str_query);
        }
        
    }


//$obj = new user();
//if($obj->get_user('kwadwo')){
//    $row = $obj->fetch();
//    echo $row['password'];
//}
//else{
//    echo 'sth';
//}
?>