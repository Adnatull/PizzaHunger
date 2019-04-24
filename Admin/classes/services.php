<?php
class Services {
    private static $instance = null;
    private $conn = null;

    public $errors = array();
    function __construct() {
        if(isset($_POST['insertService'])) {
            $this->insertService();
        }
        if(isset($_GET['deleteService'])) {
           // echo '<script type="text/javascript">alert("'.$_GET['deleteService'].'")</script>';
           $this->deleteService();
        }
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function deleteService() {
        $id = $_GET['deleteService'];
        $this->errors = array();
        if(empty($id)) {
            array_push($this->errors, "No service is selected");
        }
        $sql = "SELECT * FROM `services` WHERE `service_id`=$id";
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

    private function insertService() {
        $this->errors = array();
        $service_name       = $_POST['service_name'];
        if(empty($service_name)) {
            array_push($this->errors, "Service Name field is empty");
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
            $target = "../images/".basename($image);
            if ( !move_uploaded_file($_FILES['image']['tmp_name'], $target) ) {      
                array_push($this->errors, "Failed to upload photo!");
            }            
        } else {
            array_push($this->errors, "Please select an image for this service");
        }
        

        
        
        $sub_id             = $_POST['sub_id'];
        if(empty($sub_id)) {
            array_push($this->errors, "Sub Category field is not selected");
        }



        $faq_ques           = $_POST['faq_ques'];
        if(empty($faq_ques)) {
            array_push($this->errors, "FAQ question field is empty");
        }
        $faq_ans            = $_POST['faq_ans'];
        if(empty($faq_ans)) {
            array_push($this->errors, "FAQ Answer field is empty");
        }

        



        $serviceTitle       = $_POST['serviceTtile'];
        if(empty($serviceTitle)) {
            array_push($this->errors, "Service Title field is empty");
        }

        $serviceImage = "";
        //$tmpusername = $username;
        $imgextension = "";
        if (strlen($_FILES['serviceImage']['name'])>0){
            $serviceImage = $_FILES['serviceImage']['name'];
            $tmp = strrev($serviceImage);
            for ($i=0; $i<strlen($tmp); $i++) {
                $imgextension = $tmp[$i].$imgextension;
                if ($tmp[$i]=='.') {
                    break;
                }
            } 
            $t = time();
            $serviceImage = $t.md5($serviceImage).$imgextension;
            $target = "../images/".basename($serviceImage);
            if ( !move_uploaded_file($_FILES['serviceImage']['tmp_name'], $target) ) {      
                array_push($this->errors, "Failed to upload service detail photo!");
            } 
           // echo '<script type="text/javascript">alert("'.$serviceTitle.'")</script>';
           // echo '<script type="text/javascript">alert("'.$serviceImage.'")</script>';
            
       
        } else {
            array_push($this->errors, "Please select an image for service detail");
        }
        
        $serviceDetail      = $_POST['serviceDetail'];
        if(empty($serviceDetail)) {
            array_push($this->errors, "Service Detail field is empty");
        }
       // echo '<script type="text/javascript">alert("'.$serviceDetail.'")</script>';
        
        //echo '<script type="text/javascript">alert("Hello")</script>';
        if(count($this->errors)==0) {
            $faq_id = $this->insertFaq($faq_ques, $faq_ans);
            if($faq_id != false) {
                $service_detail_id = $this->insertServiceDetail($serviceTitle, $serviceImage, $serviceDetail);
                if($service_detail_id != false) {
                    if(!isset($this->conn)) {
                        $this->conn = Connection::getInstance()->getConn();
                    }
                    $sql = "INSERT INTO `services`( `service_name`, `price`, `image`, `sub_id`, `faq_id`, `service_details_id`) VALUES ('$service_name','$price','$image','$sub_id','$faq_id','$service_detail_id') ";
                    try {
                        $this->conn->exec($sql);
                        
                        header("Location: service.php");
                    } catch (PDOException $e) {
                        array_push($this->errors, "Something wrong with inserting Service Insertion");
                        return false;
                    }
                } else {
                    array_push($this->errors, "Can not insert Service Detail! Try again");
                }
            } else {
                array_push($this->errors, "Can not insert FAQ! Try again");
            }
        }
        



    }

    private function insertServiceDetail($serviceTitle, $serviceImage, $serviceDetail) {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $sql    = "INSERT INTO `service_details`( `service_detail_title`, `service_detail_image`, `service_description`) VALUES ('$serviceTitle','$serviceImage', '$serviceDetail') ";
        $lastId = false;
        try {
            $this->conn->exec($sql);
            $lastId = $this->conn->lastInsertId();
           // header("Location: services.php");
        } catch (PDOException $e) {
            //array_push($this->errors, "Something wrong with inserting FAQ");
            return false;
        }
        return $lastId;
    }

    private function insertFaq($ques, $ans) {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $sql    = "INSERT INTO `faq`( `question`, `answer`) VALUES ('$ques','$ans') ";
        $lastId = false;
        try {
            $this->conn->exec($sql);
            $lastId = $this->conn->lastInsertId();
           // header("Location: services.php");
        } catch (PDOException $e) {
            //array_push($this->errors, "Something wrong with inserting FAQ");
            return false;
        }
        return $lastId;
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