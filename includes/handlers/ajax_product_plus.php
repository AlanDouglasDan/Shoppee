<?php  
require_once("../../config/config.php");

$userLoggedIn = $_SESSION['username'];
$product_id = $_POST['product_id'];

$query = mysqli_query($con, "SELECT quantity FROM carts WHERE product_id='$product_id' AND username='$userLoggedIn'");
$total = mysqli_num_rows($query);
if($total == 1){
    $row = mysqli_fetch_array($query);
    $quantity = $row['quantity'] + 1;
    $query2 = mysqli_query($con, "UPDATE carts SET quantity='$quantity' WHERE product_id='$product_id' AND username='$userLoggedIn'");
    $query3 = mysqli_query($con, "SELECT * FROM products WHERE id='$product_id'");
    $row2 = mysqli_fetch_array($query3);
    $image = $row2['image'];
    $name = $row2['name'];
    $price2 = $row2['price2'];
    $price2 = $price2 * $quantity;
    echo "<main style='border-radius: 5px;'>
                <img src='$image' class='img-responsive' alt='' style='height: 40vh !important;'>
                <span class='branding'>Official Store</span>
                <h4>$name</h4>
                    <span class='cart_controls'>
                        <span class='fa controlz fa-minus' onclick='drop($product_id)'></span>&nbsp;&nbsp; 
                        <b style='font-size: 18px;'>$quantity</b>
                        &nbsp;&nbsp;<span class='fa controlz fa-plus' onclick='plus($product_id)'></span>    
                    </span>
                    <h3><b>Price: # $price2</b></h3>
            </main>
            <br>";
}
?>