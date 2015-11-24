<html>
    <head>
        <title></title>
    </head>
    <body>
    <?php
     date_default_timezone_set('UTC');

if (isset($_REQUEST['fn']) && isset($_REQUEST['sn']) && isset($_REQUEST['pwd']) && isset($_REQUEST['aid'])) {
    include("district_task.php");
    $obj = new district_task();
    

    $task_title   = $_REQUEST['tt'];
    $task_desc    = $_REQUEST['td'];
    $clinics   = $_REQUEST['cli'];
    $date = $_REQUEST['dt'];

    $end_date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
   
    
    if (!$obj->add_admin($task_title, $task_desc, $clinics, $end_date)) {
        echo "Error adding" . mysql_error();
    } else {
        echo "Added $task_title, $task_desc, $clinics, $end_date";
    }
}
?>
       <div class="container" id="form">
            <form action="add_district_task.php" method="get">
                <div>Task Title: <input type="text" name="tt"></div>
                <div>Task Description: <textarea name="sn"><textarea></div>
                <div>Clinics: <input type="text" name="cli"></div>
                <div>Date: <input type="text" name="dt"></div>
                <div><input type="submit" value="Save" ></div>

            </form>
        </div>
    </body>
</html>