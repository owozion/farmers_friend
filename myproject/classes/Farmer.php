<?php

    error_reporting(E_ALL);
    require_once('Db.php');

    class Farmer extends Db
    {
        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function update_farmer($fname, $lname, $dob, $gender, $phone, $state, $lga, $bank, $account, $bvn, $address, $farmsize, $profilepic, $cac, $minute, $id){

             // upload the file first
             $original = $profilepic['name'];
             $temp = $profilepic['tmp_name'];
             $r = explode(".",$original);
             $newname = time().rand().".".end($r);
 
             move_uploaded_file($temp,"../uploads/$newname");
             file_exists("../uploads/$newname"); //check if file exist
             copy("../uploads/$newname","../admin/uploads/$newname"); //add to admin folder so admin can see images too when he fetches

              // upload the second file
              $original = $cac['name'];
              $temp = $cac['tmp_name'];
              $r = explode(".",$original);
              $newname1 = time().rand().".".end($r);
  
              move_uploaded_file($temp,"../uploads/$newname1");
              file_exists("../uploads/$newname"); //check if file exist
              copy("../uploads/$newname","../admin/uploads/$newname"); //add to admin folder so admin can see images too when he fetches

               // upload the third file
               $original = $minute['name'];
               $temp = $minute['tmp_name'];
               $r = explode(".",$original);
               $newname2 = time().rand().".".end($r);
   
               move_uploaded_file($temp,"../uploads/$newname2");
               file_exists("../uploads/$newname"); //check if file exist
               copy("../uploads/$newname","../admin/uploads/$newname"); //add to admin folder so admin can see images too when he fetches
 
               //update db
            $sql = "UPDATE farmer SET farmer_firstname=?, farmer_lastname=?, farmer_dob=?, farmer_gender=?, farmer_phone=?, state_id=?, lga_id=?, farmer_bankname=?, farmer_accountno=?, farmer_bvn=?, farmer_address=?, farmer_farmsize=?, farmer_profilep=?, farmer_cac=?, farmer_min=? WHERE farmer_id=?";
            $stmt = $this->dbconn->prepare($sql);
            $chk = $stmt->execute([$fname, $lname, $dob, $gender, $phone, $state, $lga, $bank, $account, $bvn, $address, $farmsize, $newname, $newname1, $newname2, $id]);
            if($chk){
                return true;

            }else{
                return false;
            }
        }
        public function login($email,$password){
            try{
                $query = "SELECT * FROM farmer WHERE farmer_email=?";
                $stmt = $this->dbconn->prepare($query);
                $stmt->execute([$email]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    $hashed = $result['farmer_password'];
                    $chk = password_verify($password,$hashed); //true or false
                    if($chk){
                        return $result['farmer_id'];
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

        public function get_farmer_by_id($id){
            try{
                $query = "SELECT * FROM farmer WHERE farmer_id =?";
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

        public function insert_farmer($firstname,$lastname,$email,$pwd,$category){
           try{
            #sql
            $query = "INSERT INTO farmer(farmer_firstname, farmer_lastname, farmer_email, farmer_password, usercat_id) VALUES (?,?,?,?,?)";
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

        public function insert_user($firstname,$lastname,$email,$pwd,$category){
            try{
             #sql
             $query = "INSERT INTO users(fname, lname, email, `password`, `roles`) VALUES (?,?,?,?,?)";
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


         public function get_roles_by_id($id){
            try{
                $query = "SELECT roles FROM users WHERE users_id =?";
                $stmt = $this->dbconn->prepare($query);
                $stmt->execute([$id]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result["roles"];
            }catch(PDOException $e){
                $_SESSION['errormsg'] = $e->getMessage();
                return 0;
            }catch(Exception $e){
                $_SESSION['errormsg'] = $e->getMessage();
                return 0;
            }
        }


        public function get_farmer_application($id){
            try{
                $query = "SELECT * FROM `programmedetails` JOIN programme on programme.programme_id = programmedetails.programme_id JOIN farmer on farmer.farmer_id=programmedetails.farmer_id WHERE programmedetails.farmer_id=? ;";
                $stmt = $this->dbconn->prepare($query);
                $stmt->execute([$id]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }catch(PDOException $e){
                $_SESSION['errormsg'] = $e->getMessage();
                return 0;
            }catch(Exception $e){
                $_SESSION['errormsg'] = $e->getMessage();
                return 0;
            }
        }


        public function login_user($email,$password){
            $query = "SELECT * FROM users WHERE email=?";
                $stmt = $this->dbconn->prepare($query);
                $stmt->execute([$email]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    $hashed = $result['password'];
                    $chk = password_verify($password,$hashed); //true or false
                    if($chk){
                        return $result['users_id'];
                    }else{
                        $_SESSION['errormsg'] = "The password is wrong"; return 0;
                    }
                }else{
                    $_SESSION['errormsg'] = "invalid email"; return 0;
                }
        }

    }
?>