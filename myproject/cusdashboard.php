<?php
session_start();
require_once "user_guard.php";
require_once "classes/Customer.php";
require_once "classes/State.php";
require_once "classes/Order.php";
require_once "classes/Farmer.php";

$id =$_SESSION["useronline"];
$customer = new customer;
$customers = $customer->get_customer_by_id($id);

$orders = new Order;
$allorder=$orders->fetch_specific_order($id);

// $t=$products->fetch_product($id);

$f=new Farmer;

$states = new State;
$states = $states->fetch_states();

$localgovernment = new State;
$lgas = $localgovernment->fetch_lga();

$category = new State;
$cats = $category->fetch_category();

// echo "<pre>";
// print_r($customers);
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
                   
                   <p> Welcome <?php echo $customers['customer_firstname'];?></p>
                   
                    <img src="uploads/<?php echo $customers['customer_profilep'];?>" height="80" class="d-block w-55 img-fluid rounded-top-5 rounded-bottom-5 img-thumbnail rounded-circle" alt="Profile picture">
                    <button class="btn  mb-2 col-12" id="editpro">Update Profile</button>
                   <button class="btn  mb-2 col-12" id="addpro">Loyalty Reward</button>
                   <button class="btn  mb-2 col-12" id="viewpro">View my Order</button>   
                </div>

                <div class="col-md-8 shadow m-3 produce dashboard">
                    <h1 class="dashb ">You keep us in Bussiness</h1>
                    <h1 class="dashb  pb-5">Buy more! Payless!!</h1>
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
                            <label for="inputname" class="form-label">Product Name</label>
                            <input type="text" name="productname" class="form-control" id="inputname" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Category</label>
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
                            <label for="inputquantity" class="form-label">Quantity</label>
                            <input type="number" name="productqty" class="form-control" id="productqty" required>
                        </div>
                        <div class="col-md-4">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="productprice" class="form-control" id="productprice"required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputquantity" class="form-label">Available Quantity</label>
                            <input type="number" name="availableqty" class="form-control" id="productqty" required>
                        </div>
                        <div> 
                            <label for="bio">Product description</label>
                            <textarea name="productdescription" id="bio" rows="10" cols="30" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                                <label for="productpicture"> Upload Product Picture </label>
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
                        <!-- <input type="hidden" name="id" value="<?php #echo $_SESSION['useronline'];?>"> -->
                        <input class="btn btn-warning noround mb-3 align-center" id="btnaddproduct" name="btnaddproduct" type="submit" value="Add Product">                            
                        </div>
                    </form>
                                  

                <!-- Customer Update-->
                    <form class="row g-3 pb-5" id="editprofile" action="process/process_cusprofile.php" method="post" enctype="multipart/form-data">
                        <h6 class="profile">Edit Profile</h6>
                        <div class="col-md-6">
                            <label for="" class="form-label">Firstname</label>
                            <input type="name" name="fname" value="<?php echo $customers['customer_firstname'];?>" class="form-control" id="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Surname</label>
                            <input type="name" name="lname" value="<?php echo $customers['customer_lastname'];?>" class="form-control" id="inputsurname" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" value="<?php echo $customers['customer_email'];?>" class="form-control" id="email"required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Date of Birth</label>
                            <input type="date" name="dob" value="<?php echo $customers['customer_dob'];?>" class="form-control" id = "dob" placeholder="yyyy/mm/dd" required>
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
                            <input type="number" name="phone" value="<?php echo $customers['customer_phone'];?>" class="form-control" id = "phone" placeholder="" required>
                        </div>
                        
                        <div class="col-md-6">
                        <label for="lname" class="form-label">State</label>
                        <select name="state_id" id="state_id" class="form-select">
                        <option value="">Select One</option>
                        <?php
                        foreach($states as $state){
                            $statename = $state['state_name'];
                            $stateid = $state['state_id'];
                            if($stateid == $customers['state_id']){
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
                            // echo "<pre>";
                            // print_r($customers);
                            // echo "<pre>";
                            // die();
                            foreach($lgas as $lga){
                                $lganame = $lga['lga_name'];
                                $lgaid = $lga['lga_id'];
                                if($lgaid == $customers['lga_id']){
                                echo "<option value='$lgaid' selected>$lganame</option>";
                                }else{
                                echo "<option value='$lgaid'>$lganame</option>";
                                }
                            }
                            ?>
                            </select>
                        </div>
                       
                        <div class="col-12">
                            <label for="" class="form-label">Address</label>
                            <input type="text" name="address" value="<?php echo $customers['customer_address'];?>"class="form-control" id="" placeholder="1234 Main St" required>
                            
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

                <!-- view my order -->
                <form class="row g-3 pb-5" id="viewproduct" action="process/process_product.php" method="post" enctype="multipart/form-data">
                        
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
                               <h1 class="profile" style="color:green; text-align:centre">My Order</h1>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List of Order
                            </div>
                            <div class="card-body">
                               <table class="table">
                                    <thead>
                                        <tr style="color: green;">
                                        <th scope="col" class="">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">RefNo</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Date Ordered</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(is_array($allorder)){
                                        $counter = 1;
                                        foreach($allorder as $order){
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $counter;?></th>
                                        <td><?php echo $order['product_name'];?></td>
                                        <td> &#8358;<?php echo number_format($order['product_price']*$order["orderdetailsquantity"]);?></td>
                                        <td><?php echo $order['order_status'];?></td>
                                        <td><?php echo $order['order_ref'];?></td>
                                        <td><?php echo $order['customer_address'];?></td>
                                        <td><?php echo $order['order_date'];?></td>
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