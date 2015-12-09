/**
 * Created by StreetHustling on 12/7/15.
 */
$(document).ready(function(){
    load_dashboard();
    //
});

$("#addTaskBtn").click(function(){
    assignTask();
});

$("#addNurseBtn").click(function(){
    addNurse();
});

/**
 * This function sends a JSON request to a given url and
 * convert the response into a JSON Object
 * @param u: the url to the page to send the JSON response
 */
function sendRequest(u){
    // Send request to server
    //u a url as a string
    //async is type of request
    var obj=$.ajax({url:u,async:false});
    //Convert the JSON string to object

    var result=$.parseJSON(obj.responseText);
    return result;	//return object
}


function getClinicTasks(){
    var district = localStorage.getItem("district");

    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/clinic_task_controller.php?" +
        "cmd=7&clinic="+district;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result
        showTasks(obj);
    }
    else{

    }
}


function checkBoxStatus(obj){
    if(obj.checked){
        confirm_task(obj.value);
    }else {

        alert(obj.value);
    }
}


function confirm_task(task_id){


    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/clinic_task_controller.php?" +
        "cmd=3=&id="+task_id;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result
        var success = '<div class="alert alert-success alert-dismissible" role="alert">'+obj.message+'' +
            '</div>';

        $("#message").html(success).fadeIn().fadeOut(4000);
    }
    else{

    }
}

function showTasks(obj){
    var unread = 0;
    $("#clinic_tasks_div").html("");
    for(var index in obj.clinic_tasks){
        var task_list = "";

        if(obj.clinic_tasks[index].confirmed == "confirmed"){
            task_list = '<tr class="read">';
        }else{
            task_list = '<tr class="unread">';
            unread ++;
        }

        task_list += '<td class="small-col"><input type="checkbox" class="confirm" onchange="checkBoxStatus(this)"' +
            'value="'+obj.clinic_tasks[index].task_id+'"/></td>';


        if(obj.clinic_tasks[index].confirmed == "confirmed"){

            task_list += '<td class="small-col"><i class="fa fa-check"></i></td>';
        }else{
            task_list += '<td class="small-col"><i class="fa fa-alert"></i></td>';
        }

        task_list += '<td class="name"><a href="javascript: ">'+obj.clinic_tasks[index].fname+" "+
            obj.clinic_tasks[index].sname+ '</a></td>';

        task_list += '<td class="subject"><a href="#">'+obj.clinic_tasks[index].task_title+'</a></td>';
        task_list += '<td class="time"><i class="fa fa-clock-o"></i> '+obj.clinic_tasks[index].due_date+'</td>';
        task_list += '<td class="time">'+obj.clinic_tasks[index].due_time+'</td>';
        task_list += '</tr>';

        $("#clinic_tasks_div").append(task_list);
    }

    $("#unread_tasks").text("("+unread+")");

}

function viewReports(){

}


function getDistrictNurses(){
    var district = localStorage.getItem("district");

    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/user-contoller.php?" +
        "cmd=6&district="+district;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result
        showNurses(obj);
    }
    else{

    }
}

function viewClinicNurses(){
    var district = localStorage.getItem("district");

    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/user-contoller.php?" +
        "cmd=6&district="+district;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result
        viewNurses(obj);
    }
    else{

    }
}

function viewNurses(obj){
    $("#nurse_table").html("");
    var nurse_table_header = '<tr> <th>ID</th> <th>First Name</th> <th>Surname</th> <th>Phone</th> ' +
        '<th>Gender</th></tr>';
    $("#nurse_table").append(nurse_table_header);

    for (var index in obj.clinic_nurses){
        var nurse_row = '<tr><td>'+obj.clinic_nurses[index].nurse_id+'</td>';
        nurse_row += '<td>'+obj.clinic_nurses[index].fname+'</td>';
        nurse_row += '<td>'+obj.clinic_nurses[index].sname+'</td>';
        nurse_row += '<td>'+obj.clinic_nurses[index].phone+'</td>';
        nurse_row += '<td>'+obj.clinic_nurses[index].gender+'</td></tr>';
        $("#nurse_table").append(nurse_row);
    }
}

