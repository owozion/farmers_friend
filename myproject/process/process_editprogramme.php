<?php
error_reporting(E_ALL);
session_start();
require_once "../user_guard.php";
require_once "../classes/Programme.php";
require_once "../classes/utilities.php"; //function sanitizer is a stand-alone function in this file.
$prod = new Programme;

if(isset($_POST['btneditprog'])){
    //retrieve fom data
    $progname = sanitizer($_POST['progname']);
    $proggoal = sanitizer($_POST['proggoal']);
    $progamt = sanitizer($_POST['progamount']);
    $progtag = sanitizer($_POST['progtag']);
    $progdesc = sanitizer($_POST['progdesc']);
    $progimg = ($_FILES['progimg']);
    $governmentid =$_SESSION["useronline"];
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

        $check = $prod->update_product($progname, $proggoal, $progamt, $progtag, $progdesc, $progimg, $governmentid, $id);
        // echo "<pre>";
        // print_r($check);
        // echo "</pre>";
        //  die();

    if($check){
        $_SESSION['feedback'] = 'Programme updated successfully';
        header("location:../govdashboard.php"); exit();
        exit();
       
    }else{
        $_SESSION['errormsg'] = 'Something bad happened, pls try again!';
        header("location:../govdashboard.php"); exit();
    }
}else{
    $_SESSION['errormsg'] = "Please complete the Programme form";
    header("location:../govdashboard.php");
    exit();
}

?>