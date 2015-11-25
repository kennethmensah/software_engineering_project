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

    function add_clinic_task($title, $desc, $nurses, $supervisor, $confirmed, $clinic ){
        $str_query = "INSERT INTO se_clinic_tasks
                      task_title = '$title',
                      task_desc = '$desc',
                      assigned_to ";

        return $this->query($str_query);
    }
}