function getCompletedTasks(){

    var district = localStorage.getItem("district");

    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/clinic_task_controller.php?cmd=9" +
        "&clinic="+district;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result
        showCompleted(obj);
    }
    else{

    }
}

function showCompleted(obj){
    $("#clinic_tasks_div").html("");
    for(var index in obj.clinic_tasks){
        var task_list = "";

        if(obj.clinic_tasks[index].confirmed == "confirmed"){
            task_list = '<tr class="read">';
        }else{
            task_list = '<tr class="unread">';
        }

        task_list += '<td class="small-col"><input type="checkbox" class="confirm" onchange="checkBoxStatus(this)"' +
            'value="'+obj.clinic_tasks[index].task_id+'"/></td>';


        if(obj.clinic_tasks[index].confirmed == "confirmed"){

            task_list += '<td class="small-col"><i class="fa fa-check"></i></td>';
        }else{
            task_list += '<td class="small-col"><i class="fa fa-alert"></i></td>';
        }

        task_list += '<td class="name"><a href="javascript: ">'+obj.clinic_tasks[index].fname+" "+
            obj.clinic_tasks[index].sname+ '</a></td>';

        task_list += '<td class="subject"><a href="#">'+obj.clinic_tasks[index].task_title+'</a></td>';
        task_list += '<td class="time">Due: '+obj.clinic_tasks[index].due_date+'</td>';
        task_list += '<td class="time"><i class="fa fa-clock-o"></i> '+obj.clinic_tasks[index].date_completed+'</td>';
        task_list += '</tr>';

        $("#clinic_tasks_div").append(task_list);
    }
}



function getConfirmedTasks(){

    var district = localStorage.getItem("district");

    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/clinic_task_controller.php?cmd=10" +
        "&clinic="+district;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result
        showConfirmedTasks(obj);
    }
    else{

    }
}

function showConfirmedTasks(obj){
    $("#clinic_tasks_div").html("");
    for(var index in obj.clinic_tasks){
        var task_list = "";

        task_list = '<tr class="read">';
        task_list += '<td class="small-col"><i class="fa fa-check"></i></td>';

        task_list += '<td class="small-col"><i class="fa fa-alert"></i></td>';

        task_list += '<td class="name"><a href="javascript: ">'+obj.clinic_tasks[index].fname+" "+
            obj.clinic_tasks[index].sname+ '</a></td>';

        task_list += '<td class="subject"><a href="#">'+obj.clinic_tasks[index].task_title+'</a></td>';
        task_list += '<td class="time">Due: '+obj.clinic_tasks[index].due_date+'</td>';
        task_list += '<td class="time"><i class="fa fa-clock-o"></i> '+obj.clinic_tasks[index].date_completed+'</td>';
        task_list += '</tr>';

        $("#clinic_tasks_div").append(task_list);
    }
}


function getDueTasks(){

    var district = localStorage.getItem("district");

    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/clinic_task_controller.php?cmd=11" +
        "&clinic="+district;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result
        showConfirmedTasks(obj);
    }
    else{

    }
}

function showDueTasks(obj){
    $("#clinic_tasks_div").html("");
    for(var index in obj.clinic_tasks){
        var task_list = "";

        task_list = '<tr class="read">';
        task_list += '<td class="small-col"><i class="fa fa-check"></i></td>';

        task_list += '<td class="small-col"><i class="fa fa-alert"></i></td>';

        task_list += '<td class="name"><a href="javascript: ">'+obj.clinic_tasks[index].fname+" "+
            obj.clinic_tasks[index].sname+ '</a></td>';

        task_list += '<td class="subject"><a href="#">'+obj.clinic_tasks[index].task_title+'</a></td>';
        task_list += '<td class="time">Due: '+obj.clinic_tasks[index].due_date+'</td>';
        task_list += '<td class="time"><i class="fa fa-clock-o"></i> '+obj.clinic_tasks[index].due_time+'</td>';
        task_list += '</tr>';

        $("#clinic_tasks_div").append(task_list);
    }
}

