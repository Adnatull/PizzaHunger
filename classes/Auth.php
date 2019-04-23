<?php
class Auth {

    private $data = null;
    private static $start = null;
    private $conn = null;
    public $errors = array();
    private function __construct() {
        if(isset($_POST['login'])){
            $this->loginUser();

        }
    }

    public static function getInstance()  {
        if(self::$start == null) {
            self::$start = new self();
        }
        return self::$start;
    }

    private function loginUser() {

        $this->errors = array();
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($email)) {
            array_push($this->errors, "Email field is empty");
        }
        if (empty($password)) {
            array_push($this->errors, "Password field is empty");
        }
        $password = md5($password);
        if(count($this->errors)==0) { 
            if($this->conn == null) {
                $this->conn = Connection::getInstance();
            }
            $db1 = $this->conn->getConn(); 
            
                $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
                $stmt = $db1->query($sql);
                $user = $stmt->fetch();
                if($user !== false) {
                    // 
                    if($this->data == null) {
                        $this->data = Session::getStart();
                    }
                    $this->data->userID = $user['id'];
                    $this->data->user = $user;
                    $this->data->user['password'] = "";
                    echo '<script type="text/javascript">alert("Login Successful")</script>';
                    
                    
                } else {
                    array_push($this->errors, "Wrong email/password");
                }
                
            
        }       
    }

    private function userLogOut() {
        //echo '<script type="text/javascript">alert("Customer Log OUT")</script>';
        $this->data = Session::getStart();
        unset($this->data->userID);
        unset($this->data->user);
        $this->data->destroy();
        header("Location: index.php");
    } 
    
} 
?>