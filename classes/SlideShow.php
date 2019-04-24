<?php
class SlideShow {
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
    public function firstSlide() {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $sql        = "SELECT * FROM `slideshow` WHERE `position`=1 LIMIT 1; ";
        $stmt       = $this->conn->query($sql);
        $slide      = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $slide;
    }

    public function secondSlide() {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $sql        = "SELECT * FROM `slideshow` WHERE `position`='2' LIMIT 1; ";
        $stmt       = $this->conn->query($sql);
        $slide      = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $slide;
    }

    public function thirdSlide() {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $sql        = "SELECT * FROM `slideshow` WHERE `position`='3' LIMIT 1; ";
        $stmt       = $this->conn->query($sql);
        $slide      = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $slide;
    }
    
}