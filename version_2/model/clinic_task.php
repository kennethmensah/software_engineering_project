<?php
/**
    *@author Group 4
    *@version 2.0.0
    *@copyright Copyright (c) 2015, Group 4
*/

include_once 'adb.php';

class clinic_task extends adb{

    /*
    *
    *@constructor clinic_task() Contructor of clinic_task class
    */
    function clinic_task(){

    }

    /**
     * @method boolean add_clinic_task() add_clinic_task($title, $desc, $nurses, $supervisor, $due_date, $due_time, $clinic ) executes a query to add a new task
     * @param string $title The title of task
     * @param string $desc Description of task
     * @param int $nurses Nurse ID
     * @param int $supervisor Supervisor ID
     * @param date $due The due date
     * @param string $clinic The Clinic
     * @return boolean
     */
    function add_clinic_task($title, $desc, $nurses, $supervisor, $due_date, $due_time, $clinic ){
        $str_query = "INSERT INTO se_clinic_tasks SET
                      task_title = '$title',
                      task_desc = '$desc',
                      assigned_to = $nurses,
                      assigned_by = $supervisor,
                      date_assigned = CURDATE(),
                      date_completed = '0000-00-00',
                      due_date = '$due_date',
                      due_time = '$due_time',
                      confirmed = 'not',
                      clinic = $clinic";

        return $this->query($str_query);
    }


    /**
     * @method boolean get_clinic_tasks() executes a query to select all tasks
     * @return boolean
     */
    function get_clinic_tasks(){

        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id";

        return $this->query($str_query);
    }

    /**
     * @method boolean get_task_by_Id() get_task_by_Id($id) Gets task by ID
     * @param int $id The Task ID
     * @return boolean
     */
    function get_task_by_Id($id){

        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND task_id = $id";

        return $this->query($str_query);
    }

    /**
     * @method boolean get_by_date_completed() get_by_date_completed($date) Gets tasks by date completed
     * @param Date $date The completed date
     * @return boolean
     */
    function get_by_date_completed($date){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND CT.date_completed = '$date'";

        return $this->query($str_query);
    }

    /**
     * @method boolean get_by_date_assigned() get_by_date_assigned($date) Gets tasks by date assigned
     * @param date $date The date assigned
     * @return boolean
     */
    function get_by_date_assigned($date){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND CT.date_assigned = '$date'";

        return $this->query($str_query);
    }


//    /**
//     * Function For supervisors to view due tasks of all nurses
//     * @return bool
//     */
//    function get_due_tasks(){
//        $str_query = "SELECT
//                      task_id,
//                      task_title,
//                      task_desc,
//                      assigned_by,
//                      assigned_to,
//                      date_assigned,
//                      due_date,
//                      due_time,
//                      DATEDIFF(CURDATE(), due_date) As overdue_days,
//                      TIMEDIFF(CURTIME(), due_date) As overdue_time
//                      FROM se_clinic_tasks WHERE DATEDIFF(CURDATE(), due_date) > 0";
//
//        return $this->query($str_query);
//    }
//    
    /**
     * @method boolean get_overdue_tasks() Gets overdue tasks of all nurses
     * @return boolean
     */
    function get_overdue_tasks(){
        $str_query = "SELECT
                      task_id,
                      task_title,
                      task_desc,
                      assigned_by,
                      assigned_to,
                      date_assigned,
                      due_date,
                      due_time,
                      DATEDIFF(CURDATE(), due_date) As overdue_days,
                      TIMEDIFF(CURTIME(), due_date) As overdue_time
                      FROM se_clinic_tasks WHERE DATEDIFF(CURDATE(), due_date) >= 0";

        return $this->query($str_query);
    }


    /**
     * @method boolean confirm_task() confirm_task($id) confirm tasks
     * @param int $id The Task ID
     * @return boolean
     */
    function confirm_task($id){
        $str_query = "UPDATE se_clinic_tasks SET
                      confirmed = 'confirmed'
                      WHERE task_id = $id";

        return $this->query($str_query);
    }

