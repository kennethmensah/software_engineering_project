<?php



if(filter_input (INPUT_GET, 'cmd')){
    $cmd = $cmd_sanitize = '';
    $cmd_sanitize = sanitize_string( filter_input (INPUT_GET, 'cmd'));
    $cmd = intval($cmd_sanitize);
                                    
    switch ($cmd){
        case 1:
           /**
            * Add a new district task
            */
            add_district_task_control();
            break;
        case 2:
            /**
            * update an exisiting district task
            */
            update_district_task_control();
            break;
        case 3:
            /**
            * retrieve a specfic district task
            */
            get_district_task_control();
            break;
        case 4:
            /**
            * retrieve all district tasks in DB
            */
            get_district_tasks_control();
            break;
        case 5:
            /**
            * delete a specfic district task
            */
            search_by_taskname_control();
            break;      
        case 6:
            /**
            * delete a specfic district task
            */
            delete_district_task_control();
            break;    
        default:
            echo '{"result":0, "message":"Invalid Command Entered"}';
            break;
    }
}

/**
 * Controller method to add a new district task
 */
function add_district_task_control(){
    
    $obj  = $task_title = $task_desc = $clinics = $date = '';
    
    if( filter_input (INPUT_GET, 'task_title') && filter_input(INPUT_GET, 'task_desc')
        && filter_input(INPUT_GET, 'clinics') && filter_input(INPUT_GET, 'date')){
    
        $obj = get_district_task_model();
        $task_title = sanitize_string(filter_input (INPUT_GET, 'task_title'));
        $task_desc = sanitize_string(filter_input (INPUT_GET, 'task_desc'));
        $clinics = sanitize_string(filter_input (INPUT_GET, 'clinics'));
        $date = sanitize_string(filter_input(INPUT_GET, 'date'));
        
        if ($obj->add_user($task_title, $task_desc, $clinics, $date)){
            echo '{"result":0,"message": "addition of new task was successful"}';
        }
        
        else
        {
            echo '{"result":0,"message": "addition of new task was unsuccessful"}';
        }
        
    }
}
/**
 * Controller method to update data for an existing district task
 */
function update_district_task_control(){
    
    $obj  = $task_title = $task_desc = $clinics = $date = $id ='';
    
    if(filter_input(INPUT_GET, 'id') && filter_input (INPUT_GET, 'task_title') && filter_input(INPUT_GET, 'task_desc')
        && filter_input(INPUT_GET, 'clinics') && filter_input(INPUT_GET, 'date')){
    
        $obj = get_district_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'id'));
        $task_title = sanitize_string(filter_input (INPUT_GET, 'task_title'));
        $task_desc = sanitize_string(filter_input (INPUT_GET, 'task_desc'));
        $clinics = sanitize_string(filter_input (INPUT_GET, 'clinics'));
        $date = sanitize_string(filter_input(INPUT_GET, 'date'));
        
        if ($obj->update_district_task($id,$task_title, $task_desc, $clinics, $date)){
            echo '{"result":0,"message": "updating of new task was successful"}';
        }
        
        else
        {
            echo '{"result":0,"message": "updating of new task unsuccessful"}';
        }
        
    }
}

/**
 * Controller method to retrieve data of a specific district task
 */
function get_district_task_control(){
    
    $obj  = $id = $result = '';
    
    if(filter_input(INPUT_GET, 'id'){
    
        $obj = get_district_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'id'));
        
        
        if ($obj->get_district_task($id)){
           $result =$obj->get_district_task($id);
           $result = json_encode($result);        }
        
        else
        {
            echo '{"result":0,"message": "getting specified task  was unsuccessful"}';
        }
        
        return $result;
    }
}

/**
 * Controller method to retrive data for all district tasks
 */
function get_district_tasks_control(){
    
    $obj  = $result = '';
    
    
        $obj = get_district_task_model();
        
        
        
        if ($obj->get_district_tasks()){
           $result =$obj->get_district_tasks();
           $result = json_encode($result);        }
        
        else
        {
            echo '{"result":0,"message": "getting all district tasks was unsuccessful"}';
        }
        
        return $result;
    }

/**
 * Controller method to delete an existing district task
 */
function delete_district_task_control(){
    
    $obj  = $id = '';
    
    if(filter_input(INPUT_GET, 'id'){
    
        $obj = get_district_task_model();
        $id = sanitize_string(filter_input (INPUT_GET, 'id'));
        
        
        if ($obj->delete_district_task($id)){

            echo '{"result":0,"message": "deletion of specified task successful"}';
        }
        
        else
        {
            echo '{"result":0,"message": "deletion of new task unsuccessful"}';
        }
        
        return $result;
    }
}

/**
 * Controller method to search district tasks based on task name/title
 */
function search_by_taskname_control(){
    
    $obj  = $name = $result = '';
    
    
        $obj = get_district_task_model();
        
        
        
        if ($obj->search_district_task_by_name()){
           $result =$obj->search_district_task_by_name($name);
           $result = json_encode($result);        
       }
        
        else
        {
            echo '{"result":0,"message": "getting specified district task was unsuccessful"}';
        }
        
        return $result;
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
    require_once '../model/user.php';
    $obj = new district_task();
    return $obj;
}



?>