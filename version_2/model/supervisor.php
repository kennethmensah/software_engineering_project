<?php
/**
    *@author Group 4
    *@version 2.0.0
    *@copyright Copyright (c) 2015, Group 4
*/

include_once 'adb.php';

class supervisors extends adb{

    /*
     *@constructor  supervisors() Constructor for the supervisors class 
    */
    function supervisors(){}

    /**
     * @method boolean add_supervisors() add_supervisors($supervisor_id, $fname, $sname, $district_zone, $phone, $gender) Adds supervisor tp database
     * @param int $supervisors_id Supervisor ID
     * @param string $fname The firstname
     * @param string $sname The lastname
     * @param string $district_zone The district Zone
     * @param string $phone The phone number
     * @param string $gender The gender
     * @return boolean
     */
    function add_supervisors($supervisor_id, $fname, $sname, $district_zone, $phone, $gender){
        $str_query =  "INSERT into se_supervisors SET
                   supervisor_id = $supervisor_id,
                   fname = '$fname',
                   sname = '$sname',
                   district_zone = $district_zone,
                   gender = '$gender',
                   phone = '$phone'";

        return $this->query($str_query);
    }


    /**
     * @method update_supervisors_details() update_supervisors_details($supervisor_id, $fname, $sname, $district_zone, $phone,$gender) Updates supervisor details
     * @param int $supervisors_id Supervisor ID
     * @param string $fname The firstname
     * @param string $sname The lastname
     * @param string $district_zone The district Zone
     * @param string $phone The phone number
     * @param string $gender The gender
     * @return boolean
     */
    function update_supervisors_details($supervisor_id, $fname, $sname, $district_zone, $phone,$gender){
        $str_query = "UPDATE se_supervisors SET
                   fname = '$fname',
                   sname = '$sname',
                   district_zone = $district_zone,
                   gender = '$gender',
                   phone = '$phone'
                WHERE supervisor_id = $supervisor_id";

        return $this->query($str_query);
    }

    /**
     * @method boolean update_district_zone() update_district_zone($supervisor_id, $district_zone) Update district zone
     * @param int $supervisors_id Supervisor ID
     * @param string $district_zone The district zone
     * @return boolean
     */
    function update_district_zone($supervisor_id, $district_zone){
        $str_query = "UPDATE se_supervisors SET
                   district_zone = $district_zone
                WHERE supervisor_id = $supervisor_id";

        return $this->query($str_query);
    }

    /**
     * @method boolean update_phone() update_phone($supervisor_id, $phone) Updates the phone number
     * @param int $supervisors_id Supervisor ID
     * @param string $phone Phone number
     * @return boolean
     */
    function update_phone($supervisor_id, $phone){
        $str_query = "UPDATE se_supervisors SET
                   phone = '$phone'
                WHERE supervisor_id = $supervisor_id";

        return $this->query($str_query);
    }


    /**
     * @method boolean get_details() get_details($supervisor_id) Gets details of supervisor
     * @param $supervisors_id Supervisor ID
     * @return boolean
     */
    function get_details($supervisor_id){
        $str_query = "SELECT * FROM se_supervisors
                WHERE supervisor_id = $supervisor_id";

        return $this->query($str_query);
    }

    function alert_superviser(){
        

    }

}

/**
 * Unit Test and usage
 */
//$obj = new supervisors();
//$obj->add_supervisors(1,'Aelaf','Dafla',2,'+233200393945');
//$obj = new supervisors();
//$obj->get_details(1);
//if($row = $obj->fetch()){
//    echo "supervisors name:  ".$row['fname'];
//}





