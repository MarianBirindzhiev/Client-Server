<?php
    // Start or resume the session
    session_start();

    if(!isset($_SESSION['authenticated']))
    {
        // If not authenticated, set a status message and redirect to the login page
        $_SESSION['status'] = "Please login!";

         // Redirect to the login page
        header("Location: ../login/login.php");

        // Terminate script execution to ensure immediate redirection
        exit; 
    }

?>