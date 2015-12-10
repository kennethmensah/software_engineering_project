<?php

/**
 * This class interfaces contains queries that interface with the
 * users database. It contains relevant queries necessary for
 * assigning tasks, retrieving tasks and updating tasks.
 *
 * PHP version 5.6
 *
 * @category   Model
 * @author     Kenneth Mintah Mensah <kenneth.mensah@ashesi.edu.gh>
 * @author     Joshua Atsu Aherdemla <joshua.aherdemla@ashesi.edu.gh>
 * @author     Norbert Sackey <norbert.sackey@ashesi.edu.gh>
 * @author     Edwina Baddoo <edwina.baddoo@ashesi.edu.gh>
 * @version    SVN: 2.0.0
 */

/**
 * A database interface class
 *
 * The class below contains functions that interface with the database
 * via MYSQL
 */
    
include_once 'adb.php';

class user extends adb{

    function user(){}


    function add_user($username, $password, $user_type, $email){
        $str_query =  "INSERT into se_users SET
               username = '$username',
               password = '$password',
               email = '$email',
               user_type = '$user_type'";

        return $this->query($str_query);
    }


    /**
     * function edit user password details
     */
    function edit_password($username, $password){
        $str_query = "UPDATE se_users SET
            password = '$password'
            WHERE username = '$username'";

        return $this->query($str_query);
    }

    /**
     * function edit user password details
     */
    function edit_password_byId($id, $password){
        $str_query = "UPDATE se_users SET
            password = '$password'
            WHERE user_id = $id";

        return $this->query($str_query);
    }

    /*
     *
     */
    function get_user($username, $pass){
        $str_query = "SELECT * FROM se_users
            WHERE username = '$username' AND password = '$pass'";

        return $this->query($str_query);
    }

    function get_user_byId($id){
        $str_query = "SELECT * FROM se_users
            WHERE user_id = $id";

        return $this->query($str_query);
    }

}

?>