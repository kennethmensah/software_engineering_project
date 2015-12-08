<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/23/15
 * Time: 6:17 PM
 */

include_once 'adb.php';

class clinic_task extends adb{

    function clinic_task(){

    }

    /**
     * executes a query to add a new task
     * @param $title
     * @param $desc
     * @param $nurses
     * @param $supervisor
     * @param $due
     * @param $clinic
     * @return bool
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
     * executes a query to select all tasks
     * @return bool
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
     * @param $id
     * @return bool
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
     * @param $date
     * @return bool
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
     * @param $date
     * @return bool
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
     * Function For supervisors to view overdue tasks of all nurses
     * @return bool
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
     * Function for supervisors to confirm tasks
     * @param $id
     * @return bool
     */
    function confirm_task($id){
        $str_query = "UPDATE se_clinic_tasks SET
                      confirmed = 'confirmed'
                      WHERE task_id = $id";

        return $this->query($str_query);
    }

    /**
     * Function to view overdue tasks assigned to nurse
     * @param $id
     * @return bool
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
     * function to get all tasks
     * @return bool
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
     * function to set task completed time
     * @param $task_id
     * @param $nurse_id
     * @return bool
     */
    function update_time_completed($task_id, $nurse_id){
        $str_query = "UPDATE se_clinic_tasks SET
                      date_completed = CURDATE()
                      WHERE task_id = $task_id AND assigned_to = $nurse_id";

        return $this->query($str_query);
    }

    /**
     * Function to get completed tasks for the year
     * @return bool
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
     * executes a search query to find a task by the given title
     * @param $search_task
     * @return bool
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
     * executes search query to search task for given nurses
     * @param $nurse
     * @param $search_text
     * @return bool
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
     * executes a query to show tasks assigned to nurses in the
     * last 30 days
     * @param $nurse
     * @return bool
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