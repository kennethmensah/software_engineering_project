<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 11/22/15
 * Time: 7:47 AM
 */

$con = mysqli_connect("localhost","root","","nurse_task_managerV2");

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//$str_query = "INSERT INTO se_users (username, password, user_type, email)
//VALUES ('amakye.dede','amakye.dede','nurse','aben.woha')";
//
//
//if(mysqli_query($con, $str_query)){
//    echo "worked";
//}else{
//    echo "did not work";
//}

$str_query = "INSERT INTO se_users SET
              username = 'KwameAnim',
              password = 'Ajaie',
              email = 'k.a@sth.com'";


if(mysqli_query($con, $str_query)){
    echo "worked";
}else{
    echo "did not work";
}

mysqli_close($con);

?>