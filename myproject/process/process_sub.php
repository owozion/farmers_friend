<?php
    error_reporting(E_ALL);
    session_start();
    require_once('../classes/Subscribers.php');
    require_once('../classes/utilities.php');
    // require_once "../user_guard.php";

    $sub = new Subscriber;
    

    #check if the form was submitted or the user visit this page directly
    if(isset($_POST["subscribe"])){
        #retrieve form data
        $email = sanitizer($_POST['email']);
       
        // echo"<pre>";
        // print_r($email);
        // echo"</pre>";
        // exit();

        if(empty($email)){
            $_SESSION['errormsg2'] = "Please insert your email address";
            header("location:../index.php");
            exit();
           
        }
        
        else{
            $chk = $sub->insert_subscriber($email);
            $_SESSION['feedback2'] = "Subscribed successfully";
            header('location:../index.php');
        //    echo $chk;
        //    exit();
        }
        
    // }else{
    //     $_SESSION['errormsg'] = "Please complete the form";
    //     header("location:../register.php"); 
    //     exit();
    }


?>