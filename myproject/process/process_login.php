<?php
   session_start();
    require_once "../classes/utilities.php";
    require_once "../classes/Farmer.php";
    require_once "../classes/Customer.php";
    require_once "../classes/Ngo.php";
    require_once "../classes/Government.php";

    $farmer = new Farmer;
    $ngo = new Ngo;
    $customer = new Customer;
    $government = new Government;
    if(isset($_POST['btnlogin'])){ //form was submitted
        //retrieve form data
        $email = sanitizer($_POST['email']);
        $pwd = sanitizer($_POST['pwd']);
        $category = $_POST['category'];
       
    //  echo  password_hash("1234", PASSWORD_DEFAULT);
    //  die();
        // echo $email;
        // echo $category;
        // die();
        //call the method that will check if the credentials are valid
        if($category == 1){
            $data = $farmer->login($email,$pwd);
            if($data){//log in as a farmer
                $d=$farmer->login_user($email,$pwd);
            if($d){
                $_SESSION['useronline'] = $data;
                $_SESSION['useronline2']=$d;
            header("location:../dashboard.php");
            exit();
            }

           
            }
        }
        if($category == 2){
            $data = $ngo->login($email,$pwd);
            if($data){//log in as a customer
                $d=$farmer->login_user($email,$pwd);
               if($d){
                $_SESSION['useronline'] = $data;
                $_SESSION['useronline2'] = $d;
                header("location:../ngodashboard.php");
                exit();
               }
            }
        }
        if($category == 3){
            $data = $customer->login($email,$pwd);
            if($data){//log in as an ngo
                $d=$farmer->login_user($email,$pwd);
               if($d){
                $_SESSION['useronline'] = $data;
                $_SESSION['useronline2'] = $d;
                header("location:../cusdashboard.php");
                exit();
               }
            }
        }
        
            if($category == 4){
                $data = $government->login($email,$pwd);
                if($data){//log in as a government
                  
                    $d=$farmer->login_user($email,$pwd);
               if($d){
                $_SESSION['useronline'] = $data;
                $_SESSION['useronline2'] = $d;
                header("location:../govdashboard.php");
               }
               
            }else{
                header("location:../loginpage.php");
            }
        }
        else{
            header("location:../loginpage.php");
        }

    }else{ //direct visit
        $_SESSION['errormsg'] = "Please complete the form";
        header("location:../loginpage.php");
        exit();
    }
?>