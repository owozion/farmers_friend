<?php
session_start();

require_once "classes/State.php";

$usercategory = new State;
$usercat = $usercategory->fetch_usercategory();

// echo "<pre>";
// print_r($usercat);
// echo "<pre>";
// echo  password_hash("1234", PASSWORD_DEFAULT);
// die();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Farmer's Friend</title>

<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">

</head>
<body>
   

       
<main class="form-signin w-100 m-auto">

<div class="container col-md-6 px-4 py-5" >
 
 
  <!-- content begins -->   
 
<h1 class="h3 mb-3 text-center">Farmer's Friend <br> Create Account</h1>

<?php
if(isset($_SESSION['errormsg'])){
  echo "<div class='alert alert-danger'>" .$_SESSION['errormsg']."</div>";
  unset($_SESSION['errormsg']); 
}
?>



<form action="process/process_signup.php" method="post">   
<div class="form-group row mb-3">
  <div class="col-md-6">
    <div class="form-floating">
      <input type="text" name="fname" class="form-control" id="floatingfname" placeholder="Firstname">
      <label for="floatingfname">Firstname</label>
    </div>
   </div>
   <div class="col-md-6">
    <div class="form-floating">
      <input type="text" name="lname" class="form-control" id="floatinglname" placeholder="Lastname">
      <label for="floatinglname">Lastname</label>
    </div>
   </div>
</div>
    <div class="form-floating mb-3">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" name="pwd" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
  
     <div class="form-floating mb-3">
                        
                        <select name="category" id="category" class="form-select">
                        <option value=""></option>
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
    
     
    <button class="w-100 btn btn-lg btn-primary noround" type="submit" name="registerbutton" value="register">Create Account</button>
    <div class="form-floating">
      <p> Have an account? <a href="loginpage.php">Login</a>   </p>
     
    </div>
    
  </form>




<!-- content ends-->
  </div>

 


<!-- end more content-->
  
<!-- FOOTER -->
<footer class="container-fluid" style="height:100px; line-height:100px;">
  
  <p>&copy; 2024 Farmer'sfriend.com. All rights reserved</p>
</footer>

</main>
      
  </body>
</html>