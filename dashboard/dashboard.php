<?php
/**
 * Created by PhpStorm.
 * User: Akshay Mehta
 * Date: 11/13/2017
 * Time: 2:03 AM
 */

require_once 'Dashboard_Function.php';

$dashboard = new Dashboard_Function();

$facultyMembers = $dashboard->fetchAllFacultyMembers();
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
    <!--         This should be the last line in head-->
    <link rel="stylesheet" href="dashboard.css">
    <script type="text/javascript" src="dashboard.js"></script>


</head>

<body>

<div class="main_div">
<div class="header">
    <h1 id = "header" class="ui header">Welcome</h1>

    <div id= "navItem" class="ui secondary  menu">
        <a class="active item">
            Home
        </a>
        <a class="item">
            Profile
        </a>
        <a id="nav_logout" class="item">
            Logout
        </a>
    </div>
</div>




<div class="main_table">

    <table class="ui celled table">
        <thead>
        <tr class='center aligned'>
            <th>Name</th>
            <th>Email</th>
            <th>IsActive</th>
            <th>CreatedAt</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
            for($i=0;$i<sizeof($facultyMembers);$i++)
            {
                echo "<tr class='center aligned' ><td>".$facultyMembers[$i]['name']."</td>";
                echo "<td>".$facultyMembers[$i]['email']."</td>";
                if($facultyMembers[$i]['isActive'] == 0) {
                    echo "<td> No </td>";
                }else{
                    echo "<td> Yes </td>";
                }
                echo "<td>".$facultyMembers[$i]['createdAt']."</td>";
                if($facultyMembers[$i]['isActive'] == 0){
                    echo "<td class='center aligned'><button class=\"ui labeled icon button\"><i class=\"check icon\"></i>Activate</button>";
                }else{
                    echo "<td class='center aligned'><button class=\"ui labeled icon button\"><i class=\"check icon\"></i>Deactivate</button>";
                }
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<button class=\"ui labeled icon button\"><i class=\"delete icon\"></i>Delete</button>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<button class=\"ui labeled icon button\"><i class=\"User icon\"></i>View Profile</button></td></tr>";
            }
        ?>
        </tbody>
    </table>

</div>

</div>


</body>

</html>
