<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/23/15
 * Time: 6:18 PM
 */

include_once 'adb.php';

class district_task extends adb{

  
    /*
     *@constructor  district_task() Constructor for the district_task class 
    */
    function district_task()
    {
        
    }
    
    /**
    *@method boolean add_district_task() add_district_task($taskTitle, $taskDesc, $clinics, $date) Adds a new district_task given the required parameters
    *@param int $id The District ID
    *@param String $taskTitle this is the title given to the task 
    *@param String $taskDes this is description for all activities involved in the task
    *@param String $clinics this represents the names one or more clinics assigned this task
    *@param String $date this is the date on which the new task was added  
    *@return boolean
    */
    
    function add_district_task($taskTitle, $taskDesc, $clinics, $date)
    {
        
        $str_query = "insert into se_district_tasks set " . " task_title = '$taskTitle'," . "task_desc = '$taskDesc',". "clinics = '$clinics'," . "due_date = '$date'";
        return $this->query($str_query);
    }
    
    /**
    *@method boolean edit_district_task() edit_district_task($taskTitle, $taskDesc, $clinics,$date) Updates an existing district_task given the required parameters
    *@param int $id this represents the unique identifier for each district task
    *@param String $taskTitle this is the title given to the task 
    *@param String $taskDes this is description for all activities involved in the task
    *@param String $clinics this represents the names one or more clinics assigned this task
    *@param String $date this is the date on which the new task was added  
    *@return bool the result will return true/false whether the sql query is successful
    */
    function edit_district_task($taskTitle, $taskDesc, $clinics,$date)
    {
        $str_query = "update se_district_tasks set " .  "task_title = '$taskTitle'," . "task_desc = '$taskDesc'". "clinics = '$clinics'," . "due_date = '$date'". "where task_id = '$id'";
        return $this->query($str_query);
    }
    
    
    /**
    *@method boolean get_district_task() get_district_task($id) Retrives the information for a given district task using its id
    *@param int $id The District ID
    *@return boolean
    */
    function get_district_task($id)
    {
        $str_query = "select task_title, task_desc,clinics,due_date from se_district_tasks
                where task_id = $id";
        return $this->query($str_query);
    }
    
    /**
    *@method boolean get_district_tasks() Retrives the information for all district_tasks stored in the database
    *@return boolean
    */

    function get_district_tasks()
    {
        $str_query = "select task_id, task_title, task_desc,clinics,due_date from se_district_tasks";
        
        return $this->query($str_query);
    }

    /**
    *@method boolean delete_district_task() delete_district_task($id) Deletes the row storing data for a given district task using its id
    *@param int $id district task ID
    *@return bool the result will return true/false whether the sql query is successful
    */
    
    function delete_district_task($id)
    {
        $str_query = "delete from  se_district_tasks where task_id = $id";
        return $this->query($str_query);
    }
    
    /**
    *@method boolean search_district_task_by_name() search_district_task_by_name($sn) Searches for the rows with names of district_tasks that match the pattern
    *@param int $sn The name of the district_task
    *@return boolean
    */
    
    function search_district_task_by_name($sn)
    {
        $str_query = "select task_id, task_title, task_desc,clinics,due_date from se_district_tasks where task_name like '%$sn%'";
        return $this->query($str_query);
    }
    
}


/**
 * Unit Test and usage
 */
$obj = new district_task();
//$obj->add_district_task('Vacination','vaccination for polio kids in the north','Berekuso clinic', '21/03/2015');
//$obj = new district_task();
$obj->get_district_task(1);
$row = $obj->fetch();
print_r($row);
/*if(){
echo "Task:  " .$row ['task_title'];
}*/
echo "hello";
