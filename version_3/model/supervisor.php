<?php
/**
 * This class contains queries that interface with the
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

class Supervisors extends adb
{

    /**
     *supervisors constructor.
     *
     *this method instantiates an object of the supervisors class
     */
    function Supervisors()
    {
    }

    /**
     * Executes a query to add a new supervisor details
     *
     * This method executes a query to add a new supervisor
     * given the required details
     *
     * @param int $supervisor_id : supervisor's id
     * @param string $fname : first name
     * @param string $sname : surname
     * @param int $district_zone : clinic or district zone
     * @param int $phone : phone
     * @param string $gender : gender
     * @return bool: returns true/false indicating whether the query is successful of not
     */
    function addSupervisors($supervisor_id, $fname, $sname, $district_zone, $phone, $gender)
    {
        $str_query = "INSERT into se_supervisors SET
                   supervisor_id = $supervisor_id,
                   fname = '$fname',
                   sname = '$sname',
                   district_zone = $district_zone,
                   gender = '$gender',
                   phone = '$phone'";

        return $this->query($str_query);
    }


}