<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/23/15
 * Time: 6:23 PM
 */

include_once 'adb.php';

class clinic extends adb{

    /**
     *
     */
    function clinic(){

    }

    function add_clinic(){
        $str_query =  "INSERT into se_users SET
                   username = '$username',
                   password = '$password',
                   email = '$email',
                   user_type = '$user_type'";

        return $this->query($str_query);
    }
}