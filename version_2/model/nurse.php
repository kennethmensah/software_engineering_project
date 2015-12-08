<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/22/15
 * Time: 4:09 AM
 */

include_once 'adb.php';

class nurses extends adb{

    function nurses(){}

    /**
     * @param $nurses_id
     * @param $fname
     * @param $sname
     * @param $district_zone
     * @param $phone
     * @return bool
     */
    function add_nurses($nurse_id, $fname, $sname, $district_zone, $phone,$gender){
        $str_query =  "INSERT into se_nurses SET
                   nurse_id = $nurse_id,
                   fname = '$fname',
                   sname = '$sname',
                   district_zone = $district_zone,
                   gender = '$gender',
                   phone = '$phone'";

        return $this->query($str_query);
    }


    /**
     * @param $nurses_id
     * @param $fname
     * @param $sname
     * @param $district_zone
     * @param $phone
     * @return bool
     */
    function update_nurses_details($nurse_id, $fname, $sname, $district_zone, $phone, $gender){
        $str_query = "UPDATE se_nurses SET
                   fname = '$fname',
                   sname = '$sname',
                   district_zone = $district_zone,
                   gender = '$gender',
                   phone = '$phone'
                WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }

    /**
     * @param $nurses_id
     * @param $district_zone
     * @return bool
     */
    function update_district_zone($nurse_id, $district_zone){
        $str_query = "UPDATE se_nurses SET
                   district_zone = $district_zone
                WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }

    /**
     * @param $nurses_id
     * @param $phone
     * @return bool
     */
    function update_phone($nurse_id, $phone){
        $str_query = "UPDATE se_nurses SET
                   phone = '$phone'
                WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }


    /**
     * @param $nurses_id
     * @return bool
     */
    function get_details($nurse_id){
        $str_query = "SELECT * FROM se_nurses
                WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }

    function get_nurse_by_location($district){
        $str_query = "SELECT * FROM se_nurses
                WHERE district_zone = $district";

        return $this->query($str_query);
    }

}

/**
 * Unit Test and usage
 */
//$obj = new nurses();

//$obj->add_nurses(1,'Araba','Maison',2,'+233244393945');
//$obj = new nurses();
//$obj->get_nurse_by_location(2);
//if($row = $obj->fetch()){
//    echo "nurses name:  ".$row['fname'];
//}





