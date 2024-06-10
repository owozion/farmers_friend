<?php
session_start();
require_once "user_guard.php";
require_once "classes/Government.php";
require_once "classes/Farmer.php";
require_once "classes/Programme.php";
require_once "classes/State.php";
require_once "classes/Apply.php";

$f=new Farmer;

$id =$_SESSION["useronline"];
$government = new Government;
$govs = $government->get_government_by_id($id);

$programme = new Programme;

$t=$programme->fetch_programme($id);

$states = new State;
$states = $states->fetch_states();

$localgovernment = new State;
$lgas = $localgovernment->fetch_lga();

$category = new State;
$cats = $category->fetch_category();



$progapplication = new Apply;
$application = $progapplication->get_farmer_application($id);
// echo "<pre>";
// print_r($t);
// echo "</pre>";
// die();
?>

<?php
require_once "partials/header_dash.php";
?>
           <!-- banner on different farms and about farmers friend -->
           <div class="row head"> 
             	    <div class="col-md"><h2>Dashboard</h2></div>
              
        	</div>
            <!-- entities expected to register -->
            <div class="row">
                <div class="col-md-2 col-sm-12 shadow m-3 produce">
                   
                   <p> Welcome <?php echo $govs['government_firstname'];?></p>
                   
                    <img src="uploads/<?php echo $govs['government_profilep'];?>" height="80" class="d-block w-55 img-fluid rounded-top-5 rounded-bottom-5 img-thumbnail rounded-circle" alt="Profile picture">
                    <button class="btn  mb-2 col-12" id="editpro">Update Profile</button>
                   <button class="btn  mb-2 col-12" id="addpro">Add Programme</button>
                   <button class="btn  mb-2 col-12" id="application">View Application</button>
                   <button class="btn  mb-2 col-12" id="viewpro">View my programmes</button>   
                </div>

                <div class="col-md-9 col-sm-12 shadow m-3 produce dashboard">
                    <h1 class="dashb">Supporting Farmers</h1>
                    <h1 class="dashb  pb-5">Farming!!! Saving the Universe from Hunger and Global Warming.</h1>
                    <?php
                if (isset($_SESSION["feedback"])){
                    echo "<div class='alert alert-success'>".$_SESSION["feedback"]."</div>";
                    unset($_SESSION["feedback"]);
                }
                if (isset($_SESSION["errormsg"])){
                    echo "<div class='alert alert-danger'>".$_SESSION["errormsg"]."</div>";
                    unset($_SESSION["errormsg"]);
                }
                ?>
                    <!-- Add programmes -->
                    <form class="row g-3 overlay " id="addproduct" action="process/process_programme.php" method="post" enctype="multipart/form-data">
                        <h6 class="profile" style="color: black">Add Programme</h6>
                        <div class="col-md-6">
                            <label for="inputname" class="form-label" style="color: black">Programme Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputname" class="form-label" style="color: black">Programme Goal</label>
                            <input type="text" name="goal" class="form-control" id="goal" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputname" class="form-label" style="color: black">Amount Invested</label>
                            <input type="number" name="amount" class="form-control" id="amount" required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputquantity" class="form-label" style="color: black">Number of Farmers to be empowered</label>
                            <input type="number" name="qty" class="form-control" id="qty" required>
                        </div>
                        <div> 
                            <label for="bio" style="color: black">Programme description</label>
                            <textarea name="description" id="bio" rows="10" cols="30" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                                <label for="productpicture" style="color: black"> Upload Programme Picture </label>
                                <input type="file" name="image" id="image" class=""/>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck" style="color: black" required>
                                Please confirm the above information before you submit
                            </label>
                            </div>
                        </div>
                        <div class="col-12">
                        <!-- <input type="hidden" name="id" value="<?php #echo $_SESSION['useronline'];?>"> -->
                        <input class="btn btn-warning noround mb-3 align-center" id="btnaddproduct" name="btnprogramme" type="submit" value="Add Programme">                            
                        </div>
                    </form>
                                  

                <!-- Government Update-->
                    <form class="row g-3 pb-5" id="editprofile" action="process/process_govprofile.php" method="post" enctype="multipart/form-data">
                        <h6 class="profile">Edit Profile</h6>
                        <div class="col-md-6">
                            <label for="" class="form-label">Firstname</label>
                            <input type="name" name="fname" value="<?php echo $govs['government_firstname'];?>" class="form-control" id="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Surname</label>
                            <input type="name" name="lname" value="<?php echo $govs['government_lastname'];?>" class="form-control" id="inputsurname" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" value="<?php echo $govs['government_email'];?>" class="form-control" id="email"required>
                        </div>                        
                        <div class="col-md-6">
                        <label for="lname" class="form-label">State</label>
                        <select name="state_id" id="state_id" class="form-select">
                        <option value="">Select One</option>
                        <?php
                        foreach($states as $state){
                            $statename = $state['state_name'];
                            $stateid = $state['state_id'];
                            if($stateid == $govs['state_id']){
                            echo "<option value='$stateid' selected>$statename</option>";
                            }else{
                            echo "<option value='$stateid'>$statename</option>";
                            }
                        }
                        ?>
                        </select>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">LGA</label>
                            <select name="lga_id" id="lga" class="form-select">
                            <option value="">Select One</option>
                            <?php
                            // foreach($lgas as $lga){
                            //     $lganame = $lga['lga_name'];
                            //     $lgaid = $lga['lga_id'];
                            //     if($lgaid == $govs['lga_id']){
                            //     echo "<option value='$lgaid' selected>$lganame</option>";
                            //     }else{
                            //     echo "<option value='$lgaid'>$lganame</option>";
                            //     }
                            // }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="productpicture" class="form-label">Upload Profile Picture</label>
                            <input type="file" name="picture" id="picture" class="form-control"/>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck" required>
                                confirm you inputed your correct information
                            </label>
                            </div>
                        </div>
                        <div class="col-12">
                        <input class="btn btn-warning" id="btnupdate" name="btnupdate" type="submit" value="Update Profile!">                            
                        </div>
                        </form>

                <!-- view my programme -->
                <form class="row g-3 pb-5" id="viewproduct" action="" method="post">
                        
                        <main>
                    <div class="container-fluid px-4">
                        <div class="card mb-4">
                            <div class="card-body">
                               &nbsp;&nbsp; 
                               <?php
                               if(isset($_SESSION['admin_errormsg'])){
                                echo "<div class='alert alert-danger'>". $_SESSION['admin_errormsg'] ."</div>";
                                unset($_SESSION['admin_errormsg']);
                               }
                               if(isset($_SESSION['admin_feedback'])){
                                echo "<div class='alert alert-success'>". $_SESSION['admin_feedback']. "</div>";
                                unset($_SESSION['admin_feedback']);
                               }
                               ?>
                               <h1 class="profile" style="color:green; text-align:centre">Agricultural Support Programme</h1>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List of Programme
                            </div>
                            <div class="card-body">
                               <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Goal</th>
      <th scope="col">Amount Invested</th>
      <!-- <th scope="col">Benefactor</th> -->
      <!-- <th scope="col">Image</th> -->
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(is_array($t)){
      $counter = 1;
      foreach($t as $pro){
//         echo "<pre>";
// print_r($t);
// echo "</pre>";
// die();
?>
<tr>
      <th scope="row"><?php echo $counter;?></th>
      <td><?php echo $pro['programme_name'];?></td>
      <td><?php echo $pro['programme_goal'];?></td>
      <td><?php echo $pro['programme_invested_amount'];?></td>
      <td><a href="edit_programme.php?id=<?php echo $pro['programme_id'];?>" class="btn btn-sm btn-primary">Edit</a> 
      <a onclick="return confirm('Are you sure you want to delete')" href="delete_programme.php?id=<?php echo $pro['programme_id'];?>" class="btn btn-sm btn-danger">Delete</a></td>
  </tr>
<?php
$counter ++;
      }
    }
    ?>
    
     
  </tbody>
