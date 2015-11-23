
<script>
    function addAdmin(){
        $('#content_area').slideUp();
        var fn = $("input[name='fn']").val();
        var sn = $("input[name='sn']").val();
        var g = $("input[name='gender']:checked").val();
        var d = $("select[name='dpt']").val();
        var user = $("input[name='user']").val();
        var pass = $("input[name='pass']").val();

        xmlhttp = getXMLHttp();
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
              $('#status').fadeIn(1000).fadeOut(2000);
            document.getElementById("status").innerHTML=xmlhttp.responseText;
            getAllAdmins();
            }
        }

        xmlhttp.open("GET","adminFunctions.php?cmd=2&fn="+fn+"&sn="+sn
        +"&gender="+g+"&dpt="+d+"&user="+user+"&pass="+pass,true);
        xmlhttp.send();

    }

        function getXMLHttp(){
            if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            } else {  // code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            return xmlhttp;
        }
</script>

        <form action="administratorsadd.php" method="post" id="add-form">
            <legend> Add Administrator </legend>
                <table class="add">
                    <tr id="add-icon">
                        <td colspan="2">
                        <span class="flaticon-medical51"></span>
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
                        <td><input type="password" name="pass" 
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
                    include_once 'department.php';
                    $obj = new departments();
                    $obj->get_all_departments();
                    $rows = $obj->fetch();
                    $counter = 0;
                    echo '<option value="" id="dpt">--select a department--</option>';
                    
                    while ($rows){
                        $counter = $rows['department_id'];
                        $department_name = $rows['department_name'];
                        echo "<option value='{$counter}'>{$department_name}</option>";
                        $rows = $obj->fetch();
                    }
                    
                    ?>
                        </select>
                    </td>
                </tr>
                <tr class="add-button">
                    <td colspan="2">
                        <input type="button" value="add" onclick="addAdmin()">
                    </td>
                </tr>
                    
                </table>
        </form>
        

