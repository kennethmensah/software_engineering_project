<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 12/7/15
 * Time: 11:39 PM
 */

session_start();
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];
$email = $_SESSION['email'];
$loggedIn = $_SESSION['logged_in'];


$sname = $_SESSION['sname'];
$fname = $_SESSION['fname'];
$phone = $_SESSION['phone'];
$district = $_SESSION['district'];
$gender = $_SESSION['gender'];

?>