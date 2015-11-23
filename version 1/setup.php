<?php

include_once 'adb.php';

class setup extends adb{
    
    function setup(){}
    
    function createTable($name, $query){
        $str_query = "create table if not exists " . $name . "(".$query. ")";
        return $this->query($str_query);
    }
    
}

$obj = new setup();

$obj->createTable('webPro_department', 'department_id INT AUTO_INCREMENT PRIMARY KEY,'
        . 'department_name VARCHAR(30)');

$obj->createTable('webPro_nurses', 'nurse_id INT AUTO_INCREMENT PRIMARY KEY,'
        . 'nurse_fname VARCHAR(50),'
        . 'nurse_sname VARCHAR(50),'
        . 'gender CHAR,'
        . 'department INT,'
        .'FOREIGN KEY (department) REFERENCES  webPro_department(department_id)');


$obj->createTable('webPro_administrators', 'admin_id INT AUTO_INCREMENT PRIMARY KEY,'
        . 'admin_fname VARCHAR(50),'
        . 'admin_sname VARCHAR(50),'
        . 'gender CHAR,'
        . 'department INT,'
        . 'position VARCHAR(20),'
         .'FOREIGN KEY (department) REFERENCES  webPro_department(department_id)');

$obj->createTable('webPro_tasks', 'task_id INT AUTO_INCREMENT PRIMARY KEY,'
        . 'description VARCHAR(100),'
        . 'nurse INT,'
        . 'date DATE,'
        . 'due_date DATE,'
        . 'date_started DATE,'
        . 'date_finished DATE,'
        . 'assigned_by INT,'
        . 'task_status VARCHAR(15) DEFAULT "not started",'
        . 'isadmin TINYINT(1),'
        . 'time TIME,'
        . 'FOREIGN KEY (nurse) REFERENCES  webPro_nurses(nurse_id)');

$obj->createTable('webPro_users', 'user VARCHAR(50),'
        . 'password VARCHAR(20),'
        . 'admin BOOLEAN,'
        . 'id INT');

include_once 'administrator.php';
include_once 'users.php';
$fname = 'admin';
$sname = '';
$gender = 'M';
$department = 1;
$username = 'admin';
$password = 'admin';

$obj = new administrator();
$user = new users();
$admin = 1;
$obj->add_admin($sname, $fname, $gender, $department);
$id = $obj->get_insert_id();
$user->add_users($username, $password, $admin, $id);
?>
