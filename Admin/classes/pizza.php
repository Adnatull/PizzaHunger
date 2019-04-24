<?php
class Pizza {
    private static $instance = null;
    private $conn = null;

    public $errors = array();
    function __construct() {
        if(isset($_POST['insertPizza'])) {
            $this->insertPizza();
        }
        if(isset($_GET['deletePizza'])) {
           // echo '<script type="text/javascript">alert("'.$_GET['deleteService'].'")</script>';
           $this->deletePizza();
        }
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function deletePizza() {
        $id = $_GET['deletePizza'];
        $this->errors = array();
        if(empty($id)) {
            array_push($this->errors, "No Pizza is selected");
        }
        $sql = "SELECT * FROM `pizza` WHERE `id`=$id";
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $stmt       = $this->conn->query($sql);
        $pizza    = $stmt->fetchAll(PDO::FETCH_ASSOC);
        

        $img = $pizza[0]['image'];
        unlink("../images/pizza/".$img);
        $sql = "DELETE FROM `pizza` WHERE `id`=$id";
        try{
            $this->conn->exec($sql);
        }catch(PDOException $e) {
            array_push($this->errors, "Could not remove Pizza from database");
        }


    }

    private function insertPizza() {
        $this->errors = array();
        $pizza_name       = $_POST['pizza_name'];
        if(empty($pizza_name)) {
            array_push($this->errors, "Pizza Name field is empty");
        }

        $pizza_description       = $_POST['pizza_description'];
        if(empty($pizza_description)) {
            array_push($this->errors, "Pizza description field is empty");
        }


        $price              = $_POST['price'];
        if(empty($price)) {
            array_push($this->errors, "Price field is empty");
        }

        $image = "";
        //$tmpusername = $username;
        $imgextension = "";
        if (strlen($_FILES['image']['name'])>0){
            $image = $_FILES['image']['name'];
            $tmp = strrev($image);
            for ($i=0; $i<strlen($tmp); $i++) {
                $imgextension = $tmp[$i].$imgextension;
                if ($tmp[$i]=='.') {
                    break;
                }
            }
            $t = time();
            $image = $t.md5($image).$imgextension;
            $target = "../images/pizza/".basename($image);
            if ( !move_uploaded_file($_FILES['image']['tmp_name'], $target) ) {      
                array_push($this->errors, "Failed to upload photo!");
            }            
        } else {
            array_push($this->errors, "Please select an image for this service");
        }
        
        //echo '<script type="text/javascript">alert("Hello")</script>';
        if(count($this->errors)==0) {
            if($this->conn == null) {
                $this->conn = Connection::getInstance()->getConn();
            }
            $sql = "INSERT INTO `pizza`( `name`, `description`, `price`, `image`) VALUES ('$pizza_name', '$pizza_description', $price,'$image'); ";
                    try {
                        $this->conn->exec($sql);
                        
                        header("Location: pizza.php?msg=insertSuccessful");
                    } catch (PDOException $e) {
                        array_push($this->errors, "Something wrong with inserting Pizza");
                        return false;
                    }
        }
        



    }


    public function getPizza() {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $sql        = "SELECT * FROM `pizza`";
        $stmt       = $this->conn->query($sql);
        $pizza   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $pizza;
      
    }
    
}