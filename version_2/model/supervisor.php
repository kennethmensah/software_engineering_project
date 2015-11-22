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
    function add_supervisors($supervisors_id, $fname, $sname, $district_zone, $phone){
        $str_query =  "INSERT into se_supervisors SET
                   supervisors_id = $supervisors_id,
                   fname = '$fname',
                   sname = '$sname',
                   district_zone = $district_zone,
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
    function update_supervisors_details($supervisors_id, $fname, $sname, $district_zone, $phone){
        $str_query = "UPDATE se_supervisors SET
                   fname = '$fname',
                   sname = '$sname',
                   district_zone = $district_zone,
                   phone = '$phone'
                WHERE supervisors_id = $supervisors_id";

        return $this->query($str_query);
    }

    /**
     * @param $supervisors_id
     * @param $district_zone
     * @return bool
     */
    function update_district_zone($supervisors_id, $district_zone){
        $str_query = "UPDATE se_supervisors SET
                   district_zone = $district_zone
                WHERE supervisors_id = $supervisors_id";

        return $this->query($str_query);
    }

    /**
     * @param $supervisors_id
     * @param $phone
     * @return bool
     */
    function update_phone($supervisors_id, $phone){
        $str_query = "UPDATE se_supervisors SET
                   phone = '$phone'
                WHERE supervisors_id = $supervisors_id";

        return $this->query($str_query);
    }


    /**
     * @param $supervisors_id
     * @return bool
     */
    function get_details($supervisors_id){
        $str_query = "SELECT * FROM se_supervisors
                WHERE supervisors_id = $supervisors_id";

        return $this->query($str_query);
    }

}

/**
 * Unit Test and usage
 */
$obj = new supervisors();
$obj->add_supervisors(1,'Aelaf','Dafla',2,'+233200393945');
//$obj = new supervisors();
//$obj->get_details(1);
//if($row = $obj->fetch()){
//    echo "supervisors name:  ".$row['fname'];
//}





