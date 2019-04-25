<?php
    class SlideShow {
    private static $instance = null;
    private $conn = null;

    public $errors = array();
    function __construct() {
        if(isset($_POST['insertSlideShow'])) {
            $this->insertSlideShow();
            // echo '<script type="text/javascript">alert("Hello")</script>';

        }
        if(isset($_GET['deleteSlideShow'])) {
           $this->deleteSlideShow();
        }
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function deleteSlideShow() {
        $id = $_GET['deleteSlideShow'];
        $this->errors = array();
        if(empty($id)) {
            array_push($this->errors, "No Slide is selected");
        }
        $sql = "SELECT * FROM `slideshow` WHERE `id`=$id";
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $stmt       = $this->conn->query($sql);
        $slideshow    = $stmt->fetchAll(PDO::FETCH_ASSOC);
        

        $img = $slideshow[0]['image'];
        unlink("../images/slideshow/".$img);
        $sql = "DELETE FROM `slideshow` WHERE `id`=$id";
        try{
            $this->conn->exec($sql);
        }catch(PDOException $e) {
            array_push($this->errors, "Could not remove slideshow from database");
        }
    }

    private function insertSlideShow() {
        $this->errors = array();
        $name       = $_POST['name'];
        if(empty($name)) {
            array_push($this->errors, "Name field is empty");
        }

        $short_heading       = $_POST['short-heading'];
        if(empty($short_heading)) {
            array_push($this->errors, "Short Heading field is empty");
        }

        $position       = $_POST['position'];
        if(empty($position)) {
            array_push($this->errors, "Slide Position field is empty");
        }


        $description              = $_POST['description'];
        if(empty($description)) {
            array_push($this->errors, "Description field is empty");
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
            $target = "../images/slideshow/".basename($image);
            if ( !move_uploaded_file($_FILES['image']['tmp_name'], $target) ) {      
                array_push($this->errors, "Failed to upload photo!");
            }            
        } else {
            array_push($this->errors, "Please select an image for this slide");
        }
        
        //echo '<script type="text/javascript">alert("Hello")</script>';
        if(count($this->errors)==0) {
            if($this->conn == null) {
                $this->conn = Connection::getInstance()->getConn();
            }
            $sql = "INSERT INTO `slideshow`( `name`, `short-heading`, `description`, `image`, `position`) VALUES ('$name', '$short_heading', '$description','$image', '$position'); ";
                    try {
                        $this->conn->exec($sql);
                        
                        header("Location: add-slideshow.php?msg=insertSuccessful");
                    } catch (PDOException $e) {
                        array_push($this->errors, "Something wrong with inserting slide");
                        return false;
                    }
        }
        



    }


    public function getSlideShow() {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $sql        = "SELECT * FROM `slideshow`";
        $stmt       = $this->conn->query($sql);
        $slideshow   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $slideshow;
      
    }
}

?>