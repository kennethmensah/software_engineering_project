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
            *Adds a Task to database
            */
            add_task_control();
            break;
        case 2:
            /*
            *Gets Tasks from database
            */
            get_tasks_control();
            break;
        case 3:
            /*
            *Edits a Task in database
            */
            edit_task_control();
            break;
        case 4:
            /*
            *Gets a Task from database
            */
            get_task_control();
            break;
        default:
            /*
            *Default value returns an error message
            */
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
 * @return district_task
 */
function get_district_task_model(){
    require_once '../model/district_task.php';
    $obj = new district_task();
    return $obj;
}