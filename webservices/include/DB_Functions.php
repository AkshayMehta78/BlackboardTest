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
        $password = $this->randomPassword();
        $query = "INSERT INTO faculty(name,email,password,isActive,createdAt,isDeleted) VALUES('$fullname','$email','$password',false,NOW(),false)";
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


    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function sendEmailToFaculty($result){
        $this->mail->isSMTP();                            // Set mailer to use SMTP
        $this->mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                     // Enable SMTP authentication
        $this->mail->Username = 'akshaymehta9211@gmail.com';          // SMTP username
        $this->mail->Password = '@Akshay3244'; // SMTP password
        $this->mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = 587;                          // TCP port to connect to

        $this->mail->setFrom('info@example.com', 'CodexWorld');
        $this->mail->addReplyTo('info@example.com', 'CodexWorld');
        $this->mail->addAddress('john@gmail.com');   // Add a recipient
        $this->mail->addCC('cc@example.com');
        $this->mail->addBCC('bcc@example.com');

        $this->mail->isHTML(true);  // Set email format to HTML

        $bodyContent = '<h1>How to Send Email using PHP in Localhost by CodexWorld</h1>';
        $bodyContent .= '<p>This is the HTML email sent from localhost using PHP script by <b>CodexWorld</b></p>';

        $this->mail->Subject = 'Email from Localhost by CodexWorld';
        $this->mail->Body    = $bodyContent;

        if(!$this->mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

}
 
?>