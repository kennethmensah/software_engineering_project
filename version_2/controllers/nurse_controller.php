<?php
/**
    *@author Group 4
    *@version 2.0.0
    *@copyright Copyright (c) 2015, Group 4
    */

/**
*@method void session_start() Starts the session
*/
session_start();

if(filter_input (INPUT_GET, 'cmd')){
    $cmd = $cmd_sanitize = '';
    $cmd_sanitize = sanitize_string( filter_input (INPUT_GET, 'cmd'));
    $cmd = intval($cmd_sanitize);

    switch ($cmd){
        case 1:
            /*
            *Adds Nurse to database
            */
            add_nurse_control();
            break;
        case 2:
            /*
            *Gets Nurses from database
            */
            get_nurses_control();
            break;
        case 3:
            /*
            *Get a nurse from database
            */
            get_nurse_control();
            break;
        case 4:
            /*
            *Edits a nurse in a database
            */
            edit_nurse_control();
            break;
        default:
            /*
            *Default value sends an error message
            */
            echo '{"result":0, "message":"Invalid Command Entered"}';
            break;
    }
}

/*
 *@method void add_nurse_control() Adds a nurse to database
 */
function add_nurse_control(){
    if( filter_input (INPUT_GET, 'nurse_id') && filter_input(INPUT_GET, 'fname')
        && filter_input(INPUT_GET, 'sname')&& filter_input(INPUT_GET, 'zone')
        && filter_input(INPUT_GET, 'phone')&& filter_input(INPUT_GET, 'gender')){

        $obj = get_nurse_model();

        $nurse_id = sanitize_string(filter_input (INPUT_GET, 'nurse_id'));
        $fname = sanitize_string(filter_input (INPUT_GET, 'fname'));
        $sname = sanitize_string(filter_input (INPUT_GET, 'sname'));
        $district_zone = sanitize_string(filter_input (INPUT_GET, 'zone'));
        $phone = sanitize_string(filter_input (INPUT_GET, 'phone'));
        $gender = sanitize_string(filter_input (INPUT_GET, 'gender'));

        if ($obj->add_nurses($nurse_id, $fname, $sname, $district_zone, $phone,$gender)){
            echo '{"result":1,"message": "nurse added successfully"}';
        }
        else
        {
            echo '{"result":0,"message": "unable to add nurse"}';
        }

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
 * @return nurse
 */
function get_nurse_model(){
    require_once '../model/nurse.php';
    $obj = new nurse();
    return $obj;
}