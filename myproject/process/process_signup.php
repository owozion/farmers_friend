<?php

    error_reporting(E_ALL);
    session_start();
    require_once('../classes/Farmer.php');
    require_once('../classes/Customer.php');
    require_once('../classes/Ngo.php');
    require_once('../classes/Government.php');
    require_once('../classes/utilities.php');
    $farmer = new Farmer;
    $ngo = new Ngo;
    $customer = new Customer;
    $government = new Government;
    #check if the form was submitted or the user visit this page directly
    if(isset($_POST["registerbutton"])){
        #retrieve form data
       
        $firstname = sanitizer($_POST['fname']);
        $lastname = sanitizer($_POST['lname']);
        $email = sanitizer($_POST['email']);
        $pwd = sanitizer($_POST['pwd']);
        $category = $_POST['category'];
       
        
        // echo $firstname;
        // echo $lastname;
        // echo $email;
        // echo $pwd;
        // echo $category;
        // exit();
        if(empty($firstname) || empty($lastname) || empty($email) || empty($pwd) || empty($category)){
            $_SESSION['errormsg'] = "All fields are required";
            header("location:../register.php");
            exit();
           
        }
        
        else{
           //  $chk = $farmer->insert_farmer($firstname,$lastname,$email,$pwd,$category);
        //    echo $chk;
        //    exit();
            # try it out, fill the form and submit, then check your db to confirm the data has been inserted
            


            if($category == 1){
                $chk = $farmer->insert_farmer($firstname,$lastname,$email,$pwd,$category);


                if($category==1){
                $role="farmer";
                    $c=$farmer->insert_user($firstname,$lastname,$email,$pwd,$role);
                    $_SESSION['useronline2']=$c;
                }

               
                // echo $chk;
                // die();
                if($chk){ $_SESSION['useronline'] = $chk;
                    header('location:../dashboard.php');
                    exit();
                   }else{
                    header("location:../register.php");
                    exit();
                   }
                die();
            }

            if($category == 2){
                $chk = $ngo->insert_ngo($firstname,$lastname,$email,$pwd,$category);

                
                if($category==2){
                    $role="ngo";
                        $c=$farmer->insert_user($firstname,$lastname,$email,$pwd,$role);
                        $_SESSION['useronline2']=$c;
                    }
    

                if($chk){ $_SESSION['useronline'] = $chk;
                    header('location:../ngodashboard.php');
                    exit();
                   }else{
                    header("location:../register.php");
                    exit();
                   }
                die();
            }

            if($category == 3){
                $chk = $customer->insert_customer($firstname,$lastname,$email,$pwd,$category);

                
                if($category==3){
                    $role="customer";
                        $c=$farmer->insert_user($firstname,$lastname,$email,$pwd,$role);
                        $_SESSION['useronline2']=$c;
                    }
    

                if($chk){ $_SESSION['useronline'] = $chk;
                    header('location:../cusdashboard.php');
                    exit();
                   }else{
                    header("location:../register.php");
                    exit();
                   }
                die();
            }

            if($category == 4){
                $chk = $government->insert_government($firstname,$lastname,$email,$pwd,$category);

                
                if($category==4){
                    $role="government";
                        $c=$farmer->insert_user($firstname,$lastname,$email,$pwd,$role);
                        $_SESSION['useronline2']=$c;
                    }
    


                if($chk){ $_SESSION['useronline'] = $chk;
                    header('location:../govdashboard.php');
                    exit();
                   }else{
                    header("location:../register.php");
                    exit();
                   }
                die();
            }
        //    if($chk){ $_SESSION['useronline'] = $chk;
        //     header('location:../dashboard.php');
        //     exit();
        //    }else{
        //     header("location:../register.php");
        //     exit();
        //    }
        }

    }else{
        $_SESSION['errormsg'] = "Please complete the form";
        header("location:../register.php"); 
        exit();
    }


?>