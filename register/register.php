<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Registration form</title>
</head>
<body>
    <div class="wrapper">
        <form action="code.php" method="POST">
            
           <div class="alert">
                <?php
                    if(isset($_SESSION['status']))
                    {
                        echo "<h4>".$_SESSION['status']."</h4>";
                        unset($_SESSION['status']);
                    }
                ?>
            </div>

            <h1>Sign up</h1>
            <div class ="input-div">
                <input type="text" name="email" id="email" placeholder="Email" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class ="input-div">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-div">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="input-div">
                <input type="password" name="repeat-password" id="repeat-password" placeholder="Repeat password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            
            <button type="submit" name="register-btn" class="btn">Sign up</button>

            <div class="have-an-account">
                <a href="../login/login.php">Have an account?</a>
            </div>

        </form>
    </div>
</body>
</html>