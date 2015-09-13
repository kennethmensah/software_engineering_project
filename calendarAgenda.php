<?php
    //include_once 'calendar.php';
?>
            <script>
                function getDate(d, m, y){
                    
                    //$('.daysTask').text(y +"-"+m+"-"+d);
                    date = y +"-"+m+"-"+d;
                    xmlhttp = getXMLHttp();
                    xmlhttp.onreadystatechange=function() {
                  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    
                    //document.getElementById("status").innerHTML=xmlhttp.responseText;
                    $('.daysTask').html(xmlhttp.responseText);
                    }
                  }

                  xmlhttp.open("GET","taskFunctions.php?cmd=12&date="+date,true);
                  xmlhttp.send();
                }
                
                    
    function previousMonth(){
        
        var month = $('#cal_mth').text();
        
        month--;
        if(month > 0){
            
            showCalendarMonth(month);
        }
    }
    
    function nextMonth(){
        
        var month = $('#cal_mth').text();
        month++;
        if( month <= 12){
            
            showCalendarMonth(month);
        }
    }
    
    function previousYear(){
        
        var year = $('#cal_yr').text();
        
        year--; 
        showCalendarYear(year);
        
    }
    
    function nextYear(){
        
        var year = $('#cal_yr').text();
        year++;
        showCalendarYear(year);    
    }
    
    function showCalendar() {
        //$('#calendar_area').slideToggle();
        var d = new Date();

        var m = d.getMonth();
        m++;

        var y = d.getFullYear();
        xmlhttp=getXMLHttp();
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("calendar_area").innerHTML=xmlhttp.responseText;
          }
        }
        xmlhttp.open("GET","calendar.php?cmd=2&m="+m+"&y="+y,true);
        xmlhttp.send();
    }
    
    function showCalendarMonth(m) {
        var d = new Date();

        var y = d.getFullYear();
        xmlhttp=getXMLHttp();
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("calendar_area").innerHTML=xmlhttp.responseText;
   
          }
        }
        xmlhttp.open("GET","calendar.php?cmd=2&m="+m+"&y="+y,true);
        xmlhttp.send();
    }
    
    function showCalendarYear(y) {
        var m = $('#cal_mth').text();
        xmlhttp=getXMLHttp();
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("calendar_area").innerHTML=xmlhttp.responseText;
          }
        }
        xmlhttp.open("GET","calendar.php?cmd=2&m="+m+"&y="+y,true);
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
    
    $('document').ready( function(){
        showCalendar();
    });
        
    
            </script>

  <div class="container">

    <h1>Calendar</h1>      
        <div id="calendar_area"></div>
        
 </div>

