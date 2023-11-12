<?php
    session_start();

    unset($_SESSION['authenticated']);
    unset($_SESSION['auth_user']);
    $_SESSION['status'] = "You successfully logged out!";
    header("Location: ../login/login.php");

?>