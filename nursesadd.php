<script type="text/javascript" src="jquery-2.1.3.js"></script>
<script>
    function add(){
        
    var fn = $("input[name='fn']").val();
    var sn = $("input[name='sn']").val();
    var g = $("input[type='radio']:checked").val();
    var d = $("select[name='dpt']").val();
    var user = $("input[name='user']").val();
    var pass = $("input[name='pass']").val();
    
    $('#content_area').slideUp();
    
    xmlhttp = getXMLHttp();
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        $('#status').fadeIn(1000).fadeOut(1000);
        document.getElementById("status").innerHTML=xmlhttp.responseText;
        getAllNurses();
        }
    }

    xmlhttp.open("GET","nurseFunctions.php?cmd=2&fn="+fn+"&sn="+sn
    +"&gender="+g+"&dpt="+d+"&user="+user+"&pass="+pass,true);
    xmlhttp.send();

}
    
    
    function sendRequest(u){
				// Send request to server
				//u a url as a string
				//async is type of request
                                
                var obj=$.ajax({url:u,async:false});

                //Convert the JSON string to object
                var result=$.parseJSON(obj.responseText);
                return result;	//return object
    }


</script>

        
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
                            <input type="radio" name="gender" id="g" value="F" required>F
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Department:</td>
                        <td><select name="dpt" required>
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
                        <input type="button" value="add" onclick="add()">
                    </td>
                </tr>
                    
                </table>
            
        </form>

        


    

