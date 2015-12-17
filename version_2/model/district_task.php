<?php
/**
 * This class interfaces contains queries that interface with the
 * district tasks database. It contains relevant queries necessary for
 * assigning tasks, retrieving tasks and updating tasks at a district level.
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

include_once 'adb.php';

class District_Task extends adb{

  
    /*
    This is a constructor for the district_task class 
    */
    function District_Task()
    {
        
    }
    
    /**
    * This function adds a new district_task given the required parameters
    * 
    *@param int $id this represents the unique identifier for each district task
    *@param String $taskTitle this is the title given to the task 
    *@param String $taskDes this is description for all activities involved in the task
    *@param String $clinics this represents the names one or more clinics assigned this task
    *@param String $date this is the date on which the new task was added  
    *@return bool the result will return true/false whether the sql query is successful
    */
    
    function addDistrictTask($taskTitle, $taskDesc, $clinics, $date)
    {
        
        $str_query = "INSERT INTO se_district_tasks SET
                      task_title = '$taskTitle',
                      task_desc = '$taskDesc',
                      clinics = '$clinics',
                      due_date = '$date'";
        return $this->query($str_query);
    }
    
    /**
    * This function updates an existing district_task given the required parameters
    *
    *@param int $id this represents the unique identifier for each district task
    *@param String $taskTitle this is the title given to the task 
    *@param String $taskDes this is description for all activities involved in the task
    *@param String $clinics this represents the names one or more clinics assigned this task
    *@param String $date this is the date on which the new task was added  
    *@return bool the result will return true/false whether the sql query is successful
    */
    function editDistrictTask($taskTitle, $taskDesc, $clinics,$date, $id)
    {
        $str_query = "UPDATE se_district_tasks SET
                      task_title = '$taskTitle',
                      task_desc = '$taskDesc',
                      clinics = '$clinics',
                      due_date = '$date'
                      WHERE task_id = '$id'";
        return $this->query($str_query);
    }
    
    
    /**
    *This function retrives the information for a given district task using its id
    *@param int $id this represents the unique identifier for each district task
    *@return bool the result will return true/false whether the sql query is successful
    */
    function getDistrictTask($id)
    {
        $str_query = "SELECT
                      task_title,
                      task_desc,
                      clinics,
                      due_date
                      FROM se_district_tasks
                      WHERE task_id = $id";
        return $this->query($str_query);
    }
    
    /**
    *This function adds retrives the information for all district_tasks stored in the database
    *@return bool the result will return true/false whether the sql query is successful
    */

    function getDistrictTasks()
    {
        $str_query = "SELECT
                      task_id,
                      task_title,
                      task_desc,
                      clinics,
                      due_date
                      FROM se_district_tasks";
        
        return $this->query($str_query);
    }

    /**
    *This function adds deletes the row storing data for a given district task using its id
    *@param int $id this represents the unique identifier for each district task
    *@return bool the result will return true/false whether the sql query is successful
    */
    
    function deleteDistrictTask($id)
    {
        $str_query = "DELETE FROM
                      se_district_tasks
                      WHERE task_id = $id";
        return $this->query($str_query);
    }
    
    /**
    *This function adds searches for the rows with names of district_tasks that match the pattern
    *@param int $sn this represents the name of the district_task
    *@return bool the result will return true/false whether the sql query is successful
    */
    
    function searchDistrictTaskByName($sn)
    {
        $str_query = "SELECT
                      task_id,
                      task_title,
                      task_desc,
                      clinics,
                      due_date
                      FROM se_district_tasks
                      WHERE task_name LIKE '%$sn%'";
        return $this->query($str_query);
    }
    
}

?>
