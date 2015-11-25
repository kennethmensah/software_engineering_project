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
     * @param $title
     * @param $desc
     * @param $nurses
     * @param $supervisor
     * @param $due
     * @param $clinic
     * @return bool
     */
    function add_clinic_task($title, $desc, $nurses, $supervisor, $due, $clinic ){
        $str_query = "INSERT INTO se_clinic_tasks SET
                      task_title = '$title',
                      task_desc = '$desc',
                      assigned_to = '$nurses',
                      assigned_by = $supervisor,
                      date_assigned = CURDATE(),
                      date_completed = '0000-00-00',
                      due_date = '$due',
                      confirmed = 'not',
                      clinic = $clinic";

        return $this->query($str_query);
    }


    function get_clinic_tasks(){
        $str_query = "SELECT * FROM se_clinic_tasks";

        return $this->query($str_query);
    }


}

//$nurses = array("1","2");
//
//$nurses = serialize($nurses);

$obj = new clinic_task();
//$obj->add_clinic_task('Vaccination', 'Perform vaccination on 30 children', $nurses, 1, '2015-12-23',1);

if($obj->get_clinic_tasks()){
    $row = $obj->fetch();
    $nurse = unserialize($row['assigned_to']);
    print_r($nurse);
}