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
            *Adds Task to database
            */
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
             * retrieve a particular task
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
            overdue_tasks();
            break;
        default:
            echo '{"result":0, "message":"Invalid Command Entered"}';
            break;
    }
}

/**
 *@method void add_task_control() Adds a task to the database
 */
function add_task_control(){

    if( filter_input (INPUT_GET, 'title') && filter_input (INPUT_GET, 'desc')
        && filter_input (INPUT_GET, 'nurse') && filter_input (INPUT_GET, 'supervisor')
        && filter_input (INPUT_GET, 'date') && filter_input (INPUT_POST, 'time')
        && filter_input (INPUT_POST, 'clinic')){

        $obj =  get_clinic_task_model();

        $title = sanitize_string(filter_input (INPUT_POST, 'title'));
        $desc = sanitize_string(filter_input (INPUT_POST, 'desc'));
        $nurse = sanitize_string(filter_input (INPUT_GET, 'nurse'));
        $supervisor = sanitize_string(filter_input (INPUT_POST, 'supervisor'));
        $due_date = sanitize_string(filter_input (INPUT_POST, 'date'));
        $due_time = sanitize_string(filter_input (INPUT_POST, 'time'));
        $clinic  = sanitize_string(filter_input (INPUT_POST, 'clinic'));


        if ($obj->$obj->add_clinic_task($title, $desc, $nurse, $supervisor, $due_date,$due_time, $clinic)){
            echo '{"result":1,"message": "task added successfully"}';
        }
        else
        {
            echo '{"result":0,"message": "unable to add task"}';
        }

    }
}

/**
 *@method void get_tasks_control() Gets tasks from the database
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
 *@method get_task_control() Get a task from the database
 */
function get_task_control(){
    if( filter_input (INPUT_GET, 'id')){

        $obj = get_clinic_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'id'));

        if ($obj->get_task_by_Id($id)){
            echo '{"result":1, "overdue_tasks":[';
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
 *@method void get_nurse_task_control() Gets tasks assigned a particular nurse
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
 *@method void confirm_task_control() Confirms tasks finished by nurse
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
 *@method void overdue_tasks() Gets all overdue tasks in database
 */
function overdue_tasks(){
    $obj = get_clinic_task_model();
    if ($obj->get_overdue_tasks()){
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
 * @return clinic_task
 */
function get_clinic_task_model(){
    require_once '../model/clinic_task.php';
    $obj = new clinic_task();
    return $obj;
}