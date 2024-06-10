<?php
error_reporting(E_ALL);
session_start();
require_once "../user_guard.php";
require_once "../classes/Customer.php";
require_once "../classes/utilities.php"; //function sanitizer is a stand-alone function in this file.


if($_POST['btnupdate']){
    //retrieve form data
    $fname = sanitizer($_POST['fname']);
    $lname = sanitizer($_POST['lname']);
    $dob = sanitizer($_POST['dob']);
    $gender = ($_POST['gender']);
    $phone = sanitizer($_POST['phone']);
    $state = $_POST['state_id'];
    $lga = $_POST['lga_id'];
    $address = sanitizer($_POST['address']);
    $profilepic = ($_FILES['picture']);
    $id =$_SESSION["useronline"];

    // echo "<pre>";
    // print_r($fname);
    // echo "<br>";
    // print_r($lname);
    // echo "<br>";
    // print_r($dob);
    // echo "<br>";
    // print_r($gender);
    // echo "<br>";
    // print_r($phone);
    // echo "<br>";
    // print_r($state);
    // echo "<br>";
    // print_r($lga);
    // echo "<br>";
    // print_r($address);
    // echo "<br>";
    // print_r($profilepic);
    // echo "<br>";
    // print_r($id);
    // echo "</pre>";
    // die();
   

    if(!$state){
        $_SESSION['errormsg'] ="Please select a state";
        header("location:../cusdashboard.php");
    }

    $cust = new Customer;
    $check = $cust->update_customer($fname, $lname, $dob, $gender, $phone, $address, $profilepic, $state, $lga, $_SESSION['useronline']);
    if($check){
        $_SESSION['feedback'] = 'Profile updated successfully!';
        header("location:../cusdashboard.php"); exit();

    }else{
        $_SESSION['errormsg'] = 'Something bad happened, pls try again!';
        header("location:../cusdashboard.php"); exit();
    }
}else{
    $_SESSION['errormsg'] = "Please complete the form";
    header("location:../cusdashboard.php");
    exit();
}

?>