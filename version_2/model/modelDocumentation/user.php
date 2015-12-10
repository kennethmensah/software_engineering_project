<?php

/**
 * This class interfaces contains queries that interface with the
 * users database. It contains relevant queries necessary for
 * adding users, retrieving users and updating user details.
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

    /**
     * user constructor.
     *
     * this method instantiates an object of the user class
     */
    function user(){}

    /**
     * Executes a query to add a new user
     *
     * This method executes a query to assign a new user.
     *
     * @param String $username this is the username of the user
     * @param String $password this is the password of the user
     * @param int $user_type user type ie. admin, supervisor, nurse
     * @param String $email this is the email of the user
     * @return bool returns true/false indicating whether the query is successful of not
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
     * Executes a query to edit user password
     *
     * This method executes a query to edit a user's password
     *
     * @param String $username this is the username of the user
     * @param String $password this is the password of the user
     * @return bool returns true/false indicating whether the query is successful of not
     */
    function edit_password($username, $password){
        $str_query = "UPDATE se_users SET
            password = '$password'
            WHERE username = '$username'";

        return $this->query($str_query);
    }

    /**
     * Executes a query to edit user password
     *
     * This method executes a query to edit a user's password
     *
     * @param String $id this is the id of the user
     * @param String $password this is the password of the user
     * @return bool returns true/false indicating whether the query is successful of not
     */
    function edit_password_byId($id, $password){
        $str_query = "UPDATE se_users SET
            password = '$password'
            WHERE user_id = $id";

        return $this->query($str_query);
    }

    /**
     * Executes a query to get a users details
     *
     * This method executes a query to get a user's details
     * by their username and password
     *
     * @param String $username this is the username of the user
     * @param String $pass this is the password of the user
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function get_user($username, $pass){
        $str_query = "SELECT * FROM se_users
            WHERE username = '$username' AND password = '$pass'";

        return $this->query($str_query);
    }

    /**
     * Executes a query to get a users details
     *
     * This method executes a query to get a user's details
     * by their user id
     *
     * @param int $id this is the id of the user
     * @return bool returns true/false indicating whether the query is successful of not
     */
    function get_user_byId($id){
        $str_query = "SELECT * FROM se_users
            WHERE user_id = $id";

        return $this->query($str_query);
    }

}

?>