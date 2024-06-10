<?php

    error_reporting(E_ALL);
    require_once('Db.php');

    class Government extends Db
    {
        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function update_government($fname, $lname, $profilepic, $state, $lga, $id){

             // upload the file first
             $original = $profilepic['name'];
             $temp = $profilepic['tmp_name'];
             $r = explode(".",$original);
             $newname = time().rand().".".end($r);
 
             move_uploaded_file($temp,"../uploads/$newname");
             file_exists("../uploads/$newname"); //check if file exist
             copy("../uploads/$newname","../admin/uploads/$newname"); //add to admin folder so admin can see images too when he fetches

               //update db
            $sql = "UPDATE government SET government_firstname=?, government_lastname=?, state_id=?, lga_id=?, government_profilep=? WHERE government_id=?";
            $stmt = $this->dbconn->prepare($sql);
            $chk = $stmt->execute([$fname, $lname, $state, $lga, $newname, $id]);
            if($chk){
                return true;

            }else{
                return false;
            }
        }
        public function login($email,$password){
            try{
                $query = "SELECT * FROM government WHERE government_email=?";
                $stmt = $this->dbconn->prepare($query);
                $stmt->execute([$email]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    $hashed = $result['government_password'];
                    $chk = password_verify($password,$hashed); //true or false
                    if($chk){
                        return $result['government_id'];
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

        public function get_government_by_id($id){
            try{
                $query = "SELECT * FROM government WHERE government_id =?";
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
            } //SELECT customer.usercat_id as cuscat_id,farmer.usercat_id as farmcat_id,government.usercat_id as govcat_id,ngo.usercat_id as ngocat_id FROM customer,farmer,government,ngo;
        }
        public function logout(){
            session_unset();
            session_destroy();
        }

        public function insert_government($firstname,$lastname,$email,$pwd,$category){
           try{
            #sql
            $query = "INSERT INTO government(government_firstname, government_lastname, government_email, government_password, usercat_id) VALUES (?,?,?,?,?)";
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