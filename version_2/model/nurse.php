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
     * @param int $nurses_id
     * @param string $fname
     * @param string $sname
     * @param string $district_zone
     * @param string $phone
     * @return bool
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
     * @param $nurses_id
     * @param $fname
     * @param $sname
     * @param $district_zone
     * @param $phone
     * @return bool
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
     * @param $nurses_id
     * @param $district_zone
     * @return bool
     */
    function update_district_zone($nurse_id, $district_zone){
        $str_query = "UPDATE se_nurses SET
                   district_zone = $district_zone
                WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }

    /**
     * @param $nurses_id
     * @param $phone
     * @return bool
     */
    function update_phone($nurse_id, $phone){
        $str_query = "UPDATE se_nurses SET
                   phone = '$phone'
                WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }


    /**
     * @param $nurses_id
     * @return bool
     */
    function get_details($nurse_id){
        $str_query = "SELECT * FROM se_nurses
                WHERE nurse_id = $nurse_id";

        return $this->query($str_query);
    }

    function get_nurse_by_location($district){
        $str_query = "SELECT * FROM se_nurses
                WHERE district_zone = $district";

        return $this->query($str_query);
    }

}





