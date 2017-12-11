$(document).ready(function(){

    var user = $.parseJSON(localStorage.getItem("user"));


    var response = user['response'];

    $("#header").text("Welcome, "+response['name']);

    $("#nav_logout").click(function () {
       localStorage.clear();
        redirectToHome();
    });
});



function onStatusClick(userId,status) {
    var url = "activateFacultyStatus.php";
    var formData = {
        'userId' : userId,
        'status' : status
    };

    $.ajax({
        type : 'POST',
        url : url,
        data : formData,
        encode : true,
        success: function (response, status, xhr) {
            alert(response);
            window.location.replace('dashboard.php');
        },
        error: function (xhr, status, error) {
            alert(error);
        }
    });
}