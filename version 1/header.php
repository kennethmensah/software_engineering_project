<html>
	<head>
		<title>Index</title>
		<link rel="stylesheet" href="css/style.css">
                <link rel="stylesheet" href="css/flaticon.css" type="text/css">
                <link rel="stylesheet" href="css/themify-icons/themify-icons.css"
                      type="text/css">
		
                
                <script type="text/javascript" src="jquery-2.1.3.js"></script>
                <script type="text/javascript">
                    
                    function loadNurses(){
                        $('.container').slideUp(function(){
                            $('#workspace').load('nurseCentral.php');
                        });
                    }
                    
                    function loadDepartments(){
                        $('.container').slideUp(function(){
                            $('#workspace').slideDown(
                            $('#workspace').load('departmentCentral.php'));
                        });
                    }
                    
                    function loadAdmin(){
                        $('.container').slideUp(function(){
                            $('#workspace').slideDown().load('adminCentral.php');
                        });
                    }
                    
                    function loadTasks(){
                        $('.container').slideUp(function(){
                            $('#workspace').load('taskView.php');
                        });
                    }
                    
                    function validatePassword(){
                        
                        var pass = $('input[type="password"]').val();
                        
                        if(pass.length <= 8){
                            $('#passVal').text('Password Too Short');
                        }
                        else{
                            $('#passVal').text('');
                        }
                    }
                    
                    function toggleNav(){
                            $('#sideNav').slideToggle();
                    }
                    
                    function toggleStatus(){
                            $('#status').slideToggle();
                    }
                    
                    function hideForm(d){
                        if(d==0){
                            $('#divContent h2 span').replaceWith('<span \n\
                    class="ti-angle-down" onclick="hideForm(1)"></span>');
                            $('#viewArea').slideUp();
                        }else{
                            $('#divContent h2 span').replaceWith('<span \n\
                    class="ti-angle-up" onclick="hideForm(0)"></span>');
                            $('#viewArea').slideDown();
                        }
                    }
                    
                    function load_file(file, element){
                        $(element).load(file);
                    }
                    
                    function display_date(day, month, year){
                        this.style.backgroundColor('white');
                            
                        
                        var date = day+"-"+month+"-"+year;
                        //alert(day+"-"+month+"-"+year);
                        $('#date_selected').val(date);
                    }
                    
                    function start(id){
                        xmlhttp = getXMLHttp();

                        xmlhttp.onreadystatechange=function() {
                          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById("status").innerHTML=xmlhttp.responseText;

                          }
                        }
                        xmlhttp.open("GET","taskFunctions.php?cmd=7&id="+id,true);
                        xmlhttp.send();
                    }
                    
                    function viewTask(id){
                        xmlhttp = getXMLHttp();

                        xmlhttp.onreadystatechange=function() {
                          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById("content_area").innerHTML=xmlhttp.responseText;

                          }
                        }
                        xmlhttp.open("GET","taskFunctions.php?cmd=10&id="+id,true);
                        xmlhttp.send();
                    }

                    function complete(id){
                        xmlhttp = getXMLHttp();

                        xmlhttp.onreadystatechange=function() {
                          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById("status").innerHTML=xmlhttp.responseText;

                          }
                        }
                        xmlhttp.open("GET","taskFunctions.php?cmd=8&id="+id,true);
                        xmlhttp.send();
                    }
                    
                    function checkUser(username){

                        var theUrl="checkuser.php?user="+username;
                        xmlhttp = getXMLHttp();
                        xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {

                          document.getElementById("userValidate").innerHTML=xmlhttp.responseText;
                        }
                        }

                        xmlhttp.open("GET",theUrl,true);
                        xmlhttp.send();

                    }
                    
                    
                </script>
	</head>
	<body>
            <?php
            session_start();
            if(isset($_SESSION['user'])){
                $user = $_SESSION['user'];
                $user_id = $_SESSION['id'];
                $isadmin = $_SESSION['admin'];
                $fname = $_SESSION['fname'];
                $sname = $_SESSION['sname'];
                
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
                                <nav id="divPageMenu">
                                    <ul class="topmenu">
                                        <li class="menuitem">
                                            <a href="dashboard.php"><span class="ti-user" ></span>
                                                Profile</a>
                                            <ul class="submenu">
                                                <li><a href="logout.php">
                                                    <span class="ti-power-off" ></span>
                                                    Logout</a></li>
                                                <li><a href="editProfile.php">
                                                    <span class="ti-settings" ></span>
                                                    Settings</a></li>
                                            </ul>
                                        </li>
                                        <li class="menuitem"><a><span class="ti-menu" ></span>
                                                Menu</a></li>
                                        <li class="menuitem"><a href="dashboard.php">
                                                <span class="ti-home" ></span>
                                        Home</a></li>

                                        <div id="profile_name"><span><?php
                                                if(isset($_SESSION['user'])){
                                                    echo "{$fname}"." "." {$sname}"." Logged In";
                                                }else{
                                                    echo 'Not Logged In';
                                                }
                                                ?></span> 
                                            <span class="ti-angle-down"></span>
                                        </div>

                                    </ul>
                                </nav>
                            </td>
                        </tr>
                        <tr id="mainPage">
                            <td id="mainnav">
                                    <?php 
                                    if ($isadmin){
                                        
                                        echo'
                                        <div id="aside">
                                            <h1><span class="ti-dashboard" onclick="toggleNav();"></span></h1>
                                            <div id="sideNav">
                                            <div class="menuitem"><a >
                                            <span class="flaticon-nurse7" onclick="loadNurses()"></span>
                                                     Nurses</a>
                                             </div>
                                             <div class="menuitem"><a>
                                             <span class="flaticon-medical51" onclick="loadAdmin()"></span>
                                                 Administrators</a>
                                             </div>
                                             <div class="menuitem"><a>
                                             <span class="flaticon-medical50" onclick="loadTasks()"></span>
                                                 Tasks</a>
                                             </div>
                                             <div class="menuitem"><a>
                                             <span class="flaticon-hospital15" onclick="loadDepartments()"></span>
                                                 Departments</a>
                                             </div>
                                             </div>
                                        </div>
                                        <div id="Notifications">
                                            <h1>Latest Notifications</h1>
                                            <div>See Doctor Martin</div>
                                            <div>Visit Ward 7</div>
                                            <div>Blood Drive Today</div>
                                        
                                        <div id="socialmedia">
                                            <span class="ti-twitter"></span>
                                            <span class="ti-facebook"></span>
                                            <span class="ti-instagram"></span>
                                            <span class="ti-google"></span>
                                        </div>
                                    </div>';
                                    }
                                    elseif(!$isadmin && isset ($_SESSION['user'])){
                                        
                                        echo '
                                            <div id="aside">
                                            <h1><span class="ti-dashboard" onclick="toggleNav();"></span></h1>
                                            <div id="sideNav">
                                        <div class="menuitem"><a
                                        href="taskView.php"><span class="flaticon-medical50"></span>
                                            Tasks</a>
                                            </div>
                                            </div>
                                        </div>
                                        <div id="Notifications">
                                            <h1>Latest Notifications</h1>
                                            <div>See Doctor Martin</div>
                                            <div>Visit Ward 7</div>
                                            <div>Blood Drive Today</div>
                                        
                                        <div id="socialmedia">
                                            <span class="ti-twitter"></span>
                                            <span class="ti-facebook"></span>
                                            <span class="ti-instagram"></span>
                                            <span class="ti-google"></span>
                                        </div>
                                    </div>';
                                            
                                    }
                                    else{
                                        header('Location: login.php');
                                    }
                                    ?>
                                    
            
				</td>
                                <td id="workspace">
                                    <div class="container">
                                        <h1>Nurses</h1>
                                    </div>
                                </td>
			</tr>
		</table>
	</body>
</html>
                                

				
                                    
