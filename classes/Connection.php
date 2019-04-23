<?php
class Connection
{
    private $db_connection;
    private static $instance = null;
    public function __construct()
    {
        $this->ConnectToDatabase();
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConn()
    {        
        return $this->db_connection;
    }

    private function ConnectToDatabase()
    {

        try {
            $this->db_connection = new PDO("mysql:host=127.0.0.1;dbname=pizzaHunger", "root", "");
            // set the PDO error mode to exception
            $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
           // echo '<script type="text/javascript">alert("Connected successfully")</script>';
        } catch (PDOException $e) {
            //echo "Connection failed: " . $e->getMessage();
            echo '<script type="text/javascript">alert("'."Connection failed: " . $e->getMessage().'")</script>';
        }
    }
}
