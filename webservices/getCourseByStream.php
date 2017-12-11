<?php
/**
 * Created by PhpStorm.
 * User: Akshay Mehta
 * Date: 12/9/2017
 * Time: 11:56 PM
 */

require_once '../faculty/Faculty_Function.php';
$streamId = $_POST['streamId'];

$faculty = new Faculty_Function();

$response = array();

if (!empty($streamId)) {
    $result = $faculty->fetchAllCoursesByStream($streamId);
    if ($result!=false) {
        $response = array('status'=>true,'response'=>$result);
    }else{
        $response = array('status'=>false,'message'=>'No Stream found!');
    }
}else{
    $response = array('status'=>false,'message'=>'Stream cannot be empty!');
}
echo json_encode($response);

