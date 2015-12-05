<html>
    <head>
        <title></title>
    </head>
    <body>
    <?php

if (isset($_REQUEST['tt']) && isset($_REQUEST['td']) && isset($_REQUEST['cli']) && isset($_REQUEST['dt'])) {
    include("../model/district_task.php");
    $obj = new district_task();
    

    $task_title   = $_REQUEST['tt'];
    $task_desc    = $_REQUEST['td'];
    $clinics   = $_REQUEST['cli'];
    $date = $_REQUEST['dt'];

    $temp = strtotime($date);
    $end_date = date('Y-m-d', $temp);
   
    
    if (!$obj->add_district_task($task_title, $task_desc, $clinics, $end_date)) {
        echo "Error adding " . mysql_error();
    } else {
        echo "Added $task_title, $task_desc, $clinics, $end_date";
    }
}
?>
       <div class="container" id="form">
            <form action="add_district_task.php" method="get">
                <div>Task Title: <input type="text" name="tt"></div>
                <div>Task Description: <textarea name="td"></textarea></div>
                <div>Clinics: <input type="text" name="cli"></div>
                <div>Date: <input type="text" name="dt"></div>
                <div><input type="submit" value="Save" onsubmit = "confirmAdd()"></div>

            </form>
        </div>
    </body>
</html>
?>