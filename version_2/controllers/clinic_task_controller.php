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
            /**
             * retrieve all tasks
             */
            get_tasks_control();
            break;
        case 3:
            confirm_task_control();
            break;
        case 4:
            /**
             * retrieve particular task
             */
            get_task_control();
            break;
        case 5:
            /**
             * get task by nurse id
             */
            get_nurse_task_control();
            break;
        case 6:
            /**
             * get tasks overdue
             */
            get_nurse_due_tasks_control();
            break;
        case 7:
            get_clinic_tasks();
            break;

        case 8:
            generate_report();
            break;
        case 9:
            get_completed_tasks();
            break;
        case 10:
            get_confirmed_tasks();
            break;
        case 11:
            get_due_tasks();
            break;

        case 12:
            complete_task_control();
            break;

        case 13:

            get_nurse_completed_task_control();

            break;

        case 14:
            get_nurse_confirmed_task_control();
            break;
        default:
            echo '{"result":0, "message":"Invalid Command Entered"}';
            break;
    }
}


function generate_report(){
    if( filter_input (INPUT_GET, 'nurse_id')){

        $obj = get_clinic_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'nurse_id'));

        if ($obj->get_task_by_Id($id)){
            echo '{"result":1, "clinic_tasks":[';
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
}

/**
 * controller method to add a task
 */
function add_task_control(){

    if( filter_input (INPUT_GET, 'title') && filter_input (INPUT_GET, 'desc')
        && filter_input (INPUT_GET, 'nurse') && filter_input (INPUT_GET, 'supervisor')
        && filter_input (INPUT_GET, 'date') && filter_input (INPUT_GET, 'time')
        && filter_input (INPUT_GET, 'clinic')){

        $obj =  get_clinic_task_model();

        $title = sanitize_string(filter_input (INPUT_GET, 'title'));
        $desc = sanitize_string(filter_input (INPUT_GET, 'desc'));
        $nurse = sanitize_string(filter_input (INPUT_GET, 'nurse'));
        $supervisor = sanitize_string(filter_input (INPUT_GET, 'supervisor'));
        $due_date = sanitize_string(filter_input (INPUT_GET, 'date'));
        $due_time = sanitize_string(filter_input (INPUT_GET, 'time'));
        $clinic  = sanitize_string(filter_input (INPUT_GET, 'clinic'));


        if ($obj->add_clinic_task($title, $desc, $nurse, $supervisor, $due_date, $due_time, $clinic)){
            echo '{"result":1,"message": "task added successfully"}';
        }
        else
        {
            echo '{"result":0,"message": "unable to add task"}';
        }

    }
}

/**
 * function to get all tasks
 */
function get_tasks_control(){
    $obj = get_clinic_task_model();
    if ($obj->get_clinic_tasks()){
        echo '{"result":1, "clinic_tasks":[';
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

/**
 * function that retrieve a particular task
 */
function get_task_control(){
    if( filter_input (INPUT_GET, 'id')){

        $obj = get_clinic_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'id'));

        if ($obj->get_task_by_Id($id)){
            echo '{"result":1, "clinic_tasks":[';
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
}


/**
 * returns all nurse task for the last 30 days
 */
function get_nurse_task_control(){
    if( filter_input (INPUT_GET, 'id')){

        $obj = get_clinic_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'id'));

        if ($obj->get_all_nurse_tasks($id)){
            echo '{"result":1, "clinic_tasks":[';
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
}

/**
 * confirm task
 */
function confirm_task_control(){
    if( filter_input (INPUT_GET, 'id')){

        $obj = get_clinic_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'id'));

        if($obj->confirm_task($id)){
            echo '{"result":1,"message":"task confirmed"}';
        }else{
            echo '{"result":0,"message":"query unsuccessful"}';
        }
    }
}

/**
 * this function fetches all tasks assigned in a particular clinic
 */
function get_clinic_tasks(){
    if( filter_input (INPUT_GET, 'clinic')){

        $obj = get_clinic_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'clinic'));

        if ($obj->get_all_clinic_tasks($id)){
            echo '{"result":1, "clinic_tasks":[';
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
}


function get_completed_tasks(){
    if( filter_input (INPUT_GET, 'clinic')){

        $obj = get_clinic_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'clinic'));

        if ($obj->get_completed_tasks_by_clinic($id)){
            echo '{"result":1, "clinic_tasks":[';
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
}

/**
 * this function retrieves confirmed tasks
 */
function get_confirmed_tasks(){
    if( filter_input (INPUT_GET, 'clinic')){

        $obj = get_clinic_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'clinic'));

        if ($obj->get_all_confirmed_tasks($id)){
            echo '{"result":1, "clinic_tasks":[';
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
}


function get_due_tasks(){
    if( filter_input (INPUT_GET, 'clinic')){

        $obj = get_clinic_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'clinic'));

        if ($obj->get_due_tasks($id)){
            echo '{"result":1, "clinic_tasks":[';
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
}

function complete_task_control(){
    if( filter_input (INPUT_GET, 'nurse') && filter_input (INPUT_GET, 'task')){

        $obj = get_clinic_task_model();
        $nurse = sanitize_string(filter_input (INPUT_GET, 'nurse'));
        $task = sanitize_string(filter_input (INPUT_GET, 'task'));

        if($obj->update_time_completed($task, $nurse)){
            echo '{"result":1,"message":"task marked as complete"}';
        }else{
            echo '{"result":0,"message":"query unsuccessful"}';
        }
    }
}


function get_nurse_completed_task_control(){
    if( filter_input (INPUT_GET, 'id')){

        $obj = get_clinic_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'id'));

        if ($obj->get_nurse_completed_tasks($id)){
            echo '{"result":1, "clinic_tasks":[';
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
}


function get_nurse_confirmed_task_control(){
    if( filter_input (INPUT_GET, 'id')){

        $obj = get_clinic_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'id'));

        if ($obj->get_nurse_cofirmed_tasks($id)){
            echo '{"result":1, "clinic_tasks":[';
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
}


function get_nurse_due_tasks_control(){
    if( filter_input (INPUT_GET, 'id')){

        $obj = get_clinic_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'id'));

        if ($obj->get_nurse_due_task($id)){
            echo '{"result":1, "clinic_tasks":[';
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