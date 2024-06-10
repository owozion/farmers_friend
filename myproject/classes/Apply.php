<?php
    error_reporting(E_ALL);
    require_once('Db.php');

    class Apply extends Db{
        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function get_programmedetails_by_id($id){
            try{
                $query = "SELECT * FROM programmedetails WHERE programmedetails_id =?";
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


        public function insert_programmedetails($category, $type, $turnover, $proid, $id){
           try{
            #sql
            $query = "INSERT INTO programmedetails(programmedetails_category, programmedetails_type, programmedetails_turnover, programme_id, farmer_id) VALUES (?,?,?,?,?)";
            #prepare
            $stmt = $this->dbconn->prepare($query);
            #execute
            $result = $stmt->execute([$category, $type, $turnover, $proid, $id]);
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

        public function update_programme_status($programmestatus, $id){
            
            $sql = "UPDATE programmedetails SET pro_status=? WHERE programmedetails_id=?";
           $stmt = $this->dbconn->prepare($sql);
           $chk = $stmt->execute([$programmestatus, $id]);
           if($chk){
               return true;

           }else{
               return false;
           }

        }


        public function get_farmer_application($id){
            try{
                $query = "SELECT * FROM `programmedetails` JOIN programme on programme.programme_id = programmedetails.programme_id JOIN government ON government.government_id=programme.government_id JOIN farmer on farmer.farmer_id=programmedetails.farmer_id WHERE programme.government_id =?";
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


        public function get_farmer_application_ngo($id){
            try{
                $query = "SELECT * FROM `programmedetails` JOIN programme on programme.programme_id = programmedetails.programme_id JOIN ngo ON ngo.ngo_id=programme.ngo_id JOIN farmer on farmer.farmer_id=programmedetails.farmer_id WHERE programme.ngo_id =?";
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

        public function update_application_status($value,$id){
            $sql = "UPDATE programmedetails SET pro_status=? WHERE programmedetails_id=?";
            $stmt =$this->dbconn->prepare($sql);
            $result=$stmt->execute([$value,$id]);
            return $result;
        }
    }

