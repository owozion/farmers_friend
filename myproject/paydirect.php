<?php
session_start();
require_once "user_guard.php";
require_once "classes/Paystack.php";
require_once "classes/Order.php";
require_once "classes/Customer.php";

$pay = new Paystack;
$order=new Order;

$reference = isset($_SESSION['refno'])? $_SESSION['refno'] : 0;
$confirmation_from_paystack = $pay->paystack_verify($reference);
$ord=$order->get_order_byref($reference);

$id =$order->get_orderid_byref($reference);

if($confirmation_from_paystack && $confirmation_from_paystack->status==1){
    $ord=$order->update_payment_status("paid",$id);
    unset($_SESSION["products"]);
   header("location:cusdashboard.php");
   exit();
}else{
    $ord=$order->update_payment_status("failed",$id);
    header("location:shop.php");
    exit();
}