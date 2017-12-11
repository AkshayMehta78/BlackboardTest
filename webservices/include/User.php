<?php
/**
 * Created by PhpStorm.
 * User: Akshay Mehta
 * Date: 12/11/2017
 * Time: 3:25 AM
 */

class User
{
    public $id = NULL;
    public $name = NULL;
    public $email = NULL;
    public $isActive = NULL;
    public $isAdmin = NULL;
    //Logout
    public function userLogOut()
    {
        destroySession("user");
    }
}