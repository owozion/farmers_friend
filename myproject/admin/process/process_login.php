<?php
   session_start();
   require_once "../classes/utilities.php";
    require_once "../classes/Myadmin.php";


    $admin = new Myadmin;
    if(isset($_POST['btnlogin'])){ //form was submitted
        //retrieve form data
        

        $email = sanitizer($_POST['email']);
        $pwd = sanitizer($_POST['pwd']);
        // echo $email;
        // echo $pwd;
        // die();
        //call the method that will check if the credentials are valid
        $data = $admin->login($email,$pwd);

        // print_r($data);
        // die();

        if($data){//log him in
            $_SESSION['adminonline'] = $data;
            header("location:../mydashboard.php");
            exit();
        }else{
            header("location:../loginpage.php");
        }
    }else{ //direct visit
        $_SESSION['errormsg'] = "Please complete the form";
        header("location:../loginpage.php");
        exit();
    }
?>