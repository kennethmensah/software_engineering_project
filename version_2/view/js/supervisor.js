/**
 * Created by StreetHustling on 12/7/15.
 */
$(document).ready(function(){

    getDistrictNurses();
});

$("#addTaskBtn").click(function(){
    assignTask();
});

$("#addNurseBtn").click(function(){
    addNurse();
});

function sendRequest(u){
    // Send request to server
    //u a url as a string
    //async is type of request
    var obj=$.ajax({url:u,async:false});
    //Convert the JSON string to object

    var result=$.parseJSON(obj.responseText);
    return result;	//return object
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
    alert(username);
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