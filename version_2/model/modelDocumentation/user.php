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

class User extends adb{

    /**
     * user constructor.
     *
     * this method instantiates an object of the user class
     */
    function User(){}

    /**
     * Executes a query to add a new user
     *
     * This method executes a query to assign a new user.
     *
     * @param $username: username
     * @param $password: password
     * @param $user_type: user type ie. admin, supervisor, nurse
     * @param $email: email
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function addUser($username, $password, $user_type, $email){
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
     * @param $username: username
     * @param $password: password
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function editPassword($username, $password){
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
     * @param $id: user id
     * @param $password: password
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function editPasswordById($id, $password){
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
     * @param $username: username
     * @param $pass: password
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function getUser($username, $pass){
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
     * @param $id: user id
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function getUserById($id){
        $str_query = "SELECT * FROM se_users
            WHERE user_id = $id";

        return $this->query($str_query);
    }

}

?>