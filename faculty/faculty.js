$(document).ready(function () {

    $("#addNewSchool").hide();

    $(".addschool").click(function () {
        window.location.href = "../faculty/addSchool.php";
    });


    $('#select_stream').on('change', function () {

        var streamId = $('#select_stream').val();
        var url = "../webservices/getCourseByStream.php";
        var formData = {
            'streamId': streamId
        };

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            encode: true,
            success: function (response, status, xhr) {
                var options = $("#select_course");
                options.empty();
                if (response != null && response != undefined) {
                    var response = $.parseJSON(response);
                    if (response['status']) {
                        var courses = response['response'];
                        $.each(courses, function () {
                            options.append(new Option(this.name, this.id));
                        });
                        if (courses.length >= 1) {
                            $("#addNewSchool").show();
                        } else {
                            $("#addNewSchool").hide();
                        }
                    }
                }
            },
            error: function (xhr, status, error) {
                alert(error);
            }
        });
    });


    $("#addNewSchool").click(function () {

        var schoolId = $('#select_school').val();
        var streamId = $('#select_stream').val();
        var courseId = $('#select_course').val();


        var url = "../webservices/saveFacultSchool.php";
        var formData = {
            'schoolId': schoolId,
            'streamId': streamId,
            'courseId': courseId
        };

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            encode: true,
            success: function (response, status, xhr) {
                if (response != null && response != undefined) {
                    var response = $.parseJSON(response);
                    alert(response['response']);
                    if (response['status']) {
                        window.location.href = "../faculty/editProfile.php";
                    }
                }

            },
            error: function (xhr, status, error) {
                alert(error);
            }
        });


    });

});