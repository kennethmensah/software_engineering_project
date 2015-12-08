<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php
if (isset($_REQUEST['fn']) && isset($_REQUEST['sn']) && isset($_REQUEST['pwd']) && isset($_REQUEST['aid'])) {
    include("administrator.php");
    $obj = new administrator();
    
    $fname    = $_REQUEST['fn'];
    $sname    = $_REQUEST['sn'];
    $gender   = $_REQUEST['gen'];
    $district = $_REQUEST['dis'];
    $age      = $_REQUEST['age'];
    $password = $_REQUEST['pwd'];
    $id       = $_REQUEST['aid'];
    
    if (!$obj->add_admin($sname, $fname, $gender, $age, $district, $id, $password)) {
        echo "Error adding" . mysql_error();
    } else {
        echo "Added $sname, $fname, $gender, $age,$district,$id,$password";
    }
}
?>
       <div class="container" id="form">
            <form action="administratorsadd.php" method="get">
                <div>Administrator Firstname: <input type="text" name="fn"></div>
                <div>Administrator Lastname: <input type="text" name="sn"></div>
                <div>Gender: <input type="text" name="gen"></div>
                <div>District: <input type="text" name="dis"></div>
                <div>Age: <input type="text" name="age"></div>
                <div>Employee ID: <input type="text" name="aid"></div>
                <div>Password <input type="text" name="pwd"></div>
                <div><input type="submit" value="Save" ></div>
            </form>
        </div>
    </body>
</html>
