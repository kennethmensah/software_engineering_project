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

function showTasks(obj){

    for(var index in obj.clinic_tasks){
        var task_list = "";

        if(obj.clinic_tasks[index].confirmed == "confirmed"){
            task_list = '<tr class="unread">';
        }else{
            task_list = '<tr class="read">';
        }

        task_list += '<td class="small-col"><input type="checkbox" class="confirm"/></td>';
        if(obj.clinic_tasks[index].confirmed == "confirmed"){
            $('.confirm').attr('checked', true);
        }


        task_list += '<td class="small-col"><i class="fa fa-star"></i></td>';
        task_list += '<td class="name"><a href="javascript: ">'+obj.clinic_tasks[index].fname+" "+
            obj.clinic_tasks[index].sname+ '</a></td>';
        task_list += '<td class="subject"><a href="#">'+obj.clinic_tasks[index].task_title+'</a></td>';
        task_list += '<td class="time"><i class="fa fa-clock-o"></i> '+obj.clinic_tasks[index].due_date+'</td>';
        task_list += '<td class="time">'+obj.clinic_tasks[index].due_time+'</td>';
        task_list += '</tr>';

        $("#clinic_tasks_div").append(task_list);
    }
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


