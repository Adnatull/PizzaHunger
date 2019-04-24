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
            array_push($this->errors, "No service is selected");
        }
        $sql = "SELECT * FROM `pizza` WHERE `id`=$id";
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $stmt       = $this->conn->query($sql);
        $service    = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo '<script type="text/javascript">alert("'.var_dump($service).'")</script>';
        $faq_id             = $service[0]['faq_id'];
        $service_detail_id  = $service[0]['service_details_id'];

        // $sql        = "SELECT * FROM `faq` WHERE `faq_id`=$faq_id";
        // $stmt       = $this->conn->query($sql);
        // $faq        = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // echo '<script type="text/javascript">alert("'.$faq_id.'")</script>';
        // echo '<script type="text/javascript">alert("'.$service_detail_id.'")</script>';

        $sql            = "SELECT * FROM `service_details` WHERE `service_detail_id`=$service_detail_id";
        $stmt           = $this->conn->query($sql);
        $service_detail = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $img = $service_detail[0]['service_detail_image'];
        unlink("../images/".$img);
        $sql = "DELETE FROM `faq` WHERE `faq_id`=$faq_id";
        try{
            $this->conn->exec($sql);
        }catch(PDOException $e) {
            array_push($this->errors, "Could not remove faq from database");
        }

        $sql = "DELETE FROM `service_details` WHERE `service_detail_id`=$service_detail_id";
        try{
            $this->conn->exec($sql);
        }catch(PDOException $e) {
            array_push($this->errors, "Could not remove Service Detail from database");
        }
        $img = $service[0]['image'];
        unlink("../images/".$img);
        $sql = "DELETE FROM `services` WHERE `service_id`=$id";
        try{
            $this->conn->exec($sql);
        }catch(PDOException $e) {
            array_push($this->errors, "Could not remove Service from database");
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


    public function getServices() {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $sql        = "SELECT * FROM `services`";
        $stmt       = $this->conn->query($sql);
        $services   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $ser        = array();
        foreach($services as $service) {
            $sub_id             = $service['sub_id'];
            $sql                = "SELECT * FROM `sub_category` WHERE `sub_id`=$sub_id; ";
            $stmt               = $this->conn->query($sql);
            $sub_category       = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($sub_category)==0) {
                continue;
            }
            //echo '<script type="text/javascript">alert("'.var_dump($sub_category).'")</script>';

            $cat_id             = $sub_category[0]['cat_id'];        
            $sql                = "SELECT * FROM `category` WHERE `cat_id`=$cat_id; ";
            $stmt               = $this->conn->query($sql);
            $category           = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($category)==0) {
                continue;
            }

            $faq_id             = $service['faq_id'];
            $sql                = "SELECT * FROM `faq` WHERE `faq_id`=$faq_id";
            $stmt               = $this->conn->query($sql);
            $faq                = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $service_details_id = $service['service_details_id'];
            $sql                = "SELECT * FROM `service_details` WHERE `service_detail_id`=$service_details_id";
            $stmt               = $this->conn->query($sql);
            $service_detail     = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $ser[$service['service_id']]['name']                    = $service['service_name'];
            $ser[$service['service_id']]['id']                      = $service['service_id'];
            $ser[$service['service_id']]['price']                   = $service['price'];
            $ser[$service['service_id']]['image']                   = $service['image'];
            $ser[$service['service_id']]['sub_id']                  = $service['sub_id'];
            $ser[$service['service_id']]['sub_name']                = $sub_category[0]['sub_name'];
            $ser[$service['service_id']]['cat_id']                  = $category[0]['cat_id'];
            $ser[$service['service_id']]['cat_name']                = $category[0]['name'];
            $ser[$service['service_id']]['faq_id']                  = $faq[0]['faq_id'];
            $ser[$service['service_id']]['faq_question']            = $faq[0]['question'];
            $ser[$service['service_id']]['faq_answer']              = $faq[0]['answer'];
            $ser[$service['service_id']]['service_detail_id']       = $service['service_details_id'];
            $ser[$service['service_id']]['service_detail_title']    = $service_detail[0]['service_detail_title'];
            $ser[$service['service_id']]['service_detail_image']    = $service_detail[0]['service_detail_image'];
            $ser[$service['service_id']]['service_description']     = $service_detail[0]['service_description'];

        }
       
        return $ser;
    }
    
}