<?php
    error_reporting(E_ALL);
    require_once "Db.php";

    class State extends Db{
        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function fetch_states(){
            $sql = "SELECT * FROM state";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;
        }

        public function fetch_category(){
            $sql = "SELECT * FROM category";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $records =$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;
        }
        public function fetch_lga(){
            $sql = "SELECT * FROM lga";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function fetch_usercategory(){
            $sql = "SELECT * FROM usercategory";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;
        }

        public function fetch_lga_by_stateid($id){
            $sql ="SELECT * FROM lga WHERE state_id =?";

            $stmt = $this->dbconn->prepare($sql);

            $stmt->execute([$id]);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

    }

    // $lga = new State;

    // $data = $lga->fetch_lga_by_stateid(10);

    // print_r($data)
;
?>
