<?php
if(filter_input (INPUT_GET, 'cmd')){
    $cmd = $cmd_sanitize = '';
    $cmd_sanitize = sanitizeString( filter_input (INPUT_GET, 'cmd'));
    $cmd = intval($cmd_sanitize);

    switch ($cmd){
        case 1:
            userSignupControl();
            break;
        case 2:
            userLoginControl();
            break;
        case 3:
            //userEditControl();
            break;
        case 4:
            editPasswordControl();
            break;
        case 5:
            userLogoutControl();
            break;
        case 6:
            getNursesInDistrict();
            break;
        case 7:
            getUserDetails();
            break;
        default:
            echo '{"result":0, "message":"Invalid Command Entered"}';
            break;
    }
}


/**
 * This function takes parameters from the the url
 * and adds the details of the user from the url
 * parameters to the database
 */
function userSignupControl(){

    $obj  = $username = $password = $usertype = $row = '';

    if( filter_input (INPUT_GET, 'user') && filter_input(INPUT_GET, 'pass')
        && filter_input(INPUT_GET, 'type') && filter_input(INPUT_GET, 'email')){

        $obj = getUserModel();
        $username = sanitizeString(filter_input (INPUT_GET, 'user'));
        $password = sanitizeString(filter_input (INPUT_GET, 'pass'));
        $password = encrypt($password);
        $usertype = sanitizeString(filter_input (INPUT_GET, 'type'));
        $email = sanitizeString(filter_input(INPUT_GET, 'email'));

        if ($obj->addUser($username, $password, $usertype, $email)){
            if( strcmp($usertype, 'admin') == 0)
            {
                //if user type is admin
                adminSignup($obj->get_insert_id());
            }
            elseif( strcmp($usertype, 'nurse') == 0)
            {
                //if user is a nurse
                nurseSignup($obj->get_insert_id());
            }
            elseif( strcmp($usertype, 'supervisor') == 0) {
                //if user is a supervisor
                supervisorSignup($obj->get_insert_id());
            }
        }
        else
        {
            echo '{"result":0,"message": "signup unsuccessful"}';
        }

    }
}


function setUserSessionDetails($username, $user_id, $user_type, $email){
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_type'] = $user_type;
    $_SESSION['email'] = $email;
    $_SESSION['logged_in'] = 'true';
}

function setUserSessionValues($sname, $fname, $phone, $district, $gender){
    $_SESSION['sname'] = $sname;
    $_SESSION['fname'] = $fname;
    $_SESSION['phone'] = $phone;
    $_SESSION['district'] = $district;
    $_SESSION['gender'] = $gender;
}

/**
 * @param $supervisor_id
 */
