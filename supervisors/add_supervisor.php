<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php
            if(isset($_REQUEST['sfn'])){
                include("supervisors.php");
                $obj=new supervisors();
                
                $fname=$_REQUEST['sfn'];
                $lname=$_REQUEST['sln'];
                $gender=$_REQUEST['gen'];
                $nurseid=$_REQUEST['nid'];
                $taskid=$_REQUEST['tid'];
                
                if(!$obj->add_supervisor($fname,$lname,$gender,$nurseid,$taskid)){
                    echo "Error adding".mysql_error();
                }else{
                    echo "Added $fname, $lname, $gender, $nurseid, $taskid";
                }
            }
        ?>
        <div class="container" id="form">
            <form action="add_supervisor.php" method="get">
                <div>Supervisor Firstname: <input type="text" name="sfn"></div>
                <div>Supervisor Lastname: <input type="text" name="sln"></div>
                <div>Gender: <input type="text" name="gen"></div>
                <div>Nurse ID: <input type="text" name="nid"></div>
                <div>Task ID: <input type="text" name="tid"></div>
                <div><input type="submit" value="Add"></div>
            </form>
        </div>
    </body>
</html>