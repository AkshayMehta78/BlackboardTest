<?php
/**
 * Created by PhpStorm.
 * User: Akshay Mehta
 * Date: 11/24/2017
 * Time: 11:46 PM
 */


require_once 'Faculty_Function.php';
require_once '../webservices/include/User.php';

session_start();


$faculty = new Faculty_Function();

if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $facultyId =  $user->id;
    $facultySchools = $faculty->fetchFacultySchoolDetails($facultyId);
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
        <h1 id = "header" class="ui header">Welcome</h1>

        <div  id= "navItem" class="ui secondary  menu">
            <a href="../faculty/index.php" class=" item">
                Home
            </a>
            <a class="active item">
                Profile
            </a>
            <a href="../webservices/include/logout.php" id="nav_logout" class="item">
                Logout
            </a>
        </div>
    </div>

    <div id="div_schools">
        <table class="ui large table">
            <thead>
            <tr class='center aligned'>
                <th>SCHOOL</th>
                <th >STREAM</th>
                <th >COURSES</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for($i=0;$i<sizeof($facultySchools);$i++)
            {
                $courseArray = $facultySchools[$i]['course'];
                $courseSize = sizeof($courseArray);

                echo "<tr class='center aligned' ><td  rowspan = '".$courseSize."'>".$facultySchools[$i]['school']['name']."</td>";
                echo "<td rowspan='".$courseSize."' class='center aligned' >".$facultySchools[$i]['stream']['name']."</td>";

                for($j=0;$j<$courseSize;$j++)
                {
                    echo "<td class='left aligned'>";
                    echo $courseArray[$j]['name'];
                    echo "</td></tr><tr>";
                }
                echo "</tr>";
            }
            ?>
            <td class='center aligned' colspan='3' >
                <input type="button" class="addschool" value="Add School"></td></td>
            </tbody>
        </table>
    </div>

</div>
</html>
