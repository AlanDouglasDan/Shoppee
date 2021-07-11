<?php
require_once("../../config/config.php");

$query = sanitizeString($_POST['query']);
$userLoggedIn = $_SESSION['username'];

// $names = explode(" ", $query);

//If query contains an underscore, assume user is searching for usernames
// if(strpos($query, '_') !== false) 
$usersReturnedQuery = mysqli_query($con, "SELECT * FROM products WHERE name LIKE '%$query%' ORDER BY name LIMIT 8");
//If there are two words, assume they are first and last names respectively
// else if(count($names) == 2)
// 	$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[1]%') AND user_closed='no' ORDER BY first_name LIMIT 8");
// //If query has one word only, search first names or last names 
// else 
// 	$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%') AND user_closed='no' ORDER BY first_name LIMIT 8");


if($query != ""){

	while($row = mysqli_fetch_array($usersReturnedQuery)) {        

		echo "<div class='resultDisplay'>
				<a href='products.php?id=" . $row['id'] . "' style='color: #1485BD'>
					<div class='liveSearchProfilePic'>
						<img src='" . $row['image'] ."'>
					</div>

					<div class='liveSearchText'>
						" . $row['name'] . "
						<b><p style='color: var(--color); font-size: 14px;'># " . $row['price2'] ."</p></b>
						<p style='color: var(--color); text-decoration: line-through; font-size: 11px;'># " . $row['price'] ."</p>
					</div>
				</a>
            </div>";

	}

}

?>