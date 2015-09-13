<html>
	<head>
		<title>Index</title>
		<link rel="stylesheet" href="css/style.css">
                <link rel="stylesheet" href="css/themify-icons/themify-icons.css">
                <link rel="stylesheet" href="css/flaticon.css" type="text/css">
                <script type="text/javascript" src="jquery-2.1.3.js"></script>
		<script>
                   
                    
                    function toggleNav(){
                            $('#sideNav').slideToggle();
                    }
                    
                    function toggleStatus(){
                            $('#status').slideToggle();
                    }
                    
                    function loadNurses(){
                        $('.container').slideUp(function(){
                            $('#workspace').load('nurseCentral.php');
                        });
                    }
                    
                    function loadDepartments(){
                        $('.container').slideUp(1000,function(){
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
                    
                    
                    function hideForm(d){
                        if(d==0){
                            $('#divContent h2 span').replaceWith('<span \n\
                    class="ti-angle-up" onclick="hideForm(1)"></span>');
                            $('#content_area').slideUp();
                        }else{
                            $('#divContent h2 span').replaceWith('<span \n\
                    class="ti-angle-down" onclick="hideForm(0)"></span>');
                            $('#content_area').slideDown();
                        }
                    }
                    
                    
			
		</script>
	</head>
        
	<body>
		<table id="body_table">
			<tr>
				<td colspan="2" id="pageheader">
					Application Header
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
                                                <li class="menuitem"><a href="dashboard.php">
                                                        <span class="ti-menu" ></span>
                                                        Menu</a></li>
                                                <li class="menuitem"><a href="dashboard.php">
                                                        <span class="ti-home" ></span>
                                                Home</a></li>
                                                
                                                <div id="profile_name"><span>Baby Got You</span> 
                                                    <span class="ti-angle-down"></span></div>
                                                <div id="profile"><img src="css/got you.jpg"></div>
                                            </ul>
                                        </nav>
                                </td>
                        </tr>
                        <tr id="mainPage">
                                    <td id="mainnav">
                                        <div id="aside">
                                            <h1><span class="ti-dashboard" onclick="toggleNav();"></span></h1>
                                            <div id="sideNav">
                                            <div class="menuitem">
                                                <a>
                                                    <span class="flaticon-nurse7" onclick="loadNurses()"></span>Nurses</a>
                                            </div>
                                            <div class="menuitem">
                                                <a><span class="flaticon-medical51" onclick="loadAdmin()"></span>Administrators</a>
                                            </div>
                                            <div class="menuitem">
                                                <a><span class="flaticon-medical50" onclick="loadTasks()"></span>Tasks</a>
                                            </div>
                                            <div class="menuitem">
                                                <a><span class="flaticon-hospital15" onclick="loadDepartments()"></span>Departments</a>
                                            </div>
                                            </div>
                                        </div>
                                        <div id="Notifications">
                                            <h1>Latest Notifications</h1>
                                            <div>See Doctor Martin</div>
                                            <div>Visit Ward 7</div>
                                            <div>Blood Drive Today</div>
                                        </div>
                                    </td>
                                    <td id="workspace">
                                        <div class="container">
                                            <h1>Nurses</h1>
                                            <div id="dash">
                                                <span class="ti-plus">Add</span>
                                                <span class="ti-pencil">Update</span>
                                                <span class="ti-trash">Delete</span>
                                                <div id="search"><input type="text"><span class="ti-search"></span></div>
                                            </div>
					<div id="status_content" >
                                            <h2>status message 
                                                <span class="ti-arrow-circle-down" onclick="toggleStatus()">
                                                    
                                                </span></h2>
                                            <div id="status">
                                            <div id="divStatus" class="error">
						status message <span class="ti-check" ></span>
                                            </div>
                                            </div>
                                                <div id="divStatus" class="success">
						status message <span class="ti-check" ></span>
                                            </div>
                                            
					</div>
					<div id="divContent">
                                            <h2><span class="ti-angle-down" onclick="hideForm(0)"></span></h2>
                                            <div id="viewArea">
                                                
                                                <div id="content_area">
                                                <form action="nursesadd.php" method="post" id="add-form">
            
                                                            <legend> Add Nurse </legend>
                                                            <table class="add">
                                                                <tr id="add-icon">
                                                                    <td colspan="2">
                                                                    <span class="flaticon-nurse7"></span>
                                                                
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                <td>
                                                                    First name:</td>
                                                                <td><input type="text" name="fn" id="fn"  required></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Surname: </td><td><input type="text" name="sn" id="sn"required></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Username: </td><td><input type="text" name="user" 
                                                                        onblur="checkUser(this.value)" required>
                                                                        <span id="userValidate"></span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Password: </td>
                                                                    <td>
                                                                        <input type="password" name="pass" 
                                                                               onblur="validatePassword()" required>
                                                                        <div id="passVal"></div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Gender:</td>
                                                                    <td>
                                                                        <input type="radio" name="gender" id="g" value="M" required>M 
                                                                        <input type="radio" name="gender" id="g"value="F" required>F
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Department:</td><td><select name="dpt" required>
                                                                <?php 

                                                                    echo '<option value="" id="dpt">--select a department--</option>';

                                                                ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr class="add-button">
                                                                <td colspan="2">
                                                                    <input type="button" value="add" onclick="add()">
                                                                </td>
                                                            </tr>

                                                            </table>

                                                    </form>
                                                </div>
                                            </div>
                                            
                                            <div id="displayArea">
						<table id="tableExample" class="reportTable" width="100%">
							<tr class="header">
								<th>Department Name</th>
                                                                <th>Department ID </th>
                                                                <th> </th>
							</tr>
							<tr class="row1">
								<td>data example</td>
								<td>123</td>
								<td class="modify">
                                                                <span class="ti-pencil" onclick=update('.$did.')></span>
                                                                <span class="ti-trash"  onclick=deleteDepartment('.$did.')></span>
                                                                </td>
								
							</tr>
							<tr class="row2">
								<td>data example</td>
								<td>123</td>
								<td class="modify">
                                                                <span class="ti-pencil" onclick=update('.$did.')></span>
                                                                <span class="ti-trash"  onclick=deleteDepartment('.$did.')></span>
                                                                </td>
							</tr>
                                                </table>
                                            </div>
					</div>
                                        </div>
				</td>
			</tr>
		</table>
	</body>
</html>	
