<?php
error_reporting(E_ALL);
session_start();
require_once "../classes/admin_guard.php";
require_once "../classes/Myadmin.php";
require_once "../classes/utilities.php"; //function sanitizer is a stand-alone function in this file.


if($_POST['btnupdate']){
    //retrieve form data
    $fname = sanitizer($_POST['fname']);
    $lname = sanitizer($_POST['lname']);
    $phone = sanitizer($_POST['phone']);
    $profilepic = ($_FILES['picture']);
    $id =$_SESSION["adminonline"];

    // echo "<pre>";
    // print_r($fname);
    // echo "<br>";
    // print_r($lname);
    // echo "<br>";
    // print_r($phone);
    // echo "<br>";
    // print_r($profilepic);
    // echo "<br>";
    // print_r($id);
    // echo "</pre>";
    // die();
   

    if(!$profilepic){
        $_SESSION['errormsg'] ="Please attach a profile picture";
        header("location:../mydashboard.php");
    }

    $admin = new Myadmin;
    $check = $admin->update_admin($fname, $lname, $phone, $profilepic, $id);
    if($check){
        $_SESSION['feedback'] = 'Profile updated!';
        header("location:../mydashboard.php"); exit();

    }else{
        $_SESSION['errormsg'] = 'Something bad happened, pls try again!';
        header("location:../mydashboard.php"); exit();
    }
    }else{
    $_SESSION['errormsg'] = "Please complete the form";
    header("location:../mydashboard.php");
    exit();
}

?>