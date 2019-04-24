<?php
    class profile {
        private static $instance = null;
        public $errors = array();

        function __construct() {
            if(isset($_POST["editProfileButtonHit"])) {
                $this->editProfile();
            }
        }

        public static function getInstance() {
            if(!isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        private function editProfile() {
            $this->errors = array();
            $data = Session::getStartWithoutSession();
            $id = $data->user['id'];
            echo '<script type="text/javascript">alert("'.$id.'")</script>';
            $name = $_POST["name"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];
            $education = $_POST["education"];
            $skill = $_POST["skill"];
            //$updated_at = CURRENT_TIMESTAMP;
            if(empty($name)) {
                array_push($this->errors, "Name is required");
            }
            if(empty($username)) {
                array_push($this->errors, "Username is required");
            }
            if(empty($email)) {
                array_push($this->errors, "Email is required");
            }
            if(empty($address)) {
                array_push($this->errors, "Address is required");
            }
            if(empty($phone)) {
                array_push($this->errors, "Phone is required");
            }
            if(empty($education)) {
                array_push($this->errors, "Education is required");
            }
            if(empty($skill)) {
                array_push($this->errors, "Skill is required");
            }
            if(count($this->errors)==0) {
                $sql= "UPDATE admin SET name = '$name', username = '$username', email = '$email', address = '$address', phone = '$phone', education = '$education', skill = '$skill', updated_at = CURRENT_TIMESTAMP WHERE id = $id";
                //$sql = "INSERT INTO admin (name, username, email, address, phone, education, skill, updated_at) VALUES ('$name', '$username', '$email', '$address', '$phone', '$education', '$skill', CURRENT_TIMESTAMP ) ";
                $conn = Connection::getInstance();
                $db1 = $conn->getConn(); 
                //echo '<script type="text/javascript">alert("'.$sql.'")</script>';
                try {
                    $db1->exec($sql);                    
                    
                    $user = array(
                        'name'      =>  $name,
                        'username'  =>  $username,
                        'email'     =>  $email,
                        'address'   =>  $address,
                        'phone'     =>  $phone,
                        'education' =>  $education,
                        'skill'     =>  $skill,
                        'id'        =>  $data->user['id'],
                        'created_at'=>  $data->user['created_at'],
                        'updated_at'=>  $data->user['updated_at'],
                        'password'  =>  ""
                    );
                    // $data->user['name'] = $name;
                    // $data->user['username'] = $username;
                    // $data->user['email'] = $email;
                    // $data->user['address'] = $address;
                    // $data->user['phone'] = $phone;
                    // $data->user['education'] = $education;
                    // $data->user['skill'] = $skill;
                    //$data->user = $user;
                    $data->user = $user;
                    header("Location: dashboard.php");
                } catch (PDOException $e) {
                    array_push($this->errors, "Email/Phone already exists");
                }
            }
        }

        private function checkUsername() {
            $username = $_POST["checkUsername"];
            //echo '<script type="text/javascript">alert("'.$username.'")</script>';
            $sql = "SELECT * FROM admin WHERE username='$username' ";
            $conn = Connection::getInstance();
            $db1 = $conn->getConn(); 
            $stmt = $db1->query($sql);
            $user = $stmt->fetch();
            if($user !== false) {
                echo "<span class='status-not-available'> Username Not Available.</span>";
            }else{
                echo "<span class='status-available'> Username Available.</span>";
            }
        }
    }
?>