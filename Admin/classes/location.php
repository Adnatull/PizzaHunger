<?php 
class Location {
    private static $instance = null;
    private $conn = null;
    public $error = array();

    function __construct() {
        
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getLocations() {
       // echo '<script type="text/javascript">alert("Hello")</script>';
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        
        $this->errors = array();
        $sql = "SELECT `location_id`, `loaction_name`, `location_status` FROM `location`";
        $stmt = $this->conn->query($sql);
        $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $locations;
    }
}