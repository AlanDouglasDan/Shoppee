<?php
    require_once "config/config.php";
    require_once "includes/form_handlers/register_handler.php";
    require_once "includes/form_handlers/login_handler.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel='stylesheet' type='text/css' media='screen' href='assets/css/main.css'>   
    <script src="assets/js/jquery-1.11.1.min.js"></script>
</head>
<body style="background-color: aliceblue;">
    <div class="container">
        <div class="img">
            <img class = "extra" src="assets/images/phenom2.jpg" draggable="false">
        </div>
        <div class="login-container">
            <form action="register.php" method="POST">
                <img class="avatar" src="assets/images/phenom3.png" >
                <h2>Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-user"></i>
                    </div>
                    <div>
                        <h5>Username or Email</h5>
                        <input type="text" name="username" class="input" value="<?php 
                        if(isset($_SESSION['log_username'])){
                            echo $_SESSION['log_username'];
                        }
                        ?>"required autocomplete="off">
                    </div>
                </div>
                <div class="input-div two">
                    <div class="i">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div>
                        <h5>Password</h5>
                        <input type="password" name="password" class="input">
                    </div>
                </div>
                <?php if(in_array("Invalid Login Details<br>", $error_array)) echo "Invalid Login Details<br>"; ?>
                <a href="#">Forgot Password?</a>
                <input type="submit" class="btn" value="login" name="login_button">
                <center><a href="#" style="width: fit-content;" id="signup" class="signup">Need an account? Register here</a></center>
            </form>
        </div>
    </div>
    <div class="container2" style="display: none;">
        <div class="img">
            <img class = "extra" src="assets/images/phenom2.jpg" draggable="false">
        </div>
        <div class="login-container">
            <form action="register.php" method="POST">
                <img class="avatar" src="assets/images/phenom3.png" >
                <h2>Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-user"></i>
                    </div>
                    <div>
                        <h5>First Name</h5>
                        <input type="text" name="reg_fname" class="input" value="<?php 
                            if(isset($_SESSION['reg_fname'])){
                                echo $_SESSION['reg_fname'];
                            }
                            ?>"required autocomplete="off">
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-user"></i>
                    </div>
                    <div>
                        <h5>Last Name</h5>
                        <input type="text" name="reg_lname" class="input" value="<?php 
                            if(isset($_SESSION['reg_lname'])){
                                echo $_SESSION['reg_lname'];
                            }
                            ?>"required autocomplete="off">
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div>
                        <h5>Phone Number</h5>
                        <input type="tel" name="reg_phone" class="input" value="<?php 
                        if(isset($_SESSION['reg_phone'])){
                            echo $_SESSION['reg_phone'];
                        }
                        ?>"required autocomplete="off">
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div>
                        <h5>Email</h5>
                        <input type="email" name="reg_email" class="input" value="<?php 
                        if(isset($_SESSION['reg_email'])){
                            echo $_SESSION['reg_email'];
                        }
                        ?>" required autocomplete="off">
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div>
                        <h5>Confirm Email</h5>
                        <input type="email" name="reg_email2" class="input" value="<?php 
                        if(isset($_SESSION['reg_email2'])){
                            echo $_SESSION['reg_email2'];
                        }
                        ?>" required autocomplete="off">
                        <?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>"; 
                        else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>"; 
                        else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; ?>
                    </div>
                </div>
                <div class="input-div two">
                    <div class="i">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div>
                        <h5>Password</h5>
                        <input type="password" name="reg_password" class="input">
                    </div>
                </div>
                <div class="input-div two">
                    <div class="i">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div>
                        <h5>Confirm Password</h5>
                        <input type="password" name="reg_password2" class="input">
                    </div>                    
                </div>
                <br>
                <?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>"; 
                else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>"; 
                else if(in_array("Your password must be between 5 and 30 characters<br>", $error_array)) echo "Your password must be between 5 and 30 characters<br>"; ?>
                <input type="submit" class="btn" value="login" name="register_button">
                <center><a href="#" style="width: fit-content; margin-bottom: 2em;" id="signin" class="signin">Already have an account? Sign in here!</a></center>
            </form>
        </div>
    </div>
    <script>
        $("#signup").click(function(){
            $(".container").slideUp("slow", function(){
                $(".container2").slideDown("slow");
            });
            console.log("hey world!");
        });

        $("#signin").click(function(){
            $(".container2").slideUp("slow", function(){
                $(".container").slideDown("slow");
            });
        });

        const inputs = document.querySelectorAll('.input');

        function focusFunc(){
            var parent = this.parentNode.parentNode;
            parent.classList.add('focus');
        }

        function blurFunc(){
            var parent = this.parentNode.parentNode;
            if(this.value == ""){
                parent.classList.remove('focus');
            }
        }

        inputs.forEach(input => {
            input.addEventListener('focus', focusFunc);
            input.addEventListener('blur', blurFunc);
        });

        var r_inputs = document.getElementsByClassName('input');
        for(var i=0; i<r_inputs.length; i++){
            if(r_inputs[i].value != ""){
                r_inputs[i].parentNode.parentNode.classList.add('focus');
            }
        }
    </script>
</body>
</html>