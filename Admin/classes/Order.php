<?php 
class Order {
    static private $instance = null;
    private $conn = null;
    private $data = null;

    function __construct() {

    }

    public static function getInstance() {
        if(!isset(self::$insance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getPendingOrder() {
        if(!isset($this->conn)) {
            $this->conn = Connection::getInstance()->getConn();
        }
        $sql            = "SELECT * FROM `orders` WHERE `is_confirm`=0";
        $stmt           = $this->conn->query($sql);
        $pendingOrder   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $order          = array();
        foreach($pendingOrder as $pending) {            
            $id                 = $pending['order_id'];
            $sql                = "SELECT * FROM `order_details` WHERE `order_id`=$id";
            $stmt               = $this->conn->query($sql);
            $services           = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($services)==0) {
                continue;
            }
            $ser                = array();
            foreach($services as $service) {
                $serviceID = $service['service_id'];
                $sql = "SELECT * FROM `services` WHERE `service_id`=$serviceID";
                $stmt               = $this->conn->query($sql);
                $ssss               = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $ser[$service['order_details_id']]['id']        = $service['order_details_id'];
                $ser[$service['order_details_id']]['serviceID'] = $service['service_id'];
                $ser[$service['order_details_id']]['quantity']  = $service['service_quantity'];
                $ser[$service['order_details_id']]['service_provider_id'] = $service['service_provider_id'];
                $ser[$service['order_details_id']]['serviceName'] = $ssss[0]['service_name'];
                $ser[$service['order_details_id']]['unitPrice']       = $ssss[0]['price'];
                $ser[$service['order_details_id']]['totalPrice']      = $ssss[0]['price'] * $service['service_quantity'];

            }
            $services = $ser;
            $id                 = $pending['user_id'];
            $sql                = "SELECT * FROM `users` WHERE `id`=$id LIMIT 1";
            $stmt               = $this->conn->query($sql);
            $user           = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($user)==0) {
                continue;
            }
            $order[$pending['order_id']]['order_id']    = $pending['order_id'];
            $order[$pending['order_id']]['user_id']     = $pending['user_id'];
            $order[$pending['order_id']]['day']         = $pending['day'];
            $order[$pending['order_id']]['time']        = $pending['time'];
            $order[$pending['order_id']]['order_code']  = $pending['order_code'];
            $order[$pending['order_id']]['services']    = $services;
            $order[$pending['order_id']]['user']        = $user[0];
            $order[$pending['order_id']]['user']['password'] = '';
        }
        return $order;
    }
}

?>