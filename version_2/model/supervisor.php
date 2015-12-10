<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/22/15
 * Time: 3:28 AM
 */

include_once 'adb.php';

class supervisors extends adb{

    function supervisors(){}

    /**
     * @param $supervisors_id
     * @param $fname
     * @param $sname
     * @param $district_zone
     * @param $phone
     * @return bool
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
     * @param $supervisors_id
     * @param $fname
     * @param $sname
     * @param $district_zone
     * @param $phone
     * @return bool
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
     * @param $supervisors_id
     * @param $district_zone
     * @return bool
     */
    function update_district_zone($supervisor_id, $district_zone){
        $str_query = "UPDATE se_supervisors SET
                   district_zone = $district_zone
                WHERE supervisor_id = $supervisor_id";

        return $this->query($str_query);
    }

    /**
     * @param $supervisors_id
     * @param $phone
     * @return bool
     */
    function update_phone($supervisor_id, $phone){
        $str_query = "UPDATE se_supervisors SET
                   phone = '$phone'
                WHERE supervisor_id = $supervisor_id";

        return $this->query($str_query);
    }


    /**
     * @param $supervisors_id
     * @return bool
     */
    function get_details($supervisor_id){
        $str_query = "SELECT * FROM se_supervisors
                WHERE supervisor_id = $supervisor_id";

        return $this->query($str_query);
    }

}






