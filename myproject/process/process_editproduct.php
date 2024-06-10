<?php
error_reporting(E_ALL);
session_start();
require_once "../user_guard.php";
require_once "../classes/Product.php";
require_once "../classes/utilities.php"; //function sanitizer is a stand-alone function in this file.
$prod = new Product;

if(isset($_POST['btneditproduct'])){
    //retrieve fom data
    $pname = sanitizer($_POST['productname']);
    $pcategory = $_POST['cat_id'];
    $pqty = sanitizer($_POST['productqty']);
    $pprice = sanitizer($_POST['productprice']);
    $avlqty = sanitizer($_POST['availableqty']);
    $pdescription = sanitizer($_POST['productdescription']);
    $pimage = ($_FILES['productimage']);
    $famerid =$_SESSION["useronline"];
    $id=$_POST['id'];

    // echo "<pre>";
    // print_r($pname);
    // print_r($pcategory);
    // print_r($pqty);
    // print_r($pprice);
    // print_r($avlqty);
    // print_r($pdescription);
    // print_r($pimage);
    // print_r($id);
    // echo "</pre>";
    //  die();

        $check = $prod->update_product($pname, $pqty, $pprice, $avlqty, $pdescription, $pimage, $pcategory,$famerid,$id);
        // echo "<pre>";
        // print_r($check);
        // echo "</pre>";
        //  die();

    if($check){
        $_SESSION['feedback'] = 'Product updated successfully';
        header("location:../dashboard.php"); exit();
        exit();
       
    }else{
        // $_SESSION['errormsg'] = 'Something bad happened, pls try again!';
        header("location:../dashboard.php"); exit();
    }
}else{
    $_SESSION['errormsg'] = "Please complete the Product form";
    header("location:../dashboard.php");
    exit();
}

?>