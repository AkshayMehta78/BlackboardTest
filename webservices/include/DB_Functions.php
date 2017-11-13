<?php
 
class DB_Functions {
 
    private $db;
    private $dbConnection;
 
    //put your code here
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->dbConnection = $this->db->connect();
    }
 
    // destructor
    function __destruct() {
 
    }
 
    /**
     * Register new user
     * returns user details
     */
    public function requestNewFaculty($fullname, $email) {
        $query = "INSERT INTO faculty(name,email,isActive,createdAt,isDeleted) VALUES('$fullname','$email',true,NOW(),false)";
        $result = mysqli_query($this->dbConnection,$query);
        // check for successful store
        if ($result) {
            // get user details
            // last inserted id
            $result = mysqli_query($this->dbConnection,"SELECT name,email,isActive,createdAt,isDeleted FROM faculty WHERE email = '$email'");
            // return user details
            return mysqli_fetch_array($result);
        } else {
            return false;
        }
    }


    public function isEmailExists($email){
        $result = mysqli_query($this->dbConnection,"SELECT email from faculty WHERE email = '$email'");
        $no_of_rows = mysqli_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }


    public function getLoggedInUser($email,$password,$isAdmin){
        $tableName = "faculty";
        if($isAdmin=='true'){
            $tableName = "admin";
        }
        $query = "SELECT id from ".$tableName." WHERE email = '$email' AND password = '$password'";

        $result = mysqli_query($this->dbConnection,$query);
        $no_of_rows = mysqli_num_rows($result);

        if ($no_of_rows > 0) {
            $result = mysqli_query($this->dbConnection,"SELECT * FROM ".$tableName." WHERE email = '$email'");
            // return user details

            return mysqli_fetch_array($result);
        } else {
            // user not existed
            return false;
        }
    }

}
 
?>