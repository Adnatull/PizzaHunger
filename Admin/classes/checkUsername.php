<?php
require_once "../../classes/Session.php";
require_once "../../classes/Connection.php";
if(!empty($_POST["checkUsername"])) {
    $username = $_POST["checkUsername"];
            //echo '<script type="text/javascript">alert("'.$username.'")</script>';
            $sql = "SELECT * FROM admin WHERE username='$username' ";
            $conn = Connection::getInstance();
            $db1 = $conn->getConn(); 
            $stmt = $db1->query($sql);
            $user = $stmt->fetch();
            $data = Session::getStart();
            if($user !== false) {
                if($user['username']==$data->user['username']) {
                    echo "<span class='status-not-available'> Username Available.</span>";
                } else {
                    echo "<span class='status-not-available'> Username Not Available.</span>";
                }
            }else{
                echo "<span class='status-available'> Username Available.</span>";
            }
}
?>