</table>
                            </div>
                        </div>
                    </div>
                </main>
                        </form>


                <!-- View Application -->
                <form class="row g-3 pb-5" id="viewapplication" action="" method="post" enctype="multipart/form-data">
                        
                        <main>
                    <div class="container-fluid px-4">
                        <div class="card mb-4">
                            <div class="card-body">
                               &nbsp;&nbsp; 
                               <?php
                               if(isset($_SESSION['admin_errormsg'])){
                                echo "<div class='alert alert-danger'>". $_SESSION['admin_errormsg'] ."</div>";
                                unset($_SESSION['admin_errormsg']);
                               }
                               if(isset($_SESSION['admin_feedback'])){
                                echo "<div class='alert alert-success'>". $_SESSION['admin_feedback']. "</div>";
                                unset($_SESSION['admin_feedback']);
                               }
                               ?>
                               <h1 class="profile" style="color:green; text-align:centre">Application from Farmers</h1>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List
                            </div>
                            <div class="card-body">
                               <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Programme Name</th>
      <th scope="col">Farmer Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Category</th>
      <th scope="col">Farm Size</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(is_array($application)){
      $counter = 1;
      foreach($application as $pro){
//         echo "<pre>";
// print_r($t);
// echo "</pre>";
// die();
?>
<tr>
      <th scope="row"><?php echo $counter;?></th>
      <td><?php echo $pro['programme_name'];?></td>
      <td><?php echo $pro['farmer_firstname']; echo $pro['farmer_lastname'];?></td>
      <td><?php echo $pro['farmer_email'];?></td>
      <td><?php echo $pro['farmer_phone'];?></td>
      <td><?php echo $pro['programmedetails_type'];?></td>
      <td><?php echo $pro['farmer_farmsize'];?></td>
      <td><?php echo $pro['pro_status'];?></td>
      <td><div class="dropdown">
  <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Action
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="status.php?id=<?php echo $pro['programmedetails_id']?>&value=Approved">Approved</a></li>
    <li><a class="dropdown-item" href="status.php?id=<?php echo $pro['programmedetails_id']?>&value=Decline">Decline</a></li>
  </ul>
</div></td>
  </tr>
<?php
$counter ++;
      }
    }
    ?>
    
     
  </tbody>
</table>
                            </div>
                        </div>
                    </div>
                </main>
</form>
		</div>
	
        
          
                <!-- footer -->
<?php
    require_once "partials/footer.php";
?>