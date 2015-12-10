<?php
/**
 * This class interfaces contains queries that interface with the
 * supervisors database. It contains relevant queries necessary for
 * adding supervisors, retrieving supervisors and updating
 * supervisors details.
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

class supervisors extends adb{

    /**
     *supervisors constructor.
     *
     *this method instantiates an object of the supervisors class
     */
    function supervisors(){}

    /**
     * Executes a query to add a new supervisor details
     *
     * This method executes a query to add a new supervisor
     * given the required details
     *
     * @param int $supervisors_id: supervisor's id
     * @param string $fname: first name
     * @param string $sname: surname
     * @param int $district_zone: clinic or district zone
     * @param int $phone: phone
     * @param string $gender: gender
     * @return bool: returns true/false indicating whether the query is successful of not
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
     * Executes a query to edit a supervisor's details
     *
     * This method executes a query to edit a supervisor's details
     * given the required details
     *
     * @param int $supervisor_id: supervisor's id
     * @param string $fname: first name
     * @param string $sname: surname
     * @param int $district_zone: clinic or district zone
     * @param int $phone: phone
     * @param string $gender: gender
     * @return bool: returns true/false indicating whether the query is successful of not
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
     * Executes a query to edit a supervisor's district zone or clinic
     *
     * This method executes a query to edit a supervisor's district zone
     * or clinic given the required details
     *
     * @param int $supervisor_id: supervisor id
     * @param int $district_zone: district zone or clinic id
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function update_district_zone($supervisor_id, $district_zone){
        $str_query = "UPDATE se_supervisors SET
                   district_zone = $district_zone
                WHERE supervisor_id = $supervisor_id";

        return $this->query($str_query);
    }

    /**
     * Executes a query to edit a supervisor's phone number
     *
     * This method executes a query to edit a supervisor's phone
     * number given the required details
     *
     * @param int $supervisor_id: supervisor id
     * @param string $phone: phone number
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function update_phone($supervisor_id, $phone){
        $str_query = "UPDATE se_supervisors SET
                   phone = '$phone'
                WHERE supervisor_id = $supervisor_id";

        return $this->query($str_query);
    }


    /**
     * Executes a query to get a supervisor's details
     *
     * This method executes a query to get a supervisor's details
     * given the supervisors id
     *
     * @param int $supervisor_id: supervisor id
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function get_details($supervisor_id){
        $str_query = "SELECT * FROM se_supervisors
                WHERE supervisor_id = $supervisor_id";

        return $this->query($str_query);
    }

}






