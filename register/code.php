<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Require PHPMailer files
    require '../PHPMailer-master/src/Exception.php';
    require '../PHPMailer-master/src/PHPMailer.php';
    require '../PHPMailer-master/src/SMTP.php';

    // Start a new PHP session
    session_start();

    // Include database connection details
    include('../config/dbConnection.php');

    // Function to send email verification
    function sendemail_verification($username, $email, $verify_token)
    {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        // SMTP configuration
        $mail->isSMTP();                                                    //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                               //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                           //Enable SMTP authentication
        $mail->Username   = 's44886571@gmail.com';                          //SMTP username
        $mail->Password   = 'qgqwbssbglsnctmt';                             //SMTP password
        $mail->SMTPSecure = 'ssl';                                          //Enable implicit SSL encryption
        $mail->Port       = 465;                                            //SSL port to connect to;

        // Set sender and recipient
        $mail->setFrom('s44886571@gmail.com');                              //Add a sender
        $mail->addAddress($email);                                          //Add a recipient

        //Set email format to HTML
        $mail->isHTML(true);                                                

        // Email content
        $mail->Subject = 'Email verification';
        $email_template = 
        "
            <h2> You have registered</h2>
            <h5> Verify your email address to login with the below given link</h5>
            <br/><br/>
            <a href='http://localhost/Client-Server/mail-confirmation/verify-email.php?token=$verify_token'> Click me </a>";
        $mail->Body = $email_template;

        // Try to send the email, handle errors if any
        try 
        {
            $mail->send();
            echo 'Message has been sent';
        } 
        catch (Exception $e) 
        {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
    }

    // Check if registration form is submitted
    if(isset($_POST['register-btn']))
    {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeat-password'];
        $verify_token = md5(rand());

        //Check if password and repeated-password are the same;
        if($password !== $repeatPassword)
        {
            $_SESSION['status'] = "Passwords does not match!";
            header("Location: register.php");
            exit;
        }

        // Validate email using a regular expression
        if(!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',$email))
        {
            $_SESSION['status'] = "The email is invalid";
            header("Location: register.php");
            exit;
        }

        // Validate that the username is not empty
        if(empty($username))
        {
            $_SESSION['status'] = "The username is invalid";
            header("Location: register.php");
            exit;
        }
        
        // Check if there is a user with the same email address
        $check_email = "SELECT email FROM users WHERE email='$email' LIMIT 1";
        $check_email_query_run = mysqli_query($connection,$check_email);

        // If email already exists, redirect with an error message
        if(mysqli_num_rows($check_email_query_run) > 0)
        {
            $_SESSION['status'] = "Email already exists!";
            header("Location: register.php");
            exit;
        }
        else
        {
            // Insert user details into the database
            $query = "INSERT INTO users(email, username, password, verify_token) 
                VALUES('$email','$username','$password','$verify_token')";
            
            // Execute the query
            $query_run = mysqli_query($connection,$query);

             // If registration is successful, send verification email and redirect to confirmation page
            if($query_run)
            {
                sendemail_verification("$username","$email","$verify_token");
                header("Location: ../mail-confirmation/mail-confirmation.html"); // send to the new page
            }
            // If registration fails, redirect with an error message
            else
            {
                $_SESSION['status'] = "Registration failed!";
                header("Location: register.php");
                exit;
            }
        }
        
    }
?>