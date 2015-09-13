

<script type="text/javascript">
    
    function previousMonth(){
        
        var month = $('#cal_mth').text();
        
        var d = new Date();
        var m = d.getMonth();
        m++; 
        if(month > m){
            month--;
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
        
        var d = new Date();
        var y = d.getFullYear();
        y++; 
        if(year >= y){
            year--;
            showCalendarYear(year);
        }
    }
    
    function nextYear(){
        
        var year = $('#cal_yr').text();
        year++;
        var d = new Date();
        var y = d.getFullYear();
        var max = y+3;
        if(year < max){
            showCalendarYear(year);
        }
    }
    
    function showCalendar() {
        $('#calendar_area').slideToggle();
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
        xmlhttp.open("GET","calendar.php?cmd=1&m="+m+"&y="+y,true);
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
        xmlhttp.open("GET","calendar.php?cmd=1&m="+m+"&y="+y,true);
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
        xmlhttp.open("GET","calendar.php?cmd=1&m="+m+"&y="+y,true);
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
    
    function display_date(d,m,y){
        var date = y+"-"+m+"-"+d;
        $('#date').val(date);
    }
    
    function addTask(){
        $('#content_area').slideUp();
    var nurse = $("select[name='nurse']").val();
    var task = $("textarea[name='task']").val();
    var dd = $("input[name='d_date']").val();
    var p = $("select[name='priority']").val();
    
    xmlhttp = getXMLHttp();
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        $('#status').fadeIn(1000).fadeOut(1000);
        document.getElementById("status").innerHTML=xmlhttp.responseText;
        sortBy(1);
      }
    }

    xmlhttp.open("GET","taskFunctions.php?cmd=1&nurse="+nurse+"&task="+task
    +"&priority="+p+"&d_date="+dd,true);
    xmlhttp.send();

}

   
</script>
        
<form action="" method="post" id="add-form">
            
                <legend> Add task </legend>
                <table class="add">
                    <tr id="add-icon">
                        <td colspan="2">
                        <span class="flaticon-medical50"></span>
                        </td>
                        
                    </tr>
                    <?php
                    session_start();
                if($_SESSION['admin'] == 1){
                    echo '<tr>';
                    
                    echo '<td> Assigned to:</td>
                    <td><select name="nurse">';
                    
                    
                    
                    include_once 'nurses.php';
                    $obj2 = new nurses();
                    $obj2->get_nurses();
                    $row1 = $obj2->fetch();
                    $counter = 0;
                    echo '<option value="">--select a nurse--</option>';
                    
                    while ($row1){
                        $counter = $row1['nurse_id'];
                        echo $counter;
                        $nurse_sname = $row1['nurse_sname'];
                        $nurse_fname = $row1['nurse_fname'];
                        echo "<option value='{$counter}'>{$nurse_fname} "
                        . "{$nurse_sname} </option>";
                        $row1 = $obj2->fetch();
                    }
                 
                 echo '</select></td>';
                        
                 echo '</tr>';
                 }
                    ?>
                       
                <tr>
                <td>Task description:</td>
                <td>
                <textarea cols="30" rows="3" name="task"></textarea>
                </td>
                </tr>
                <tr>


                    <td>Due Date:</td>
                    <td> 
                        <span class="ti-calendar" onclick="showCalendar();" value="Calendar">
                        </span>
                        <input type="text" id="date" name="d_date">
                        <div id="calendar_area"></div>
                    </td>
                  
                </tr>
                <tr>
                    <td>Priority:</td>
                    <td>
                        <select name="priority">
                            <option value="1">High</option>
                            <option value="2">Medium</option>
                            <option value="3">Low</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="hidden" id="date_selected1"></td>
                </tr>
                <tr class="add-button">
                    <td colspan="2">
                <input type="button" value="add" onclick="addTask();">
                    </td>
                </tr> 
</form>
        
        
    
