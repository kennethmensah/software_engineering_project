<?php
session_start();

if(filter_input (INPUT_GET, 'cmd')){
    $cmd = $cmd_sanitize = '';
    $cmd_sanitize = sanitize_string( filter_input (INPUT_GET, 'cmd'));
    $cmd = intval($cmd_sanitize);
                                    
    switch ($cmd){
        case 1:
            user_signup_control();
            break;
        case 2:
            user_login_control();
            break;
        case 3:
            user_edit_control();
            break;
        case 4:
            edit_password_control();
            break;
        default:
            echo '{"result":0, "message":"Invalid Command Entered"}';
            break;
    }
}

/**
 *
 */
function user_signup_control(){
    
    $obj  = $username = $password = $usertype = $row = '';
    
    if( filter_input (INPUT_GET, 'user') && filter_input(INPUT_GET, 'pass')
        && filter_input(INPUT_GET, 'type') && filter_input(INPUT_GET, 'email')){
    
        $obj = get_user_model();
        $username = sanitize_string(filter_input (INPUT_GET, 'user'));
        $password = sanitize_string(filter_input (INPUT_GET, 'pass'));
        $password = encrypt($password);
        $usertype = sanitize_string(filter_input (INPUT_GET, 'type'));
        $email = sanitize_string(filter_input(INPUT_GET, 'email'));
        
        if ($obj->add_user($username, $password, $usertype, $email)){
             if( strcmp($usertype, 'admin') == 0)
             {
                //if user type is admin
                admin_signup($obj->get_insert_id());
             }
             elseif( strcmp($usertype, 'nurse') == 0)
             {
                //if user is a nurse
                 nurse_signup($obj->get_insert_id());
             }
             elseif( strcmp($usertype, 'supervisor') == 0){
                //if user is a supervisor
                 supervisor_signup($obj->get_insert_id());
             }
                
        }
        else
        {
            echo '{"result":0,"message": "signup unsuccessful"}';
        }
        
    }
}

/**
 * @param $admin_id
 */
function admin_signup($admin_id){
    $obj = $sname = $fname = $phone = '';
    if(filter_input (INPUT_GET, 'sname') && filter_input(INPUT_GET, 'fname')
        && filter_input(INPUT_GET, 'phone')
        && filter_input(INPUT_GET, 'district') && filter_input(INPUT_GET, 'gender')){
        $obj = get_admin_model();
        $sname = sanitize_string(filter_input (INPUT_GET, 'sname'));
        $fname = sanitize_string(filter_input (INPUT_GET, 'fname'));
        $phone = sanitize_string(filter_input (INPUT_GET, 'phone'));
        $district = sanitize_string(filter_input (INPUT_GET, 'district'));
        $gender = sanitize_string(filter_input (INPUT_GET, 'gender'));
        
        if($obj->add_admin($admin_id, $sname, $fname,$district, $phone, $gender)){
            echo '{"result":1,"message": "signup successful"}';
        }
        else{
            echo '{"result":0,"message": "signup unsuccesful"}';
        }
    }
}

/**
 * @param $supervisor_id
 */
function supervisor_signup($supervisor_id){
    $obj = $sname = $fname = $district = $phone = '';
    if(filter_input (INPUT_GET, 'sname') && filter_input(INPUT_GET, 'fname')
        && filter_input(INPUT_GET, 'phone') && filter_input(INPUT_GET, 'district')
        && filter_input(INPUT_GET, 'gender')){
        $obj = get_supervisor_model();
        $sname = filter_input (INPUT_GET, 'sname');
        $fname = filter_input (INPUT_GET, 'fname');
        $phone = filter_input (INPUT_GET, 'phone');
        $district = filter_input (INPUT_GET, 'district');
        $gender = sanitize_string(filter_input (INPUT_GET, 'gender'));
        
        if($obj->add_supervisors($supervisor_id,$fname,$sname,$district,$phone,$gender)){
            echo '{"result":1,"message": "signup successful"}';
        }
        else{
            echo '{"result":0,"message": "signup unsuccesful"}';
        }
    }
}


