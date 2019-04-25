<?php 
class ContactUs {
    private $conn = null;
    private static $instance = null;
    public $errors = array();

    function __construct() {
        if(isset($_POST['contactus'])) {
            $this->storeContactMessage();
        }
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function storeContactMessage() {
        $this->errors = array();

        $name       = $_POST['name'];
        $email      = $_POST['email'];
        $subject    = $_POST['subject'];
        $message    = $_POST['message'];

        if(empty($name)) {
            array_push($this->errors, "name field is empty!");
        }

        if(empty($email)) {
            array_push($this->errors, "Email field is empty!");
        }

        if(empty($subject)) {
            array_push($this->errors, "Subject field is empty!");
        }

        if(empty($message)) {
            array_push($this->errors, "Message field is empty!");
        }

        if(count($this->errors)==0) {
            if(!isset($this->conn)) {
                $this->conn = Connection::getInstance()->getConn();
            }
            $sql = "INSERT INTO contactus (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message');";
            try {
                $this->conn->exec($sql);
                header("Location: contact.php");
            } catch (PDOException $e) {
                array_push($this->errors, "Something wrong with your picture");
            }
        }
        
        

    }
}
?>