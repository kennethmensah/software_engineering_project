<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/23/15
 * Time: 6:23 PM
 */

include_once 'adb.php';

class clinic extends adb{

    /**
     *
     */
    function clinic(){

    }

    /**
     * @param $clinic_name
     * @param $clinic_location
     * @return bool
     */
    function add_clinic($clinic_name, $clinic_location){
        $str_query =  "INSERT into se_clinics SET
                   clinic_name = '$clinic_name',
                   clinic_location = '$clinic_location'";

        return $this->query($str_query);
    }

    /**
     * @return bool
     */
    function get_clinics(){
        $str_query = "SELECT * FROM se_clinics";

        return $this->query($str_query);
    }

    function get_clinic($id){
        $str_query = "SELECT * FROM se_clinics where clinic_id = $id";

        return $this->query($str_query);
    }


}

/**
 * Unit test and usage
 */

$obj = new clinic();
//$obj->add_clinic('Kwashieman Community Clinic', 'Kwashieman');
if($obj->get_clinic(1)){
    $row = $obj->fetch();
    echo "clinic name ". $row['clinic_name'];
}else{
    echo "query failed";
}