/**
 * @param $nurse_id
 */
function nurse_signup($nurse_id){
    $obj = $sname = $fname = $phone = $gender = $email = '';
    if(filter_input (INPUT_GET, 'sname') && filter_input(INPUT_GET, 'fname') && filter_input(INPUT_GET, 'phone')
        && filter_input(INPUT_GET, 'gender') && filter_input(INPUT_GET, 'district')){
        $obj = get_nurse_model();
        $sname = sanitize_string(filter_input (INPUT_GET, 'sname'));
        $fname = sanitize_string(filter_input (INPUT_GET, 'fname'));
        $phone = sanitize_string(filter_input (INPUT_GET, 'phone'));
        $gender = sanitize_string(filter_input (INPUT_GET, 'gender'));
        $district = sanitize_string(filter_input (INPUT_GET, 'district'));


        if($obj->add_nurses($nurse_id, $sname, $fname,$district, $phone,$gender)){
            echo '{"result":1,"message": "signup successful"}';
        }
        else{
            echo '{"result":0,"message": "signup unsuccesful"}';
        }
    }
}



//login function
function user_login_control(){

    $obj = $username = $pass = '';

    if(filter_input (INPUT_GET, 'user') && filter_input(INPUT_GET, 'pass')){
        
        $obj = get_user_model();
        $username = sanitize_string(filter_input (INPUT_GET, 'user'));
        $pass = sanitize_string(filter_input (INPUT_GET, 'pass'));
        $pass = encrypt($pass);
        
        if($obj->get_user($username, $pass)){
            $row = $obj->fetch();

            if($row == 0){
                echo "Invalid user";
            }else {
                $_SESSION['user'] = $row['username'];
                $_SESSION['id'] = $row['user_id'];
                $_SESSION['user_type'] = $user_type = $row['user_type'];

                echo '{"result":1,"user_type":"' . $user_type . '"}';
            }
        }
        else{
            echo '{"result":0,"message": "Invalid User"}';
        }
    }else{
        echo '{"result":0,"message": "Invalid Credentials"}';
    }
}


function set_user_details(){
    
}

function user_edit_control(){

}

function edit_password_control(){
    $obj  = $username = $password = '';

    if( filter_input (INPUT_GET, 'id') && filter_input(INPUT_GET, 'pass')){

        $obj = get_user_model();
        $user_id = sanitize_string(filter_input (INPUT_GET, 'id'));
        $password = sanitize_string(filter_input (INPUT_GET, 'pass'));
        $password = encrypt($password);

        if ($obj->edit_password_byId($user_id,$password)){
            echo '{"result":1,"message": "password changed successfully"}';
        }
        else
        {
            echo '{"result":0,"message": "signup unsuccessful"}';
        }

    }
}

/**
 * @param $val
 * @return string
 */
function sanitize_string($val){
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlentities($val);
    
    return $val;
}

/**
 * @param $pass
 * @return string
 */
function encrypt($pass){
    $salt1 = "qm&h*";
    $salt2 = "pg!@";
    $token = hash('ripemd128', "$salt1$pass$salt2");
    return $token;
}

/**
 * @return user
 */
function get_user_model(){
    require_once '../model/user.php';
    $obj = new user();
    return $obj;
}


/**
 * @return nurses
 */
function get_nurse_model(){
    require_once '../model/nurse.php';
    $obj = new nurses();
    return $obj;
}

/**
 * @return supervisors
 */
function get_supervisor_model(){
    require_once '../model/supervisor.php';
    $obj = new supervisors();
    return $obj;
}


/**
 * @return admin
 */
function get_admin_model(){
    require_once '../model/admin.php';
    $obj = new admin();
    return $obj;
}


?>