<?php

    error_reporting(E_ALL);
    require_once('Db.php');

    class Myadmin extends Db
    {
        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function update_admin($fname, $lname, $phone, $profilepic, $id){

             // upload the file first
             $original = $profilepic['name'];
             $temp = $profilepic['tmp_name'];
             $r = explode(".",$original);
             $newname = time().rand().".".end($r);
 
             move_uploaded_file($temp,"../uploads/$newname");
 
               //update db
            $sql = "UPDATE admin SET admin_firstname=?, admin_lastname=?, admin_phone=?, admin_image=? WHERE admin_id=?";
            $stmt = $this->dbconn->prepare($sql);
            $chk = $stmt->execute([$fname, $lname, $phone, $newname, $id]);
            if($chk){
                return true;

            }else{
                return false;
            }
        }
        public function login($email,$password){
            try{
                $query = "SELECT * FROM admin WHERE admin_email=?";
                $stmt = $this->dbconn->prepare($query);
                $stmt->execute([$email]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    $hashed = $result['admin_password'];
                    $chk = password_verify($password,$hashed); //true or false
                    if($chk){
                        return $result['admin_id'];
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

        public function get_admin_by_id($id){
            try{
                $query = "SELECT * FROM admin WHERE admin_id =?";
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

    }
?>