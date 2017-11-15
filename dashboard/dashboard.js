$(document).ready(function(){

    var user = $.parseJSON(localStorage.getItem("user"));

    if(user==null || user == undefined){
        redirectToHome();
    }
    var response = user['response'];

    $("#header").text("Welcome, "+response['name']);

    $("#nav_logout").click(function () {
       localStorage.clear();
        redirectToHome();
    });
});

function redirectToHome() {
    window.location.replace('/BlackboardTest/index.html');
}