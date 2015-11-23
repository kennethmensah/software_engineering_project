<?php

/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/22/15
 * Time: 2:03 AM
 */
define("DB_HOST", 'localhost');

define("DB_NAME", "nurse_task_managerV2");
define("DB_PORT", 3307);
define("DB_USER","root");
define("DB_PWORD","");

define("LOG_LEVEL_SEC",0);
define("LOG_LEVEL_DB_FAIL",0);

define("PAGE_SIZE",10);

function log_msg ( $level, $er_code, $msg, $mysql_msg ) {
    return 0;
}

class adb
{

    /**error description*/
    var $str_error;
    /*error code*/
    var $error;
    /*db connection link*/
    var $link;
    /* Every error log has a 4 digit code. The first two digits(prefix) tells you which class logged the error*/
    var $er_code_prefix;
    /* query result resource*/
    var $result;
    /*isconnected*/
    var $isConnected;

    function adb ( )
    {

        $this->er_code_prefix=1000;
        $this->isConnected = false;
    }

    /**
     * logs error into database using functions defined in log.php
     */
    function log_error($level, $code, $msg, $mysql_msg = "NONE") {
        $er_code = $this->er_code_prefix + $code;
        //call to a predefined function
        $log_id = log_msg($level, $er_code, $msg, $mysql_msg);
        //if log id is false return 0;
        if (!$log_id) {
            return 0;
        }

//        display this code to user
        $this->error="$er_code-$log_id";
        return $log_id;
    }

    /**
     * creates connection to database
     */
    function establish_connection  ( )
    {

        if($this->isConnected)
        {
            return true;
        }
        //try to connect to db
        $this->link = mysqli_connect(DB_HOST,DB_USER, DB_PWORD, "nurse_task_managerV2");

        if (mysqli_connect_errno()) {
            //if connection fail log error and set $str_error
            echo "not connected";	//debug line
            $this->log_error(LOG_LEVEL_DB_FAIL,1, "connection failed  in db:connect()", mysqli_error($this->link));
            echo mysqli_error($this->link);
            return false;
        }

        return true;
    }


    /**
     *returns a row from a data set
     */
    function fetch ( )
    {
        return mysqli_fetch_assoc ( $this->result );
    }

    /**
     * connect to db and run a query
     */
    function query ( $str_sql )
    {

        if ( !$this->establish_connection ( ) )
        {
            return false;
        }

        $this->result = mysqli_query($str_sql,$this->link);
        if (!$this->result) {
            $this->log_error(LOG_LEVEL_DB_FAIL, 4, "query failed", mysqli_error($this->link));
            return false;
        }

        return true;
    }

    /**
     * returns number of rows in current dataset
     */
    function get_num_rows ( )
    {
        return mysqli_num_rows($this->result);
    }

    /**
     *returns last auto generated id
     */
    function get_insert_id ( )
    {
        return mysqli_insert_id($this->link);
    }

    /**
     * Function to close the sql connection
     */
    function close_connection ( )
    {
        return mysqli_close ( $this->link );
    }

}
