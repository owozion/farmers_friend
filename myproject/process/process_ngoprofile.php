<?php
error_reporting(E_ALL);
session_start();
require_once "../user_guard.php";
require_once "../classes/Ngo.php";
require_once "../classes/utilities.php"; //function sanitizer is a stand-alone function in this file.


if($_POST['ngoupdate']){
    //retrieve form data
    $fname = sanitizer($_POST['fname']);
    $lname = sanitizer($_POST['lname']);
    $state = $_POST['state_id'];
    $lga = $_POST['lga_id'];
    $profilepic = ($_FILES['picture']);
    $id =$_SESSION["useronline"];

    // echo "<pre>";
    // print_r($fname);
    // echo "<br>";
    // print_r($lname);
    // echo "<br>";
    // print_r($profilepic);
    // echo "<br>";
    // print_r($state);
    // echo "<br>";
    // print_r($lga);
    // echo "<br>";
    // print_r($id);
    // echo "</pre>";
    // die();
   

    if(!$state){
        $_SESSION['errormsg'] ="Please select a state";
        header("location:../ngodashboard.php");
    }

    $gov = new Ngo;
    $check = $gov->update_ngo($fname, $lname, $profilepic, $state, $lga, $_SESSION['useronline']);
    if($check){
        $_SESSION['feedback'] = 'Profile updated successfully!';
        header("location:../ngodashboard.php"); exit();

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