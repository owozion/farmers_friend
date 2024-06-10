<?php
error_reporting(E_ALL);
require_once('Db.php');

class Subscriber extends Db{
    private $dbconn;

    public function __construct()
    {
        $this->dbconn = $this->connect();
    }

    public function insert_subscriber($email){
         #sql
         $query = "INSERT INTO subscribers(subscriber_email) VALUES (?)";
         #prepare
         $stmt = $this->dbconn->prepare($query);
         #execute
         $result = $stmt->execute([$email]);
         #after insertion, get the id on the table, save it in a session and return it.
         $id = $this->dbconn->lastInsertId();
        return $id;
    }

}
?>