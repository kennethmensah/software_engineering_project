<?php
/**
 * This class contains queries that interface with the
 * clinic database. It contains relevant queries necessary for
 * adding clinic, retrieving clinics and updating clinics.
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

class Clinic extends adb
{


    /**
     * This is a constructor for the clinic class
     *
     */
    function Clinic()
    {

    }

    /**
     * This function adds a new clinic given the required parameters
     *
     * @param String $clinic_name this is the official name of the clinic
     * @param String $clinic_location this is the location of the clinic
     * @return bool the result will return true/false whether the sql query is successful
     */

    function addClinic($clinic_name, $clinic_location)
    {
        $str_query = "INSERT into se_clinics SET
                   clinic_name = '$clinic_name',
                   clinic_location = '$clinic_location'";

        return $this->query($str_query);
    }

}