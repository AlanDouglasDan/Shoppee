<?php
    require_once("includes/header.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    else{
        header("Location: home.php");
    }
    // echo $id;
    $query = mysqli_query($con, "SELECT * FROM products WHERE id='$id'");
    if(mysqli_num_rows($query) == 0){
        header("Location: home.php");
    }
    $product = mysqli_fetch_array($query);
    $name = $product['name'];
    $price = $product['price'];
    $price2 = $product['price2'];
    $image = $product['image'];
    $warranty = $product['warranty'];
    $perc = round(100 - ($price2/$price * 100), 0);
    $query2 = mysqli_query($con, "SELECT * FROM ratings WHERE product_id='$id'");
    if(mysqli_num_rows($query2)){
        $total = mysqli_num_rows($query2);
        if($total > 1){
            $total .= " ratings";
        }
        else{
            $total .= " rating";
        }
    }
    else
        $total = "0 ratings";
    $query3 = mysqli_query($con, "SELECT stars FROM ratings WHERE product_id='$id' AND username='$userLoggedIn'");
    if(mysqli_num_rows($query3)){
        $ty = mysqli_fetch_array($query3);
        $number = $ty['stars'];
    }
    else
        $number = 0;
    $query4 = mysqli_query($con, "SELECT * FROM saved_items WHERE product_id='$id' AND username='$userLoggedIn'");
    $totall = mysqli_num_rows($query4);

    $date = date("Y-m-d");
    $time = time() + 7 * 24 * 60 * 60;
    $time2 = time() + 10 * 24 * 60 * 60;
    $delivery_day = date("l j F", $time);
    $delivery_day2 = date("l j F", $time2);
    $delivery_info = "Delivered between " . $delivery_day . " and " . " $delivery_day2";

    
?>

<br>
<main style="border-radius: 5px;">
    <img src="<?php echo $image; ?>" class='img-responsive' alt="" style='height: 40vh !important;'>
</main>
<br>

<main>
    <span class='branding'>Official Store</span>
    <h4><?php echo $name; ?></h4>
    <h2><b># <?php echo $price2; ?></b></h2>
    <span style='text-decoration: line-through; margin: 0;'># <?php echo $price; ?></span>
    <span class='perc' style='margin-left: 5px;'>- <?php echo $perc; ?>%</span>
    <br><br>
    <div>
        <span class="change">
            <?php
                for($i=1; $i<=5; $i++){
                    if($i <= $number)
                        echo "<span onclick='rate($i, $id)' class='fa fa-star fa-lg' style='color: orange;'></span> ";
                    else
                        echo "<span onclick='rate($i, $id)' class='fa fa-star fa-lg'></span> ";
                }
            ?>
            <br>
            <span style='color: blue;'>(<?php echo $total; ?>)</span>
        </span>
        <span class="to_save<?php echo $id; ?>">
        <?php 
            if($totall == 0)
                echo "<span class='fa fa-heart-o fa-lg pull-right' style='color: orange; margin-left: 25px;' onclick='save($id, 0)'></span>";
            else
                echo "<span class='fa fa-heart fa-lg pull-right' style='color: orange; margin-left: 25px;' onclick='unsave($id, 0)'></span>";
        ?>
        </span>
        <span class="fa fa-share-alt fa-lg pull-right" style='color: orange;'></span>        
    </div>
</main>
<br>

<main>
    <h6 style='color: grey;'>DELIVERY AND RETURNS INFO</h6>
    <div style='line-height: 2;'>
        <span class="fa fa-paper-plane fa-lg" style='color: orange;'></span>
        <span style='color: orange;' class='fa-lg'><b> SHOPPEE</b></span><br>
        Eligible for <b>Free Shipping</b>
    </div>
    <br>
    <div style='line-height: 2;'>
        <span class="fa fa-truck fa-lg" style='color: orange;'></span>
        <span style='color: orange;' class='fa-lg'><b> Delivery Information</b></span><br>
        <?php echo $delivery_info; ?>
    </div>
    <br>
    <div style='line-height: 2;'>
        <span class="fa fa-recycle fa-lg" style='color: orange;'></span>
        <span style='color: orange;' class='fa-lg'><b> Return Policy</b></span><br>
        Free return within 15 days for Shoppee premium items and 7 days for other eligible items
        Full refund if you do not get your package delivered
    </div>
    <br>
    <div style='line-height: 2;'>
        <span class="fa fa-shield fa-lg" style='color: orange;'></span>
        <span style='color: orange;' class='fa-lg'><b> Warranty</b></span><br>
        <?php echo $warranty; ?>
    </div>
</main>
<br>

<main>
    <h6 style='color: grey;'>CUSTOMERS ALSO VIEWED</h6>
    <div class="holds">
        <?php
            $query5 = mysqli_query($con, "SELECT * FROM products WHERE id!='$id'");
            while($row = mysqli_fetch_array($query5)){
                $imagee = $row['image'];
                $namee = $row['name'];
                $price3 = $row['price'];
                $price4 = $row['price2'];
                $idz = $row['id'];
                $perce = round(100 - ($price4/$price3 * 100), 0);
                echo "<a href='products.php?id=$idz'>
                        <div class='conts'>
                            <span class='perc'>- $perce%</span>
                            <img style='width: 60%; margin: auto; height: auto !important;' class='img-responsive' src='$imagee'>                        
                            <p>$namee</p>
                            <b># $price4</b>
                            <p style='text-decoration: line-through; margin: 0;'># $price3</p>
                        </div>
                    </a>";
            }
        ?>
    </div>
</main>

</div>
</body>