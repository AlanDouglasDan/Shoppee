<?php  
require_once("../../config/config.php");

$userLoggedIn = $_SESSION['username'];
$product_id = $_POST['product_id'];
$number = $_POST['number'];

$query = mysqli_query($con, "SELECT * FROM saved_items WHERE product_id='$product_id' AND username='$userLoggedIn'");
$total = mysqli_num_rows($query);
if($total == 1){
    $query2 = mysqli_query($con, "DELETE FROM saved_items WHERE product_id='$product_id' AND username='$userLoggedIn'");
}
// echo "<span class='fa fa-heart-o fa-lg pull-right to_save' style='color: orange; margin-left: 25px;' onclick='save($product_id)'></span>";
if($number == 0)
    echo "<span class='fa fa-heart-o fa-lg pull-right' style='color: orange; margin-left: 25px;' onclick='save($product_id, 0)'></span>";
else
    echo "<span class='fa fa-heart-o fa-lg' style='color: orange;' onclick='save($product_id, 1)'></span>";
?>