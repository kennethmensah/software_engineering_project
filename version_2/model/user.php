<?php

/**
    *@author Group 4
    *@version 2.0.0
    *@copyright Copyright (c) 2015, Group 4
*/
    
    include_once 'adb.php';

    class user extends adb{
       
    /**
     *@constructor  user() Constructor for the user class 
     */
        function user(){}
        
        /**
         *@method boolean add_user() add_user($username, $password, $user_type, $email) Adds a user to the database
         *@param string $username The username
         *@param string password Password
         *@param string $user_type The user type
         *@param string email The email
         *@return boolean
         */
        function add_user($username, $password, $user_type, $email){
            $str_query =  "INSERT into se_users SET
                   username = '$username',
                   password = '$password',
                   email = '$email',
                   user_type = '$user_type'";
            
            return $this->query($str_query);
        }
        
        
        /**
         *@method boolean edit_password() edit_password($username, $password, $user_type, $email) Edit user in the database
         *@param string $username The username
         *@param string password Password
         *@return boolean
         */
        function edit_password($username, $password){
            $str_query = "UPDATE se_users SET
                password = '$password'
                WHERE username = '$username'";
            
            return $this->query($str_query);
        }

        /**
         *@method boolean edit_password_byId() edit_password_byId($id, $password) Edit a user password to the database
         *@param string $id User ID
         *@param string password Password
         *@return boolean
         */
        function edit_password_byId($id, $password){
            $str_query = "UPDATE se_users SET
                password = '$password'
                WHERE user_id = $id";

            return $this->query($str_query);
        }
        
        /**
         *@method boolean get_user() get_user($username, $pass) Gets a user from the database
         *@param string $username The username
         *@param string pass Password
         *@return boolean
         */
        function get_user($username, $pass){
            $str_query = "SELECT * FROM se_users
                WHERE username = '$username' AND password = '$pass'";
            
            return $this->query($str_query);
        }

        /**
         *@method booolean get_user_byId() get_user_byId($id) Gets user by ID
         *@param int $id User ID
         *@return boolean
         */
        function get_user_byId($id){
            $str_query = "SELECT * FROM se_users
                WHERE user_id = $id";

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

// $obj = new user();
// if($obj->add_user("kwasi_banmmnjkj", "demo", "admin",'dffdfdfd')){
//     echo "sth". $result;
// }else{
//     echo "nana";
// }


?>