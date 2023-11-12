<?php

    session_start();
    include('../config/dbConnection.php');

    if(isset($_POST['login-btn']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
        $login_query_run = mysqli_query($connection,$login_query);

        if(mysqli_num_rows($login_query_run) > 0)
        {
            $row = mysqli_fetch_array($login_query_run);

            if($row['verify_status'] == "1")
            {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user'] = ['username' => $row['username']];

                header("Location: ../successfully-login/successfully-login.php");
            }
            else
            {
                $_SESSION['status'] = "Please verify your account!";
                header("Location: login.php");
                exit;
            }
        }
        else
        {
            $_SESSION['status'] = "Invalid email or password";
            header("Location: login.php");
            exit;
        }
    }

?>