<?php
    require_once "config/config.php";
    require_once "includes/header.php";
    
    $f_name = $user['first_name'];    
    $query4 = mysqli_query($con, "SELECT * FROM carts WHERE username='$userLoggedIn'");
    $to_buy = mysqli_num_rows($query4);
    if($to_buy == 0)
        $badge = "";
    else
        $badge = "<span class='badge'>$to_buy</span>";
?>
<div class="header">
    <div style="font-size: 150%;"><b>SHOPEE</b> <span class="fa fa-shopping-cart" style="color: orange;"></span></div>
    <div class="search_box">
        <input type="text" onkeyup="getProducts(this.value)" placeholder="Search for Products..." autocomplete="off" id="search_text_input">
        <div class="button_holder centerr">
            <span class="fa fa-search"></span>
        </div>
        <div class="search_results"></div>
        <div class="search_results_footer_empty"></div>
    </div>
    <div class='menu_list'><span class="fa fa-user-plus"></span> Hi, <?php echo $f_name; ?></div>
    <div class='menu_list'>
        <input type="checkbox" class="checkbox" id="chkx">
        <label class="label" for="chkx">
            <i class="fa fa-moon-o"></i>
            <i class="fa fa-sun-o"></i>
            <div class="ball"></div>
        </label>    
    </div>
    <!-- <div class='menu_list'><span class="fa fa-question-circle"></span> Help</div> -->
    <div class='menu_list'><a href='cart.php'><span class="fa fa-shopping-cart"></span> Cart</a><?php echo $badge; ?></div>
</div>

<script>
    var darkMode = localStorage.getItem('dmode');

    const enableDarkMode = function(){
        document.body.classList.add('darkmode');
        localStorage.setItem('dmode', 'enabled');
        console.log("hello world");
    }

    const disableDarkMode = () =>{
        document.body.classList.remove('darkmode')
        localStorage.setItem('dmode', 'null');
        console.log("fuck you");
    }

    if(darkMode === 'enabled'){
        enableDarkMode();
    }
    else{
        disableDarkMode();
    }

    var chkx = document.getElementById("chkx");
    chkx.addEventListener('change', () => {
        darkMode = localStorage.getItem('dmode');
        
        if(darkMode !== 'enabled'){
            enableDarkMode();
        }
        else{
            disableDarkMode();
        }
    });
</script>

<section style='z-index: -1;'>
    <div class="section_list">
        <li><span class="fa fa-transgender"></span> Health & Beauty</li>
        <li><span class="fa fa-home"></span> Home & Office</li>
        <li><span class="fa fa-tablet"></span> Phones & Tablets</li>
        <li><span class="fa fa-desktop"></span> Computing</li>
        <li><span class="fa fa-television"></span> Electronics</li>
        <li><span class="fa fa-shirtsinbulk"></span> Fashion</li>
        <li><span class="fa fa-child"></span> Baby Products</li>
        <li><span class="fa fa-gamepad"></span> Gaming</li>
        <li><span class="fa fa-soccer-ball-o"></span> Sporting Goods</li>
        <li><span class="fa fa-automobile"></span> Automobile</li>
        <li><span class="fa fa-ellipsis-h"></span> Other Categories</li>
    </div>
    <div id="carousel_generic" class="carousel slide img_container" data-ride='carousel' data-interval='5000'>
        <ol class="carousel-indicators">
            <li class='active' data-target='#carousel_generic' data-slide-to='0'></li>
            <li data-target='#carousel_generic' data-slide-to='1'></li>
            <li data-target='#carousel_generic' data-slide-to='2'></li>
            <li data-target='#carousel_generic' data-slide-to='3'></li>
        </ol>
        <div class="img_container2 carousel-inner" role='list-box'>
            <div class="carousel-inner item active">
                <img src="assets/images/Banner1.png" alt="">
            </div>
            <div class="carousel-inner item">
                <img src="assets/images/Banner2.png" alt="">    
            </div>
            <div class="carousel-inner item">
                <img src="assets/images/Banner3.jpg" alt="">    
            </div>
            <div class="carousel-inner item">
                <img src="assets/images/Banner4.jpg" alt="">
            </div>
        </div>
        <!-- <a href="#carousel_generic" role="button" data-slide="prev" class="left carousel-control">
            <span class="icon-prev" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a href="#carousel_generic" role="button" data-slide="next" class="right carousel-control">
            <span class="icon-next" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a> -->
    </div>