function showNurses(obj){

    var districtNurses = "";
    districtNurses += '<label>Select Nurse</label>';
    districtNurses += '<select name="nurse" class="form-control">';
    districtNurses += '<option selected>Select a nurse</option>';
    for(var index in obj.clinic_nurses) {

        districtNurses += '<option value="'+obj.clinic_nurses[index].nurse_id+'">' +
            obj.clinic_nurses[index].fname+" "+ obj.clinic_nurses[index].sname+'</option>';
    }

    districtNurses += '</select>';
    $("#nurses").html(districtNurses);
}


function assignTask(){
    var title = $("#title").val();
    var desc = $("#desc").val();
    var nurse = $("select[name=nurse] option:selected").val();
    var due_date = $("#due_date").val();
    var due_time = $("#due_time").val();
    var district = localStorage.getItem("district");
    var user_id = localStorage.getItem("user_id");
    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/clinic_task_controller.php?" +
        "cmd=1&title="+title+"&desc="+desc+"&nurse="+nurse+"&supervisor="+user_id+"&date="+due_date+"&time="+due_time+"&clinic="+district;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result
        clearAddTaskForm();
        var success = '<div class="alert alert-success alert-dismissible" role="alert">'+obj.message+'' +
            '</div>';

        $("#message").html(success).fadeIn().fadeOut(4000);


    }
    else{
        var failed = '<div class="alert alert-danger alert-dismissible" role="alert">'+obj.message+'' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            '</div>';
        $("#message").html(failed).fadeIn();
    }
}


function clearAddTaskForm(){
    var title = $("#title").val("");
    var desc = $("#desc").val("");
    var due_date = $("#due_date").val("");
    var due_time = $("#due_time").val("");
}

function addNurse(){

    var username = $("input[name=username]").val();
    var fname = $("input[name=firstname]").val();
    var gender = $("select[name=gender] option:selected").val();
    var sname = $("input[name=surname]").val();
    var email = $("input[name=email]").val();
    var pass = $("input[name=pass]").val();
    var phone = $("input[name=phone]").val();
    var clinic = localStorage.getItem("district");
    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/user-contoller.php?cmd=1" +
        "&user="+username+"&pass="+pass+"&type=nurse&email="+email+"&sname="+sname+"&fname="+fname+"&phone=+" +
        phone+"&district="+clinic+"&gender="+gender;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result
        clearAddNurseForm();
        var success = '<div class="alert alert-success alert-dismissible" role="alert">'+obj.message+'' +
            '</div>';

        $("#message").html(success).fadeIn().fadeOut(4000);
    }
    else{
        var failed = '<div class="alert alert-danger alert-dismissible" role="alert">'+obj.message+'' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            '</div>';
        $("#message").html(failed).fadeIn();
    }
}

function clearAddNurseForm(){
    $("input[name=username]").val("");
    $("input[name=firstname]").val("");
    $("select[name=gender] option:selected").val();
    $("input[name=surname]").val("");
    $("input[name=email]").val("");
    $("input[name=pass]").val("");
    $("input[name=phone]").val("");
}


function load_dashboard(){
    $("#main_content").load("supervisor_pages/dashboard.html");
    $("#sub_content").load("supervisor_pages/to_do_list.html");
}


function loadAddTaskForm(){
    $("#main_content").load("supervisor_pages/add_task.html");
}

function loadAddNurseForm(){
    $("#page_name").text("Nurses");
    //var add_nurse = addNurseForm();
    //$("#sub_content").html(add_nurse);
    $("#sub_content").load("supervisor_pages/add_nurse.html");
}


function loadClinicTasks(){
    $("#page_name").text("Clinic Tasks");
    $("#sub_content").load("supervisor_pages/clinic_task_page.html", function(){
        getClinicTasks();
        getDistrictNurses();
    });
}



function loadViewNurses(){
    $("#sub_content").load("supervisor_pages/view_nurse.html", function(){
        viewClinicNurses();
    });
}


function loadCalendar(){
    $("#sub_content").load("supervisor_pages/supervisor_calendar.html", function(){
        initializeCalendar();
    });
}


