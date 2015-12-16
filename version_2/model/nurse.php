<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/22/15
 * Time: 4:09 AM
 */

include_once 'adb.php';

class nurses extends adb{

    /*
     *@constructor  nurses() Constructor for the nurses class 
    */
    function nurses(){}

    /**
     * @method boolean add_nurses() add_nurses($nurse_id, $fname, $sname, $district_zone, $phone,$gender) Adds nurses to the database
     * @param int $nurses_id The nurse ID
     * @param string $fname The firstname
     * @param string $sname The lastname
     * @param string $district_zone The District Zone
     * @param string $phone The phone number
     * @return boolean
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
     * @method boolean update_nurses_details() update_nurses_details($nurse_id, $fname, $sname, $district_zone, $phone, $gender) Updates nurse details
     * @param int $nurses_id The nurse ID
     * @param string $fname Nurse firstname
     * @param string $sname Nurse lastname
     * @param string $district_zone The district zone
     * @param string $phone The phone number
     * @return boolean
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
     * @method boolean update_district_zone() update_district_zone($nurse_id, $district_zone) Updates nurses ID and District Zone
     * @param int $nurses_id The nurse ID
     * @param string $district_zone The district zone
     * @return boolean
     */
    function update_district_zone($nurse_id, $district_zone){
        $str_query = "UPDATE se_nurses SET
                   district_zone = $district_zone
                WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }

    /**
     * @method boolean update_phone() update_phone($nurse_id, $phone) Update Phone number for nurse
     * @param int $nurses_id The nurse ID
     * @param string $phone The phone number
     * @return boolean
     */
    function update_phone($nurse_id, $phone){
        $str_query = "UPDATE se_nurses SET
                   phone = '$phone'
                WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }


    /**
     * @method boolean get_details() get_details($nurse_id) Getshe details of a nurse
     * @param int $nurses_id The nurse ID
     * @return boolean
     */
    function get_details($nurse_id){
        $str_query = "SELECT * FROM se_nurses
                WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }

}

/**
 * Unit Test and usage
 */
//$obj = new nurses();
//$obj->add_nurses(1,'Araba','Maison',2,'+233244393945');
//$obj = new nurses();
//$obj->get_details(1);
//if($row = $obj->fetch()){
//    echo "nurses name:  ".$row['fname'];
//}





