<?php
    require_once "includes/header.php";

?>

<div class="search_header" style='justify-content: center;'>
    <a href='home.php' class="fa fa-arrow-left fa-lg" style='padding: 0 2rem; position: absolute; left: 0;'></a>
    <span style='font-size: 120%;'> <?php echo $userLoggedIn; ?></span>
</div>
<br>

<?php
    $query = mysqli_query($con, "SELECT product_id, quantity FROM carts WHERE username='$userLoggedIn'");
    $total = 0;
    while($row = mysqli_fetch_array($query)){
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $query2 = mysqli_query($con, "SELECT * FROM products WHERE id='$product_id'");
        while($row2 = mysqli_fetch_array($query2)){
            $name = $row2['name'];
            $price = $row2['price'];
            $price2 = $row2['price2'];
            $price2 = $price2 * $quantity;
            $image = $row2['image'];
            $total += $price2;
            echo "<div class='item$product_id'>
                    <main style='border-radius: 5px;'>
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
                    <br>
                </div>";
        }
    }    
?>

<main>
    <h3 style='color: orange;' class='total'>Total Price = <?php echo $total; ?></h3>
    <button class="btn btn-success" style='width: 100%;'>Complete Order</button>
</main>

</div>
</body>