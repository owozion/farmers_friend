<?php
// session_start();
// require_once "classes/Farmer.php";

// $t=new Farmer;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/animate.min.css">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/index.css">
    
    <title>Home Page</title>
</head>
<body>
        <div class="container-fluid">
            <!-- above nav just about nav size -->
                <!-- above nav just about nav size -->
                <!-- nav area -->
                <div class="row beforenav sticky-top">
                    <div class="col-md-12">
                        <div class="container-fluid">                        
                              <nav class="navbar navbar-expand-lg background-color-green  ">
                                <div class="container-fluid">
                                    <img src="assets/images/support3.png" alt="support" height="44px" class="mt mx-1 p-1">
                                  <h3 class="navbar-brand text-white d-flex">Farmer's <br>Friend</h3>
                                  <a class="navbar-brand text-white" href="#"></a>
                                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                  </button>
                        
                                  <form class="d-flex col-6 " role="search">
                                    <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search" >
                                    <button class="btn btn-outline-success text-white butn linker" type="submit">Search</button>
                                  </form>
                        
                                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                      <li class="nav-item  ms-3 me-3">
                                        <a class="nav-link active text-white linker" aria-current="page" href="index.php">Home</a>
                                      </li>
                                      <li class="nav-item  ms-3 me-3">
                                        <a class="nav-link text-white linker" href="#meet">Contact us</a>
                                      </li>
                                      <li class="nav-item  ms-3 me-3">
                                        <a class="nav-link text-white linker" href="#meet">About us</a>
                                      </li>
                                      <li class="nav-item dropdown ms-3 me-3 linker">
                                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        
                                        </a>
                                        <ul class="dropdown-menu linker">
                                          <?php
                                         if(isset($_SESSION['useronline2'])){
                                          $id=$_SESSION['useronline2'];
                                          $role=$f->get_roles_by_id($id);                                       
                                            if($role=="farmer"){
                                               print "<li><a class='dropdown-item text-green' href='dashboard.php'>Dashboard</a></li>";
                                            }

                                            if($role=="ngo"){
                                              print "<li><a class='dropdown-item text-green' href='ngodashboard.php'>Dashboard</a></li>";
                                           }

                                           if($role=="customer"){
                                            print "<li><a class='dropdown-item text-green' href='cusdashboard.php'>Dashboard</a></li>";
                                            }

                                            if($role=="government"){
                                              print "<li><a class='dropdown-item text-green' href='govdashboard.php'>Dashboard</a></li>";
                                           }
                                         }
                                          ?>

                                        
                                          <li><a class='dropdown-item text-green' href="shop.php">Shop</a></li>
                                          <li><a class="dropdown-item text-green" href="loginpage.php">Log out</a></li>
                                          <li><a class="dropdown-item text-green" href=""></a></li>
                                        </ul>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link disabled text-white" aria-disabled="true"></a>
                                      </li>
                            
                                    </ul>
                                   
                                          <a href="showcart.php" style="color:orange; font-weight:bold "> (<?php if(isset($_SESSION['products'])){echo count($_SESSION['products']);}?>)<img src="assets/images/cart.png" alt="shoppingcart" height="44px" class="mt mx-1 p-1"></a>

                                  </div>
                                </div>
                              </nav>
                        </div>
                    </div>
                </div>