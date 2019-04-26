<?php 
class ContactUs {
    private $conn = null;
    private static $instance = null;
    public $errors = array();

    function __construct() {
        if(isset($_GET['deleteMessage'])) {
            $this->deleteMessage();
        }

        
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getMessages() {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $sql        = "SELECT * FROM `contactus`";
        $stmt       = $this->conn->query($sql);
        $pizza   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $pizza;
      
    }

    private function deleteMessage() {
        $id = $_GET['deleteMessage'];
        $this->errors = array();
        if(empty($id)) {
            array_push($this->errors, "No Pizza is selected");
        }
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        
        $sql = "DELETE FROM `contactus` WHERE `id`=$id";
        try{
            $this->conn->exec($sql);
        }catch(PDOException $e) {
            array_push($this->errors, "Could not remove Message from database");
        }


    }

    
}
?>