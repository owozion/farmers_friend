<?php
session_start();
require_once "classes/admin_guard.php";
require_once "classes/Myadmin.php";
require_once "classes/Power.php";
require_once "classes/Product.php";

$id =$_SESSION["adminonline"];

$adm = new Myadmin;
$admin = $adm->get_admin_by_id($id);

$cust = new Power;
$allcust = $cust->fetch_customer();

$ngo = new Power;
$allngo = $ngo->fetch_ngo();

$farmer = new Power;
$allFarmer = $farmer->fetch_farmers();

$government = new Power;
$allgov = $government->fetch_government();

$products = new Product;
$t=$products->fetch_product($id);
$allproducts=$products->fetch_allproduct();

$t=count($allgov)+count($allngo)+count($allcust)+count($allFarmer);

$orders=new Power;
$allorder=$orders->fetch_all_orders();
$allpendorder=$orders->fetch_all_pending_orders();
$totalpayment=$orders->fetch_total_payment();

$sol = new Power;
$sold =$sol->get_farmers_sales($id);


// echo print_r($id);
 


?>

<?php
require_once "partials/header.php";
?>
           <!-- banner on different farms and about farmers friend -->
           <div class="row head"> 
             	    <div class="col-md"><h2>Dashboard</h2></div>
              
        	</div>
            <!-- entities expected to register -->
            <div class="row">
                <div class="col-md-2 shadow m-3 produce">
                   
                   <p> Welcome <?php echo $admin['admin_firstname'];?></p>
                   
                <img src="uploads/<?php echo $admin['admin_image'];?>" height="40" class="d-block w-55 img-fluid rounded-top-5 rounded-bottom-5 img-thumbnail rounded-circle" alt="Profile picture">
                   <button class="btn  mb-2 col-12" id="editpro">Update Profile</button>
                   <button class="btn  mb-2 col-12" id="addpro">List of Product</button>
                   <button class="btn  mb-2 col-12" id="viewpro">List of Farmers</button>
                   <button class="btn  mb-2 col-12" id="showgov">List of Government</button>
                   <button class="btn  mb-2 col-12" id="showngo">List of NGO</button>
                   <button class="btn  mb-2 col-12" id="showcust">List of Customers</button>
                   <button class="btn  mb-2 col-12" id="showall">Order</button>    
                </div>

                <div class="col-md-9 shadow m-3 produce">
                    <h1 class="dashb m-2" style="color: green; justify-content: center; ">Welcome SuperAdmin</h1>
                    
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

   <!-- Display on Dashboard -->
                 <main id="">
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary shadow onhover:hover text-white mb-4">
                                    <div class="card-body">List of all Users : <?php print $t ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                <div class="card-body">List of Orders: <?php echo count($allorder) ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div>Pending Orders: <?php echo count($allpendorder) ?></div>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Total Sales: &#8358; <?php isset($totalpayment) && !empty($totalpayment)?print number_format($totalpayment):print "0"; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                       
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Restricted Users</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                       
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         
                        
                    </div>
                </main>

                    <!-- List of product -->
                    <main class="row g-3 pb-5" id="listproduct">
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
                            <h1 class="profile center" style="color:green; text-align: center">List of Products</h1>
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
                                        <th scope="col">Image</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Quantity</th>
                                        <th scope="col">Uploaded By</th>
                                        <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(is_array($allproducts)){
                                        $counter = 1;
                                        foreach($allproducts as $allpro){
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $counter;?></th>
                                        <td><?php echo $allpro['product_name'];?></td>
                                        <td><img src="uploads/<?php echo $allpro['product_image'];?>" height="40"></td>
                                        <td>&#8358; <?php echo number_format($allpro['product_price']);?></td>
                                        <td><?php echo $allpro['product_qty'];?></td>
                                        <td><?php echo $allpro['product_totalqty'];?></td>
                                        <td><?php echo $allpro['farmer_email'];?></td>
                                        <td><a href="edit_product.php?id=<?php echo $allpro['product_id'];?>" class="btn btn-sm btn-warning">Edit</a> <a href="approve_product.php?id=<?php echo $allpro['product_id'];?>" class="btn btn-sm btn-primary">Approve</a> 
                                        <a onclick="return confirm('Are you sure you want to delete')" href="delete_product.php?id=<?php echo $allpro['product_id'];?>" class="btn btn-sm btn-danger">Delete</a> </td>
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

                <!-- Admin Update-->
                <form class="row g-3 pb-5" id="editprofile" action="process/process_dashboard.php" method="post" enctype="multipart/form-data">
                        <h6 class="profile" style="color: green;">Edit Profile</h6>
                        <div class="col-md-6">
                            <label for="" class="form-label" style="color: black;">Firstname</label>
                            <input type="name" name="fname" value="<?php echo $admin['admin_firstname'];?>" class="form-control" id="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label" style="color: black;">Surname</label>
                            <input type="name" name="lname" value="<?php echo $admin['admin_lastname'];?>" class="form-control" id="inputsurname" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label" style="color: black;">Phone Number</label>
                            <input type="text" name="phone" value="<?php echo $admin['admin_phone'];?>" class="form-control" id = "phone" placeholder="" required>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="picture" style="cursor:pointer; color:black;" class="form-label"> Upload Profile Picture </label>
                            <input type="file" name="picture" id="picture" class="form-label" required/>
                            <!-- <input type="file" name="picture" id="picture" style='display:none;' class="form-label"/> -->

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

                <!-- view all farmers -->
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
                               <h1 class="profile center" style="color:green; text-align: center">Registered Farmers</h1>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List of Farmers
                            </div>
                            <div class="card-body">
                               <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Firstname</th>
      <th scope="col">Lastname</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(is_array($allFarmer)){
      $counter = 1;
      foreach($allFarmer as $farm){
?>
<tr>
      <th scope="row"><?php echo $counter;?></th>
      <td><?php echo $farm['farmer_firstname'];?></td>
      <td><?php echo $farm['farmer_lastname'];?></td>
      <td><?php echo $farm['farmer_email'];?></td>
      <td><?php echo $farm['farmer_phone'];?></td>
      <td><img src="uploads/<?php echo $farm['farmer_profilep'];?>" height="40"></td>
      <td><a onclick="return confirm('Are you sure you want to delete')" href="delete_farmer.php?id=<?php echo $farm['farmer_id'];?>" class="btn btn-sm btn-danger">Delete</a> </td>
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


                        <!-- view all Government -->
            
                        
                <main class="row g-3 pb-5" id="listgovernment">
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
                               <h1 class="profile center" style="color:green; text-align: center">Registered Government</h1>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List of Government
                            </div>
                            <div class="card-body">
                               <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Firstname</th>
      <th scope="col">Lastname</th>
      <th scope="col">Email</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(is_array($allgov)){
      $counter = 1;
      foreach($allgov as $gov){
?>
<tr>
      <th scope="row"><?php echo $counter;?></th>
      <td><?php echo $gov['government_firstname'];?></td>
      <td><?php echo $gov['government_lastname'];?></td>
      <td><?php echo $gov['government_email'];?></td>
      <td><img src="uploads/<?php echo $gov['government_profilep'];?>" height="40"></td>
      <td><a onclick="return confirm('Are you sure you want to delete')" href="delete_government.php?id=<?php echo $gov['government_id'];?>" class="btn btn-sm btn-danger">Delete</a> </td>
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

    
    
                <!-- view all NGO -->
              
                <main class="row g-3 pb-5" id="listngo">
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
                               <h1 class="profile center" style="color:green; text-align: center">Registered NGO</h1>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List of NGO
                            </div>
                            <div class="card-body">
                               <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Firstname</th>
                                        <th scope="col">Lastname</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(is_array($allngo)){
                                        $counter = 1;
                                        foreach($allngo as $ngo){
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $counter;?></th>
                                        <td><?php echo $ngo['ngo_firstname'];?></td>
                                        <td><?php echo $ngo['ngo_lastname'];?></td>
                                        <td><?php echo $ngo['ngo_email'];?></td>
                                        <td><img src="uploads/<?php echo $ngo['ngo_profilep'];?>" height="40"></td>
                                        <td><a onclick="return confirm('Are you sure you want to delete')" href="delete_ngo.php?id=<?php echo $ngo['ngo_id'];?>" class="btn btn-sm btn-danger">Delete</a> </td>
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
        

                <!-- view all Customer -->
              
                <main class="row g-3 pb-5" id="listcust">
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
                               <h1 class="profile center" style="color:green; text-align: center">Registered Customers</h1>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List of Customer
                            </div>
                            <div class="card-body">
                               <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Firstname</th>
                                        <th scope="col">Lastname</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(is_array($allcust)){
                                        $counter = 1;
                                        foreach($allcust as $cust){
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $counter;?></th>
                                        <td><?php echo $cust['customer_firstname'];?></td>
                                        <td><?php echo $cust['customer_lastname'];?></td>
                                        <td><?php echo $cust['customer_email'];?></td>
                                        <td><img src="uploads/<?php echo $cust['customer_profilep'];?>" height="40"></td>
                                        <td><a onclick="return confirm('Are you sure you want to delete')" href="delete_customer.php?id=<?php echo $cust['customer_id'];?>" class="btn btn-sm btn-danger">Delete</a> </td>
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

                                <!-- view all order -->
              
                <main class="row g-3 pb-5" id="listall">
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
                               <h1 class="profile center" style="color:green; text-align: center">Orders</h1>
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
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">RefNo</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Date Ordered</th>
                                        <th scope="col">Action</th>
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
                                        <td><?php echo $order['customer_firstname'];?></td>
                                        <td><?php echo $order['product_name'];?></td>
                                        <td><?php echo $order['customer_phone'] ;?></td>
                                        <td>&#8358;<?php echo number_format($order['product_price']*$order['product_qty']);?></td>
                                        <td><?php echo $order['order_status'];?></td>
                                        <td><?php echo $order['order_ref'];?></td>
                                        <td> &#8358;<?php echo number_format($order['order_amount']);?></td>
                                        <td><?php echo $order['customer_address'];?></td>
                                        <td><?php echo $order['order_date'];?></td>
                                        <td><div class="dropdown">
  <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Action
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="status.php?id=<?php echo $order['order_id']?>&value=Delivered">Delivered</a></li>
    <li><a class="dropdown-item" href="status.php?id=<?php echo $order['order_id']?>&value=Returned">Returned</a></li>
    <li><a class="dropdown-item" href="status.php?id=<?php echo $order['order_id']?>&value=Failed">Failed</a></li>
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
	
</div> 
          
                <!-- footer -->
    <?php
        require_once "partials/footer.php";
    ?>