<?php
session_start();
require_once "../classes/Order.php";
if(isset($_GET["id"]) && isset($_GET["value"])){
    $id =$_GET["id"];
    $value =$_GET["value"];

 $order = new Order;

 $status=$order->update_order_status($value,$id);

 if($status){
  $_SESSION['feedback']="Updated successfully";
  header("location:mydashboard.php");
  exit;
 }else{
    $_SESSION['errormsg']="Unable to update";
    header("location:mydashboard.php");
    exit;
 }

}else{
    header("location:mydashboard.php");
    exit;
}
?>