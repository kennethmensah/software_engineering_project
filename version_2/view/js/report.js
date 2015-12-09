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


function getNurseTasks(){
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

function getClinic(){
    var district = localStorage.getItem("district");


    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/clinic_controller.php?" +
        "cmd=3&id="+district;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1) {					//check result

    }
    else{

    }
}

