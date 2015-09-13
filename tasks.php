<?php
    include_once("adb.php");

class tasks extends adb{
    
    function tasks(){
        
    }
    
    function add_task($description, $nurse, $assigned_by, $admin, $p, $dd ){
        
        $str_query = "insert into webPro_tasks set "
                . "description = '$description',"
                . "nurse = $nurse,"
                . "date = CURDATE(),"
                . "time = CURTIME(),"
                . "priority = $p,"
                . "due_date = '$dd',"
                . "task_status = 'not started',"
                . "assigned_by = $assigned_by,"
                . "isadmin = $admin";
        
        return $this->query($str_query);
    }
    
    function start_task($id){
        $str_query = "update webPro_tasks set task_status = 'ongoing',
                date_started = CURDATE()
                where task_id = $id ";
        return $this->query($str_query);
    }
    
    function finish_task($id){
        $str_query = "update webPro_tasks set task_status = 'completed',
                date_finished = CURDATE()
                where task_id = $id ";
        return $this->query($str_query);
    }
    
    function get_task($id){
        $str_query = "select task_id,nurse_id,nurse_fname, nurse_sname,task_status, 
            description, due_date, priority, date_started,date_finished
            from webPro_tasks, webPro_nurses where task_id=$id  and nurse=nurse_id ";
        return $this->query($str_query);
    }
    
    function get_task_by_nurse($nurse){
        $str_query = "select task_id,nurse_id,nurse_fname, nurse_sname,task_status, 
            description, due_date, priority from webPro_tasks, webPro_nurses where nurse=$nurse
            and nurse=nurse_id" ;
        
        return $this->query($str_query);
    }
    
    function get_task_by_date($date){
        $str_query = "select task_id,nurse_id,nurse_fname, nurse_sname,task_status, 
            description, due_date,priority from webPro_tasks, webPro_nurses where 
            due_date = '$date'  and nurse=nurse_id ";
        
        return $this->query($str_query);
    }
    
    function get_task_by_date_id($date, $id){
        $str_query = "select task_id,nurse_id,nurse_fname, nurse_sname,task_status, 
            description, due_date,priority from webPro_tasks, webPro_nurses 
            where due_date= '$date'  and nurse = $id and nurse=nurse_id";
        
        return $this->query($str_query);
    }
    
    function get_all_tasks_overdue(){
        $str_query = "select task_id,nurse_id,nurse_fname, nurse_sname,task_status,
                 description, due_date, DATEDIFF(CURDATE(),due_date) AS overdue,
                priority from webPro_tasks, webPro_nurses where nurse=nurse_id
                 and task_status ='ongoing' or nurse=nurse_id
                 and task_status ='not started'";
        return $this->query($str_query);
    }
    
    function get_nurse_overdue($id){
        $str_query = "select task_id,nurse_id,nurse_fname, nurse_sname,task_status,
                 description, due_date, DATEDIFF(CURDATE(),due_date) AS overdue,
                priority from webPro_tasks, webPro_nurses where nurse=nurse_id 
                and nurse=$id and task_status ='ongoing' or nurse=nurse_id 
                and nurse=$id and task_status ='not started'";
        return $this->query($str_query);
    }
    
            
    function get_task_by_status_id($status, $id){
        $str_query = "select task_id,nurse_id,nurse_fname, nurse_sname,task_status, 
            description, due_date, priority from webPro_tasks, webPro_nurses 
            where task_status= '$status'  and nurse = $id and nurse=nurse_id";
        
        return $this->query($str_query);
    }
    
    function get_task_by_status($status){
        $str_query = "select task_id,nurse_id,nurse_fname, nurse_sname,task_status, 
            description, due_date, priority from webPro_tasks, webPro_nurses where 
            task_status= '$status' and nurse=nurse_id";
        
        return $this->query($str_query);
    }
    
    function get_all_tasks(){
        $str_query = "select task_id, description, nurse, date, time, assigned_by
                 , isadmin from webPro_tasks";
        
        return $this->query($str_query);
    }
    
    function delete_task($id){
        $str_query = "delete from webPro_tasks where task_id = $id";
        return $this->query($str_query);
    }
    
