<?php
    // Start or resume the session
    session_start();

   // Unset the 'authenticated' and 'auth_user' keys in the session
    unset($_SESSION['authenticated']);
    unset($_SESSION['auth_user']);

    // Set a logout status message
    $_SESSION['status'] = "You successfully logged out!";
    
     // Redirect to the login page
    header("Location: ../login/login.php");

?>