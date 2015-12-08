<?php

include_once 'adb.php';

class admin_report extends adb{

    function admin_report(){

    }

   /**
    *This function retrives the information for all tasks stored in the database have been completed.
    *@return bool the result will return true/false whether the sql query is successful
    */
    function get_comfirmed_report()
    {
        $str_query = "select task_id, task_title, task_desc,clinics, assigned_to, assigned_by, confirmed from se_clinic_tasks where confirmed = COMFIRM";
        
        return $this->query($str_query);
    }

	/**
    *This function retrives the information for all tasks stored in the database that have not been completed
    *@return bool the result will return true/false whether the sql query is successful
    */
    function get_uncompleted_report()
    {
        $str_query = "select task_id, task_title, task_desc,clinics, assigned_to, assigned_by, confirmed from se_clinic_tasks where confirmed = NOT";
        
        return $this->query($str_query);
    }

    function get_nurse_work($nurse_id){
    	$str_query = " select task_title, task_desc, clinics"
    }


?>