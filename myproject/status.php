<?php
session_start();
require_once "classes/Apply.php";
if(isset($_GET["id"]) && isset($_GET["value"])){
    $id =$_GET["id"];
    $value =$_GET["value"];

 $progstatus = new Apply;

 $status=$progstatus->update_programme_status($value, $id);

 if($status){
  $_SESSION['feedback']="Updated successfully";
  header("location:govdashboard.php");
  exit;
 }else{
    $_SESSION['errormsg']="Unable to update";
    header("location:govdashboard.php");
    exit;
 }

}else{
    header("location:govdashboard.php");
    exit;
}
?>