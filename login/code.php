<?php

    // Start a PHP session
    session_start();

    // Include database connection details
    include('../config/dbConnection.php');

    // Check if the login form is submitted
    if(isset($_POST['login-btn']))
    {
        // Get the email and password from the submitted form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // SQL query to retrieve user data based on provided email and password
        $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
        $login_query_run = mysqli_query($connection,$login_query);

        // Check if a user with the given credentials exists
        if(mysqli_num_rows($login_query_run) > 0)
        {
            // Fetch user data
            $row = mysqli_fetch_array($login_query_run);

            // Check if the user's account is verified
            if($row['verify_status'] == "1")
            {
                // Set authentication status and user data in the session
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user'] = ['username' => $row['username']];

                // Redirect to the successful login page
                header("Location: ../successfully-login/successfully-login.php");
            }
            // If the user's account is not verified, redirect with a verification message
            else
            {
                $_SESSION['status'] = "Please verify your account!";
                header("Location: login.php");
                exit;
            }
        }
        // If no user found with the given credentials, redirect with an error message
        else
        {
            $_SESSION['status'] = "Invalid email or password";
            header("Location: login.php");
            exit;
        }
    }

?>