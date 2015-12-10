<?php
/**
 * This class interfaces contains queries that interface with the
 * nurses database. It contains relevant queries necessary for
 * adding nurses, retrieving nurses and updating nurse details.
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

class nurses extends adb{

    /**
     * nurses constructor.
     *
     * this method instantiates an object of the nurses class
     */
    function nurses(){}

    /**
     * Executes a query to add a new nurse details
     *
     * This method executes a query to add a new nurse
     * given the required details
     *
     * @param int $nurse_id nurse's id
     * @param String $fname first name
     * @param String $sname surname
     * @param int $district_zone clinic or district zone
     * @param String $phone phone
     * @param String $gender gender
     * @return bool returns true/false indicating whether the query is successful of not
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
     * Executes a query to edit a nurse's details
     *
     * This method executes a query to edit a nurse's details
     * given the required details
     *
     * @param int $nurse_id nurse's id
     * @param String $fname first name
     * @param String $sname surname
     * @param int $district_zone clinic or district zone
     * @param String $phone phone
     * @param String $gender gender
     * @return bool returns true/false indicating whether the query is successful of not
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
     * Executes a query to edit a nurse's district zone or clinic
     *
     * This method executes a query to edit a nurse's district zone
     * or clinic given the required details
     *
     * @param int $nurse_id nurse id
     * @param int $district_zone district zone or clinic id
     * @return bool returns true/false indicating whether the query is successful of not
     */
    function update_district_zone($nurse_id, $district_zone){
        $str_query = "UPDATE se_nurses SET
                   district_zone = $district_zone
                WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }

    /**
     * Executes a query to edit a nurse's phone number
     *
     * This method executes a query to edit a nurse's phone
     * number given the required details
     *
     * @param int $nurse_id nurse id
     * @param string $phone phone number
     * @return bool returns true/false indicating whether the query is successful of not
     */
    function update_phone($nurse_id, $phone){
        $str_query = "UPDATE se_nurses SET
                   phone = '$phone'
                WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }


    /**
     * Executes a query to get a nurse's details
     *
     * This method executes a query to get a nurse's details
     * given the supervisors id
     *
     * @param int $nurse_id: nurse id
     * @return bool returns true/false indicating whether the query is successful of not
     */
    function get_details($nurse_id){
        $str_query = "SELECT * FROM se_nurses
                WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }


    /**
     * Executes a query to get a nurse's details by location
     *
     * This method executes a query to get a nurse's details
     * given the nurse's clinic
     *
     * @param int $district clinic id
     * @return bool returns true/false indicating whether the query is successful of not
     */
    function get_nurse_by_location($district){
        $str_query = "SELECT * FROM se_nurses
                WHERE district_zone = $district";

        return $this->query($str_query);
    }

}





