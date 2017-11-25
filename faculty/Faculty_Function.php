<?php
/**
 * Created by PhpStorm.
 * User: Akshay Mehta
 * Date: 11/14/2017
 * Time: 11:24 PM
 */

class Faculty_Function
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


    public function isSchoolAdded($facultyId){
        $query = "SELECT id from facultyschool WHERE facultyId = $facultyId";
        $result = mysqli_query($this->dbConnection,$query);
        $no_of_rows = mysqli_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }

    public function fetchFacultySchoolDetails($facultyId){
        $sql = "SELECT * FROM facultyschool WHERE facultyId = $facultyId";
        $result = mysqli_query($this->dbConnection,$sql);
        $array = array();
        while($row = mysqli_fetch_assoc($result)) {
            $courses = $row['courses'];
            $stream = $row['streamId'];
            $schoolId = $row['schoolId'];
            $schoolJSON = $this->fetchSchoolDetails($schoolId);
            $streamJSON = $this->fetchStreamDetails($stream);
            $courseArray = $this->fetchCourseDetails($courses);
            $array[] = array('school'=>$schoolJSON,'stream'=>$streamJSON,'course'=>$courseArray);
        }
        return $array;
    }


    public function fetchCourseDetails($courses)
    {
        $courseIds = explode(',', $courses);
        $array = array();
        foreach ($courseIds as $courseId) {
            $sql = "SELECT * FROM course where id = $courseId";
            $result = mysqli_query($this->dbConnection, $sql);
            $course = mysqli_fetch_row($result);
            $array[] = array('id'=>$course[0],'name'=>$course[2]);
        }

        return $array;
    }

    public function fetchStreamDetails($stream)
    {
        $sql = "SELECT * FROM stream where id = $stream";
        $result = mysqli_query($this->dbConnection, $sql);
        $stream = mysqli_fetch_row($result);
        $array = array('id'=>$stream[0],'name'=>$stream[1]);
        return $array;
    }

    public function fetchSchoolDetails($schoolId)
    {
        $sql = "SELECT * FROM school where id = $schoolId";
        $result = mysqli_query($this->dbConnection, $sql);
        $stream = mysqli_fetch_row($result);
        $array = array('id'=>$stream[0],'name'=>$stream[1]);
        return $array;
    }
}