function supervisorSignup($supervisor_id){
    $obj = $sname = $fname = $district = $phone = '';
    if(filter_input (INPUT_GET, 'sname') && filter_input(INPUT_GET, 'fname')
        && filter_input(INPUT_GET, 'phone') && filter_input(INPUT_GET, 'district')
        && filter_input(INPUT_GET, 'gender')){
        $obj = getSupervisorModel();
        $sname = filter_input (INPUT_GET, 'sname');
        $fname = filter_input (INPUT_GET, 'fname');
        $phone = filter_input (INPUT_GET, 'phone');
        $district = filter_input (INPUT_GET, 'district');
        $gender = sanitizeString(filter_input (INPUT_GET, 'gender'));

        if($obj->addSupervisors($supervisor_id,$fname,$sname,$district,$phone,$gender)){
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
function nurseSignup($nurse_id){
    $obj = $sname = $fname = $phone = $gender = $email = '';
    if(filter_input (INPUT_GET, 'sname') && filter_input(INPUT_GET, 'fname') && filter_input(INPUT_GET, 'phone')
        && filter_input(INPUT_GET, 'gender') && filter_input(INPUT_GET, 'district')){
        $obj = getNurseModel();
        $sname = sanitizeString(filter_input (INPUT_GET, 'sname'));
        $fname = sanitizeString(filter_input (INPUT_GET, 'fname'));
        $phone = sanitizeString(filter_input (INPUT_GET, 'phone'));
        $gender = sanitizeString(filter_input (INPUT_GET, 'gender'));
        $district = sanitizeString(filter_input (INPUT_GET, 'district'));


        if($obj->addNurses($nurse_id, $sname, $fname,$district, $phone,$gender)){
            echo '{"result":1,"message": "signup successful"}';
        }
        else{
            echo '{"result":0,"message": "signup unsuccesful"}';
        }
    }
}

/**
 * controller function to login users
 */
function userLoginControl(){

    $obj = $username = $pass = '';

    if(filter_input (INPUT_GET, 'user') && filter_input(INPUT_GET, 'pass')){

        $obj = getUserModel();
        $username = sanitizeString(filter_input (INPUT_GET, 'user'));
        $pass = sanitizeString(filter_input (INPUT_GET, 'pass'));
        $pass = encrypt($pass);

        if($obj->getUser($username, $pass)){
            $row = $obj->fetch();

            if($row == 0){
                echo "Invalid user";
            }else {
                $username = $row['username'];
                $user_id = $row['user_id'];
                $user_type = $row['user_type'];
                $email = $row['email'];

                setUserSessionDetails($username,$user_id, $user_type,$email);


                if(strcmp($user_type, 'admin') == 0){
                    $admin = getAdminModel();
                    if($admin->getDetails($user_id)){
                        $row = $admin->fetch();
                        $sname = $row['sname'];
                        $fname = $row['fname'];
                        $district = $row['district'];
                        $phone = $row['phone'];
                        $gender = $row['gender'];
                        setUserSessionValues($sname,$fname,$phone, $district,$gender);
                        echo '{"result":1,"user_type":"' . $user_type . '", "district": "'.$district.'",
                         "user_id": "'.$user_id.'"}';
                        //header("Location: http://localhost/SE/software_engineering_project/version_2/view/admin_home.php");
                    }

                }elseif(strcmp($user_type, 'nurse') == 0){
                    $nurse = getNurseModel();
                    if($nurse->getDetails($user_id)){
                        $row = $nurse->fetch();
                        $sname = $row['sname'];
                        $fname = $row['fname'];
                        $district = $row['district_zone'];
                        $phone = $row['phone'];
                        $gender = $row['gender'];
                        setUserSessionValues($sname,$fname,$phone, $district,$gender);
                        echo '{"result":1,"user_type":"' . $user_type . '", "district": "'.$district.'",
                         "user_id": "'.$user_id.'"}';
                        //echo "user_name ". $sname. " phone ". $phone;
                        //header("Location: http://localhost/SE/software_engineering_project/version_2/view/nurse_home.php");
                    }
                }elseif(strcmp($user_type, 'supervisor') == 0){
                    $supervisor = getSupervisorModel();
                    if($supervisor->getDetails($user_id)){
                        $row = $supervisor->fetch();
                        $sname = $row['sname'];
                        $fname = $row['fname'];
                        $district = $row['district_zone'];
                        $phone = $row['phone'];
                        $gender = $row['gender'];
                        setUserSessionValues($sname,$fname,$phone, $district,$gender);
                        echo '{"result":1,"user_type":"' . $user_type . '", "district": "'.$district.'",
                         "user_id": "'.$user_id.'"}';
                        //echo "user_name ". $sname. " phone ". $phone;
                        //header("Location: http://localhost/SE/software_engineering_project/version_2/view/supervisor_home.php");
                    }
                }
            }
        }
        else{
            echo '{"result":0,"message": "Invalid User"}';
            $_SESSION['logged_in'] = false;
        }
    }else{
        echo '{"result":0,"message": "Invalid Credentials"}';
        $_SESSION['logged_in'] = false;
    }
}




/**
 * sanitize input from url
 *
 * @param $val
 * @return string
 */
function sanitizeString($val){
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlentities($val);

    return $val;
}

/**
 * this function encrypts a users password
 * with the ripe md 128 encryption
 *
 *
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
function getUserModel(){
    require_once '../model/user.php';
    $obj = new User();
    return $obj;
}


/**
 * @return Nurses
 */
function getNurseModel(){
    require_once '../model/nurse.php';
    $obj = new Nurses();
    return $obj;
}

/**
 * @return Supervisors
 */
function getSupervisorModel(){
    require_once '../model/supervisor.php';
    $obj = new Supervisors();
    return $obj;
}


/**
 * @return Admin
 */
function getAdminModel(){
    require_once '../model/admin.php';
    $obj = new Admin();
    return $obj;
}