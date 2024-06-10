<?php
error_reporting(E_ALL);
session_start();
require_once "../user_guard.php";
require_once "../classes/Farmer.php";
require_once "../classes/utilities.php"; //function sanitizer is a stand-alone function in this file.


if($_POST['btnupdate']){
    //retrieve form data
    $fname = sanitizer($_POST['fname']);
    $lname = sanitizer($_POST['lname']);
    $dob = sanitizer($_POST['dob']);
    $gender = ($_POST['gender']);
    $phone = sanitizer($_POST['phone']);
    $state = $_POST['state_id'];
    $lga = sanitizer($_POST['lga_id']);
    $bank = sanitizer($_POST['bank']);
    $account = sanitizer($_POST['account']);
    $bvn = sanitizer($_POST['bvn']);
    $address = sanitizer($_POST['address']);
    $farmsize = sanitizer($_POST['farmsize']);
    $profilepic = ($_FILES['picture']);
    $cac = ($_FILES['cac']);
    $minute = ($_FILES['minute']);
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
    // print_r($bank);
    // echo "<br>";
    // print_r($account);
    // echo "<br>";
    // print_r($bvn);
    // echo "<br>";
    // print_r($address);
    // echo "<br>";
    // print_r($farmsize);
    // echo "<br>";
    // print_r($profilepic);
    // print_r($cac);
    // print_r($minute);
    // echo "<br>";
    // print_r($id);
    // echo "</pre>";
   

    if(!$state){
        $_SESSION['errormsg'] ="Please select a state";
        header("location:../dashboard.php");
    }

    $farm = new Farmer;
    $check = $farm->update_farmer($fname, $lname, $dob, $gender, $phone, $state, $lga, $bank, $account, $bvn, $address, $farmsize, $profilepic, $cac, $minute, $_SESSION['useronline']);
    if($check){
        $_SESSION['feedback'] = 'Profile updated successfully!';
        header("location:../dashboard.php"); exit();

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