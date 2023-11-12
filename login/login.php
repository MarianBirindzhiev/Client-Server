<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login form</title>
</head>
<body>
    <div class="wrapper">
        <form action="code.php" method="POST">

            <div class="alert">
                <?php
                    // Check if the 'status' key is set in the session
                    if(isset($_SESSION['status']))
                    {
                        // If set, echo an <h4> HTML element with the value of 'status'
                        echo "<h4>".$_SESSION['status']."</h4>";
                        
                        // Unset the 'status' key in the session to clear the status message
                        unset($_SESSION['status']);
                    }
                ?>
            </div>

            <h1>Login</h1>
            <div class ="input-div">
                <input type="text" name="email" id="email" placeholder="Email" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-div">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            
            <button type="sumbit" name="login-btn" class="btn">Login</button>

            <div class="register-link">
                <a href="../register/register.php">Don't have an account?</a>
            </div>
        </form>
    </div>
</body>
</html>