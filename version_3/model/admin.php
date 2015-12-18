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

class Admin extends adb
{

    function Admin()
    {
    }

    /**
     * Executes an sql query to add a new admin
     *
     * This function executes an sql query to add a new admin given the following
     * parameters
     *
     * @param int $admin_id id of the admin
     * @param string $fname first name of the admin
     * @param string $sname surname of the admin
     * @param string $district id of district
     * @param string $phone phone number of the admin
     * @return bool the result will return true/false whether the sql query is successful
     */
    function addAdmin($admin_id, $fname, $sname, $district, $phone, $gender)
    {
        $str_query = "INSERT into se_admin SET
                   admin_id = $admin_id,
                   fname = '$fname',
                   sname = '$sname',
                   district = $district,
                   gender = '$gender',
                   phone = '$phone'";

        return $this->query($str_query);
    }


    /**
     * Executes an sql query to get the details of a given admin
     *
     * This function executes an sql query to get the details of an admin
     * given the admin's id
     *
     * @param $admin_id
     * @return bool
     */
    function getDetails($admin_id){
        $str_query = "SELECT * FROM se_admin
                      WHERE admin_id = $admin_id";

        return $this->query($str_query);
    }
}