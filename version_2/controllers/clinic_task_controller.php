<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/25/15
 * Time: 10:50 AM
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
function get_clinic_task_model(){
    require_once '../model/clinic_task.php';
    $obj = new clinic_task();
    return $obj;
}