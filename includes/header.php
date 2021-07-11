<?php
    require_once "config/config.php";    

    if (isset($_SESSION['username'])) {
        $userLoggedIn = $_SESSION['username'];
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);
    }
    else {
        // header("Location: register.php");
        $userLoggedIn = "Visitor";
        $user['first_name'] = "Visitor";
    }
?>

<html class='animate__animated animate__fadeInDownBig'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Shoppee!</title>

    <!-- Javascript -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <!-- <script src="assets/js/demo.js"></script> -->
    <!-- <script src="assets/js/jquery.jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>
    <script src="croppie/croppie.js"></script> -->

    <!-- CSS -->
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- <link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
    <link rel="stylesheet" href="croppie/croppie.css"> -->
    <link rel="stylesheet" href="assets/css/animate.css">

</head>

<script>    
    $(document).ready(function(){
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
    });
</script>

<body>
    <div class="wrapper">
