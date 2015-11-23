<?php
//include_once 'header.php';
?>
<script>
function showResult(str) {
    
  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  xmlhttp = getXMLHttp();
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        
      document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","departmentFunctions.php?cmd=1&st="+str,true);
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
    
    function getDepartmentAdd(){
            $("#content_area").show();
            $("#content_area").load('departmentsadd.php');
    }
    
    function getAllDepartments() {
        
        xmlhttp = getXMLHttp();
        
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
           
          }
        }
        xmlhttp.open("GET","departmentFunctions.php?cmd=3",true);
        xmlhttp.send();
        
    }
    
    function deleteDepartment(id){

        xmlhttp = getXMLHttp();
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            $('#status').fadeIn(1000).fadeOut(2000);
            document.getElementById("status").innerHTML=xmlhttp.responseText;
          }
        }

        xmlhttp.open("GET","departmentFunctions.php?cmd=5&id="+id,true);
        xmlhttp.send();

    }
    
    function update(id){
        
        $("#content_area").show();
        $("#content_area").load('departmentUpdate.php?id='+id); 
    }
    
    function hideStatus(){
        $('#status').slideUp();
    }
    
    $('document').ready(function(){
        getAllDepartments();
    });
    
</script>

<div class="container">
    <h1>Departments</h1>
    <div id="dash">
        <span class=ti-plus onclick="getDepartmentAdd()"></span>
        <span class=ti-pencil onclick="getAllDepartments()"></span>
        <span class=ti-trash onclick="getAllDepartments()"></span>
        <div id="search">
            <input type="text" type="text" name="st" size="40" max-size="60" 
                   onkeyup="showResult(this.value)">
            <span class="ti-search"></span>
        </div>
    </div>
    <div id="status_content">
    <h2>status message 
        <span class="ti-arrow-circle-down" onclick="toggleStatus()">

        </span></h2>
    <div id="status"></div>                                        
</div>
    
<div id="divContent">
    <h2><span class="ti-angle-down" onclick="hideForm(0)"></span></h2>
    <div id="viewArea">
        <div id="content_area"></div>
    </div>

    <div id="displayArea">
        <div id="livesearch"></div>
    </div>
    </div>
    
</div>


