<?php
class Sub_Category{
    private static $instance = null;
    private $conn = null;
    public $errors = array();
    public $singleSubCategory = array();

    function __construct() {        
        if(isset($_POST['sub_category_insert'])) {
             $this->insertSubCategory();
        }
        if(isset($_GET['deleteSubCategory'])) {
            $this->deleteSubCategory();
        }
        if(isset($_GET['editSubCategory'])) {
            $this->showSingleSubCategory();
        }
        if(isset($_POST['update_sub_category'])) {
           // echo '<script type="text/javascript">alert("Update Hello")</script>';
           $this->updateSubCategory();
        }
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }

    public function getCategories() {       
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $sql = "SELECT * FROM `category` ";
        $stmt = $this->conn->query($sql);
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
       // echo '<script type="text/javascript">alert("Hello")</script>';
        return $categories;
    }

    private function insertSubCategory() {
        $this->errors = array();       
        $cat_id = $_POST['cat_id'];
        if(empty($cat_id)) {
            array_push($this->errors, "The category name is required");
        }
        $name = $_POST['sub_name'];
        if(empty($name)) {
            array_push($this->errors, "The sub category name is empty");
        }
        $img = "";
        //$tmpusername = $username;
        $imgextension = "";
        if (!empty($_FILES['image'])){
            $img = $_FILES['image']['name'];
            $tmp = strrev($img);
            for ($i=0; $i<strlen($tmp); $i++) {
                $imgextension = $tmp[$i].$imgextension;
                if ($tmp[$i]=='.') {
                    break;
                }
            }            
        } else {
            array_push($this->errors, "Please select an image for this sub category");
        }
        $t = time();
        $img = $t.md5($img).$imgextension;
        $target = "../images/".basename($img);
        if ( !move_uploaded_file($_FILES['image']['tmp_name'], $target) ) {      
            array_push($this->errors, "Failed to upload photo!");
        }
        
        if(count($this->errors)==0) {
            $sql = "INSERT INTO `sub_category`(`sub_name`, `sub_image`, `cat_id`) VALUES ('$name','$img','$cat_id') ";
            //$sql = "INSERT INTO `category`( `name`, `image`) VALUES ('$name', '$img') ";
            if(!isset($this->conn)) {
                $this->conn = Connection::getInstance()->getConn();
            }
            //echo '<script type="text/javascript">alert("'.$sql.'")</script>';
            try {
                $this->conn->exec($sql);
                header("Location: sub_category.php");
            } catch (PDOException $e) {
                array_push($this->errors, "Something wrong with your picture");
            }
        }         
    }

    public function getDynamicSubCategory($cat_id) {
       // echo '<script type="text/javascript">alert("HELLO")</script>';
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $sql = "SELECT * FROM `sub_category` WHERE cat_id = '$cat_id' ";
        $stmt = $this->conn->query($sql);
        $sub_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $sub_categories;
    }
    public function getSubCategories() {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $sql = "SELECT * FROM `sub_category` 
                        JOIN `category` ON (category.cat_id = sub_category.cat_id) ";
        
        $stmt = $this->conn->query($sql);
        $sub_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $sub_categories;
    }

    private function deleteSubCategory() {
        $id = $_GET['deleteSubCategory'];
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $this->errors = array();      
           // echo '<script type="text/javascript">alert("'.$id.'")</script>';
            $sql = "DELETE FROM `sub_category` WHERE `sub_id` = $id ";
            $img = $_GET['ImageName'];            
            try {
                $this->conn->exec($sql);
                unlink("../images/".$img);
            } catch(PDOException $e) {
                array_push($this->errors, "Something went wrong");
            }
    }

    private function showSingleSubCategory() {
        $id = $_GET['editSubCategory'];
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $this->errors   = array();
        $sql            = "SELECT * FROM `sub_category` WHERE `sub_id` = $id LIMIT 1";
        $stmt           = $this->conn->query($sql);
        $sub_category   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cat_id         = $sub_category[0]['cat_id'];
        
        $sql            = "SELECT * FROM `category` WHERE `cat_id` = $cat_id LIMIT 1";
        $stmt           = $this->conn->query($sql);
        $category       = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->singleSubCategory = array(
            'sub_id'        => $sub_category[0]['sub_id'],
            'sub_name'      => $sub_category[0]['sub_name'],
            'sub_image'     => $sub_category[0]['sub_image'],
            'cat_id'        => $category[0]['cat_id'],
            'cat_name'      => $category[0]['name'],
            'cat_image'     => $category[0]['image']
        );
       // echo '<script type="text/javascript">alert("'.var_dump($this->singleSubCategory).'")</script>';
    }
    private function updateSubCategory() {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $this->errors = array();
        $sub_id = $_POST['sub_id'];
        $sub_name = $_POST['sub_name'];
        $cat_id = $_POST['cat_id'];
        if(empty($sub_id) || strlen($sub_id)==0) {
            array_push($this->errors, "Sub Category ID is not given");
        }
        if(empty($sub_name) || strlen($sub_name)==0) {
            array_push($this->errors, "Sub category name is not given");
        }
        if(empty($cat_id) || strlen($cat_id)==0) {
            array_push($this->errors, "Category is not selected");
        }
        $sql = "";
        $img = "";
        $imgextension = "";
        if(empty($_FILES['image']['name']) || empty($_FILES['image']) || strlen($_FILES['image']['name'])==0 ) {
            $sql = "UPDATE `sub_category` SET `sub_name`='$sub_name',`cat_id`=$cat_id WHERE `sub_id`=$sub_id ";
        } else {
            $img = $_FILES['image']['name'];
            $tmp = strrev($img);
            for ($i=0; $i<strlen($tmp); $i++) {
                $imgextension = $tmp[$i].$imgextension;
                if ($tmp[$i]=='.') {
                    break;
                }
            }       
            $t = time();
            $img = $t.md5($img).$imgextension;
            $target = "../images/".basename($img);
            if ( !move_uploaded_file($_FILES['image']['tmp_name'], $target) ) {      
                array_push($this->errors, "Failed to upload photo!");
            }
            $sql = "UPDATE `sub_category` SET `sub_name`='$sub_name',`sub_image`='$img',`cat_id`=$cat_id WHERE `sub_id`=$sub_id ";
        }
        if(count($this->errors)==0) {
            try {
                $this->conn->exec($sql);
                header("Location: sub_category_view.php");
            } catch (PDOException $e) {
                echo '<script type="text/javascript">alert("'.$sql.'")</script>';
                array_push($this->errors, "Something wrong with update");
            }

        }

    }
}