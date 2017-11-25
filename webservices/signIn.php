<?php
/**
 * Created by PhpStorm.
 * User: Akshay Mehta
 * Date: 11/12/2017
 * Time: 9:50 PM
 */

require_once '../webservices/include/DB_Functions.php';
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$isAdmin = $_POST['isAdmin'];

$db = new DB_Functions();

$response = array();

if (!empty($username) && !empty($password)) {
    $result = $db->getLoggedInUser($username,$password,$isAdmin);
    if ($result!=false) {
        if($isAdmin){
            $_SESSION["facultyId"] = $result['id'];
        }else{
            $_SESSION["adminId"] = $result['id'];
        }
        $_SESSION["isAdmin"] = $isAdmin;

        $response = array('status'=>true,'response'=>$result);
    }else{
        $response = array('status'=>false,'message'=>'Invalid Credentials!');
    }
}else{
    $response = array('status'=>false,'message'=>'Username or Password cannot be empty!');
}

echo json_encode($response);

?>