<?php 
    include('../config/authentication.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="successfully-login.css">
    <title>Successfully login</title>
</head>
<body>
<div class="container">

    <h2>Login Successful!</h2>
    <p>Welcome to our website, <?php echo $_SESSION['auth_user']['username']; ?>. You are now logged in.</p>
    <p><a href="logout.php" class="logout-link">Logout</a></p>
</div>
</body>
</html>