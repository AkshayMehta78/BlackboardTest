<?php
/**
 * Created by PhpStorm.
 * User: Akshay Mehta
 * Date: 12/9/2017
 * Time: 11:56 PM
 */

require_once '../faculty/Faculty_Function.php';
require_once '../webservices/include/User.php';

session_start();

$schoolId = $_POST['schoolId'];
$streamId = $_POST['streamId'];
$courseId = $_POST['courseId'];

if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $facultyId =  $user->id;
}


$faculty = new Faculty_Function();

$response = array();

if (!empty($courseId)) {
    if(!$faculty->checkIfCourseIsAdded($schoolId,$streamId,$courseId,$facultyId)){
        $result = $faculty->saveFacultSchool($schoolId,$streamId,$courseId,$facultyId);
        if ($result!=false) {
            $response = array('status'=>true,'response'=>"Course Added to your Profile.");
        }else{
            $response = array('status'=>false,'response'=>'Something went wrong!');
        }
    }else{
        $response = array('status'=>false,'response'=>'Course Already added!');
    }

}else{
    $response = array('status'=>false,'response'=>'Stream cannot be empty!');
}
echo json_encode($response);

