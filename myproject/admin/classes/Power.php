<?php
    error_reporting(E_ALL);
    require_once "Db.php";

    class Power extends Db{
        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function fetch_customer(){
            $sql = "SELECT * FROM customer";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $records;
        }

        public function fetch_ngo(){
            $sql = "SELECT * FROM ngo";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $records;
        }

        public function fetch_government(){
            $sql = "SELECT * FROM government";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $records;
        }

        public function fetch_farmers(){
            $sql = "SELECT * FROM farmer";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $records;
        }
        
        public function fetch_all_orders(){
            $sql= "SELECT * FROM orders JOIN orderdetails on orderdetails.order_id=orders.order_id JOIN product on product.product_id=orderdetails.pro_id JOIN customer on orders.customer_id = customer.customer_id ORDER BY order_date DESc";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $records;
        }
        public function fetch_all_pending_orders(){
            $sql= "SELECT * FROM orders JOIN customer on orders.customer_id = customer.customer_id WHERE order_status=? ";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute(['Pending']);
            $records = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $records;
        }

        public function fetch_total_payment(){
            $sql="SELECT sum(payment_amount) from payment WHERE payment_status=?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute(['Paid']);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            return $records['sum(payment_amount)'];
        }

        public function delete_farmer($id){
            $sql = "DELETE FROM farmer WHERE farmer_id =?";
            $stmt=$this->dbconn->prepare($sql);
            $res = $stmt->execute([$id]);
            return $res;
        }

        public function delete_ngo($id){
            $sql = "DELETE FROM ngo WHERE ngo_id =?";
            $stmt=$this->dbconn->prepare($sql);
            $res = $stmt->execute([$id]);
            return $res;
        }

        public function delete_government($id){
            $sql = "DELETE FROM government WHERE government_id =?";
            $stmt=$this->dbconn->prepare($sql);
            $res = $stmt->execute([$id]);
            return $res;
        }

        public function delete_customer($id){
            $sql = "DELETE FROM customer WHERE customer_id =?";
            $stmt=$this->dbconn->prepare($sql);
            $res = $stmt->execute([$id]);
            return $res;
        }


        public function get_farmers_sales($id){
            $sql = "SELECT * FROM orderdetails JOIN orders ON orders.order_id=orderdetails.order_id JOIN product ON product.product_id = orderdetails.pro_id JOIN farmer ON farmer.farmer_id=product.farmer_id WHERE product.farmer_id=?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

    }

?>
