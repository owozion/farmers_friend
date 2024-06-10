<?php
session_start();
require_once "user_guard.php";
require_once "classes/Paystack.php";
require_once "classes/Order.php";
require_once "classes/Customer.php";

$pay = new Paystack;
$t=new Order;
$u = new Customer;


$reference = isset($_SESSION['refno']) ? $_SESSION['refno'] : 0;

// echo "<pre>";
// print_r($reference);
// echo "</pre>";
// die();
// $amount = $t->
if($reference){
   $deets = $u->get_customer_by_id($_SESSION['useronline']);
   $email = $deets['customer_email'];
   $amount = $t->get_order_amt($reference);
   $payresponse = $pay->paystack_initialize($email,$amount*100,$reference);
   if(!empty($payresponse) && $payresponse->status ==1){
    $url = $payresponse->data->authorization_url ;
    header("location:$url");
    exit();
   }else{
    $_SESSION['errormsg'] = "You need to be a customer to buy anything";
    header("location:showcart.php");
    exit();
   }

}else{
    $_SESSION['errormsg'] = "You need to add items to cart";
    header("location:shop.php");
    exit();
}


?>