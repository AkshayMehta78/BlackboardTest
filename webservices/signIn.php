<?php
/**
 * Created by PhpStorm.
 * User: Akshay Mehta
 * Date: 11/12/2017
 * Time: 9:50 PM
 */

require_once '../webservices/include/DB_Functions.php';
require_once '../webservices/include/User.php';
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$isAdmin = $_POST['isAdmin'];

$db = new DB_Functions();

$response = array();

if (!empty($username) && !empty($password)) {
    $result = $db->getLoggedInUser($username,$password,$isAdmin);
    if ($result!=false) {


        $loggedInUser = new User();

        $loggedInUser->id = $result["id"];
        $loggedInUser->name = $result["name"];
        $loggedInUser->email = $result["email"];
        $loggedInUser->isActive = $result["isActive"];
        $loggedInUser->isAdmin = $isAdmin;

        $_SESSION["user"] = $loggedInUser;

        $response = array('status'=>true,'response'=>$result);
    }else{
        $response = array('status'=>false,'message'=>'Invalid Credentials!');
    }
}else{
    $response = array('status'=>false,'message'=>'Username or Password cannot be empty!');
}

echo json_encode($response);

?>