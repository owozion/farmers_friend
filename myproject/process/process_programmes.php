<?php
error_reporting(E_ALL);
session_start();
require_once "../user_guard.php";
require_once "../classes/Programme.php";
require_once "../classes/utilities.php"; //function sanitizer is a stand-alone function in this file.
$prod = new Programme;

if($_POST['btnprogrammes']){
    //retrieve form data
    $pname = sanitizer($_POST['name']);
    $pgoal = sanitizer($_POST['goal']);
    $amount = sanitizer($_POST['amount']);
    $qty = sanitizer($_POST['qty']);
    $pdescription = sanitizer($_POST['description']);
    $pimage = ($_FILES['image']);
    $id =$_SESSION["useronline"];

    // echo "<pre>";
    // print_r($pname);
    // print_r($pgoal);
    // print_r($amount);
    // print_r($qty);
    // print_r($pdescription);
    // print_r($pimage);
    // print_r($id);
    // echo "</pre>";
    //  die();

    if(empty($pname) || empty($pgoal) || empty($amount) || empty($qty) || empty($pdescription) || empty($pimage)){
        $_SESSION['errormsg'] ="All fields are required";
        header("location:../ngodashboard.php");
        die();
    }
        $check = $prod->add_programme_two($pname, $pgoal, $amount, $qty, $pdescription, $pimage, $id);
        // echo "<pre>";
        // print_r($check);
        // echo "</pre>";
        //  die();

    if($check){
        $_SESSION['feedback'] = 'Programme added successfully';
        header("location:../ngodashboard.php");
        exit();
       
    }else{
        $_SESSION['errormsg'] = 'Something bad happened, pls try again!';
        header("location:../ngodashboard.php"); exit();
    }
}else{
    $_SESSION['errormsg'] = "Please complete the form";
    header("location:../ngodashboard.php");
    exit();
}

?>