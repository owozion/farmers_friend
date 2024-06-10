<?php
error_reporting(E_ALL);
session_start();
// echo password_hash('1234',PASSWORD_DEFAULT);
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
                            <input type="email" name="email" placeholder="Email address or phone number" class="form-control">
                        </div>
                        <div class=" col-12 mb-2">
                            <input type="password" class="form-control" placeholder="password" name="pwd">
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
                        <?php
                                    if(isset($_SESSION['admin_errormsg'])){
                                        echo "<div class='alert alert-danger'>".$_SESSION['admin_errormsg']."</div>";
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