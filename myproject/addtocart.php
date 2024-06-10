<?php
session_start();
error_reporting(E_ALL);
require_once "user_guard.php";
require_once "classes/Product.php";
require_once "classes/Cart.php";

$id= isset($_GET["id"])? $_GET["id"] : 0;
if($id){
    $cart = new Cart;
    $cart->addToCart($id);
    header("location:shop.php");
    //the id exists, we want to keep it in a session variable
    //and redirect showcart.php //create showcart.php
}else{
    header("location:shop.php");
    exit();
}
?>