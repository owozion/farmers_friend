<?php
session_start();
require_once("../classes/Product.php");


if($_POST["search"]){

$product = $_POST["search"];

$pro = new Product;


$check = $pro->search_product($product);



        if($check){
            $_SESSION['searched'] = $check;
            header("location:../search.php"); exit();
        
        }else{
            $_SESSION['errormsg3'] = 'Product not found';
            header("location:../index.php"); exit();
        }




}else{
    $_SESSION['errormsg3'] = "Please insert a product";
    header("location:../index.php");
}

?>