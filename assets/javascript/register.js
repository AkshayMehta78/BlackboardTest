
$(document).ready(function(){


    $("#btn_register").click(function () {
        var fullName = $('#fullname').val();
        var email = $('#email').val();

        var url = "webservices/register.php";
        var formData = {
            'fullname' : fullName,
            'email' : email
        };

        $.ajax({
            type : 'POST',
            url : url,
            data : formData,
            encode : true,
            success: function (response, status, xhr) {
                    if(response!=null && response!=undefined ){
                        var json = $.parseJSON(response);
                        $('.ui.modal')
                            .modal({
                                closable  : false,
                                onApprove : function() {
                                   redirectToHome();
                                }
                            })
                            .modal('show')
                        ;
                    }
            },
            error: function (xhr, status, error) {
                alert(error);
            }
        });
    });
});

function redirectToHome() {
    window.location.replace("../BlackboardTest/index.html");
}


