$(document).ready(function(){

    var user = $.parseJSON(localStorage.getItem("user"));

    var response = user['response'];

    $("#header").text("Welcome, "+response['name']);
});