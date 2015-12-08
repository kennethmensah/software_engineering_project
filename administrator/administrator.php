<?php

include_once("adb.php");

/*
This class represents a district administrator who can create tasks and 
assign them to supervisors within his/her district
*/
class administrator extends adb
{
    
    /*
    This is a constructor for the administrator class 
    */
    function administrator()
    {
        
    }
    
    /**
    * This function adds a new adminitrator given the required parameters
    * 
    *@param String $sname this is the surname of the administrator
    *@param String $fname this is the first name of the administrator
    *@param String $gender this is the gender of the administrator
    *@param int $age this is the age of the administrator
    *@param String $district this is the district of in which the administrator manages 
    *@param int $id this represents the employee id of the administrator
    *@param String $password this is the password which the administrator will use to log in
    *@return bool the result will return true/false whether the sql query is successful
    */
    
    function add_admin($sname, $fname, $gender, $age, $district, $id, $password)
    {
        
        $str_query = "insert into administrator set " . "firstname = '$fname'," . "lastname = '$sname'," . "gender = '$gender'," . "age = '$age'," . "district = '$district'," . "id = '$id'," . "password = '$password' ";
        return $this->query($str_query);
    }
    
    /**
    * This function adds a new adminitrator given the required parameters
    *@param String $sname this is the surname of the administrator
    *@param String $fname this is the first name of the administrator
    *@param String $gender this is the gender of the administrator
    *@param int $age this is the age of the administrator
    *@param String $district this is the district of in which the administrator manages 
    *@param int $id this represents the employee id of the administrator
    *@return bool the result will return true/false whether the sql query is successful
    */
    function edit_administrator($id, $sname, $fname, $gender, $age, $district)
    {
        $str_query = "update administrator set " . "firstname = '$fname'," . "lastname = '$sname'," . "gender = '$gender'," . "age = '$age', " . "district = '$district', " . "where id = $id";
        return $this->query($str_query);
    }
    
    
    /**
    *This function retrives the information for a given administrator using their id
    *@param int $id this represents the employee id of the administrator
    *@return bool the result will return true/false whether the sql query is successful
    */
    function get_administrator($id)
    {
        $str_query = "select firstname, lastname, gender, age, district
                from administrator
                where id = $id";
        return $this->query($str_query);
    }
    
    /**
    *This function adds retrives the information for all administrators stored in the database
    *@return bool the result will return true/false whether the sql query is successful
    */
    function get_administrators()
    {
        $str_query = "select id, firstname, lastname, gender, age,
            district from administrator";
        
        return $this->query($str_query);
    }
    /**
    *This function adds deletes the row storing data for a given administrator using their id
    *@param int $id this represents the employee id of the administrator
    *@return bool the result will return true/false whether the sql query is successful
    */
    
    function delete_admin($id)
    {
        $str_query = "delete from administrator where id = $id";
        return $this->query($str_query);
    }
    
    /**
    *This function adds searches for the rows whose surname for administrator match the pattern
    *@param int $sn this represents the surname of the administrator
    *@return bool the result will return true/false whether the sql query is successful
    */
    
    function search_admin_by_name($sn)
    {
        $str_query = "select admin_id, firstname, lastname, gender,
            age, district administrator where lastname like '%$sn%'";
        return $this->query($str_query);
    }
    
}



?>
