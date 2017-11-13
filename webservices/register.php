<?php
/**
 * Created by PhpStorm.
 * User: Akshay Mehta
 * Date: 11/12/2017
 * Time: 9:50 PM
 */

require_once '../webservices/include/DB_Functions.php';

$fullname = $_POST['fullname'];
$email = $_POST['email'];

$db = new DB_Functions();

$response = array();

if (!empty($fullname) && !empty($email)) {
    if (!$db->isEmailExists($email)) {
        $result = $db->requestNewFaculty($fullname,$email);

        if($result!=false){
            $response = array('status'=>true,'response'=>$result);
        }else{
            $response = array('status'=>false,'message'=>'Something went wrong!');
        }
    } else {
        $response = array('status'=>false,'message'=>'Email address already exist!');
    }
}else{
    $response = array('status'=>false,'message'=>'Fullname or Email address cannot be empty!');
}

echo json_encode($response);

?>