<?php
/**
 * Created by PhpStorm.
 * User: Akshay Mehta
 * Date: 11/24/2017
 * Time: 8:58 PM
 */

require_once 'Faculty_Function.php';
session_start();


$faculty = new Faculty_Function();
$facultyId = $_SESSION['facultyId'];
$isSchoolAdded = $faculty->isSchoolAdded($facultyId);

if($isSchoolAdded == false){
    header('Location: ../faculty/editProfile.php', true, 302);
    exit;
}
?>

