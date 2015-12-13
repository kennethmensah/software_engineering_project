<?php
/**
 * This class interfaces contains queries that interface with the
 * clinics database. It contains relevant queries necessary for
 * adding clinics, retrieving clinics and updating clinic details.
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

class clinic extends adb{


    /**
     * clinic constructor
     *
     * This is a constructor for the clinic class
     */
    function clinic()
    {

    }
    
    /**
     * Executes a query to add a new clinic
     *
     * This function adds a new clinic given the required parameters
     *
     * @param String $clinic_name this is the official name of the clinic
     * @param String $clinic_location this is the location of the clinic
     * @return bool the result will return true/false whether the sql query is successful
     */
    function add_clinic($clinic_name, $clinic_location){
            $str_query =  "INSERT into se_clinics SET
                            clinic_name = '$clinic_name',
                            clinic_location = '$clinic_location'";

            return $this->query($str_query);
    }
    
    /**
     * Executes a query to edit a clinic
     *
     * This function updates an existing clinic given the required parameters
     *
     * @param int $id this represents the unique identifier for each clinic
     * @param String $clinicName this is the official name of the clinic
     * @param String $clinicLoc this is the location of the clinic
     * @return bool the result will return true/false whether the sql query is successful
     */
    function edit_clinic($id, $clinicName, $clinicLoc)
    {
        $str_query = "UPDATE se_clinics SET
                      clinic_id = '$id',
                      clinic_name = '$clinicName',
                      clinic_location = '$clinicLoc',
                      WHERE id = $id";
        return $this->query($str_query);
    }
    
    
    /**
     * Executes a query to get a clinic's details
     *
     *This function retrieves the information for a given clinic using its id
     *
     * @param int $id this represents the unique identifier for each clinic
     * @return bool the result will return true/false whether the sql query is successful
     */
    function get_clinic($id){
        $str_query = "SELECT * FROM se_clinics where clinic_id = $id";

        return $this->query($str_query);
    }
    
    /**
     * Executes a query to get all clinics
     *
     * This function retrieves the information for all clinics stored in the database
     *
     * @return bool the result will return true/false whether the sql query is successful
     */
    function get_clinics(){
        $str_query = "SELECT * FROM se_clinics";

        return $this->query($str_query);
    }


    /**
     * Executes a query to edit a clinic
     *
     * This function updates an existing clinic given the required parameters
     *
     * @param int $clinic_id this represents the unique identifier for each clinic
     * @param String $clinic_name this is the official name of the clinic
     * @param String $clinic_location this is the location of the clinic
     * @return bool the result will return true/false whether the sql query is successful
     */
    function edit_details($clinic_id, $clinic_name, $clinic_location){
        $str_query = "UPDATE se_clinics SET
                      clinic_name = '$clinic_name',
                      clinic_location = '$clinic_location'";

        return $this->query($str_query);
    }

    /**
     * Executes a query to delete a clinic
     *
     * This function adds deletes the row storing data for a given clinic using its id
     *
     * @param int $id this represents the unique identifier for each clinic
     * @return bool the result will return true/false whether the sql query is successful
     */
    function delete_clinic($id)
    {
        $str_query = "DELETE from  se_clinics WHERE id = $id";

        return $this->query($str_query);
    }
    
    /**
     * Executes a query to search a clinic by name
     *
     * This function adds searches for the rows with names of clinics that match the pattern
     *
     * @param int $sn this represents the name of the clinic
     * @return bool the result will return true/false whether the sql query is successful
     */
    function search_clinic_by_name($sn)
    {
        $str_query = "SELECT
                    clinic_id,
                    clinic_name,
                    clinic_location
                    FROM
                    WHERE clinic_name like '%$sn%'";

        return $this->query($str_query);
    }
    
}

?>
