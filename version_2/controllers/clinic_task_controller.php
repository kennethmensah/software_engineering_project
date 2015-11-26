<?php
session_start();
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/25/15
 * Time: 10:50 AM
 */


if(filter_input (INPUT_GET, 'cmd')){
    $cmd = $cmd_sanitize = '';
    $cmd_sanitize = sanitize_string( filter_input (INPUT_GET, 'cmd'));
    $cmd = intval($cmd_sanitize);

    switch ($cmd){
        case 1:
            add_task_control();
            break;
        case 2:
            get_tasks_control();
            break;
        case 3:
            edit_task_control();
            break;
        case 4:
            get_task_control();
            break;
        default:
            echo '{"result":0, "message":"Invalid Command Entered"}';
            break;
    }
}


function add_task_control(){

    if( filter_input (INPUT_GET, 'title') && filter_input(INPUT_GET, 'loc')){

        $obj =  get_clinic_task_model();

        $title = sanitize_string(filter_input (INPUT_GET, 'title'));
        $desc = sanitize_string(filter_input (INPUT_GET, 'desc'));
        $nurse = sanitize_string(filter_input (INPUT_GET, 'nurse'));
        $supervisor = sanitize_string(filter_input (INPUT_GET, 'supervisor'));
        $due_date = sanitize_string(filter_input (INPUT_GET, 'date'));
        $due_time = sanitize_string(filter_input (INPUT_GET, 'time'));
        $clinic  = sanitize_string(filter_input (INPUT_GET, 'clinic'));


        if ($obj->$obj->add_clinic_task($title, $desc, $nurse, $supervisor, $due_date,$due_time, $clinic)){
            echo '{"result":1,"message": "clinic added successfully"}';
        }
        else
        {
            echo '{"result":0,"message": "unable to add clinic"}';
        }

    }
}


function get_task_control(){
    $obj = get_clinic_model();
    if ($obj->get_clinics()){
        echo '{"result":1, "clinics":[';
        $row = $obj->fetch();
        while($row){
            echo json_encode($row);
            if( $row = $obj->fetch()){
                echo ',';
            }
        }
        echo ']}';
    }else{
        echo '{"result":0,"message": "query unsuccessful"}';
    }
}





function sanitize_string($val){
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlentities($val);

    return $val;
}


/**
 * @return clinic_task
 */
function get_clinic_task_model(){
    require_once '../model/clinic_task.php';
    $obj = new clinic_task();
    return $obj;
}