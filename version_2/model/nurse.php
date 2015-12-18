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

class Nurses extends adb{

    /**
     * nurses constructor.
     *
     * this method instantiates an object of the nurses class
     */
    function Nurses(){}

    /**
     * Executes an sql query to add nurse
     *
     * This function executes an sql query to add a nurse to the
     * nurse database given the following details
     *
     * @param int $nurse_id id of nurse
     * @param string $fname first name of nurse
     * @param string $sname surname of nurse
     * @param string $clinic_id id of clinic
     * @param string $phone phone number of nurse
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function addNurses($nurse_id, $fname, $sname, $clinic_id, $phone,$gender){
        $str_query =  "INSERT into se_nurses SET
                   nurse_id = $nurse_id,
                   fname = '$fname',
                   sname = '$sname',
                   district_zone = $clinic_id,
                   gender = '$gender',
                   phone = '$phone'";

        return $this->query($str_query);
    }


    /**
     * Executes a query to update a nurse
     *
     * This query executes an sql query to update the details of a nurse
     *
     * @param int $nurse_id id of nurse
     * @param string $fname first name of nurse
     * @param string $sname surname of nurse
     * @param string $clinic_id id of clinic
     * @param string $phone phone number of nurse
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function updateNursesDetails($nurse_id, $fname, $sname, $clinic_id, $phone, $gender){
        $str_query = "UPDATE se_nurses SET
                   fname = '$fname',
                   sname = '$sname',
                   district_zone = $clinic_id,
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
    function updateDistrictZone($nurse_id, $district_zone){
        $str_query = "UPDATE se_nurses SET
                   district_zone = $district_zone
                WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }

    /**
     * @param $nurse_id
     * @param $phone
     * @return bool
     */
    function updatePhone($nurse_id, $phone){
        $str_query = "UPDATE se_nurses SET
                      phone = '$phone'
                      WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }


    /**
     * @param $nurse_id
     * @return bool
     */
    function getDetails($nurse_id){
        $str_query = "SELECT * FROM se_nurses
                      WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }

    /**
     * Executes a query to fetch all nurses in a clinic
     *
     * @param $clinic
     * @return bool
     */
    function getNurseByLocation($clinic){
        $str_query = "SELECT * FROM se_nurses
                      WHERE district_zone = $clinic";

        return $this->query($str_query);
    }

}





