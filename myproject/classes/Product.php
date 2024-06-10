<?php
    error_reporting(E_ALL);
    require_once "Db.php";

    class Product extends Db{
        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function update_product($pname, $pqty, $pprice, $avlqty, $pdescription, $pimage, $pcategory, $farmerid, $id){

            // upload the file first
            $original = $pimage['name'];
            $temp = $pimage['tmp_name'];
            $r = explode(".",$original);
            $newname = time().rand().".".end($r);

            move_uploaded_file($temp,"../uploads/$newname");

              //update db
           $sql = "UPDATE product SET product_name=?, product_qty=?, product_price=?, product_totalqty=?, product_desc=?, product_image=?, cat_id=?, farmer_id=? WHERE product_id=?";
           $stmt = $this->dbconn->prepare($sql);
           $chk = $stmt->execute([$pname, $pqty, $pprice, $avlqty, $pdescription, $newname, $pcategory, $farmerid, $id]);
           if($chk){
               return true;

           }else{
               return false;
           }
       }


        public function add_product($pname, $pqty, $pprice, $avlqty, $pdescription, $pimage, $pcategory, $id){
            // lets upload the file first
            $original = $pimage['name'];
            $temp = $pimage['tmp_name'];
            $r = explode(".",$original);
            $newname = time().rand().".".end($r);
            move_uploaded_file($temp,"../uploads/$newname");
            copy("../uploads/$newname","../admin/uploads/$newname"); //add to admin folder so admin can see images too when he fetches
           

            //insert into db
            try{
                $query = "INSERT INTO product (product_name, product_qty, product_price, product_totalqty, product_desc, product_image, cat_id, farmer_id) VALUES(?,?,?,?,?,?,?,?)";
                $stmt = $this->dbconn->prepare($query);
                $result = $stmt->execute([$pname, $pqty, $pprice, $avlqty, $pdescription, $newname, $pcategory, $id]);
                $_SESSION['feedback'] = "$pname successfully added";
                return $result;
            }catch(Exception $e){

                $_SESSION['feedback'] = $e->getMessage(); return 0;
            }
            // echo $newname;
        }

        public function fetch_product($id){
            $sql = "SELECT * FROM product WHERE farmer_id =?";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $result;
        }

        public function fetch_specific_product($id){
            $sql = "SELECT * FROM product WHERE product_id =?";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
        }


        public function get_all_product_by_cat1(){
            $sql = "SELECT * FROM product join category on category.cat_id = product.cat_id WHERE product_status =? AND product.cat_id=? ";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute(["1","1"]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function get_all_product_by_cat2(){
            $sql = "SELECT * FROM product join category on category.cat_id = product.cat_id WHERE product_status =? AND product.cat_id=? ";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute(["1","2"]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function get_all_product_by_cat3(){
            $sql = "SELECT * FROM product join category on category.cat_id = product.cat_id WHERE product_status =? AND product.cat_id=? ";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute(["1","3"]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function delete_product($id){
            $sql = "DELETE FROM product WHERE product_id =?";
            $stmt=$this->dbconn->prepare($sql);
            $res = $stmt->execute([$id]);
            return $res;
        }

        public function search_product($product){
            $sql = "SELECT * FROM product WHERE product_name LIKE?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute(["%$product%"]);
            $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        }

        public function get_farmers_sales($id){
            $sql = "SELECT * FROM orderdetails JOIN orders ON orders.order_id=orderdetails.order_id JOIN product ON product.product_id = orderdetails.pro_id JOIN farmer ON farmer.farmer_id=product.farmer_id WHERE product.farmer_id=?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
                //SELECT * FROM `orderdetails` 
// JOIN orders ON orders.order_id=orderdetails.order_id

// JOIN product ON product.product_id = orderdetails.pro_id
// JOIN farmer ON farmer.farmer_id=product.farmer_id

// WHERE product.farmer_id=6

    }

?>
