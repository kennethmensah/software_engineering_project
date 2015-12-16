<?php
/**
    *@author Group 4
    *@version 2.0.0
    *@copyright Copyright (c) 2015, Group 4
    */

include_once 'adb.php';

class admin extends adb{

    function admin(){}

    /**
     * @method boolean add_admin() add_admin($admin_id, $fname, $sname, $district, $phone, $gender) Adds Administrator to the database
     * @param int $admin_id Administrator ID
     * @param string $fname Administrator firstname
     * @param string $sname Administrator lastname
     * @param string $district District of Administrator
     * @param string $phone The phone number of Administrator
     * @param string $gender The gender of Administrator
     * @return boolean
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
     * @method boolean update_admin_details() update_admin_details($admin_id, $fname, $sname, $district, $phone, $gender) Edits Administrator details in database
     * @param int $admin_id Administrator ID
     * @param string $fname Administrator firstname
     * @param string $sname Administrator lastname
     * @param string $district District of Administrator
     * @param string $phone The phone number of Administrator
     * @param string $gender The gender of Administrator
     * @return boolean
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
     * @method boolean update_district() update_district($admin_id, $district) Updates the district of The Administrator
     * @param int $admin_id Administrator ID
     * @param string $district District of Administrator
     * @return boolean
     */
    function update_district($admin_id, $district){
        $str_query = "UPDATE se_admin SET
                   district = $district
                WHERE admin_id = $admin_id";

        return $this->query($str_query);
    }

    /**
     * @method boolean update_phone() update_phone($admin_id, $phone) Updates phone number of Administrator
     * @param int $admin_id Administrator ID
     * @param string $phone Phone number of Administrator
     * @return boolean
     */
    function update_phone($admin_id, $phone){
        $str_query = "UPDATE se_admin SET
                   phone = '$phone'
                WHERE admin_id = $admin_id";

        return $this->query($str_query);
    }


    /**
     * @method boolean get_details() get_details($admin_id) Gets the details of Administrator
     * @param string $admin_id Administrator ID
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





