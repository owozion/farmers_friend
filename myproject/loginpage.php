<?php
session_start();
require_once "classes/State.php";

$usercategory = new State;
$usercat = $usercategory->fetch_usercategory();

// echo "<pre>";
// print_r($usercat);
// echo "<pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="animate.min.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/index.css">
    <title>Login Page</title>
</head>
    <body>
           <!-- log in page -->
        <div class="container cont_login">
            <div class="row parent_login p-5">
                <div class="col-md-7 content_login ps-5 pb-5">
                    <div class=" fs-3">
                        <h1 class="text fw-bolder face_login">Farmer's friend</h1>
                        <p>Farmer's friend bridges the gap between the government/ngo, buyer and farmers.</p>
                    </div>
                </div>
               
                <div class="col-md-5 pt-5">
                    <form action="process/process_login.php" method="post" class="p-5 box g-3" >
                        <div class=" col-12 mb-2">
                            <input type="email" name="email" placeholder="Email address" class="form-control">
                        </div>
                        <div class=" col-12 mb-2">
                            <input type="password" class="form-control" placeholder="Password" name="pwd">
                        </div>
                        <div class="col-12 mb-2">
                        
                        <select name="category" id="category" class="form-select">
                        <option value="">Select Category</option>
                        <?php
                        foreach($usercat as $user){
                            $usercategoryname = $user['usercat_name'];
                            $userid = $user['usercat_id'];
                          
                            echo "<option value='$userid'>$usercategoryname</option>";
                           
                        }
                        ?>
                        <label for="category" >Category</label>
                        </select>
                        </div> 
                        <div class="mb-2">
                            <button class="btn green col-12" name="btnlogin" value="login">Log In</button>
                        </div>
                        <div class="text-center ">
                            <p><a href="" class="forg">Forgotten password?</a></p>
                        </div>
                        <br>
                        <div class="bg-secodary all_login"></div>
                        <br>
                        <div class="mb-2 text-center">
                        <div class="form-floating">
                        <p> Don't have account? <a href="register.php">Signup</a> </p>
                        </div>
                            <?php
                            if(isset($_SESSION['errormsg'])){
                            echo "<div class='alert alert-danger'>" .$_SESSION['errormsg']."</div>";
                            unset($_SESSION['errormsg']); 
                            }
                            ?>
                    </form>
                        <br>
                        <p class="text-center"><span style="font-weight:bold;">Empower A Farmer</span> by giving them incentives or buying their product/produce.</p>
                </div>
            </div>
        </div>
    </body>
</html>