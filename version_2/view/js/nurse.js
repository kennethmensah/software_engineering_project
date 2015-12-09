
$(document).ready(function(){
    loadNurseDashboard();
    //
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


function getNurseTasks(){
    var id = localStorage.getItem("user_id");
    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/clinic_task_controller.php?" +
        "cmd=5&id="+id;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result
        return obj;
    }
    else{
        return false;
    }
}


function showMyTaskPane(){
    $("#nurse_tasks_div").html("");
    var obj = getNurseTasks();
    var unread = 0;
    for(var index in obj.clinic_tasks){
        var task_list = "";

        if(obj.clinic_tasks[index].confirmed == "confirmed"){
            task_list = '<tr class="read">';
        }else{
            task_list = '<tr class="unread">';
            unread ++;
        }




        if(obj.clinic_tasks[index].confirmed == "confirmed"){

            task_list += '<td class="small-col"><i class="fa fa-check"></i></td>';
        }else{
            task_list += '<td class="small-col"><i class="ion ion-android-alarm"></i></td>';
        }

        task_list += '<td class="subject"><a href="">'+obj.clinic_tasks[index].task_title+'</a><br>';
        task_list += '<i class="fa fa-clock-o"></i> '+obj.clinic_tasks[index].due_date+'</td>';

        task_list += '<td class="time"><a href="javascript: completeTask('+obj.clinic_tasks[index].task_id+')">' +
            ' <span class="ion ion-android-archive"/></span></a></td>';
        task_list += '</tr>';

        $("#nurse_tasks_div").append(task_list);
    }

    $("#unread_tasks").text("("+unread+")");
}


function completeTask(id){

    var nurse = localStorage.getItem("user_id");
    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/clinic_task_controller.php?" +
        "cmd=12&nurse="+nurse+"&task="+id;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result
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


function getClinic(){
    var district = localStorage.getItem("district");


    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/clinic_controller.php?" +
        "cmd=3&id="+district;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result
        return obj;
    }
    else{
        return false;
    }
}

function getNurseDetails(id){


    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/user-contoller.php?cmd=7" +
        "&id="+id;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result
        return obj;
    }
    else{
        return false;
    }
}

function setUserReportDetails(id){

    var clinic = getClinic();
    $("#clinic_name").text(clinic.clinics[0].clinic_name);
    $("#clinic_location").text(clinic.clinics[0].clinic_location);

    var user = getNurseDetails(id);
    $("#nurse_email").text("Email: "+ user.user_details[0].email);

}

function setDate(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd='0'+dd
    }

    if(mm<10) {
        mm='0'+mm
    }

    today = mm+'/'+dd+'/'+yyyy;
    $("#report_date").text(today);
}


function setTasks(id){
    var obj = getNurseTasks(id);
    $("#nurse_phone").text("Phone: "+ obj.clinic_tasks[0].phone);
    $("#nurse_name").text(obj.clinic_tasks[0].fname +" "+obj.clinic_tasks[0].sname);
    $("#report_details").html("");
    var confirmed = 0;
    var assigned = 0;
    var completed = 0;
    for (var index in obj.clinic_tasks){
        var task_row = '<tr><td>'+obj.clinic_tasks[index].task_title+'</td>';
        task_row += '<td>'+obj.clinic_tasks[index].task_desc+'</td>';
        task_row += '<td>'+obj.clinic_tasks[index].date_assigned+'</td>';
        task_row += '<td>'+obj.clinic_tasks[index].due_date+'</td>';
        task_row += '<td>'+obj.clinic_tasks[index].date_completed+'</td>';
        if(obj.clinic_tasks[index].date_completed != '0000-00-00'){
            completed ++;
        }
        if(obj.clinic_tasks[index].confirmed == 'confirmed'){
            task_row += '<td><small class="label label-success"><i class="mdi-action-done"></i> Confirmed</small></td>';
            confirmed ++;
        }else{
            task_row += '<td><small class="label label-warning"><i class="ion ion-alert"></i> Not Confirmed</small></td></tr>';
        }

        assigned++;
        $("#report_details").append(task_row);

    }
    $("#report_confirmed").text(confirmed);
    $("#report_completed").text(completed);
    $("#report_assigned").text(assigned);
}



function loadNurseDashboard(){
    $("#main_content").load("nurse_pages/dashboard.html");
}


function loadReport(){
    var id = localStorage.getItem("user_id");
    $("#page_name").text("Reports");
    $("#sub_content").load("nurse_pages/report_file.html", function(){
        setDate();
        setUserReportDetails(id);
        setTasks(id);
    });
}


function loadMyTasks(){
    $("#sub_content").load("nurse_pages/nurse_task_page.html", function(){
        showMyTaskPane();
    });
}