function addNurseForm(){
    var add = '<div class="col-md-6">';
    add += '<div class="box box-primary"> ' +
        '<div class="box-header">' +
        '<h3 class="box-title">Add New Nurse</h3>'+
        '</div>' +
        '<div class="box-body">' +
        '<!-- text input for username-->' +
        '<div class="form-group"> <div class="input-group">' +
        ' <span class="input-group-addon"><i class="fa fa-user"></i></span>' +
        '<input type="text" name="username" class="form-control" placeholder="username"> </div> </div>' +
        '<!-- text input for first name-->' +
        '<div class="form-group"> <div class="input-group">' +
        '<span class="input-group-addon"><i class="fa fa-user"></i></span>' +
        '<input type="text" name="firstname" class="form-control" placeholder="first name"> </div> </div>' +
        ' <!-- text input for surname name-->' +
        '<div class="form-group"> <div class="input-group">' +
        '<span class="input-group-addon"><i class="fa fa-user-md"></i></span>' +
        '<input type="text" name="surname" class="form-control" placeholder="surname"></div></div>' +
        '<!-- text input for nurse email-->' +
        ' <div class="form-group"><div class="input-group">' +
        '<span class="input-group-addon"><i class="fa fa-envelope"></i></span>' +
        '<input type="text" name="email" class="form-control" placeholder="email"> </div> </div>' +
        '<!-- text input for nurse password-->' +
        '<div class="form-group"> <div class="input-group">' +
        '<span class="input-group-addon"><i class="fa fa-lock"></i></span>' +
        '<input name="pass" type="password" class="form-control" placeholder="password"> </div> </div>' +
        '<!-- text input for nurse telephone -->' +
        '<div class="form-group"> <div class="input-group"> <div class="input-group-addon">' +
        '<i class="fa fa-phone"></i> </div>' +
        '<input name="phone" type="tel" class="form-control pull-right" placeholder="phone"/> </div><!-- /.input group -->' +
        '</div><!-- /.form group -->' +
        '<!-- Date and time range -->' +
        '<div class="form-group">' +
        '<select name="gender" class="form-control"> <option selected>gender</option>' +
        '<option value="M">M</option> <option value="F">F</option>' +
        '</select><!-- /.input group --> </div><!-- /.form group --> </div><!-- /.box-body -->' +
        '<div class="box-footer">' +
        '<button id="addNurseBtn" type="button" class="btn btn-primary" onclick="addNurse()">Submit</button>' +
        '</div> </div><!-- /.box --> </div>';

    return add;
}


function initializeCalendar(){
    $(function() {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function() {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });
        }
        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {//This is to add icons to the visible buttons
                prev: "<span class='fa fa-caret-left'></span>",
                next: "<span class='fa fa-caret-right'></span>",
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            },
            //Random default events
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    backgroundColor: "#f56954", //red
                    borderColor: "#f56954" //red
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d - 5),
                    end: new Date(y, m, d - 2),
                    backgroundColor: "#f39c12", //yellow
                    borderColor: "#f39c12" //yellow
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false,
                    backgroundColor: "#0073b7", //Blue
                    borderColor: "#0073b7" //Blue
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false,
                    backgroundColor: "#00c0ef", //Info (aqua)
                    borderColor: "#00c0ef" //Info (aqua)
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d + 1, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false,
                    backgroundColor: "#00a65a", //Success (green)
                    borderColor: "#00a65a" //Success (green)
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/',
                    backgroundColor: "#3c8dbc", //Primary (light-blue)
                    borderColor: "#3c8dbc" //Primary (light-blue)
                }
            ],
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                copiedEventObject.backgroundColor = $(this).css("background-color");
                copiedEventObject.borderColor = $(this).css("border-color");

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            }
        });

        /* ADDING EVENTS */
        var currColor = "#f56954"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function(e) {
            e.preventDefault();
            //Save color
            currColor = $(this).css("color");
            //Add color effect to button
            colorChooser
                .css({"background-color": currColor, "border-color": currColor})
                .html($(this).text()+' <span class="caret"></span>');
        });
        $("#add-new-event").click(function(e) {
            e.preventDefault();
            //Get value and make sure it is not null
            var val = $("#new-event").val();
            if (val.length == 0) {
                return;
            }

            //Create event
            var event = $("<div />");
            event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
            event.html(val);
            $('#external-events').prepend(event);

            //Add draggable funtionality
            ini_events(event);

            //Remove event from text input
            $("#new-event").val("");
        });
    });
}


