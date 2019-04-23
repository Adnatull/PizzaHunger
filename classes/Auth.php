<?php
class Auth {

    private static $data = null;
    private static $start = null;
    private static $conn = null;
    private function __construct() {
    }

    public static function getInstance()  {
        if(self::$data == null) {
            self::$data = Session::getStart();
        }
        if(self::$conn == null) {
            self::$conn = Connection::getInstance()->getConn();
        }
        if(self::$start == null) {
            self::$start = new self();
        }
    }


} 
?>