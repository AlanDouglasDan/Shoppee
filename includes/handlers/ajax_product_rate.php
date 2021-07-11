<?php  
require_once("../../config/config.php");

$userLoggedIn = $_SESSION['username'];
$number = $_POST['number'];
$product_id = $_POST['product_id'];

$query = mysqli_query($con, "SELECT * FROM ratings WHERE product_id='$product_id'");
if(mysqli_num_rows($query)){
    $update = mysqli_query($con, "UPDATE ratings SET stars='$number' WHERE product_id='$product_id' AND username='$userLoggedIn'");
}
else{
    $insert = mysqli_query($con, "INSERT INTO ratings VALUES('', '$userLoggedIn', '$product_id', '$number')");
}

$total = mysqli_num_rows($query);
if($total > 1){
    $total .= " ratings";
}
else{
    $total .= " rating";
}

for($i=1; $i<=5; $i++){
    if($i <= $number)
        echo "<span onclick='rate($i, $product_id)' class='fa fa-star fa-lg' style='color: orange;'></span> ";
    else
        echo "<span onclick='rate($i, $product_id)' class='fa fa-star fa-lg'></span> ";
}
?>
<br>
<span style='color: blue;'>(<?php echo $total; ?>)</span>
<?php
?>