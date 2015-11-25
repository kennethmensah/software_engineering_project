<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/25/15
 * Time: 9:20 AM
 */

session_start();

if(filter_input (INPUT_GET, 'cmd')){
    $cmd = $cmd_sanitize = '';
    $cmd_sanitize = sanitize_string( filter_input (INPUT_GET, 'cmd'));
    $cmd = intval($cmd_sanitize);

    switch ($cmd){
        case 1:
            add_clinic_control();
            break;
        case 2:
            get_clinics_control();
            break;
        case 3:
            get_clinic_control();
            break;
        case 4:
            edit_clinic_control();
            break;
        default:
            echo '{"result":0, "message":"Invalid Command Entered"}';
            break;
    }
}


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
 * @return admin
 */
function get_admin_model(){
    require_once '../model/clinic.php';
    $obj = new clinic();
    return $obj;
}