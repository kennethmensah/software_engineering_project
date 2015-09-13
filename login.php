<html>
    <head>
        <title>Index</title>
		<link rel="stylesheet" href="css/style.css">
                <link rel="stylesheet" href="css/flaticon.css" type="text/css">
                <link rel="stylesheet" href="css/themify-icons/themify-icons.css"
                      type="text/css">
		
                
                <script type="text/javascript" src="jquery-2.1.3.js"></script>
    </head>
    <body>
<?php
    //include_once 'header.php';
    session_start();
    if(isset($_SESSION['user'])){
        header('Location: index.php');
    }
?>
        <table id="body_table">
			<tr>
				<td colspan="2" id="pageheader">
                                    <span class="flaticon-caduceus3"></span>Nurse Aid
				</td>
			</tr>
			<tr>
                            <td id="content" colspan="2">
                                <div id="divPageMenu">
                                    <ul class="topmenu">
                                        <li class="menuitem"><a>
                                                <span class="ti-home" ></span>
                                        Home</a></li>

                                        <div id="profile_name"><span><?php
                                                if(isset($_SESSION['user'])){
                                                    echo "{$fname}"." "." {$sname}"." Logged In";
                                                }else{
                                                    echo 'Not Logged In';
                                                }
                                                ?></span>
                                            
                                        </div>
                                        </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                           
                            <td id="login" colspan="2">
                            <div id="login_container">                          
                                <div id="login-div">
                                    <form action="login.php" method="get" id="login_form" align="center">
                                        <table align="center" class="login-table">
                                            <tr class="logo">
                                                <td colspan="2"><span class="flaticon-caduceus3"></span>
                                                    
                                                </td>
                                        </tr>
                                        <tr>
                                            <td>username:</td><td><input type="text" name="user" 
                                                                         required></td>
                                        </tr>
                                        <tr>
                                            <td>password:</td><td><input type="password" name="pass" 
                                                                         required></td>
                                        </tr>
                                        <tr class="login-button">
                                        <td colspan="2"><input type="submit" value="login"></td>
                                        </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </td>
                      </tr>
                      <tr>
                          <td id="login_banner" colspan="2">
                              <p>Nurse Aid &COPY; is optimized for task management. Nurse Aid is constantly reviewed to 
                                  avoid errors, but we cannot warrant full correctness of all content. 
                                  While using this site, you agree to have read and accepted our terms of use, 
                                  cookie and privacy policy. Copyright &nbsp;<?php echo date('Y') ?> by Refsnes Data. 
                                  All Rights Reserved.</p>
                            </td>
                      </tr>
    
        </table>
        
        <?php
            include_once 'users.php';
            
            function sanitizeString($var){
                
                $var = stripslashes($var);
                $var = htmlentities($var);
                $var = strip_tags($var);
                return $var;
            }
            
            
          
            if(isset($_REQUEST['user'])){
                $obj = new users();
                $user = $_REQUEST['user'];
                $pass = sanitizeString($_REQUEST['pass']);
                
                $pass_encrypt = $obj->encrypt("$pass");
                
                
                if($user == "" || $pass == ""){
                    echo 'not all fields have been filled';
                }else{
                
                    if(!$obj->get_user($user)){
                        echo 'invalid username or password';
                    }
                    else{
                        $row = $obj->fetch();
                        $password = $row['password'];
                        if($password == $pass_encrypt){
                            if($row['admin'] == 0){
                                session_start();
                                $id = $row['id'];
                                echo $id;
                                include_once 'nurses.php';
                                $user_nurse = new nurses();
                                $user_nurse->get_nurse($id);
                                $user_row = $user_nurse->fetch();   
                                
                                $_SESSION['user'] = $user;
                                $_SESSION['fname'] = $user_row['nurse_fname'];
                                $_SESSION['sname'] = $user_row['nurse_sname'];
                                $_SESSION['id'] = $id;
                                $_SESSION['admin'] = false;
                                
                                header('Location: index.php');
                            }
                            else{
                                session_start();
                                $id = $row['id'];
                                
                                include_once 'administrator.php';
                                $user_admin = new administrator();
                                $user_admin->get_administrator($id);
                                $user_row = $user_admin->fetch();       
                                        
                                session_start();
                                
                                $_SESSION['user'] = $user;
                                $_SESSION['fname'] = $user_row['admin_fname'];
                                $_SESSION['sname'] = $user_row['admin_sname'];
                                $_SESSION['id'] = $id;
                                $_SESSION['admin'] = true;
                                header('Location: index.php');
                            }
                        }
                    }
                }
            }
        ?>
        
    </body>
</html>
