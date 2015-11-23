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
      xmlhttp.open("GET","taskFunctions.php?cmd=3&st="+str+"&sf=1",true);
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
    
    function getTasksAdd(){
            $("#content_area").slideDown();
            $("#content_area").load('tasksadd.php');
    }
    
    function getAllTasks() {
        xmlhttp = getXMLHttp();
        
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
           
          }
        }
        xmlhttp.open("GET","taskFunctions.php?cmd=3",true);
        xmlhttp.send();
    }
    
    function updateTask(id){
        $("#content_area").show();

        xmlhttp = getXMLHttp();
        
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("content_area").innerHTML=xmlhttp.responseText;
           
          }
        }
        xmlhttp.open("GET","taskFunctions.php?cmd=6&id="+id,true);
        xmlhttp.send();
    }
    
    
    
    function start(id){
        $("#content_area").show();

        xmlhttp = getXMLHttp();
        
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
              $('#status').fadeIn(1000).fadeOut(2000);
            document.getElementById("status").innerHTML=xmlhttp.responseText;
           
          }
        }
        xmlhttp.open("GET","taskFunctions.php?cmd=7&id="+id,true);
        xmlhttp.send();
    }
    
    function complete(id){
        $("#content_area").show();

        xmlhttp = getXMLHttp();
        
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
              $('#status').fadeIn(1000).fadeOut(2000);
            document.getElementById("status").innerHTML=xmlhttp.responseText;
           
          }
        }
        xmlhttp.open("GET","taskFunctions.php?cmd=8&id="+id,true);
        xmlhttp.send();
    }
    
    function sortBy(q){
        //$("#content_area").show();

        //var q = $('select[name="sort"]').val();
        xmlhttp = getXMLHttp();
        
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
           
          }
        }
        xmlhttp.open("GET","taskFunctions.php?cmd=4&q="+q,true);
        xmlhttp.send();
    }
    
    function viewTask(id){
       $("#content_area").slideDown();

        //var q = $('select[name="sort"]').val();
        xmlhttp = getXMLHttp();
        
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("content_area").innerHTML=xmlhttp.responseText;
           
          }
        }
        xmlhttp.open("GET","taskFunctions.php?cmd=6&id="+id,true);
        xmlhttp.send(); 
    }
    
    function viewByDue(){
        $("#over_due").slideToggle();

        xmlhttp = getXMLHttp();
        
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("over_due").innerHTML=xmlhttp.responseText;
           
          }
        }
        xmlhttp.open("GET","taskFunctions.php?cmd=11",true);
        xmlhttp.send();
    }
    
    function deleteTask(id){
        
        xmlhttp = getXMLHttp();
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            $('#status').fadeIn(1000).fadeOut(2000);
            document.getElementById("status").innerHTML=xmlhttp.responseText;
            sortBy(1);
          }
        }

        xmlhttp.open("GET","taskFunctions.php?cmd=2&id="+id,true);
        xmlhttp.send();

    }
    
    function update(id){
        $("#content_area").slideDown();
        $("#content_area").load('taskupdate.php?id='+id); 
    }
    
    function toggleSort(){
        $('#sort_menu').slideToggle();
    }
    
    $('document').ready(function(){
        $('#sort_menu').hide();
        $('#over_due').hide();
        sortBy(1);
    });
    
    
</script>
<div class="container">
    <h1>Tasks</h1>
    <div id="dash">
        <span class=ti-plus onclick="getTasksAdd()"></span>
        <span class=ti-calendar onclick="viewByDue()"></span>
        <span class=ti-pencil onclick="getAllNurses()"></span>
        <span class=ti-trash onclick="getAllNurses()"></span>
        <div id='sort'>
            Sort: <span class='ti-angle-down' onclick='toggleSort()'></span>
        </div>
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
    
    <div id='sort_menu'>
        <div onclick="sortBy(1)"><span class="ti-alarm-clock"></span> Due Date</div>
        <div onclick="sortBy(2)"><span class="ti-bell"></span> Priority</div>
    </div>
    
    <div id='over_due'>
        <h2>Overdue:</h2>
        <div class="tasks_overdue">
            <h3>Visit Ward 3 <span class="days_overdue">1 Day</span></h3>
            <p><span>Due: 2015-03-03</span><p>
        </div>
        <div class="tasks_overdue">
            <h3>Visit Ward 3 <span class="days_overdue">1 Day</span></h3>
            <p><span>Due: 2015-03-03</span><p>
        </div>
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



