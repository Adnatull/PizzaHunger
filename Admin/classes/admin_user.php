<?php

class admin_user
{
    
    private static $instance = null;
    public $errors = array();
    public $con;
    public function __construct() {
        
        if(isset($_POST['login'])) {
            $this->loginNow();
        }
        if(isset($_GET['logout'])) {
            $this->logOutNow();
        }
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function loginNow() {
        $this->errors = array();
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(empty($email)) {
            array_push($this->errors, "Email field is empty!");
        }
        if(empty($password)) {
            array_push($this->errros, "Password field is empty");
        }
        if (count($this->errors)==0) {
            $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password' LIMIT 1";
            $conn = Connection::getInstance();
            $db1 = $conn->getConn(); 
            $stmt = $db1->query($sql);
            $user = $stmt->fetch();
            if($user !== false) {
               // echo '<script type="text/javascript">alert("'.$user['name'].'")</script>';
                $data = Session::getStart();
                $data->AdminLoggedIn = "True";
                $data->user = $user;
                header("Location: dashboard.php");
            } else {
                array_push($this->errors, "Wrong Email/Password");
               // echo '<script type="text/javascript">alert("Wrong Email/Password")</script>';
            }
        }
    }

    private function logOutNow() {
        $data = Session::getStart();
        //  echo '<script type="text/javascript">alert("loggin out now")</script>';
        unset($data->AdminLoggedIn);
        unset($data->user);
        $data->destroy();
        header("Location: index.php");
    }

    /*** for registration process ***/
    public function reg_user($name,$username,$password,$email){
        $password = md5($password);

            $sql="SELECT * FROM users WHERE uname='$username' OR uemail='$email'";

            //checking if the username or email is available in db

            $check =  $this->db->query($sql) ;

            $count_row = $check->num_rows;
            //if the username is not in db then insert to the table
            if ($count_row == 0){
                $sql1="INSERT INTO users SET uname='$username', upass='$password', fullname='$name', uemail='$email'";
                $result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
                return $result;
            }

            else { return false;}

        }
    /*** for login process ***/

    public function check_login($emailusername, $password){
            $password = md5($password);

            $sql2="SELECT uid from users WHERE uemail='$emailusername' or uname='$emailusername' and upass='$password'";

            //checking if the username is available in the table
            $result = mysqli_query($this->db,$sql2);
            $user_data = mysqli_fetch_array($result);

            $count_row = $result->num_rows;

            if ($count_row == 1) {
                // this login var will use for the session thing

                $_SESSION['login'] = true;
                $_SESSION['uid'] = $user_data['uid'];
                return true;
            }
            else{
                return false;
            }
        }
    /*** for showing the username or fullname ***/
    public function get_fullname($uid){
            $sql3="SELECT fullname FROM users WHERE uid = $uid";
            $result = mysqli_query($this->db,$sql3);
            $user_data = mysqli_fetch_array($result);
            echo $user_data['fullname'];
        }

    /*** starting the session ***/

    public function get_session(){
            return $_SESSION['login'];

        }

    public function user_logout() {

            $_SESSION['login'] = FALSE;

            session_destroy();

        }

}
