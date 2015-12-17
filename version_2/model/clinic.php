<?php
/**
 * @author: Kenneth Mintah Mensah, Edwina Baddoo, Joshua Aherdermla, Norbert Sackey
 * Date: 11/23/15
 * Time: 6:23 PM
 */

include_once 'adb.php';

class clinic extends adb{


    /**
     * This is a constructor for the clinic class
     *
     */
    function clinic()
    {
        
    }
    
    /**
    * This function adds a new clinic given the required parameters
    *
    *@param String $clinicName this is the official name of the clinic 
    *@param String $clinicLoc this is the location of the clinic 
    *@return bool the result will return true/false whether the sql query is successful
    */

        function add_clinic($clinic_name, $clinic_location){
                $str_query =  "INSERT into se_clinics SET
                   clinic_name = '$clinic_name',
                   clinic_location = '$clinic_location'";

                return $this->query($str_query);
        }
    
    /**
    * This function updates an existing clinic given the required parameters
    *
    *@param int $id this represents the unique identifier for each clinic
    *@param String $clinicName this is the official name of the clinic 
    *@param String $clinicLoc this is the location of the clinic 
    *@return bool the result will return true/false whether the sql query is successful
    */
    function edit_clinic($id, $clinicName, $clinicLoc)
    {
        $str_query = "update se_clinics set " . "clinic_id = '$id'," . "clinic_name = '$clinicName'," . "clinic_location = '$clinicLoc'," . "where id = $id";
        return $this->query($str_query);
    }
    
    
    /**
    *This function retrives the information for a given clinic using its id
    *@param int $id this represents the unique identifier for each clinic
    *@return bool the result will return true/false whether the sql query is successful
    */
        function get_clinic($id){
                $str_query = "SELECT * FROM se_clinics where clinic_id = $id";

                return $this->query($str_query);
        }
    
    /**
    *This function retrives the information for all clinics stored in the database
    *@return bool the result will return true/false whether the sql query is successful
    */

        function get_clinics(){
                $str_query = "SELECT * FROM se_clinics";

                return $this->query($str_query);
        }


    /**
     * @param $clinic_id
     * @param $clinic_name
     * @param $clinic_location
     * @return bool
     */
    function edit_details($clinic_id, $clinic_name, $clinic_location){
        $str_query = "UPDATE se_clinics SET
                      clinic_name = '$clinic_name',
                      clinic_location = '$clinic_location'";

        return $this->query($str_query);
    }

    /**
    *This function adds deletes the row storing data for a given clinic using its id
    *@param int $id this represents the unique identifier for each clinic
    *@return bool the result will return true/false whether the sql query is successful
    */
    
    function delete_clinic($id)
    {
        $str_query = "delete from  se_clinics where id = $id";
        return $this->query($str_query);
    }
    
    /**
    *This function adds searches for the rows with names of clinics that match the pattern
    *@param int $sn this represents the name of the clinic
    *@return bool the result will return true/false whether the sql query is successful
    */
    
    function search_clinic_by_name($sn)
    {
        $str_query = "select clinic_id, clinicName, clinic_location where clinic_name like '%$sn%'";
        return $this->query($str_query);
    }
    
}

?>

