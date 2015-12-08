/**
 * Created by StreetHustling on 12/7/15.
 */
$(document).ready(function(){

    getDistrictNurses();
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
        alert(obj);
    }
    else{

    }
}


function showNurses(obj){

    var districtNurses = "";
    districtNurses += '<label>Select Nurse</label>';
    districtNurses += '<select class="form-control">';

    for(var index in obj.clinic_nurses) {
        districtNurses += '<option selected>Select a nurse</option>';
        districtNurses += '<option value="'+obj.clinic_nurses[index].nurse_id+'">' +
            obj.clinic_nurses[index].fname+" "+ obj.clinic_nurses[index].sname+'</option>';
    }

    districtNurses += '</select>';
    $("#nurses").html(districtNurses);
}


function assignTask(){

    var district = localStorage.getItem("district");
    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/user-contoller.php?" +
        "cmd=6&district="+district;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result
        showNurses(obj);
        alert(obj);
    }
    else{

    }
}