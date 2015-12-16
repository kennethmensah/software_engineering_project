<?php

include_once 'adb.php';

class admin_report extends adb{

    function admin_report(){

    }

   /**
    *@method boolean get_confirmed_report() Gets confirmed reports
    *@return boolean
    */
    function get_comfirmed_report()
    {
        $str_query = "select task_id, task_title, task_desc,clinics, assigned_to, assigned_by, confirmed from se_clinic_tasks where confirmed = COMFIRM";
        
        return $this->query($str_query);
    }

	/**
    *@method boolean get_uncompleted_report() Gets uncompleteed reports
    *@return bool the result will return true/false whether the sql query is successful
    */
    function get_uncompleted_report()
    {
        $str_query = "select task_id, task_title, task_desc,clinics, assigned_to, assigned_by, confirmed from se_clinic_tasks where confirmed = NOT";
        
        return $this->query($str_query);
    }
    
    /**
    *@method boolean get_nurse_work() get_nurse_work($nurse_id) Gets work done b aparticular nurse
    *@param int $nurse_id Nurse ID
    *@return boolean
    */
    function get_nurse_work($nurse_id){
    	$str_query = " select task_title, task_desc, clinics"
    }


?>