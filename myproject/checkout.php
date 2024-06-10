<?php
session_start();
error_reporting(E_ALL);
require_once "user_guard.php";
require_once "classes/Customer.php";
require_once "classes/Order.php";

$t = new Order;
//we want to retrieve the ids of the items in $_SESSION['topics'] and insert into transaction table

if(isset($_SESSION['products']) && !empty($_SESSION['products'])){
    $ref = time().rand();//generate unique reference no and keep in session
    $_SESSION['refno'] = $ref;
    $delivery="6ygffghgf";
    $trxid = $t->insert_order($ref, $_SESSION['useronline'], $delivery, $_SESSION['products']);
    //insert_order($ref, $userid, $delivery, $cart_items)
    if($trxid){
        header("location:confirm.php");
        exit();
        //we want to empty the cart and send the details to paystack
    }else{
        $_SESSION['errormsg'] = "Please try checking out again";
        header("location:shop.php");
        exit();
    }
}else{
    $_SESSION['errormsg'] = "Please add items to cart";
    header("location:shop.php");
    exit();
}
?>
