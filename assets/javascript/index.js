function redirectToHome() {

    var user = $.parseJSON(localStorage.getItem("user"));
    if(localStorage.getItem("isAdmin") == true){
        window.location = "../BlackboardTest/dashboard/dashboard.php"
    }else{
        window.location = "../BlackboardTest/faculty/"
    }

}

$(document).ready(function(){

    // check user session
    if(localStorage.getItem("user")!=undefined){
        redirectToHome();
    }

    $("#btn_register").click(function () {
        window.location.href = "register.html";
    });
    
    $("#btn_login").click(function () {
        var username = $('#username').val();
        var password = $('#password').val();
        var isAdmin = $('#ch_admin').is(':checked');

        var url = "webservices/signIn.php";
        var formData = {
            'username' : username,
            'password' : password,
            'isAdmin' : isAdmin
        };

        $.ajax({
            type : 'POST',
            url : url,
            data : formData,
            encode : true,
            success: function (response, status, xhr) {
                if(response!=null && response!=undefined ){
                    var user = $.parseJSON(response);
                    if(user['status']){
                        if (typeof(Storage) !== "undefined") {
                            // Store
                            localStorage.setItem("user",  JSON.stringify(user));
                            localStorage.setItem("isAdmin",  isAdmin);

                            redirectToHome();
                        }
                    }else{
                        // alert(user['message']);
                        $('.mini.modal')
                            .modal({
                                blurring: true
                            })
                            .modal('show')
                        ;
                    }

                }
            },
            error: function (xhr, status, error) {
                alert(error);
            }
        });

    });
});

