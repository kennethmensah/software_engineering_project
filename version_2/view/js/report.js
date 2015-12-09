/**
 * Created by StreetHustling on 12/9/15.
 */
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


function getNurseTasks(id){



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


function loadReport(id){

    $("#sub_content").load("supervisor_pages/report_file.html", function(){
        setDate();
        setUserReportDetails(id);
        setTasks(id);
    });
}







