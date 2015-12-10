<?php
/**
 * This class interfaces contains queries that interface with the
 * clinic tasks database. It contains relevant queries necessary for
 * assigning tasks, retrieving tasks and updating tasks.
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


/**
 * A database interface class
 *
 * The class below contains functions that interface with the database
 * via MYSQL
 */
include_once 'adb.php';

class clinic_task extends adb{

    /**
     * clinic_task constructor.
     *
     * this method instantiates an object of the clinic_task class
     */
    function clinic_task(){

    }

    /**
     * Executes a query to add a new task
     *
     * This method executes a query to assign a new task to a single nurse.
     * Tasks are assigned to nurses only by supervisors. This method inserts a
     * a new task into the se_clinic_tasks table if it is successful.
     *
     * @param $title: task title
     * @param $desc: task description
     * @param $nurses: id of nurse the task is assigned to
     * @param $supervisor: id of supervisor the task is assigned to
     * @param $due_date: the due date of the task
     * @param $due_time: the due time of the task
     * @param $clinic: id of clinic that the task is being assigned
     * @return bool: returns true/false indicating whether the query is successful of not
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
     * Executes a query to select all tasks
     *
     * This method executes a query that allows district administrators to view
     * all tasks assigned in various clinics within the district. It should
     * be accessible to only district administrators
     *
     * @return bool: returns true/false indicating whether the query is successful of not
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
                      CT.confirmed,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id";

        return $this->query($str_query);
    }


    /**
     * Executes a query to select all confirmed tasks in a given clinic
     *
     * This method executes a query that allows clinic supervisors to view
     * all confirmed tasks in their clinic. It should be accessible to only
     * clinic supervisors
     *
     * @param $clinic: id of clinic
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function get_all_confirmed_tasks($clinic){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.date_completed,
                      CT.confirmed,
                      CT.due_time,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND CT.clinic = $clinic
                      AND CT.confirmed = 'confirmed'";

        return $this->query($str_query);
    }


    /**
     * Executes a query to get all completed tasks in a clinic
     *
     * This method executes a query that allows clinic supervisors to view
     * all completed tasks in their clinic. It should be accessible to only
     * clinic supervisors
     *
     * @param $clinic: id of clinic
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function get_completed_tasks_by_clinic($clinic){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.date_completed,
                      CT.confirmed,
                      CT.due_time,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id AND CT.clinic = $clinic
                      AND DATEDIFF(CURDATE(), CT.date_completed) <= 7";

        return $this->query($str_query);
    }


    /**
     * Executes a query to get all tasks in a clinic
     *
     * This method is executes a query that allows clinic supervisors to view
     * all tasks in their clinic. It should be accessible to only
     * clinic supervisors
     *
     * @param $clinic: id of clinic
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function get_all_clinic_tasks($clinic){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      CT.confirmed,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id AND CT.clinic = $clinic
                      ORDER BY CT.due_date DESC";

        return $this->query($str_query);
    }

    /**
     * Executes a query to get a task by the tasks id
     *
     * This method executes a query to select the details of a single task
     * by using the tasks unique id
     *
     * @param $id: id of the task
     * @return bool: returns true/false indicating whether the query is successful of not
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
                      CT.confirmed,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND task_id = $id";

        return $this->query($str_query);
    }

    /**
     * Executes a query to get a task by the date completed
     *
     * This method executes a query to select all tasks that were
     * completed on a given date
     *
     * @param $date: date task was completed
     * @return bool: returns true/false indicating whether the query is successful of not
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
                      CT.confirmed,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND CT.date_completed = '$date'";

        return $this->query($str_query);
    }


    /**
     * Executes a query to get a task by the date assigned
     *
     * This method executes a query to select all tasks that were
     * assigned on a given date
     *
     * @param $date: date task was assigned
     * @return bool: returns true/false indicating whether the query is successful of not
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
                      CT.confirmed,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND CT.date_assigned = '$date'";

        return $this->query($str_query);
    }


    /**
     * Executes a query to get all due tasks in a clinic
     *
     * This method executes a query that allows clinic supervisors to view
     * all due tasks in their clinic. It should be accessible to only
     * clinic supervisors
     *
     * @param $clinic: id of clinic
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function get_due_tasks($clinic){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      CT.confirmed,
                      N.fname,
                      N.sname,
                      DATEDIFF(CURDATE(), due_date) As overdue_days,
                      TIMEDIFF(CURTIME(), due_date) As overdue_time
                      FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND CT.clinic = $clinic
                      AND DATEDIFF(CURDATE(), due_date) >= 0";

        return $this->query($str_query);
    }


    /**
     * Executes a query to confirm the execution of a task by a nurse
     *
     * This method executes a query that allows clinic supervisors to
     * confirm that a given task has been executed. It does so by updating
     * the confirmation status of a given task.
     * It should be accessible to only clinic supervisors
     *
     * @param $id: id of task
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function confirm_task($id){
        $str_query = "UPDATE se_clinic_tasks SET
                      confirmed = 'confirmed'
                      WHERE task_id = $id";

        return $this->query($str_query);
    }

    /**
     * Executes a query to get all due tasks assigned to a nurse
     *
     * This method executes a query that allows a nurses to view
     * all their due tasks.
     *
     * @param $nurse: id of nurse
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function get_nurse_due_task($nurse){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      CT.confirmed,
                      N.fname,
                      N.sname,
                      DATEDIFF(CURDATE(), CT.due_date) As overdue_days,
                      TIMEDIFF(CURTIME(), CT.due_time) As overdue_time
                      FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND assigned_to = $nurse
                      AND DATEDIFF(CURDATE(), CT.due_date) >= 0";

        return $this->query($str_query);
    }


    /**
     * Executes a query to get all tasks assigned to a nurse
     *
     * This method executes a query that allows a nurses to view
     * all their tasks.
     *
     * @param $nurse: id of nurse
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function get_nurse_completed_tasks($nurse){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      CT.date_completed,
                      CT.confirmed,
                      N.fname,
                      N.sname,
                      DATEDIFF(CURDATE(), due_date) As overdue_days,
                      TIMEDIFF(CURTIME(), due_time) As overdue_time
                      FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND CT.assigned_to = $nurse
                      AND CT.date_completed <> '0000-00-00'";

        return $this->query($str_query);
    }



    /**
     * Executes a query to get all confirmed tasks assigned to a nurse
     *
     * This method executes a query that allows a nurses to view
     * all their confirmed tasks.
     *
     * @param $nurse: id of nurse
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function get_nurse_cofirmed_tasks($nurse){
        $str_query = "SELECT
                      CT.task_id,
                      CT.task_title,
                      CT.task_desc,
                      CT.assigned_by,
                      CT.assigned_to,
                      CT.date_assigned,
                      CT.due_date,
                      CT.due_time,
                      CT.date_completed,
                      CT.confirmed,
                      N.fname,
                      N.sname,
                      DATEDIFF(CURDATE(), due_date) As overdue_days,
                      TIMEDIFF(CURTIME(), due_time) As overdue_time
                      FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND CT.assigned_to = $nurse
                      AND CT.confirmed = 'confirmed'";

        return $this->query($str_query);
    }

    /**
     * Executes a query to select all tasks and order them in according to due date
     *
     * This method executes a query that allows district administrators to view
     * all tasks assigned in various clinics within the district. It should
     * be accessible to only district administrators
     *
     * @return bool: returns true/false indicating whether the query is successful of not
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
                      CT.confirmed,
                      CT.due_time,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      ORDER BY CT.due_date DESC";

        return $this->query($str_query);
    }


    /**
     * Executes a query to update a completed task
     *
     * This method executes a query that allows a nurses to update
     * a completed task.
     *
     * @param $task_id: id of task completed
     * @param $nurse_id: id of nurse
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function update_time_completed($task_id, $nurse_id){
        $str_query = "UPDATE se_clinic_tasks SET
                      date_completed = CURDATE()
                      WHERE task_id = $task_id AND assigned_to = $nurse_id";

        return $this->query($str_query);
    }

    /**
     * Executes a query to get all tasks completed in a week
     *
     * This method executes a query that fetches all completed tasks
     * in a week.
     *
     * @return bool: returns true/false indicating whether the query is successful of not
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
                      CT.confirmed,
                      CT.due_time,
                      N.fname,
                      N.sname FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND DATEDIFF(CURDATE(), CT.date_completed) <= 7";

        return $this->query($str_query);
    }

    /**
     * Executes a search query to find a task by the given title
     *
     * This method executes a query to find a task by the task title
     *
     * @param $search_task: search text for the search query
     * @return bool: returns true/false indicating whether the query is successful of not
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
                      CT.confirmed,
                      N.fname,
                      N.sname
                      FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND CT.task_title LIKE '%$search_task%'";

        return $this->query($str_query);
    }

    /**
     * Executes search query to search task for given nurses
     *
     * This method executes a query to find a task assigned to a particular
     * nurse
     *
     * @param $nurse: id of the nurse
     * @param $search_text: search text for the search query
     * @return bool: returns true/false indicating whether the query is successful of not
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
                      CT.confirmed,
                      N.fname,
                      N.sname
                      FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND CT.task_title LIKE '%$search_text%'
                      AND CT.assigned_to = $nurse";

        return $this->query($str_query);
    }


    /**
     * Executes a query to show tasks assigned to a nurse in the last 30 days
     *
     * This method executes a query to show all tasks to assigned to a nurse
     * over the last 30 days
     *
     * @param $nurse: nurse id
     * @return bool: returns true/false indicating whether the query is successful of not
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
                      CT.confirmed,
                      CT.date_completed,
                      N.fname,
                      N.phone,
                      N.nurse_id,
                      N.sname
                      FROM se_clinic_tasks CT, se_nurses N
                      WHERE CT.assigned_to = N.nurse_id
                      AND CT.assigned_to = $nurse
                      AND DATEDIFF(CT.date_assigned, CURDATE()) <= 30 ";

        return $this->query($str_query);
    }
}
