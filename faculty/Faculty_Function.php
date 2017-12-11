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

    public function fetchAllSchools()
    {
        $sql = "SELECT * FROM school";
        $result = mysqli_query($this->dbConnection, $sql);
        $array = array();
        while($row = mysqli_fetch_assoc($result)){
            $array[] = array('id'=>$row['id'],'name'=>$row['name']);
        }
        return $array;
    }

    public function fetchAllStream()
    {
        $sql = "SELECT * FROM stream";
        $result = mysqli_query($this->dbConnection, $sql);
        $array = array();
        while($row = mysqli_fetch_assoc($result)){
            $array[] = array('id'=>$row['id'],'name'=>$row['name']);
        }
        return $array;
    }

    public function fetchAllCoursesByStream($streamId)
    {
        $sql = "SELECT * FROM course where streamId = $streamId";
        $result = mysqli_query($this->dbConnection, $sql);
        $array = array();
        while($row = mysqli_fetch_assoc($result)){
            $array[] = array('id'=>$row['id'],'name'=>$row['name']);
        }
        if(sizeof($array>0)){
            return $array;
        }else{
            return false;
        }

    }

    public function saveFacultSchool($schoolId, $streamId, $courseId, $facultyId)
    {
        $isSchoolStreamAdded = $this->checkIfSchoolAndStreamIsAdded($facultyId,$schoolId, $streamId);
        if($isSchoolStreamAdded){
            $courses = $isSchoolStreamAdded.','.$courseId;
            $sql = "UPDATE facultyschool SET courses='$courses' where facultyId = $facultyId and schoolId = $schoolId and streamId = $streamId";
        }else{
            $sql = "INSERT INTO facultyschool (facultyId, schoolId, streamId,courses)
                VALUES ($facultyId,$schoolId,$streamId,$courseId)";
        }
        $result = mysqli_query($this->dbConnection, $sql);
        return $result;
    }

    private function checkIfSchoolAndStreamIsAdded($facultyId, $schoolId, $streamId)
    {
        $sql = "SELECT * FROM facultySchool where facultyId = $facultyId and schoolId = $schoolId and streamId = $streamId";
        $result = mysqli_query($this->dbConnection, $sql);
        $no_of_rows = mysqli_num_rows($result);
        if($no_of_rows > 0){
            $row = mysqli_fetch_row($result);
            $course = $row[4];
            return $course;
        }else{
            return false;
        }
    }

    public function checkIfCourseIsAdded($schoolId, $streamId, $courseId, $facultyId)
    {
        $sql = "SELECT * FROM facultySchool where facultyId = $facultyId and schoolId = $schoolId and streamId = $streamId and courses like '%$courseId%'";
        $result = mysqli_query($this->dbConnection, $sql);
        $no_of_rows = mysqli_num_rows($result);
        if($no_of_rows > 0){
            return true;
        }else{
            return false;
        }
    }
}