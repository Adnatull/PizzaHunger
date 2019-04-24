<?php
class Pizza {
    private static $instance = null;
    private $conn = null;

    public $errors = array();
    function __construct() {

    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
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