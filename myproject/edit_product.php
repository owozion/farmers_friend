<?php
session_start();
require_once "user_guard.php";
require_once("partials/header.php");
require_once "classes/Farmer.php";
require_once "classes/State.php";
require_once "classes/Product.php";

$id =$_SESSION["useronline"];
$farmers = new Farmer;
$farmers = $farmers->get_farmer_by_id($id);

$category = new State;
$cats = $category->fetch_category();

$products = new Product;
$t=$products->fetch_product($id);

if(isset($_GET['id'])){
   $id=$_GET['id'];

   $pro=$products->fetch_specific_product($id);

//    print_r($pro);
//    die();
//Array ( [product_id] => 44 [product_name] => egg [product_qty] => 1 [product_price] => 2500 [product_totalqty] => 30 [product_desc] => Fresh egg [product_image] => 17150210251040807658.png [cat_id] => 1 [farmer_id] => 2 )

}

// print_r($_GET['id']);
// die();
?>

<?php
require_once "partials/header.php"
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
                   <button class="btn  mb-2 col-12" id="removepro">Remove Product</button>
                   <button class="btn  mb-2 col-12" id="viewpro">View my Products</button>
                   <!-- <button class="btn  mb-2 col-12" id="soldpro">Sold Products</button>
                   <button class="btn  mb-2 col-12" id="benefit">Agricultural Support Benefits</button>     -->
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
                    <!-- Edit Product -->
                    <form class="row g-3 overlay " id="editproduct" action="process/process_editproduct.php" method="post" enctype="multipart/form-data">
                        <h6 class="profile" style="color: black">Update Product</h6>
                        <div class="col-md-6">
                            <label for="inputname" class="form-label" style="color:black ">Product Name</label>
                            <input type="text" name="productname" value="<?php echo $pro['product_name'];?>" class="form-control" id="inputname" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label"style="color:black ">Category</label>
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
                            <input type="number" name="productqty" value="<?php echo $pro['product_qty'];?>" class="form-control" id="productqty" required>
                        </div>
                        <div class="col-md-4">
                            <label for="price" class="form-label" style="color:black ">Price</label>
                            <input type="number" name="productprice" value="<?php echo $pro['product_price'];?>" class="form-control" id="productprice"required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputquantity" class="form-label" style="color: black ">Available Quantity</label>
                        <input type="number" value="<?php echo $pro['product_totalqty'];?>" name="availableqty" class="form-control" id="productqty" required>
                        </div>
                        <div> 
                            <label for="bio" style="color:black ">Product description</label>
                            <textarea name="productdescription" id="bio" rows="10" cols="30" class="form-control"><?php echo $pro['product_desc'];?></textarea>
                        </div>
                        <div class="col-md-6">
                                <label for="productpicture" style="color: black "> Upload Product Picture </label>
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
                        <input type="hidden" name="id" value="<?php echo $pro['product_id'];?>">
                        <input class="btn btn-warning m-2" id="btneditproduct" name="btneditproduct" type="submit" value="Update Product">                            
                        </div>
                    </form>
		        </div>
	
        
          
                <!-- footer -->
<?php
    require_once "partials/footer.php";
?>