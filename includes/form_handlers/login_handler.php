<?php
    // if(isset($_COOKIE['user_login'])){
    //     $a = $_COOKIE['user_login'];
    //     $query = mysqli_query($con, "SELECT * FROM logins WHERE username='$a' AND logout='0000-00-00 00:00:00'");
    //     if(mysqli_num_rows($query)){
    //         $_SESSION['username'] = $a;
    //         header("Location: index.php");
    //         exit();
    //     }
    // }

    if(isset($_POST['login_button'])){
        $email = sanitizeString($_POST['username']);
        $passwordd = sanitizeString($_POST['password']);

        $_SESSION['log_username'] = $email;

        $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' OR username='$email'");
        // $check_database_query = "SELECT * FROM users WHERE email=? OR phone=?";
        // $stmt = mysqli_stmt_init($con);
        // if(!mysqli_stmt_prepare($stmt, $check_database_query)){
        //     echo "SQL ERROR";
        // }
        // else{
        //     mysqli_stmt_bind_param($stmt, "ss", $email, $email);
        //     mysqli_stmt_execute($stmt);
        // }
        $check_login_query = mysqli_num_rows($check_database_query);

        if($check_login_query){
            $row = mysqli_fetch_array($check_database_query);
            $username = $row['username'];
            $password = $row['password'];

            if(password_verify($passwordd, $password)){
                $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' OR phone='$email'");
                // $yes = "yes";
                // $user_closed_query = "SELECT * FROM users WHERE (email=? OR phone=?) AND user_closed=?";
                // $stmt = mysqli_stmt_init($con);
                // if(!mysqli_stmt_prepare($stmt, $user_closed_query)){
                //     echo "SQL ERROR";
                // }
                // else{
                //     mysqli_stmt_bind_param($stmt, "sss", $email, $email, $yes);
                //     mysqli_stmt_execute($stmt);
                // }
                
                // setcookie("user_login", $username, time() + (30*24*60*60));
                
                $_SESSION['username'] = $username;
                header("Location: home.php");
                exit();
            }
            else{
                array_push($error_array, "Invalid Login Details<br>");
            }
        }
        else{
            array_push($error_array, "Invalid Login Details<br>");
        }
    }

?>