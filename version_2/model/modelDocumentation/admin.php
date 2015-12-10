<?php
/**
 * This class interfaces contains queries that interface with the
 * administrator database. It contains relevant queries necessary for
 * adding administrators, retrieving administrators and updating
 * administrators details.
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
 * The class below contains functions that interface with the database
 * via MYSQL
 */

include_once 'adb.php';

class admin extends adb{

    /**
     * admin constructor.
     *
     * this method instantiates an object of the admin class
     */
    function admin(){}

    /**
     * Executes a query to add a new admin details
     *
     * This method executes a query to add a new admin
     * given the required details
     *
     * @param int $admin_id: admin's id
     * @param String $fname: first name
     * @param String $sname: surname
     * @param int $district: clinic or district zone
     * @param String $phone: phone
     * @param String $gender: gender
     * @return bool: returns true/false indicating whether the query is successful of not
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
     * Executes a query to edit an admin's details
     *
     * This method executes a query to edit an admin's details
     * given the required details
     *
     * @param int $admin_id: admin's id
     * @param String $fname: first name
     * @param String $sname: surname
     * @param int $district: clinic or district zone
     * @param String $phone: phone
     * @param String $gender: gender
     * @return bool returns true/false indicating whether the query is successful of not
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
     * Executes a query to edit a admin's district zone or clinic
     *
     * This method executes a query to edit a nurse's district zone
     * or clinic given the required details
     *
     * @param int $admin_id admin id
     * @param int $district district id
     * @return bool returns true/false indicating whether the query is successful of not
     */
    function update_district($admin_id, $district){
        $str_query = "UPDATE se_admin SET
                   district = $district
                WHERE admin_id = $admin_id";

        return $this->query($str_query);
    }

    /**
     * Executes a query to edit a admin's phone number
     *
     * This method executes a query to edit a admin's phone
     * number given the required details
     *
     * @param int $admin_id admin id
     * @param String $phone phone number
     * @return bool returns true/false indicating whether the query is successful of not
     */
    function update_phone($admin_id, $phone){
        $str_query = "UPDATE se_admin SET
                   phone = '$phone'
                WHERE admin_id = $admin_id";

        return $this->query($str_query);
    }


    /**
     * Executes a query to get a admin's details
     *
     * This method executes a query to get a admin's details
     * given the admin's id
     *
     * @param int $admin_id admin id
     * @return bool returns true/false indicating whether the query is successful of not
     */
    function get_details($admin_id){
        $str_query = "SELECT * FROM se_admin
                WHERE admin_id = $admin_id";

        return $this->query($str_query);
    }

}






