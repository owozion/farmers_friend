<?php
session_start();
require_once "user_guard.php";
require_once "classes/Farmer.php";
require_once "classes/State.php";
require_once "classes/Product.php";

$id =$_SESSION["useronline"];

$applicationstatus =new Farmer;
$application = $applicationstatus->get_farmer_application($id);

// print_r($application);
// die;


$farmers = new Farmer;
$farmers = $farmers->get_farmer_by_id($id);

$f=new Farmer;

$products = new Product;

$t=$products->fetch_product($id);

$states = new State;
$states = $states->fetch_states();

$localgovernment = new State;
$lgas = $localgovernment->fetch_lga();

$category = new State;
$cats = $category->fetch_category();

$sold = new Product;
$sold =$sold->get_farmers_sales($id);

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
                <div class="col-md-2 shadow m-3 produce">
                   
                   <p> Welcome <?php echo $farmers['farmer_firstname'];?></p>
                   
                    <img src="uploads/<?php echo $farmers['farmer_profilep'];?>" height="80" class="d-block w-55 img-fluid rounded-top-5 rounded-bottom-5 img-thumbnail rounded-circle" alt="Profile picture">
                    <button class="btn  mb-2 col-12" id="editpro">Update Profile</button>
                   <button class="btn  mb-2 col-12" id="addpro">Add Product</button>
                   <button class="btn  mb-2 col-12" id="viewpro">View my Products</button>
                   <button class="btn  mb-2 col-12" id="soldpro">Sold Products</button>
                   <button class="btn  mb-2 col-12" id="application">Application Status</button>    
                </div>

                <div class="col-md-8 shadow m-3 produce dashboard">
                    <h1 class="dashb">I'M A FARMER</h1>
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
                    <!-- Add product -->
                    <form class="row g-3 overlay " id="addproduct" action="process/process_product.php" method="post" enctype="multipart/form-data">
                        <h6 class="profile" style="color: black">Add Product</h6>
                        <div class="col-md-6">
                            <label for="inputname" class="form-label" style="color:black ">Product Name</label>
                            <input type="text" name="productname" class="form-control" id="inputname" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label" style="color:black ">Category</label>
                            <select name="cat_id" id="category" class="form-select">
                        <option value="">Select One</option>
                        <?php
                        foreach($cats as $cat){
                            $categoryname = $cat['cat_name'];
                            $categoryid = $cat['cat_id'];
                            if($categoryid == $cats['cat_id']){
                            echo "<option value='$categoryid' selected>$categoryname</option>";
                            }else{
                            echo "<option value='$categoryid'>$categoryname</option>";
                            }
                        }
                        ?>
                        </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputquantity" class="form-label" style="color:black ">Quantity</label>
                            <input type="number" name="productqty" class="form-control" id="productqty" required>
                        </div>
                        <div class="col-md-4">
                            <label for="price" class="form-label" style="color:black ">Price</label>
                            <input type="number" name="productprice" class="form-control" id="productprice"required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputquantity " style="color:black " class="form-label">Available Quantity</label>
                            <input type="number" name="availableqty" class="form-control" id="productqty" required>
                        </div>
                        <div> 
                            <label for="bio" style="color:black ">Product description</label>
                            <textarea name="productdescription" id="bio" rows="10" cols="30" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                                <label for="productpicture" style="color:black "> Upload Product Picture </label>
                                <input type="file" name="productimage" id="productimage" class=""/>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck" required>
                                Please confirm the above information before you submit
                            </label>
                            </div>
                        </div>
                        <div class="col-12">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['useronline'];?>">
                        <input class="btn btn-warning noround mb-3 align-center" id="btnaddproduct" name="btnaddproduct" type="submit" value="Add Product">                            
                        </div>
                    </form>
                                  

                <!-- Farmer Update-->
                    <form class="row g-3 pb-5" id="editprofile" action="process/process_profile.php" method="post" enctype="multipart/form-data">
                        <h6 class="profile">Edit Profile</h6>
                        <div class="col-md-6">
                            <label for="" class="form-label">Firstname</label>
                            <input type="name" name="fname" value="<?php echo $farmers['farmer_firstname'];?>" class="form-control" id="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Surname</label>
                            <input type="name" name="lname" value="<?php echo $farmers['farmer_lastname'];?>" class="form-control" id="inputsurname" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" value="<?php echo $farmers['farmer_email'];?>" class="form-control" id="email"required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Date of Birth</label>
                            <input type="date" name="dob" value="<?php echo $farmers['farmer_dob'];?>" class="form-control" id = "dob" placeholder="yyyy/mm/dd" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Gender</label>
                            <select name="gender" id="" class="form-select">
                            <option selected>Choose...</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="number" name="phone" value="<?php echo $farmers['farmer_phone'];?>" class="form-control" id = "phone" placeholder="" required>
                        </div>
                        
                        <div class="col-md-6">
                        <label for="lname" class="form-label">State</label>
                        <select name="state_id" id="state_id" class="form-select">
                        <option value="">Select One</option>
                        <?php
                        foreach($states as $state){
                            $statename = $state['state_name'];
                            $stateid = $state['state_id'];
                            if($stateid == $farmers['state_id']){
                            echo "<option value='$stateid' >$statename</option>";
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
                            <!-- <?php
                            // echo "<pre>";
                            // print_r($customers);
                            // echo "<pre>";
                            // die();
                            // foreach($lgas as $lga){
                            //     $lganame = $lga['lga_name'];
                            //     $lgaid = $lga['lga_id'];
                            //     if($lgaid == $customers['lga_id']){
                            //     echo "<option value='$lgaid' selected>$lganame</option>";
                            //     }else{
                            //     echo "<option value='$lgaid'>$lganame</option>";
                            //     }
                            // }
                            ?> -->
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Bank Name</label>
                            <input type="text" name="bank" value="<?php echo $farmers['farmer_bankname'];?>" class="form-control" id="bname" placeholder="e.g UBA" required>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Bank Account Number</label>
                            <input type="number" name="account" value="<?php echo $farmers['farmer_accountno'];?>" class="form-control" id="" placeholder="e.g 2063789820" required>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Bank Verification Number (BVN)</label>
                            <input type="number" name="bvn" value="<?php echo $farmers['farmer_bvn'];?>" class="form-control" id="" placeholder="e.g 2234" required>
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">Address</label>
                            <input type="text" name="address" value="<?php echo $farmers['farmer_address'];?>"class="form-control" id="" placeholder="1234 Main St" required>
                            
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">farm size</label>
                            <input type="text" name="farmsize" value="<?php echo $farmers['farmer_farmsize'];?>" class="form-control" id="" placeholder="e.g 1acre" required>
                        </div>
                        <div class="col-md-4">
                            <label for="productpicture" class="form-label">Upload Profile Picture</label>
                            <input type="file" name="picture" id="picture" class="form-control"/>
                        </div>
                        <div class="col-md-4">
                            <label for="productpicture" class="form-label">Provide CAC document of the farmer association you belong to</label>
                            <input type="file" name="cac" id="cac" class="form-control"/>
                        </div>
                        <div class="col-md-4">
                            <label for="productpicture" class="form-label">Provide the last minute of the Board meeting including a list of the members of the farmers association</label>
                            <input type="file" name="minute" id="minute" class="form-control"/>
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

                <!-- view my products -->
                <form class="row g-3 pb-5" id="viewproduct" action="process/process_product.php" method="post" enctype="multipart/form-data">
                        
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
                               <h1 class="profile" style="color:green; text-align:centre">Farm Products</h1>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List of Products
                            </div>
                            <div class="card-body">
                               <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Total Quantity</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(is_array($t)){
      $counter = 1;
      foreach($t as $pro){
?>
<tr>
      <th scope="row"><?php echo $counter;?></th>
      <td><?php echo $pro['product_name'];?></td>
      <td><?php echo $pro['product_qty'];?></td>
      <td><?php echo $pro['product_price'];?></td>
      <td><?php echo $pro['product_totalqty'];?></td>
      <td><img src="uploads/<?php echo $pro['product_image'];?>" height="40"></td>
      <td><a href="edit_product.php?id=<?php echo $pro['product_id'];?>" class="btn btn-sm btn-primary">Edit</a> 
      <a onclick="return confirm('Are you sure you want to delete')" href="delete_product.php?id=<?php echo $pro['product_id'];?>" class="btn btn-sm btn-danger">Delete</a> <a href="" class="btn btn-sm btn-success"></a></td>
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

                <!-- Application Status-->
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
                               <h1 class="profile" style="color:green; text-align:centre">Application for Programme</h1>
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
      <th scope="col">Programme Goal</th>
      <th scope="col">Programme Description</th>
      <th scope="col">Status</th>
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
      <td><?php echo $pro['programme_goal'];?></td>
      <td><?php echo $pro['programme_desc'];?></td>
      <td><?php echo $pro['pro_status'];?></td>
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



<!-- Farmer Sales-->
<form class="row g-3 pb-5" id="soldproduct" action="" method="post" enctype="multipart/form-data">
                        
                        <main>
                    <div class="container-fluid px-4">
                        <div class="card mb-4">
                            <div class="card-body">
                               &nbsp;&nbsp; 
                               <?php
                               if(isset($_SESSION['errormsg'])){
                                echo "<div class='alert alert-danger'>". $_SESSION['errormsg'] ."</div>";
                                unset($_SESSION['errormsg']);
                               }
                               if(isset($_SESSION['feedback'])){
                                echo "<div class='alert alert-success'>". $_SESSION['feedback']. "</div>";
                                unset($_SESSION['feedback']);
                               }
                               ?>
                               <h1 class="profile" style="color:green; text-align:centre">Sold Products</h1>
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
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total Amount</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(is_array($sold)){
      $counter = 1;
      foreach($sold as $soldpro){
// echo "<pre>";
// print_r($soldpro);
// echo "</pre>";

?>
<tr>
      <th scope="row"><?php echo $counter;?></th>
      <td><?php echo $soldpro['product_name'];?></td>
      <td>&#8358;<?php echo number_format($soldpro['product_price']);?></td>
      <td><?php echo $soldpro['product_qty'];?></td>
      <td>&#8358;<?php echo number_format($soldpro['product_price']*$soldpro['product_qty']);?></td>
 
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

