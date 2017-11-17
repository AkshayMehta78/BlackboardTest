<?php
/**
 * Created by PhpStorm.
 * User: Akshay Mehta
 * Date: 11/12/2017
 * Time: 9:50 PM
 */

require_once 'Dashboard_Function.php';

$userId = $_POST['userId'];
$status = $_POST['status'];

$db = new Dashboard_Function();

$response = array();

if (isset($userId) && isset($status)) {

        $result = $db->updateFacultyStatus($userId,$status);

        if($result!=false){
            // Send email to user regarding activation of Account
            // $db->sendEmailToFaculty($result);
            $response = array('status'=>true,'response'=>'Faculty Activation status updated');
        } else {
            $response = array('status' => false, 'message' => 'Something went wrong!');
        }
}else{
    $response = array('status'=>false,'message'=>'Invalid Request!');
}



echo json_encode($response);

?>