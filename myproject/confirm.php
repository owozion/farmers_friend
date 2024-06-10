<?php
session_start();
error_reporting(E_ALL);
require_once "user_guard.php";
require_once "classes/Order.php";
require_once "classes/Product.php";
require_once "classes/Farmer.php";

$f=new Farmer;

$reference =isset($_SESSION['refno'])? $_SESSION['refno'] :0;
if(!$reference){
  header("location:shop.php");
  exit();
}
$t =new Order;
$items = $t->get_order_byref($reference);

// echo "<pre>";
// print_r($items);
// echo "<pre>";

require_once "partials/header_dash.php";
?>
<a href="gocart.php">Go back to cart</a>
<a href="pay.php">Confirm payment</a>
<?php
die();
?>
<div class="container col-md-10 py-5" style="background-color: white;">
<div class="content">
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
        $sn = 1; 
        foreach($items as $deets){
          $product_details = $t->fetch_specific_product($id);
          $productname = $product_details['product_name'];
          $productimage = "../uploads/".$product_details['product_img'];
          $productamt = number_format($product_details['product_amt'] *$product_qty,2);
          $total = $total + ($product_details['product_amt'] * $product_qty);
        //   echo "<pre>";
        //   print_r($product_details);
        //   echo "<pre>";
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
    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";
}else{
    echo "<div class='alert alert-info'>Your cart empty</div>";
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