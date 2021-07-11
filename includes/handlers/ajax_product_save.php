<?php  
require_once("../../config/config.php");

$userLoggedIn = $_SESSION['username'];
$product_id = $_POST['product_id'];
$number = $_POST['number'];

$query = mysqli_query($con, "SELECT * FROM saved_items WHERE product_id='$product_id' AND username='$userLoggedIn'");
$total = mysqli_num_rows($query);
if($total == 0){
    $query2 = mysqli_query($con, "INSERT INTO saved_items VALUES('', '$userLoggedIn', '$product_id')");
}

if($number == 0)
    echo "<span class='fa fa-heart fa-lg pull-right' style='color: orange; margin-left: 25px;' onclick='unsave($product_id, 0)'></span>";
else
    echo "<span class='fa fa-heart fa-lg' style='color: orange;' onclick='unsave($product_id, 1)'></span>";
?>