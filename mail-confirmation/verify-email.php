<?php

    // Start a PHP session
    session_start();

    // Include database connection details
    include('../config/dbConnection.php');

    // Check if the 'token' parameter is set in the URL
    if(isset($_GET['token']))
    {
        // Get the token from the URL
        $token = $_GET['token'];

        // SQL query to retrieve the user with the given token and their verification status
        $verify_query = "SELECT verify_token,verify_status FROM users WHERE verify_token = '$token' LIMIT 1";
        $verify_query_run = mysqli_query($connection, $verify_query);

        // Check if there is a user with the given token
        if(mysqli_num_rows($verify_query_run) > 0)
        {
            // Fetch the user's data
            $row = mysqli_fetch_array($verify_query_run);

            // Check if the user's account is not already verified
            if($row['verify_status'] == "0")
            {
                // Update the user's verification status to '1' (verified)
                $clicked_token = $row['verify_token'];
                $update_query = "UPDATE users SET verify_status='1' WHERE verify_token='$clicked_token' LIMIT 1";
                $update_query_run = mysqli_query($connection,$update_query);

                // Check if the update query was successful
                if($update_query_run)
                {
                    $_SESSION['status'] = "Your account has been verified successfully";
                    header("Location: ../login/login.php");
                    exit;
                }
                else
                {
                    $_SESSION['status'] = "Verification failed";
                    header("Location: ../login/login.php");
                    exit;
                }
            }
            // If the user's account is already verified, redirect with a message
            else
            {
                $_SESSION['status'] = "Email already verified. Please login!";
                header("Location: ../login/login.php");
                exit;
            }
        }
        // If no user found with the given token, redirect with an error message
        else
        {
            $_SESSION['status'] = "This token does not exists!";
            header("Location: ../login/login.php");
            exit;
        }
    }
    // If 'token' parameter is not set in the URL, redirect with an error message
    else
    {
        $_SESSION['status'] = "Not allowed";
        header("Location: ../login/login.php");
        exit;
    }

?>