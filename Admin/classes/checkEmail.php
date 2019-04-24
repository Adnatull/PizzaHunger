<?php
require_once "../../classes/Session.php";
require_once "../../classes/Connection.php";
if(!empty($_POST["checkEmail"])) {
    $email = $_POST["checkEmail"];
            //echo '<script type="text/javascript">alert("'.$email.'")</script>';
            $sql = "SELECT * FROM admin WHERE email='$email' ";
            $conn = Connection::getInstance();
            $db1 = $conn->getConn(); 
            $stmt = $db1->query($sql);
            $user = $stmt->fetch();
            $data = Session::getStart();
            if($user !== false) {
                if($user['email'] == $data->user['email']) {
                    echo "<span class='status-available'> Email Available.</span>";
                } else {
                    echo "<span class='status-not-available'> Email Not Available.</span>";
                }
            }else{
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                   // $emailErr = "Invalid email format"; 
                    echo "<span class='status-available'> Invalid email format.</span>";
                } 
                else {
                    echo "<span class='status-available'> Email Available.</span>";
                }
                
            }
}
?>