<?php
error_reporting(E_ALL);
session_start();
require_once "../user_guard.php";
require_once "../classes/Product.php";
require_once "../classes/utilities.php"; //function sanitizer is a stand-alone function in this file.
$prod = new Product;

if($_POST['btnaddproduct']){
    //retrieve form data
    $pname = sanitizer($_POST['productname']);
    $pcategory = $_POST['cat_id'];
    $pqty = sanitizer($_POST['productqty']);
    $pprice = sanitizer($_POST['productprice']);
    $avlqty = sanitizer($_POST['availableqty']);
    $pdescription = sanitizer($_POST['productdescription']);
    $pimage = ($_FILES['productimage']);
    // $id =$_SESSION["useronline"];
    $id =$_SESSION["useronline"];
    // $id=$_POST['id'];

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
    // //  die();
        if(empty($pname) || empty($pqty) || empty($pprice) || empty($avlqty) || empty($pdescription) || empty($pimage) || empty($pcategory)){
            $_SESSION['errormsg'] ="All fields are required";
            header("location:../dashboard.php");
            die();
        }
        $check = $prod->add_product($pname, $pqty, $pprice, $avlqty, $pdescription, $pimage, $pcategory, $id);

        if($check){
            $_SESSION['feedback'] = "$pname added successfully";
            header("location:../dashboard.php");
            exit();
        
        }else{
            $_SESSION['errormsg'] = 'Something bad happened, pls try again!';
            header("location:../dashboard.php"); exit();
        }
}else{
    $_SESSION['errormsg'] = "Please complete the form";
    header("location:../dashboard.php");
    exit();
}

?>