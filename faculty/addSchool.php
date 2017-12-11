<?php
/**
 * Created by PhpStorm.
 * User: Akshay Mehta
 * Date: 12/4/2017
 * Time: 12:23 AM
 */



require_once 'Faculty_Function.php';
require_once '../webservices/include/User.php';

session_start();


$faculty = new Faculty_Function();


if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $facultyId =  $user->id;
    $allSchools = $faculty->fetchAllSchools();
    $allStream = $faculty->fetchAllStream();
}



?>
<html>

<title>BlackBoard</title>
<head>




    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="faculty.css">
    <script type="text/javascript" src="faculty.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<body>

<div class="card">
    <div class="card-header">
        Add School
    </div>
    <div class="card-body">
        <select id="select_school" class="custom-select">
            <option value="0" selected>Select School</option>
            <?php
                foreach ($allSchools as $school)
                {
                    echo "<option value='".$school['id']."'>".$school['name']."</option>";
                }
            ?>
        </select>
        <br><br>
        <select id="select_stream" class="custom-select">
            <option  value="0"  selected>Select Stream</option>
            <?php
            foreach ($allStream as $stream)
            {
                echo "<option value='".$stream['id']."'>".$stream['name']."</option>";
            }
            ?>
        </select>
        <br><br>
        <select id="select_course" class="custom-select">
            <option selected>Select Course</option>
        </select>
        <br><br>
        <a href="#" id="addNewSchool" class="btn btn-primary">Add School</a>
    </div>
</div>
</body>
</html>
