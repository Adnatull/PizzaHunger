<?php
class Category{
    private static $instance = null;
    private $conn = null;
    public $errors = array();
    public $singleCategory = array();

    function __construct() {        
        if(isset($_POST['category_insert'])) {
             $this->insertCategory();
        }
        if(isset($_GET['deleteCategory'])) {
            $this->deleteCategory();
        }
        if(isset($_GET['getSingleCategory'])) {
            $this->getSingleCategory();
        }
        if(isset($_POST['update_category'])) {
            
            $this->updateCategory();
        }
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function insertCategory() {
        $this->errors = array();       

        $name = $_POST['category'];
        if(empty($name)) {
            array_push($this->errors, "The category name is empty");
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
            array_push($this->errors, "Please select an image for this category");
        }
        $t = time();
        $img = $t.md5($img).$imgextension;
        $target = "../images/".basename($img);
        if ( !move_uploaded_file($_FILES['image']['tmp_name'], $target) ) {      
            array_push($this->errors, "Failed to upload photo!");
        }
        
        if(count($this->errors)==0) {
            $sql = "INSERT INTO `category`( `name`, `image`) VALUES ('$name', '$img') ";
            if(!isset($this->conn)) {
                $this->conn = Connection::getInstance()->getConn();
            }
            //echo '<script type="text/javascript">alert("'.$sql.'")</script>';
            try {
                $this->conn->exec($sql);
                header("Location: category.php");
            } catch (PDOException $e) {
                array_push($this->errors, "Something wrong with your picture");
            }
        }         
    }

    public function getCategories() {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $sql = "SELECT * FROM `category`";
        $stmt = $this->conn->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    private function deleteCategory() {
        $id = $_GET['deleteCategory'];
        $sql = "DELETE FROM `category` WHERE `cat_id` = $id ";

        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $this->errors = array();
        try {
            $this->conn->exec($sql);
            $img = $_GET['ImageName'];
            unlink("../images/".$img);
        } catch(PDOException $e) {
            array_push($this->errors, "Something went wrong");
        }
    }
    private function getSingleCategory() {
        $id = $_GET['getSingleCategory'];
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $this->errors = array();

        $sql = "SELECT * FROM `category` WHERE `cat_id` = $id LIMIT 1";
        $stmt = $this->conn->query($sql);
        $category= $stmt->fetchAll(PDO::FETCH_ASSOC);  



        $this->singleCategory = array(
            'cat_id'        => $category[0]['cat_id'],
            'cat_name'      => $category[0]['name'],
            'cat_image'     => $category[0]['image']
        );
        //echo '<script type="text/javascript">alert("'.$this->singleCategory['cat_name'].'")</script>';

    }
    
    private function updateCategory() {
        $this->errors = array();
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        
        $id = $_POST['cat_id'];
        $category = $_POST['category'];
        $prev_img = $_POST['prev_img'];
        //echo '<script type="text/javascript">alert("'.$id.'")</script>';


        $sql = "";
        $img = "";
        $imgextension = "";
        if(empty($_FILES['image']['name']) || empty($_FILES['image']) || strlen($_FILES['image']['name'])==0) {
            $sql = "UPDATE `category` SET `name`='$category' WHERE `cat_id`=$id ";
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
            } else {
                $sql = "UPDATE `category` SET `name`='$category', `image`='$img' WHERE `cat_id`=$id ";
                
                unlink("../images/".$prev_img);
            }
        }
        if(count($this->errors)==0) {
            try {
                $this->conn->exec($sql);
                header("Location: category_view.php");
            } catch (PDOException $e) {
               // echo '<script type="text/javascript">alert("'.$sql.'")</script>';
                array_push($this->errors, "Something wrong with update");
            }
        }


    }
}