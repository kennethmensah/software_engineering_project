<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/25/15
 * Time: 10:51 AM
 */




/**
 * @param $val
 * @return string
 */
function sanitize_string($val){
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlentities($val);

    return $val;
}


/**
 * @return district_task
 */
function get_district_task_model(){
    require_once '../model/district_task.php';
    $obj = new district_task();
    return $obj;
}