    /**
     * @method boolean  get_nurse_due_task()  get_nurse_due_task($id) Gets overdue tasks assigned to nurse
     * @param int $id The nurse ID
     * @return boolean
     */
    function get_nurse_due_task($id){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      N.fname,
                      N.sname,
                      DATEDIFF(CURDATE(), due_date) As overdue_days,
                      TIMEDIFF(CURTIME(), due_time) As overdue_time
                      FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND assigned_to = $id";

        return $this->query($str_query);
    }

    /**
     * @method boolean get_all_tasks() Get all tasks
     * @return boolean
     */
    function get_all_tasks(){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      ORDER BY CT.due_date DESC";

        return $this->query($str_query);
    }


    /**
     * @method boolean update_time_completed() update_time_completed($task_id, $nurse_id) Set task completed time
     * @param int $task_id Task ID
     * @param int $nurse_id Nurse ID
     * @return boolean
     */
    function update_time_completed($task_id, $nurse_id){
        $str_query = "UPDATE se_clinic_tasks SET
                      date_completed = CURDATE()
                      WHERE task_id = $task_id AND assigned_to = $nurse_id";

        return $this->query($str_query);
    }

    /**
     * @method boolean get_completed_for_week() Get completed tasks for the week
     * @return boolean
     */
    function get_completed_for_week(){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND DATEDIFF(CURDATE(), CT.date_completed) <= 7";

        return $this->query($str_query);
    }

    /**
     * @method boolean search_task() search_task($search_task) executes a search query to find a task by the given title
     * @param string $search_task The search item
     * @return boolean
     */
    function search_task($search_task){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      N.fname,
                      N.sname
                      FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND CT.task_title LIKE '%$search_task%'";

        return $this->query($str_query);
    }

    /**
     * @method boolean search_task_by_nurse() search_task_by_nurse($nurse, $search_text) executes search query to search task for given nurses
     * @param string $nurse The nurse
     * @param string $search_text The search item
     * @return boolean
     */
    function search_task_by_nurse($nurse, $search_text){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      N.fname,
                      N.sname
                      FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND CT.task_title LIKE '%$search_text%'
                      AND CT.assigned_to = $nurse";

        return $this->query($str_query);
    }


    /**
     * @method boolean get_all_nurse_tasks() get_all_nurse_tasks($nurse) executes a query to show tasks assigned to nurses in the last 30 days
     * @param string $nurse The nurse
     * @return boolean
     */
    function get_all_nurse_tasks($nurse){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      N.fname,
                      N.sname
                      FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND CT.assigned_to = $nurse
                      AND DATEDIFF(CT.date_assigned, CURDATE()) <= 30 ";

        return $this->query($str_query);
    }



}

//$nurses = array("3","2","4");
//
//$nurses = serialize($nurses);

//$obj = new clinic_task();
//$obj->add_clinic_task('Yellow Fever Vaccination', 'Perform vaccination on 30 pregnant women', $nurses, 1, '2015-12-23','12.00.00',1);
//
//if($obj->get_nurse_due_task(4)){
//    $row = $obj->fetch();
//    $nurse = unserialize($row['assigned_to']);
//    print_r($nurse);
//    echo $row['task_title'];
//}
//$obj->confirm_task(1);
//$obj->update_time_completed(3, 1);

 /*@method boolean update_task_date() update_task_date($task_id) Updates the tasks date of completion by the nurse in the database.
  *@param int $task_id The task ID
  *@return boolean
  */
    function update_task_date($task_id){
    	$date = date("Y,=/m/d");
    	$str_query = "update clinic_task 
    	set date_completed = '$date' where comfirmed = yes";
    	return $this->query($str_query);
    }

 /*@method boolean delete_task() delete_task($task_id) Delete tasks form the database.
  *@param int $task_id The task ID
  *@return boolean
  */
    function delete_task($task_id){
    	$str_query = "delete from clinic_task where id = $task_id";
    	return $this->query($str_query);
    }
}
