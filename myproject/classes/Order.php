<?php
require_once "Db.php";
class Order extends Db{

    private $dbconn;
    public function __construct(){
        $this->dbconn = $this->connect();
    }
    public function get_orderid_byref($ref){
        $query = "SELECT order_id FROM orders WHERE order_ref=?";
        $stmt =$this->dbconn->prepare($query);
        $stmt->execute([$ref]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result["order_id"];
    }
        public function get_order_byref($ref){
            $query = "SELECT * FROM orders JOIN orderdetails ON orderdetailsid=orders.order_id JOIN product ON orderdetails.pro_id = product.product_id WHERE order_ref=?";
            $stmt =$this->dbconn->prepare($query);
            $stmt->execute([$ref]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        public function get_order_amt($ref){
            $query = "SELECT order_amount FROM orders WHERE order_ref=?";
            $stmt =$this->dbconn->prepare($query);
            $stmt->execute([$ref]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $amt = $result['order_amount'];
            return $amt;
        }
        public function get_product_amt($id){
            $query = "SELECT product_price FROM product WHERE product_id=?";
            $stmt =$this->dbconn->prepare($query);
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $amt = $result['product_price'];
            return $amt;
        }
        public function insert_order($ref, $userid, $delivery, $cart_items){
            $query = "INSERT INTO orders(order_ref, customer_id, delivery_address) VALUES(?,?,?)"; // order_refno ~ 
            $stmt = $this->dbconn->prepare($query);
            $stmt->execute([$ref,$userid,$delivery]);
            $id = $this->dbconn->lastInsertId();

            // insert into transaction details table
            $amount = 0;
            foreach($cart_items as $productid => $qty){
                $product_amt = $this->get_product_amt($productid);
                $query2 = "INSERT INTO orderdetails(pro_id, ptotal_amount, order_id, orderdetailsquantity) VALUES(?,?,?,?)";
                $stmt2 = $this->dbconn->prepare($query2);
                $stmt2->execute([$productid,$product_amt,$id,$qty]);
                $amount = $amount + $product_amt * $qty;
            }
            $query3 = "UPDATE orders SET order_amount = ? WHERE order_id=?";
            $stmt3 = $this->dbconn->prepare($query3);
            $stmt3->execute([$amount,$id]);

            $query4 = "INSERT payment(payment_amount, order_id) VALUES(?,?)";
            $stmt4 = $this->dbconn->prepare($query4);
            $stmt4->execute([$amount,$id]);

            return $id;
        }

    public function update_payment_status($status,$id){
        $sql="UPDATE payment SET payment_status=? WHERE order_id=?";
         $stmt=$this->dbconn->prepare($sql);
         $result=$stmt->execute([$status,$id]);
         return $result;
        }

        public function fetch_specific_order($id){
            $sql= "SELECT * FROM orders JOIN orderdetails on orderdetails.order_id=orders.order_id JOIN product on product.product_id=orderdetails.pro_id JOIN customer on orders.customer_id = customer.customer_id WHERE customer.customer_id=?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $records = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $records;
        }
//admin updating order status here
        public function update_order_status($value,$id){
            $sql = "UPDATE orders SET order_status=? WHERE order_id=?";
            $stmt =$this->dbconn->prepare($sql);
            $result=$stmt->execute([$value,$id]);
            return $result;
        }
    
    
}

?>


