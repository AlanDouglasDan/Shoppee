<?php
    $fname="";
    $lname="";
    $phone = "";
    $em="";
    $em2="";
    $password="";
    $password2="";
    $error_array=array();

    if(isset($_POST['register_button'])){
        
        $fname = strip_tags($_POST['reg_fname']);
        $fname = str_replace(' ', '', $fname);
        $fname = ucfirst(strtolower($fname));
        $_SESSION['reg_fname'] = $fname;

        $lname = strip_tags($_POST['reg_lname']);
        $lname = str_replace(' ', '', $lname);
        $lname = ucfirst(strtolower($lname));
        $_SESSION['reg_lname'] = $lname;


        $phone = strip_tags($_POST['reg_phone']);
        $_SESSION['reg_phone'] = $phone;

        $em = strip_tags($_POST['reg_email']);
        $em = str_replace(' ', '', $em);
        $em = ucfirst(strtolower($em));
        $_SESSION['reg_email'] = $em;

        $em2 = strip_tags($_POST['reg_email2']);
        $em2 = str_replace(' ', '', $em2);
        $em2 = ucfirst(strtolower($em2));
        $_SESSION['reg_email2'] = $em2;

        $password = strip_tags($_POST['reg_password']);

        $password2 = strip_tags($_POST['reg_password2']);

        $date = date("Y-m-d");

        if($em == $em2){
            if(filter_var($em, FILTER_VALIDATE_EMAIL)){
                $em = filter_var($em, FILTER_VALIDATE_EMAIL);

                $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

                $num_rows = mysqli_num_rows($e_check);

                if($num_rows > 0){
                    array_push($error_array, "Email already in use<br>");
                }
            }

            else{
                array_push($error_array, "Invalid email format<br>");
            }
        }
        else{
            array_push($error_array, "Emails don't match<br>");
        }

        if(strlen($fname) > 25 || strlen($fname) < 2){
            array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
        }

        if(strlen($lname) > 25 || strlen($lname) < 2){
            array_push($error_array, "Your last name must be between 2 and 25 characters<br>");
        }

        if($password != $password2){
            array_push($error_array, "Your passwords do not match<br>");
        }
        else{
            if(preg_match('/[^A-Za-z0-9]/', $password)){
                array_push($error_array, "Your password can only contain english characters or numbers<br>");
            }
        }

        if(strlen($password) > 30 || strlen($password) < 5){
            array_push($error_array, "Your password must be between 5 and 30 characters<br>");
        }

        if(empty($error_array)){
            $password = password_hash($password, PASSWORD_DEFAULT);

            $username = strtolower($fname . "_" . $lname);
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

            $i = 1;
            $name = $username; 
            //if username exists add number to username
            while(mysqli_num_rows($check_username_query) != 0) {
                $i++; //Add 1 to i
                $username = $name . "_" . $i;
                $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
            }

            $id = "";
            $userc = $usec = 0;
            $aaa = 'no';
            $ccc = ',';

            $query = "INSERT INTO users (id, first_name, last_name, username, password, email, signup_date, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($con);
            if(!mysqli_stmt_prepare($stmt, $query)){
                alert("SQL ERROR");
            }
            else{
                mysqli_stmt_bind_param($stmt, "isssssss", $id, $fname, $lname, $username, $password, $em, $date, $phone);
                mysqli_stmt_execute($stmt);
            }

            $_SESSION['reg_fname'] = "";
            $_SESSION['reg_lname'] = "";
            $_SESSION['reg_phone'] = "";
            $_SESSION['reg_email'] = "";
            $_SESSION['reg_email2'] = "";
            
            $_SESSION['username'] = $username;
            header('location: home.php');
        }
    }

?>