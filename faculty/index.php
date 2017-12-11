<?php
/**
 * Created by PhpStorm.
 * User: Akshay Mehta
 * Date: 11/24/2017
 * Time: 8:58 PM
 */

require_once 'Faculty_Function.php';
require_once '../webservices/include/User.php';
session_start();


$faculty = new Faculty_Function();

if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $facultyId =  $user->id;
    $isSchoolAdded = $faculty->isSchoolAdded($facultyId);

    if($isSchoolAdded == false){
        header('Location: ../faculty/editProfile.php', true, 302);
        exit;
    }
}




?>


<html>

<title>BlackBoard</title>


<head>

    <!--        Linking libraries-->
    <link rel="stylesheet" type="text/css" href="../lib/semantic/semantic.min.css">
    <script src="../lib/semantic/semantic.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="faculty.css">
    <script type="text/javascript" src="faculty.js"></script>

</head>

<body>
<div class="main_div">
    <div class="header">
        <h1 id = "header" class="ui header">Welcome<?php if (!empty($user)) echo ', '.$user->name;?></h1>

        <div id= "navItem" class="ui secondary  menu">
            <a class="active item">
                Home
            </a>
            <a href="editProfile.php" class="item">
                Profile
            </a>
            <a href="../webservices/include/logout.php" id="nav_logout" class="item">
                Logout
            </a>
        </div>
    </div>
</div>


</body>


</html>