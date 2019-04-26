<?php 
class ContactUs {
    private $conn = null;
    private static $instance = null;
    public $errors = array();

    function __construct() {
        

        if(isset($_GET['name']) && isset($_GET['email']) && isset($_GET['subject']) && isset($_GET['message'])) {
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

        $name       = $_GET['name'];
        $email      = $_GET['email'];
        $subject    = $_GET['subject'];
        $message    = $_GET['message'];

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
                echo "<name> Message has been sent to Administration </name>\n";
            } catch (PDOException $e) {
                echo "<name> Insertion failed </name\n";
            }
        } else {
            foreach($this->errors as $error) {
                echo "<name> ". $error ." </name\n";
            }
        }
               

    }
}
?>