<?php
class DB_Connect 
{
    // constructor
    function __construct() {
	}

    // destructor
    function __destruct() {
    }

    // Connecting to database
    public function connect() {
        require_once '../webservices/include/config.php';
        // connecting to mysql
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

        // selecting database
        mysqli_select_db($con,DB_DATABASE);
        // return database handler
        return $con;
    }

    // Closing database connection
    public function close() {
        mysqli_close();
    }
}
?>