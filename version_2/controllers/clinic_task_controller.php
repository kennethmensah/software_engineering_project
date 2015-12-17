<?php
/**
 * start a session to allow access to user values
 */
session_start();


/**
 * This class interfaces with the javascript and produces
 * JSON response to respond to request made from the user interface
 * It contains relevant controller function for adding a clinic task
 * editing, and viewing clinic tasks.
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



if(filter_input (INPUT_GET, 'cmd')){
    $cmd = $cmd_sanitize = '';
    $cmd_sanitize = sanitizeString( filter_input (INPUT_GET, 'cmd'));
    $cmd = intval($cmd_sanitize);

    switch ($cmd){
        case 1:
            addTaskControl();
            break;
        case 2:
            /**
             * retrieve all tasks
             */
            getTasksControl();
            break;
        case 3:
            confirmTaskControl();
            break;
        case 4:
            /**
             * retrieve particular task
             */
            getTaskControl();
            break;
        case 5:
            /**
             * get task by nurse id
             */
            getNurseTaskControl();
            break;
        case 6:
            /**
             * get tasks overdue
             */
            getNurseDueTasksControl();
            break;
        case 7:
            //get_clinic_tasks();

            break;

        case 8:
            /**
             * function to generate report
             */
            break;
        case 9:
            getCompletedTasksControl();
            break;
        case 10:
            getConfirmedTasksControl();
            break;
        case 11:
            getDueTasksControl();
            break;

        case 12:
            /**
             * function to indicate that a task has been completed
             */
            completeTaskControl();
            break;

        case 13:
            /**
             * function to get the competed tasks of a nurse
             */
            getNurseCompletedTaskControl();
            break;

        case 14:
            getNurseConfirmedTaskControl();
            break;
        default:
            echo '{"result":0, "message":"Invalid Command Entered"}';
            break;
    }
}

/**
 * controller method to add a task
 */
function addTaskControl(){

    if( filter_input (INPUT_GET, 'title') && filter_input (INPUT_GET, 'desc')
        && filter_input (INPUT_GET, 'nurse') && filter_input (INPUT_GET, 'supervisor')
        && filter_input (INPUT_GET, 'date') && filter_input (INPUT_GET, 'time')
        && filter_input (INPUT_GET, 'clinic')){

        //create an object of the Clinic Task Class
        $obj =  getClinicTaskModel();

        //obtain task assignment details from the url / browser
        $title = sanitizeString(filter_input (INPUT_GET, 'title'));
        $desc = sanitizeString(filter_input (INPUT_GET, 'desc'));
        $nurse = sanitizeString(filter_input (INPUT_GET, 'nurse'));
        $supervisor = sanitizeString(filter_input (INPUT_GET, 'supervisor'));
        $due_date = sanitizeString(filter_input (INPUT_GET, 'date'));
        $due_time = sanitizeString(filter_input (INPUT_GET, 'time'));
        $clinic  = sanitizeString(filter_input (INPUT_GET, 'clinic'));


        if ($obj->addClinicTask($title, $desc, $nurse, $supervisor, $due_date, $due_time, $clinic)){

            //encode the JSON message for a successfully added task
            echo '{"result":1,"message": "task added successfully"}';
        }
        else
        {

            //encode the JSON message for an unsuccessful query execution
            echo '{"result":0,"message": "unable to add task"}';
        }

    }
}

/**
 * function to get all tasks
 */
function getTasksControl(){

    $obj = getClinicTaskModel();
    if ($obj->getClinicTasks()){
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
function getTaskControl(){
    if( filter_input (INPUT_GET, 'id')){

        $obj = getClinicTaskModel();
        $id = sanitizeString(filter_input (INPUT_GET, 'id'));

        if ($obj->getTaskById($id)){
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
function getNurseTaskControl(){
    if( filter_input (INPUT_GET, 'id')){

        $obj = getClinicTaskModel();
        $id = sanitizeString(filter_input (INPUT_GET, 'id'));

        if ($obj->getAllNurseTasks($id)){
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
function confirmTaskControl(){
    if( filter_input (INPUT_GET, 'id')){

        $obj = getClinicTaskModel();
        $id = sanitizeString(filter_input (INPUT_GET, 'id'));

        if($obj->confirmTask($id)){
            echo '{"result":1,"message":"task confirmed"}';
        }else{
            echo '{"result":0,"message":"query unsuccessful"}';
        }
    }
}

/**
 * this function fetches all tasks assigned in a particular clinic
 */
function getClinicTasksControl(){
    if( filter_input (INPUT_GET, 'clinic')){

        $obj = getClinicTaskModel();
        $id = sanitizeString(filter_input (INPUT_GET, 'clinic'));

        if ($obj->getAllClinicTasks($id)){
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


function getCompletedTasksControl(){
    if( filter_input (INPUT_GET, 'clinic')){

        $obj = getClinicTaskModel();
        $id = sanitizeString(filter_input (INPUT_GET, 'clinic'));

        if ($obj->getCompletedTasksByClinic($id)){
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
function getConfirmedTasksControl(){
    if( filter_input (INPUT_GET, 'clinic')){

        $obj = getClinicTaskModel();
        $id = sanitizeString(filter_input (INPUT_GET, 'clinic'));

        if ($obj->getAllConfirmedTasks($id)){
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


function getDueTasksControl(){
    if( filter_input (INPUT_GET, 'clinic')){

        $obj = getClinicTaskModel();
        $id = sanitizeString(filter_input (INPUT_GET, 'clinic'));

        if ($obj->getDueTasks($id)){
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

function completeTaskControl(){
    if( filter_input (INPUT_GET, 'nurse') && filter_input (INPUT_GET, 'task')){

        $obj = getClinicTaskModel();
        $nurse = sanitizeString(filter_input (INPUT_GET, 'nurse'));
        $task = sanitizeString(filter_input (INPUT_GET, 'task'));

        if($obj->updateTimeCompleted($task, $nurse)){
            echo '{"result":1,"message":"task marked as complete"}';
        }else{
            echo '{"result":0,"message":"query unsuccessful"}';
        }
    }
}


function getNurseCompletedTaskControl(){
    if( filter_input (INPUT_GET, 'id')){

        $obj = getClinicTaskModel();
        $id = sanitizeString(filter_input (INPUT_GET, 'id'));

        if ($obj->getNurseCompletedTasks($id)){
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


function getNurseConfirmedTaskControl(){
    if( filter_input (INPUT_GET, 'id')){

        $obj = getClinicTaskModel();
        $id = sanitizeString(filter_input (INPUT_GET, 'id'));

        if ($obj->getNurseConfirmedTasks($id)){
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


function getNurseDueTasksControl(){
    if( filter_input (INPUT_GET, 'id')){

        $obj = getClinicTaskModel();
        $id = sanitizeString(filter_input (INPUT_GET, 'id'));

        if ($obj->getNurseDueTask($id)){
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
 * @param string $val value from the post/get request method
 * @return string
 */
function sanitizeString($val){
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlentities($val);

    return $val;
}


/**
 * @return Clinic_Task
 */
function getClinicTaskModel(){
    require_once '../model/clinic_task.php';
    $obj = new Clinic_Task();
    return $obj;
}