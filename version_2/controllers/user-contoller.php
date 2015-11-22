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
        default:
            echo '{"result":0, "message":"Invalid Command Entered"}';
            break;
    }
}

//signup admin user
function user_signup_control(){
    
    $obj  = $username = $password = $usertype = $row = '';
    
    if( filter_input (INPUT_GET, 'username') && filter_input(INPUT_GET, 'password') && filter_input(INPUT_GET, 'usertype')){
    
        $obj = get_user_model();
        $username = sanitize_string(filter_input (INPUT_GET, 'username'));
        $password = sanitize_string(filter_input (INPUT_GET, 'password'));
        $password = encrypt($password);
        $usertype = sanitize_string(filter_input (INPUT_GET, 'usertype'));
        
        if ($obj->add_user($username, $password, $usertype)){
             if( strcmp($usertype, 'admin') == 0){
                //functionality not added yet
                //admin_signup($obj->get_insert_id());
             }elseif( strcmp($usertype, 'nurse') == 0){
                //functionality not added yet
                 //nurse_signup($obj->get_insert_id());
             }elseif( strcmp($usertype, 'supervisor') == 0){
                //functionality not added yet
                 //supervisor_signup($obj->get_insert_id());
             }
                
        }else{
            echo '{"result":0,"message": "signup unsuccessful"}';
        }
        
    }
}

//add new admin
function admin_signup($admin_id){
    $obj = $sname = $fname = $phone = '';
    if(filter_input (INPUT_GET, 'sname') && filter_input(INPUT_GET, 'fname') && filter_input(INPUT_GET, 'phone')){
        $obj = get_admin_model();
        $sname = filter_input (INPUT_GET, 'sname');
        $fname = filter_input (INPUT_GET, 'fname');
        $phone = filter_input (INPUT_GET, 'phone');
        
        if($obj->add_admin($admin_id, $sname, $fname, $phone)){
            echo '{"result":1,"message": "signup successful"}';
        }
        else{
            echo '{"result":0,"message": "signup unsuccesful"}';
        }
    }
}

//add new supervisor
function supervisor_signup($admin_id){
    $obj = $sname = $fname = $phone = '';
    if(filter_input (INPUT_GET, 'sname') && filter_input(INPUT_GET, 'fname') && filter_input(INPUT_GET, 'phone')){
        $obj = get_supervisor_model();
        $sname = filter_input (INPUT_GET, 'sname');
        $fname = filter_input (INPUT_GET, 'fname');
        $phone = filter_input (INPUT_GET, 'phone');
        
        if($obj->add_supervisor($admin_id, $sname, $fname, $phone)){
            echo '{"result":1,"message": "signup successful"}';
        }
        else{
            echo '{"result":0,"message": "signup unsuccesful"}';
        }
    }
}


//add new teller
function nurse_signup($teller_id){
    $obj = $sname = $fname = $phone = $gender = $email = '';
    if(filter_input (INPUT_GET, 'sname') && filter_input(INPUT_GET, 'fname') && filter_input(INPUT_GET, 'phone') && filter_input(INPUT_GET, 'gender') && filter_input(INPUT_GET, 'email')){
        $obj = get_nurse_model();
        $sname = sanitize_string(filter_input (INPUT_GET, 'sname'));
        $fname = sanitize_string(filter_input (INPUT_GET, 'fname'));
        $phone = sanitize_string(filter_input (INPUT_GET, 'phone'));
        $gender = sanitize_string(filter_input (INPUT_GET, 'gender'));
        $email = sanitize_string(filter_input (INPUT_GET, 'email'));
        
        if($obj->add_nurse($teller_id, $sname, $fname, $phone, $gender, $email)){
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
            
            $_SESSION['user'] = $row['username'];
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['user_type'] = $user_type = $row['user_type'];

            echo '{"result":1,"user_type":"'.$user_type .'"}';
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

//sanitize command sent
function sanitize_string($val){
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlentities($val);
    
    return $val;
}

//encrypt password
function encrypt($pass){
    $salt1 = "qm&h*";
    $salt2 = "pg!@";
    $token = hash('ripemd128', "$salt1$pass$salt2");
    return $token;
}

//create an instance of the user class
function get_user_model(){
    require_once '../model/user.php';
    $obj = new user();
    return $obj;
}


//function to get nurse model
function get_nurse_model(){
    require_once '../model/nurse.php';
    $obj = new nurses();
    return $obj;
}

//function to get supervisor model
function get_supervisor_model(){
    require_once '../model/supervisor.php';
    $obj = new supervisors();
    return $obj;
}


//function to get admin model
function get_admin_model(){
    require_once '../model/admin.php';
    $obj = new admin();
    return $obj;
}


?>