<?php
/**
 * Created by PhpStorm.
 * User: Akshay Mehta
 * Date: 11/14/2017
 * Time: 11:24 PM
 */

class Dashboard_Function
{
    private $db;
    private $dbConnection;
    //put your code here
    // constructor
    function __construct() {
        require_once '../webservices/include/DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->dbConnection = $this->db->connect();
    }

    // destructor
    function __destruct() {

    }


    public function fetchAllFacultyMembers(){
        $sql = "SELECT * FROM faculty ORDER BY isActive ASC , createdAt DESC";
        $result = mysqli_query($this->dbConnection,$sql);
        $array = array();
        while($row = mysqli_fetch_assoc($result)) {
            $array[] = $row;
        }
        return $array;
    }
}