<?php  
require_once("../../config/config.php");

$userLoggedIn = $_SESSION['username'];
$product_id = $_POST['product_id'];
$number = $_POST['number'];

$query = mysqli_query($con, "SELECT * FROM carts WHERE product_id='$product_id' AND username='$userLoggedIn'");
$total = mysqli_num_rows($query);
if($total == 1){
    $query2 = mysqli_query($con, "DELETE FROM carts WHERE product_id='$product_id' AND username='$userLoggedIn'");
}

echo "<button class='btn btn-warning' style='margin: 10px auto; width: 100%;' onclick='cart(1, $product_id)'>ADD TO CART</button>";
?>