    function search_tasks($st){
        $str_query = "select task_id,nurse_id,nurse_fname, nurse_sname,task_status, 
            description from webPro_tasks, webPro_nurses where nurse_fname like '%$st%' 
            and nurse=nurse_id or nurse_sname like '%$st%' 
            and nurse=nurse_id or description like '%$st%' 
            and nurse=nurse_id ";
        return $this->query($str_query);
    }
    
    function search_task_by_nurse($st, $id){
        $str_query = "select task_id,nurse_id,nurse_fname, nurse_sname,task_status, 
            description from webPro_tasks, webPro_nurses where nurse_fname like '%$st%' 
            and nurse=nurse_id and nurse=$id or nurse_sname like '%$st%' 
            and nurse=nurse_id and nurse=$id or description like '%$st%' 
            and nurse=nurse_id and nurse=$id";
        return $this->query($str_query);
    }
    
    function search_task_by_department($department){
        $str_query = "select task_id,nurse_id, nurse_fname, nurse_sname,
                task_status, description, department_name, department_id 
                from webPro_tasks, webPro_nurses,webPro_department where department_name 
                like '$department%' and nurse=nurse_id and 
                department_id=department ";
        return $this->query($str_query);
    }
    
    function search_task_by_dateassigned($da){
        $str_query = "select task_id,nurse_id, nurse_fname, nurse_sname,
                task_status, description, date from webPro_tasks, webPro_nurses where 
                date like '%$da%' and nurse=nurse_id ";
        return $this->query($str_query);
    }
    
    function search_task_by_duedate($da){
        $str_query = "select task_id,nurse_id, nurse_fname, nurse_sname,
                task_status, description,due_date from webPro_tasks, webPro_nurses
                where due_date like '%$da%' and nurse=nurse_id ";
        return $this->query($str_query);
    }
    
    function search_task_by_priority($p){
        $str_query = "select task_id,nurse_id, nurse_fname, nurse_sname,
                task_status, description, priority,
                due_date from webPro_tasks, webPro_nurses where  priority like
                '%$p%' and nurse=nurse_id";
        return $this->query($str_query);
    }
    
    function search_task_by_status($status){
        $str_query = "select task_id,nurse_id, nurse_fname, nurse_sname,
                task_status, description,
                due_date from webPro_tasks, webPro_nurses where task_status like
                '$status%' and nurse=nurse_id and description_id=description";
        return $this->query($str_query);
    }
    
    function search_task_by_description($desc){
        $str_query = "select task_id,nurse_id, nurse_fname, nurse_sname,
                task_status, description, due_date from webPro_tasks, webPro_nurses 
                where description like '$$desc%' and nurse=nurse_id";
        return $this->query($str_query);
    } 
    
    
    function sortByPriority(){
       $str_query = "select task_id,nurse_id, nurse_fname, nurse_sname,
               task_status, description , priority,
               due_date from webPro_tasks, webPro_nurses where nurse=nurse_id
               ORDER BY priority ASC";
       return $this->query($str_query);
    }
    
    function sortByPriority2($id){
       $str_query = "select task_id,nurse_id, nurse_fname, nurse_sname,
               task_status, description , priority,
               due_date from webPro_tasks, webPro_nurses where nurse=nurse_id
               nurse = $id
               ORDER BY priority ASC";
       return $this->query($str_query);
    }
    
    function sortByDueDate(){
       $str_query = "select task_id,nurse_id, nurse_fname, nurse_sname,
               task_status, description, priority,
               due_date from webPro_tasks, webPro_nurses where nurse=nurse_id
               ORDER BY due_date ASC";
       return $this->query($str_query);
    }
    
    function sortByDueDate2($id){
       $str_query = "select task_id,nurse_id, nurse_fname, nurse_sname,
               task_status, description, priority,
               due_date from webPro_tasks, webPro_nurses where nurse=nurse_id
               and nurse = $id
               ORDER BY due_date ASC";
       return $this->query($str_query);
    }
    
}

/*$obj = new tasks();
$obj->search_task_by_nurse('j');
$row = $obj->fetch();

echo $row['nurse_fname'];*/

?>
