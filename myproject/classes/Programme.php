<?php
    error_reporting(E_ALL);
    require_once "Db.php";

    class Programme extends Db{
        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function update_product($progname, $proggoal, $progamt, $progtag, $progdesc, $progimg, $governmentid, $id){

            // upload the file first
            $original = $progimg['name'];
            $temp = $progimg['tmp_name'];
            $r = explode(".",$original);
            $newname = time().rand().".".end($r);

            move_uploaded_file($temp,"../uploads/$newname");
            file_exists("../uploads/$newname"); //check if file exist
            copy("../uploads/$newname","../admin/uploads/$newname"); //add to admin folder so admin can see images too when he fetches

              //update db
           $sql = "UPDATE programme SET programme_name=?, programme_goal=?, programme_invested_amount=?, programme_no_target=?, programme_desc=?, programme_image=?, government_id=? WHERE programme_id=?";
           $stmt = $this->dbconn->prepare($sql);
           $chk = $stmt->execute([$progname, $proggoal, $progamt, $progtag, $progdesc, $newname, $governmentid, $id]);
           if($chk){
               return true;

           }else{
               return false;
           }
       }

       public function add_programme_two($pname, $pgoal, $amount, $qty, $pdescription, $pimage, $id){
        // lets upload the file first
        $original = $pimage['name'];
        $temp = $pimage['tmp_name'];
        $r = explode(".",$original);
        $newname = time().rand().".".end($r);
        move_uploaded_file($temp,"../uploads/$newname");
        file_exists("../uploads/$newname"); //check if file exist
        copy("../uploads/$newname","../admin/uploads/$newname"); //add to admin folder so admin can see images too when he fetches

        //insert into db
        try{
            $query = "INSERT INTO programme (programme_name, programme_goal, programme_invested_amount, programme_no_target, programme_desc, programme_image, ngo_id) VALUES(?,?,?,?,?,?,?)";
            $stmt = $this->dbconn->prepare($query);
            $result = $stmt->execute([$pname, $pgoal, $amount, $qty, $pdescription, $newname, $id]);
            $_SESSION['feedback'] = "$pname successfully added";
            return $result;
        }catch(Exception $e){

            $_SESSION['feedback'] = $e->getMessage(); return 0;
        }
        // echo $newname;
    }


        public function add_programme($pname, $pgoal, $amount, $qty, $pdescription, $pimage, $id){
            // lets upload the file first
            $original = $pimage['name'];
            $temp = $pimage['tmp_name'];
            $r = explode(".",$original);
            $newname = time().rand().".".end($r);
            move_uploaded_file($temp,"../uploads/$newname");
            file_exists("../uploads/$newname"); //check if file exist
            copy("../uploads/$newname","../admin/uploads/$newname"); //add to admin folder so admin can see images too when he fetches

            //insert into db
            try{
                $query = "INSERT INTO programme (programme_name, programme_goal, programme_invested_amount, programme_no_target, programme_desc, programme_image, government_id) VALUES(?,?,?,?,?,?,?)";
                $stmt = $this->dbconn->prepare($query);
                $result = $stmt->execute([$pname, $pgoal, $amount, $qty, $pdescription, $newname, $id]);
                $_SESSION['feedback'] = "$pname successfully added";
                return $result;
            }catch(Exception $e){

                $_SESSION['feedback'] = $e->getMessage(); return 0;
            }
            // echo $newname;
        }

        public function fetch_programme($id){
        $sql = "SELECT * FROM programme WHERE government_id =?";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $result;
        }

        public function fetch_programme_two($id){
        $sql = "SELECT * FROM programme WHERE ngo_id =?";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $result;
        }

        public function fetch_specific_programme($id){
        $sql = "SELECT * FROM programme WHERE programme_id =?";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
        }

        public function fetch_prog(){
            $sql = "SELECT * FROM programme";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $records =$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;
        }


        public function delete_programme($id){
            $sql = "DELETE FROM programme WHERE programme_id =?";
            $stmt=$this->dbconn->prepare($sql);
            $res = $stmt->execute([$id]);
            return $res;
        }

        public function delete_programme_two($id){
            $sql = "DELETE FROM programme WHERE programme_id =?";
            $stmt=$this->dbconn->prepare($sql);
            $res = $stmt->execute([$id]);
            return $res;
        }

    }

?>
