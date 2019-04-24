<?php
class CustomerReviews{
    private static $instance = null;
    private $conn = null;
    public $errors = array();
    public $singleReview = array();
    function __construct(){
        if(isset($_POST['insertCustomerReview'])) {
            $this->insertReview();
        }
       // echo '<script type="text/javascript">alert("hello")</script>';
        if(isset($_GET['deleteReview'])) {
            $this->deleteReview();
        }
        if(isset($_GET['getSingleReview'])) {
            
            $this->getSingleReview();
        }
        if(isset($_POST['updateReview'])) {
            
            $this->updateReview();
        }

    }

    public static function getInstance() {
        if(!isset(self::$instance) ){
            self::$instance = new self();
        }
        return self::$instance;
    }
    private function insertReview() {
        $this->errors = array();
        $name = $_POST['customerName'];
        $comment = $_POST['customerComment'];
        $videoUrl = $_POST['url'];
        if(empty($name)) {
            array_push($this->errors, "Name field is empty");
        }
        if(empty($comment)) {
            array_push($this->errors, "Comment field is empty");
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
            $sql = "INSERT INTO `customer_reviews`( `name`, `comment`, `image`, `video_url`) VALUES ('$name','$comment','$img','$videoUrl') ";
            //$sql = "INSERT INTO `category`( `name`, `image`) VALUES ('$name', '$img') ";
            if(!isset($this->conn)) {
                $this->conn = Connection::getInstance()->getConn();
            }
            //echo '<script type="text/javascript">alert("'.$sql.'")</script>';
            try {
                $this->conn->exec($sql);
                header("Location: happyCustomer.php");
            } catch (PDOException $e) {
                array_push($this->errors, "Something wrong with your picture");
            }
        }
    }

    public function getReviews() {
        $sql = "SELECT * FROM `customer_reviews` ";
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $stmt = $this->conn->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    private function deleteReview() {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $this->errors = array();
        $id = $_GET['deleteReview'];

        $sql = "SELECT * FROM `customer_reviews` WHERE `id`=$id LIMIT 1";
        $stmt = $this->conn->query($sql);
        $review= $stmt->fetchAll(PDO::FETCH_ASSOC); 
        $img = $review[0]['image'];
        unlink("../images/".$img);

       // echo '<script type="text/javascript">alert("'.$id.'")</script>';
        
           // echo '<script type="text/javascript">alert("'.$id.'")</script>';
            $sql = "DELETE FROM `customer_reviews` WHERE `id` = $id ";
            try {
                $this->conn->exec($sql);
            } catch(PDOException $e) {
                array_push($this->errors, "Something went wrong");
            }
         
    }
    private function getSingleReview() {
        $id = $_GET['getSingleReview'];
        $sql = "SELECT * FROM `customer_reviews` WHERE `id`=$id LIMIT 1";
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $this->errors = array();
        $stmt = $this->conn->query($sql);
        $category= $stmt->fetchAll(PDO::FETCH_ASSOC); 
        $this->singleReview = array(
            'id'        => $category[0]['id'],
            'name'      => $category[0]['name'],
            'comment'   => $category[0]['comment'],
            'image'     => $category[0]['image'],
            'video_url' => $category[0]['video_url']
        );
        //echo '<script type="text/javascript">alert("'.$id.'")</script>';
    }

    private function updateReview() {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $this->errors = array();
        
        $id = $_POST['review_id'];
        $name=  $_POST['review_name'];
        $comment = $_POST['review_comment'];
        $video_url = $_POST['video_url'];
        $prev_img = $_POST['prev_img'];
        


        $sql = "";
        $img = "";
        $imgextension = "";
        if(empty($_FILES['image']['name']) || empty($_FILES['image']) || strlen($_FILES['image']['name'])==0) {
            $sql = "UPDATE `customer_reviews` SET `name`='$name',`comment`='$comment',`video_url`='$video_url',`updated_at`=CURRENT_TIMESTAMP WHERE `id`=$id ";
          //  echo '<script type="text/javascript">alert("'.$sql.'")</script>';
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
                $sql= "UPDATE `customer_reviews` SET `name`='$name',`comment`='$comment',`image`='$img',`video_url`='$video_url',`updated_at`=CURRENT_TIMESTAMP WHERE `id`=$id ";
                unlink("../images/".$prev_img);
            }
        }
        $ss = "happyCustomerEdit.php?getSingleReview=".$id;
        if(count($this->errors)==0) {
            try {
                $this->conn->exec($sql);
                header("Location: happyCustomerView.php");
            } catch (PDOException $e) {
                array_push($this->errors, "Something wrong with update");
                //header("Location: ".$ss);
            }
        }
    }
}