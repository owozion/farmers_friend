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

            //insert into db
            // try{
                $query = "INSERT INTO product (product_name, product_qty, product_price, product_totalqty, product_desc, product_image, cat_id, farmer_id) VALUES(?,?,?,?,?,?,?,?)";
                $stmt = $this->dbconn->prepare($query);
                $result = $stmt->execute([$pname, $pqty, $pprice, $avlqty, $pdescription, $newname, $pcategory, $id]);
                // $_SESSION['useronline'] = "$pname successfully added";
                return $result;
            // }catch(Exception $e){

            //     $_SESSION['useronline'] = $e->getMessage(); return 0;
            // }
            // echo $newname;
        }

        public function fetch_product($id){
            $sql = "SELECT * FROM product WHERE farmer_id =?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        }

        public function fetch_allproduct(){
            $sql = "SELECT * FROM product JOIN farmer ON farmer.farmer_id=product.farmer_id";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([]);
            $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $result;
        }

        public function update_product_status($productstatus, $id){
            
            $sql = "UPDATE product SET product_status=? WHERE product_id=?";
           $stmt = $this->dbconn->prepare($sql);
           $chk = $stmt->execute([$productstatus, $id]);
           if($chk){
               return true;

           }else{
               return false;
           }
       }
        

       public function fetch_specific_product($id){
            $sql = "SELECT * FROM product WHERE product_id =?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
    }

    public function delete_product($id){
        $sql = "DELETE FROM product WHERE product_id =?";
        $stmt=$this->dbconn->prepare($sql);
        $res = $stmt->execute([$id]);
        return $res;
    }


    
    
    }

?>
