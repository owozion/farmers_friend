<?php
session_start();
error_reporting(E_ALL);
require_once "user_guard.php";
require_once "classes/Farmer.php";
require_once "classes/Customer.php";
require_once "classes/Cart.php";
require_once "classes/Product.php";
$f=new Farmer;
$user =new Customer;
$data = $user->get_customer_by_id($_SESSION['useronline']);
$t =new Product;

// "<pre>";
// print_r($data);
// "<pre>";
require_once "partials/header_dash.php";
?>
<div class="container col-md-10 py-5" style="background-color: white;">
<div class="content">

<?php
                            if(isset($_SESSION['errormsg'])){
                            echo "<div class='alert alert-danger'>" .$_SESSION['errormsg']."</div>";
                            unset($_SESSION['errormsg']); 
                            }
                            ?>

    <?php
    
    if(isset($_SESSION['products']) && !empty($_SESSION['products'])){
        echo "<table class='table table-striped'>
        <tr>
            <th>S/N</th>
            <th>Item Name</th>
            <th>Item Image</th>
            <th>Amount</th>
            <th>Qty</th>
            <th>Action</th>
        </tr>";
        $sn = 1; $total = 0;
        foreach($_SESSION['products'] as $productid => $product_qty){
          $product_details = $t->fetch_specific_product($productid);
          $productname = $product_details['product_name'];
          $productimage = "admin/uploads/".$product_details['product_image'];
          $productamt = number_format($product_details['product_price'] *$product_qty,2);
          $total = $total + ($product_details['product_price'] * $product_qty);

          // echo "<pre>";
          // print_r($_SESSION['products']);
          // echo "<pre>";

          // var_dump($_SESSION['[products']);
          // die();
         

          echo "<tr>
            <td>$sn</td>
            <td>$productname</td>
            <td><img src='$productimage' height='40'></td>
            <td>$productamt</td>
            <td>$product_qty</td>
            <td><a href='removecart.php?id=' class='btn btn-sm btn-danger'>Remove</a></td>
          </tr>";
          $sn ++;
        }
        $formated_total = number_format($total,2);
        echo "<tr><td>TOTAL</td><td colspan='2'></td><td align='left'>$formated_total</td>";
        echo "</table>";
    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";
}else{
    echo "<div class='alert alert-info'>Your cart is empty</div>";
}
    ?>
    <a href="emptycart.php" class='btn btn-danger btn-lg noround'>Empty Cart</a>
    &nbsp;  &nbsp;  &nbsp;
    <a href="shop.php" class='btn btn-warning btn-lg noround'>Continue Shopping</a>
    &nbsp;  &nbsp;  &nbsp;
    <?php
     if(isset($_SESSION['products']) && !empty($_SESSION['products'])){
        echo "<a href='checkout.php' class='btn btn-dark btn-lg noround'>Checkout Now</a>";
     }
    ?>
</div>
</div>