</section>

<article>    
    <h2 style="margin-top: 0;">Recommended for you</h2>
    <div class="recom">
        <?php
            $query = mysqli_query($con, "SELECT * FROM products");
            $i = 0;
            while($products = mysqli_fetch_array($query)){
                // echo $products['image'] ."<br>";
                if($i == 4)
                    break;
                $image = $products['image'];
                $name = $products['name'];
                $price = $products['price'];
                $price2 = $products['price2'];
                $id = $products['id'];
                $perc = round(100 - ($price2/$price * 100), 0);
                echo "<a href='products.php?id=$id'>
                        <div>                        
                            <span>- $perc%</span>
                            <img style='width: 60%; margin: auto; height: auto !important;' class='img-responsive' src='$image'>                        
                            <p>$name</p>
                            <b># $price2</b>
                            <p style='text-decoration: line-through; margin: 0;'># $price</p>                        
                        </div>
                    </a>";
                $i++;
            }
        ?>
    </div>
</article>
<br>

<main>
    <h3 style="background-color: red; margin: -10px -10px 10px; color: white; padding: 10px">Deals of the Day</h3>
    <div class="recom">
        <?php
            $query2 = mysqli_query($con, "SELECT * FROM products WHERE id > 6");
            $j = 0;
            while($deals = mysqli_fetch_array($query2)){
                if($j == 4)
                    break;
                $image = $deals['image'];
                $name = $deals['name'];
                $price = $deals['price'];
                $price2 = $deals['price2'];
                $id = $deals['id'];
                $perc = round(100 - ($price2/$price * 100), 0);
                echo "<a href='products.php?id=$id'>
                        <div>
                            <span>- $perc%</span>
                            <img style='width: 60%; margin: auto; height: auto !important;' class='img-responsive' src='$image'>                        
                            <p>$name</p>
                            <b># $price2</b>
                            <p style='text-decoration: line-through; margin: 0;'># $price</p>
                        </div>
                    </a>";
                $j++;
            }
        ?>
    </div>
</main>
<br>

<div class='aside'>
    <img src="assets/images/Banner3.jpg" alt="">
    <img src="assets/images/Banner4.jpg" alt="">
</div>
<br>

<main>
    <h3 style="background-color: green; margin: -10px -10px 10px; color: white; padding: 10px">Best Offers</h3>
    <div class="recom">
        <?php
            $query3 = mysqli_query($con, "SELECT * FROM products WHERE id > 10");
            $j = 0;
            while($offers = mysqli_fetch_array($query3)){
                if($j == 4)
                    break;
                $image = $offers['image'];
                $name = $offers['name'];
                $price = $offers['price'];
                $price2 = $offers['price2'];
                $id = $offers['id'];
                $perc = round(100 - ($price2/$price * 100), 0);
                echo "<a href='products.php?id=$id'>
                        <div>
                            <span>- $perc%</span>
                            <img style='width: 60%; margin: auto; height: auto !important;' class='img-responsive' src='$image'>                        
                            <p>$name</p>
                            <b># $price2</b>
                            <p style='text-decoration: line-through; margin: 0;'># $price</p>
                        </div>
                    </a>";
                $j++;
            }
        ?>
    </div>
</main>
<br>

<div class='aside'>
    <img src="assets/images/Banner1.png" alt="">
    <img src="assets/images/Banner2.png" alt="">
</div>
<br>



</div>
</body>