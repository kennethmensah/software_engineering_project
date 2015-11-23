<script>
function updateDepartment(){
    $('#content_area').slideUp();
    var did = $("input[name='did']").val();
    var dn = $("input[name='dn']").val();
    
    xmlhttp = getXMLHttp();
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
          $('#status').fadeIn(1000).fadeOut(2000);
        document.getElementById("status").innerHTML=xmlhttp.responseText;
      }
    }

    xmlhttp.open("GET","departmentFunctions.php?cmd=4&dn="+dn+"&did="+did
    ,true);
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

        <?php
            $did = intval($_REQUEST['id']);
            include_once 'department.php';
            
                  
            $obj = new departments();
            
            if(!$obj->get_department($did)){
                echo 'could not find';
            }
                
            $row = $obj->fetch();
            $dname = $row['department_name'];
        ?>
        <form action="" method="post" id="add-form">
           
                
                <legend> Department Information </legend>
                <table class="add">
                    <tr id="add-icon">
                        <td colspan="2">
                        <span class="flaticon-hospital14"></span>
                        </td>
                    </tr>
                <input type="hidden" name="did" value="<?php 
                echo $did ?>" >
                <tr>
                    <td>
                Department name: </td>
                    <td><input type="text" size="40"name="dn" value="<?php echo $dname ?>">
                    </td>
                </tr>
                
                <tr class="add-button">
                    <td colspan="2">
                        <input type="button" value="update" onclick="updateDepartment()">
                    </td>
                </tr>
                </table>
          
        </form>  
