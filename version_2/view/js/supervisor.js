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
        '<th>Gender</th><th></th></tr>';
    $("#nurse_table").append(nurse_table_header);

    for (var index in obj.clinic_nurses){
        var nurse_row = '<tr><td>'+obj.clinic_nurses[index].nurse_id+'</td>';
        nurse_row += '<td>'+obj.clinic_nurses[index].fname+'</td>';
        nurse_row += '<td>'+obj.clinic_nurses[index].sname+'</td>';
        nurse_row += '<td>'+obj.clinic_nurses[index].phone+'</td>';
        nurse_row += '<td>'+obj.clinic_nurses[index].gender+'</td>';
        nurse_row += '<td><a href="javascript: loadReport('+obj.clinic_nurses[index].nurse_id+')">View Report</a></td></tr>';
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





