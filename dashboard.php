<?php 
//include_once 'header.php';
?>
<script>
    function getXMLHttp(){
        if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        } else {  // code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        return xmlhttp;
    }
    
    function getToday(){
        var d = new Date();
        var m = d.getMonth();
        var y = d.getFullYear();
        var day = d.getDate();
       
        m++;
        
        var fd = y+"-"+m+"-"+day;
        xmlhttp = getXMLHttp();
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
           
            document.getElementById("today_agenda").innerHTML=xmlhttp.responseText;
           
          }
        }
        xmlhttp.open("GET","taskFunctions.php?cmd=5&st="+fd,true);
        xmlhttp.send();
    }
    
    function getCompleted(){
        var status = 'completed';
        xmlhttp = getXMLHttp();
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
           
            document.getElementById("completed_area").innerHTML=xmlhttp.responseText;
           
          }
        }
        xmlhttp.open("GET","taskFunctions.php?cmd=9&st="+status,true);
        xmlhttp.send();
    }
    
    function getOngoing(){
        var status = 'ongoing';
        xmlhttp = getXMLHttp();
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
           
            document.getElementById("ongoing_area").innerHTML=xmlhttp.responseText;
           
          }
        }
        xmlhttp.open("GET","taskFunctions.php?cmd=9&st="+status,true);
        xmlhttp.send();
    }
    
    function getPending(){
        var status = 'not started';
        xmlhttp = getXMLHttp();
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
           
            document.getElementById("pending_area").innerHTML=xmlhttp.responseText;
           
          }
        }
        xmlhttp.open("GET","taskFunctions.php?cmd=9&st="+status,true);
        xmlhttp.send();
    }
    
    $(document).ready(function (){
       getToday();
       $('#completed_area').hide();
       $('#ongoing_area').hide();
       $('#pending_area').hide();
    });
    
    function showCompleted(){
       $('#completed_area').slideToggle(getCompleted());
    }
    
    function showOngoing(){
       $('#ongoing_area').slideToggle(getOngoing());
    }
    
    function showPending(){
       $('#pending_area').slideToggle(getPending());
    }
    
</script>
<div class="container">
    <h1>
        <?php
           echo date('d/m/Y');
        ?>
    </h1>
   <div id="status_content" >
       <h2>status message 
           <span class="ti-arrow-circle-down" onclick="toggleStatus()">

           </span></h2>
       <div id="status"></div>   
    </div>

    <div id="homePage">
        <div id="today">
            <h2>
        <span class="ti-alert" ></span>
        Today's Tasks:  
        <?php    echo date('d/m/Y');?>
            </h2>
        <div id="today_agenda" ></div>
        </div>

       <div id="completed">
        <h2>
            <span class="ti-check" onclick="showCompleted()"></span>
            Completed Tasks
        </h2>
        <div id="completed_area" ></div>
        </div>

        <div id="ongoing">
            <h2>
        <span class="ti-loop" onclick="showOngoing()"></span>
            Ongoing Tasks
            </h2>
        <div id="ongoing_area" ></div>
        </div>

        <div id="pending">
            <h2>
        <span class="ti-time" onclick="showPending()"></span>
            Pending Tasks
            </h2>
        <div id="pending_area" ></div>
        </div>
        
        <div id='task_details'>
            <h2>Task Details</h2>
            <table>
                <tr>
                    <td class='title'>
                        <span class='ti-user'></span>Assigned To:
                    </td>
                    <td class='value'>KK</td>
                    <td class='title'>
                        <span class='ti-agenda'></span>Task: 
                    </td>
                    <td class='value'>jjhh</td>
                </tr>
                <tr>
                    <td class='title'>
                        <span class='ti-calendar'></span>Date Assigned:
                    </td>
                    <td class='value'>0000-00-00</td>
                    <td class='title'>
                        <span class='ti-alarm-clock'></span>Due Date: 
                    </td>
                    <td class='value'>000-00-00</td>
                </tr>
                <tr>
                    <td class='title'>
                        <span class='ti-stats-up'></span>Date Started:
                    </td>
                    <td class='value'>0000-00-00</td>
                    <td class='title'>
                        <span class='ti-check-box'></span>Due Finished: 
                    </td >
                    <td class='value'>000-00-00</td>
                </tr>
                <tr>
                    <td class='title'>
                        <span class='ti-bar-chart'></span>Status:
                    </td>
                    <td class='value'>0000-00-00</td>
                    <td class='title'>
                        <span class='ti-signal'></span>Priority: 
                    </td>
                    <td class='value'>000-00-00</td>
                </tr>
            </table>
        </div>

    </div>
</div>

<?php
//include_once 'footer.php';
?>
