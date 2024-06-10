<?php
  session_start();
  require_once "user_guard.php";
require_once "classes/Cart.php";
require_once "classes/Product.php";


require_once "partials/header.php";
  $product=new Product;

//   print "<pre>";

//    print_r($_SESSION['products']);
   
//  print "</pre>";


 

?>

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
                 <h1 class="profile center" style="color:green; text-align: center">Products in Cart</h1>
              </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    List of Products
                </div>
                <div class="card-body">
                
                <?php
                  if(isset($_SESSION["products"]) && !empty($_SESSION["products"])){
                    ?>
                    <table class="table">
                      <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Image</th>
            <th scope="col">Product Price</th>
            <th scope="col">Sales Quantity</th>
            <th>Subtotal</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(is_array($_SESSION['products'])){
            $counter = 1;
            $total=0;
            foreach($_SESSION['products'] as $productid => $product_qty){
              // var_dump($_SESSION['[products']);
              // die();
              $allproducts=$product->fetch_specific_product($productid);
              $subtotal=$allproducts['product_price'] * $product_qty;
              $total = $total + ($subtotal);
        ?>
        <tr>
            <th scope="row"><?php echo $counter;?></th>
            <td><?php echo $allproducts['product_name'];?></td>
            <td><img src="uploads/<?php echo $allproducts['product_image'];?>" height="40"></td>
            <td>&#8358; <?php echo number_format($allproducts['product_price']);?></td>
            <td><?php echo $product_qty;?></td>
            <td>&#8358; <?php print number_format($subtotal) ?> </td>
            <td><a onclick="return confirm('Are you sure you want to delete')" href="delete_product.php?id=<?php echo $allproducts['product_id'];?>" class="btn btn-sm btn-danger">Delete</a> </td>
        </tr>
        <?php
        $counter ++;
            }
            }
            ?>
          <tr>
            <td>TOTAL</td>
            <td>&#8358; <?php echo number_format($total) ?></td>
          </tr>
            
        </tbody>
        </table>
              <?php
              }else{
                  ?>
                <div class="alert alert-danger">Your cart is empty</div>

              <?php
                  }
                ?>
            <a href="emptycart.php" class='btn btn-danger btn-lg noround'>Empty Cart</a>
            &nbsp;  &nbsp;  &nbsp;
            <a href="shop.php" class='btn btn-warning btn-lg noround'>Continue Shopping</a>
            &nbsp;  &nbsp;  &nbsp;
            <?php
            if(isset($_SESSION['topics']) && !empty($_SESSION['topics'])){
                echo "<a href='checkout.php' class='btn btn-dark btn-lg noround'>Checkout Now</a>";
            }
            ?>
      </div>
    </div>
  </div>
</main>

<?php
require_once "partials/footer.php";
?>