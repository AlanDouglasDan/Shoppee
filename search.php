<?php

require_once("includes/header.php");

if(isset($_GET['q'])) {
	$query = $_GET['q'];
}
else {
	$query = "";
}

// if(isset($_GET['type'])) {
// 	$type = $_GET['type'];
// }
// else {
// 	$type = "name";
// }
?>

<style>
    .col-xs-6{
        width: 48%;
        background-color: var(--bgc2);
        margin: 1%;
        border-radius: 8px;
    }
</style>

<div class="search_header">
    <a href='home.php' class="fa fa-arrow-left fa-lg" style='padding: 0 2rem;'></a>
    <span style='font-size: 120%;'> <?php echo $query; ?></span>
</div>

	<?php 
	if($query == "")
		echo "You must enter something in the search box.";
	else {
		//If query contains an underscore, assume user is searching for usernames
		// if($type == "username") 
        $usersReturnedQuery = mysqli_query($con, "SELECT * FROM products WHERE name LIKE '%$query%' ORDER BY name");
		//If there are two words, assume they are first and last names respectively
		// else {
		// 	$names = explode(" ", $query);

		// 	if(count($names) == 3)
		// 		$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[2]%') AND user_closed='no' ORDER BY first_name");
		// 	//If query has one word only, search first names or last names 
		// 	else if(count($names) == 2)
		// 		$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[1]%') AND user_closed='no' ORDER BY first_name");
		// 	else 
		// 		$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%') AND user_closed='no' ORDER BY first_name");
		// }

		//Check if results were found
		// if(mysqli_num_rows($usersReturnedQuery) == 0)
		// 	echo "We can't find anyone with a " . $type . " : " .$query;
		// else 
        // echo mysqli_num_rows($usersReturnedQuery) . " results found: <br> <br>";

		// echo "<p id='grey'>Try searching for:</p>";
		// echo "<a href='search.php?q=" . $query ."&type=name'>Names</a>, <a href='search.php?q=" . $query ."&type=username'>Usernames</a><br><br>";

		while($row = mysqli_fetch_array($usersReturnedQuery)) {
            $image = $row['image'];
            $name = $row['name'];
            $price = $row['price'];
            $price2 = $row['price2'];
            $id = $row['id'];
            $perc = round(100 - ($price2/$price * 100), 0);

            $query4 = mysqli_query($con, "SELECT * FROM saved_items WHERE product_id='$id' AND username='$userLoggedIn'");
            $totall = mysqli_num_rows($query4);
            if($totall == 0)
                $save = "<span class='fa fa-heart-o fa-lg' style='color: orange;' onclick='save($id, 1)'></span>";
            else
                $save = "<span class='fa fa-heart fa-lg' style='color: orange;' onclick='unsave($id, 1)'></span>";

            $query2 = mysqli_query($con, "SELECT * FROM carts WHERE product_id='$id' AND username='$userLoggedIn'");
            if(mysqli_num_rows($query2)){
                $cart = "<button class='btn btn-warning' style='margin: 10px auto; width: 100%;' onclick='uncart(1, $id)'>REMOVE FROM CART</button>";
            }
            else
                $cart = "<button class='btn btn-warning' style='margin: 10px auto; width: 100%;' onclick='cart(1, $id)'>ADD TO CART</button>";
            
            echo "<div class='col-xs-6'>
                    <a href='products.php?id=$id'>
                        <img style='width: 60%; margin: auto; height: auto !important;' class='img-responsive' src='$image'>
                    </a>
                    <span class='to_save$id'>$save</span>
                    <p>$name</p>
                    <p><b># $price2</b></p>
                    <span style='text-decoration: line-through; color: grey;'># $price </span>                              
                    &nbsp;&nbsp;&nbsp;<span class='perc' style='margin: 0;'> - $perc%</span>
                    <br>
                    <span class='cart$id'>
                        $cart
                    </span>
                </div>";
		} //End while
	}

	?>