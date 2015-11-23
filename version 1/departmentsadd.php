<script>
function addDepartment(){
    
    var dn = $("input[name='dn']").val();
    if(dn.length != 0){
        $('#content_area').slideUp();
    xmlhttp = getXMLHttp();
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
          $('#status').fadeIn(1000).fadeOut(2000);
        document.getElementById("status").innerHTML=xmlhttp.responseText;
      }
    }

    xmlhttp.open("GET","departmentFunctions.php?cmd=2&dn="+dn,true);
    xmlhttp.send();
    }else{
      $("input[name='dn']").val('Please enter something');  
    }

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

<form action="" method="post" id="add-form">
                <legend> Add Department Information </legend>
                <table class="add">
                    <tr id="add-icon">
                        <td colspan="2">
                        <span class="flaticon-hospital15"></span>
                        </td>
                    </tr>
                <input type="hidden" name="did" >
                <tr>
                    <td>
                Department name: </td>
                    <td><input type="text" size="40"name="dn" >
                    </td>
                </tr>
                
                <tr class="add-button">
                    <td colspan="2">
                        <input type="button" value="add" onclick="addDepartment()">
                    </td>
                </tr>
                </table>
          
        </form>  

