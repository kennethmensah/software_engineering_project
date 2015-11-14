<script>
function updateNurse(){
    $('#content_area').slideUp();
    var nid = $("input[name='nid']").val();
    var fn = $("input[name='fn']").val();
    var sn = $("input[name='sn']").val();
    var g = $("input[name='gender']").val();
    var d = $("select[name='dpt']").val();
    
    xmlhttp = getXMLHttp();
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
          $('#status').fadeIn(1000).fadeOut(2000);
        document.getElementById("status").innerHTML=xmlhttp.responseText;
        getAllNurses();
        }
    }

    xmlhttp.open("GET","nurseFunctions.php?cmd=4&fn="+fn+"&sn="+sn
    +"&gender="+g+"&dpt="+d+"&nid="+nid,true);
    xmlhttp.send();
}

</script>

        <?php
        
       
            $nid = intval($_REQUEST['id']);
            include_once("nurses.php");
            include_once 'department.php';
            
                  
            $obj = new nurses();
            
            if(!$obj->get_nurse($nid)){
                echo 'could not find';
            }
                
            $row = $obj->fetch();
           
            
            $sname = $row['nurse_sname'];
            $fname = $row['nurse_fname'];
            $gender = $row['gender'];
            $department = intval($row['department']);
            
            $deptment = new departments();
        ?>
        <form action="nursesupdate.php" method="post" id="add-form">
           
                
                <legend> Update Nurse Information </legend>
                <table class="add">
                    <tr id="add-icon">
                        <td colspan="2">
                        <span class="flaticon-nurse7"></span>
                    </tr>
                <input type="hidden" name="nid" value="<?php 
                echo $nid ?>" >
                <tr>
                    <td>
                First name: </td>
                    <td><input type="text" size="40"name="fn" value="<?php echo $fname ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                Surname: </td>
                    <td><input type="text" size="40" name="sn" value="<?php echo $sname ?>"></td>
                </tr>
                <tr>
                <td>
                Gender: </td><td><input type="radio" name="gender" value="M">M 
                    <input type="radio" name="gender" value="F">F</td>
                </tr>
                <tr>
                <td>
                    
                    
                Department:</td><td><select name="dpt">
                    <?php 
                    include_once 'department.php';
                    
                    $obj1 = new departments();
                    $obj1->get_all_departments();
                    $rows = $obj1->fetch();
                    $counter = 0;
                    
                    $deptment->get_department($department);
                    $dpt_row = $deptment->fetch();
                    $dept = $dpt_row['department_name'];
                    echo "<option selected='selected' value='{$department}'>{$dept}</option>";
                    
                    while ($rows){
                        $counter++;
                        $department_name = $rows['department_name'];
                        echo "<option value='{$counter}'>{$department_name}</option>";
                        $rows = $obj1->fetch();
                    }
                    
                    ?>
                    </select></td></tr>
                <tr class="add-button">
                    <td colspan="2">
                        <input type="button" value="update" onclick="updateNurse()">
                    </td>
                </tr>
                </table>
          
        </form>    
    </body>
    

