<?php
error_reporting(E_ALL);
session_start();
require_once "../user_guard.php";
require_once "../classes/Apply.php";
require_once "../classes/utilities.php"; //function sanitizer is a stand-alone function in this file.
$programme = new Apply;

if(isset($_POST['btnsubmit'])){
    //retrieve form data
    $category = sanitizer($_POST['category']);
    $type = sanitizer($_POST['type']);
    $turnover = sanitizer($_POST['turnover']);
    $proid = $_POST['cat'];
    $id =$_SESSION["useronline"];

    // echo "<pre>";
    // print_r($category);
    // print_r($type);
    // print_r($turnover);
    // print_r($proid);
    // "<br>";
    // print_r($id);
    // echo "</pre>";
    //  die();

    if(empty($category) || empty($type) || empty($turnover) || empty($proid)){
        $_SESSION['errormsg'] ="All fields are required";
        header("location:../index.php");
        die();
    }
    
        // if($id == "farmer"){
            $check = $programme->insert_programmedetails($category, $type, $turnover, $proid, $id);
        // }else{
        //     $_SESSION['errormsg'] ="All fields are required";
        // }
        
        // echo "<pre>";
        // print_r($check);
        // echo "</pre>";
        //  die();

        if($check){
            $_SESSION['programme'] = $check;
            $_SESSION['feedback'] = 'You have successfully applied';
            header("location:../index.php"); exit();
        
        }else{
            $_SESSION['errormsg'] = 'Something bad happened, pls try again!';
            header("location:../index.php"); exit();
        }
}else{
    $_SESSION['errormsg'] = "Please complete the form";
    header("location:../register.php");
    exit();
}


// require_once("classes/App.php");
    // if(isset($_POST["message"])){
    //     //fetching from values as passed by serialize method from front end.
    //     $fullname = $_POST["username"];
    //     $email = $_POST["email"];
    //     $phone = $_POST["phone"];
    //     $message = $_POST["message"];
    //     // echo json_encode($_POST);
    //     // die();
    //     //validate
    //     if(empty($fullname) || empty($email) || empty($phohe) || empty($message)){
    //         $resp =[
    //             "success" => false,
    //             "message" => "All fields are required"
    //         ];
    //         $response = json_encode($resp);
    //         echo $response;
    //         die();
    //     }
    //     //other validation

    //     //give the values to a method that will save it in database
    //     $msg1 = new App;
    //     $result = $msg1->insert_message($fullname, $email, $phone, $message);
    //     if($result){
    //         $resp =[
    //             "success" => true,
    //             "message" => "Message received successfully"
    //         ];
    //         $response = json_encode($resp);
    //         echo $response;
    //     }
    // }else{
    //     echo "Sorry you are not passing anything to me";
    // }

?>