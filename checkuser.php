<?php 
include_once 'users.php';


if (isset($_REQUEST['user']))
{
    $obj = new users();
    $user = $_REQUEST['user'];
    
    $result=$obj->get_user($user);
    $row = $obj->fetch();
    
    
    if ($user != $row['user']){
        echo '<span class="ti-check"></span>username available';
    }
    else {
        echo '<span class="ti-alert"></span>username taken';
    }
}
?>
