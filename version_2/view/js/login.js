/**
 * Created by StreetHustling on 12/7/15.
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

function validateLogin(user, pass){
    var theUrl="http://localhost/SE/software_engineering_project/version_2/controllers/user-contoller.php?cmd=2&user="+user+"&pass="+pass;
    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result===1){					//check result

        if(obj.user_type == "admin"){

            localStorage.setItem("user_id", obj.user_id);
            localStorage.setItem("district", obj.district);
            window.location.href = "http://localhost/SE/software_engineering_project/version_2/view/admin_home.php";
            //window.location.replace("http://localhost/SE/software_engineering_project/version_2/view/admin_home.php");
        }else if(obj.user_type == "supervisor"){
            alert(obj.user_id);
            localStorage.setItem("user_id", obj.user_id);
            localStorage.setItem("district", obj.district);
            window.location.href = "http://localhost/SE/software_engineering_project/version_2/view/supervisor_home.php";
            //window.location.replace("http://localhost/SE/software_engineering_project/version_2/view/supervisor_home.php");
        }else {
            localStorage.setItem("user_id", obj.user_id);
            localStorage.setItem("district", obj.district);
            window.location.replace("http://localhost/SE/software_engineering_project/version_2/view/nurse_home.php");
        }
    }else{
        //show error message
        alert("login failed");
        // $("#divStatus").text("error while getting description");
        // $("#divStatus").css("backgroundColor","red");
    }
}

$(function(){
    $("#loginbtn").click(function(){

        console.log($("#username").val());

        validateLogin($("#username").val(), $("#password").val())
    });
});

