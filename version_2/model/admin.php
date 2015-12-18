<?php
/**
 * This class contains queries that interface with the
 * se_admin database. It contains relevant queries necessary for
 * adding admins, retrieving admins and updating admin details.
 *
 * PHP version 5.6
 *
 * @category   Model
 * @author     Kenneth Mintah Mensah <kenneth.mensah@ashesi.edu.gh>
 * @author     Joshua Atsu Aherdemla <joshua.aherdemla@ashesi.edu.gh>
 * @author     Norbert Sackey <norbert.sackey@ashesi.edu.gh>
 * @author     Edwina Baddoo <edwina.baddoo@ashesi.edu.gh>
 * @version    SVN: 2.0.0
 */


/**
 * A database interface class
 *
 * The included class contains functions that interface with the database
 * via MYSQL
 */
include_once 'adb.php';

class admin extends adb{

    function admin(){}

    /**
     * @param $admin_id
     * @param $fname
     * @param $sname
     * @param $district
     * @param $phone
     * @return bool
     */
    function add_admin($admin_id, $fname, $sname, $district, $phone, $gender){
        $str_query =  "INSERT into se_admin SET
                   admin_id = $admin_id,
                   fname = '$fname',
                   sname = '$sname',
                   district = $district,
                   gender = '$gender',
                   phone = '$phone'";

        return $this->query($str_query);
    }


    /**
     * @param $admin_id
     * @param $fname
     * @param $sname
     * @param $district
     * @param $phone
     * @return bool
     */
    function update_admin_details($admin_id, $fname, $sname, $district, $phone, $gender){
        $str_query = "UPDATE se_admin SET
                   fname = '$fname',
                   sname = '$sname',
                   district = $district,
                   gender = $gender,
                   phone = '$phone'
                WHERE admin_id = $admin_id";

        return $this->query($str_query);
    }

    /**
     * @param $admin_id
     * @param $district
     * @return bool
     */
    function update_district($admin_id, $district){
        $str_query = "UPDATE se_admin SET
                   district = $district
                WHERE admin_id = $admin_id";

        return $this->query($str_query);
    }

    /**
     * @param $admin_id
     * @param $phone
     * @return bool
     */
    function update_phone($admin_id, $phone){
        $str_query = "UPDATE se_admin SET
                   phone = '$phone'
                WHERE admin_id = $admin_id";

        return $this->query($str_query);
    }


    /**
     * @param $admin_id
     * @return bool
     */
    function get_details($admin_id){
        $str_query = "SELECT * FROM se_admin
                WHERE admin_id = $admin_id";

        return $this->query($str_query);
    }

}

/**
 * Unit Test and usage
 */
//$obj = new admin();
//$obj->get_details(1);
//if($row = $obj->fetch()){
//    echo "admin name:  ".$row['fname'];
//}





