<?php

require_once("config.php");
session_start();
//Log the user out


if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
}
header("Location: ../../");
die();
?>