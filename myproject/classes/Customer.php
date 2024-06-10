<?php

    error_reporting(E_ALL);
    require_once('Db.php');

    class Customer extends Db
    {
        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function update_customer($fname, $lname, $dob, $gender, $phone, $address, $profilepic, $state, $lga, $id){

             // upload the file first
             $original = $profilepic['name'];
             $temp = $profilepic['tmp_name'];
             $r = explode(".",$original);
             $newname = time().rand().".".end($r);
 
             move_uploaded_file($temp,"../uploads/$newname");
             file_exists("../uploads/$newname"); //check if file exist
             copy("../uploads/$newname","../admin/uploads/$newname"); //add to admin folder so admin can see images too when he fetches

               //update db
            $sql = "UPDATE customer SET customer_firstname=?, customer_lastname=?, customer_dob=?, customer_gender=?, customer_phone=?, customer_address=?, customer_profilep=?, state_id=?, lga_id=? WHERE customer_id=?";
            $stmt = $this->dbconn->prepare($sql);
            $chk = $stmt->execute([$fname, $lname, $dob, $gender, $phone, $address, $newname, $state, $lga, $id]);
            if($chk){
                return true;

            }else{
                return false;
            }
        }
        public function login($email,$password){
            try{
                $query = "SELECT * FROM customer WHERE customer_email=?";
                $stmt = $this->dbconn->prepare($query);
                $stmt->execute([$email]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    $hashed = $result['customer_password'];
                    $chk = password_verify($password,$hashed); //true or false
                    if($chk){
                        return $result['customer_id'];
                    }else{
                        $_SESSION['errormsg'] = "The password is wrong"; return 0;
                    }
                }else{
                    $_SESSION['errormsg'] = "invalid email"; return 0;
                }

            }catch(PDOException $e){
                $_SESSION['errormsg'] = $e->getMessage();
                return 0;
            }catch(Exception $e){
                $_SESSION['errormsg'] = $e->getMessage();
                return 0;
            }
        }

        public function get_customer_by_id($id){
            try{
                $query = "SELECT * FROM customer WHERE customer_id =?";
                $stmt = $this->dbconn->prepare($query);
                $stmt->execute([$id]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }catch(PDOException $e){
                $_SESSION['errormsg'] = $e->getMessage();
                return 0;
            }catch(Exception $e){
                $_SESSION['errormsg'] = $e->getMessage();
                return 0;
            }
        }
        public function logout(){
            session_unset();
            session_destroy();
        }

        public function insert_customer($firstname,$lastname,$email,$pwd,$category){
           try{
            #sql
            $query = "INSERT INTO customer(customer_firstname, customer_lastname, customer_email, customer_password, usercat_id) VALUES (?,?,?,?,?)";
            #prepare
            $stmt = $this->dbconn->prepare($query);
            #execute
            $hashed = password_hash($pwd,PASSWORD_DEFAULT);
            $result = $stmt->execute([$firstname,$lastname,$email,$hashed,$category]);
            #after insertion, get the id on the table, save it in a session and return it.
            $id = $this->dbconn->lastInsertId();
            return $id;

           }catch(PDOException $e){
            echo $e->getMessage(); //if not inserting..
            $_SESSION['errormsg']= "An error occured";//$e->getMessage();
            return 0;
           }catch(Exception $e){
            $_SESSION['errormsg']= "An error occured";//$e->getMessage();
            return 0;
           }
          
        }

    }
?>