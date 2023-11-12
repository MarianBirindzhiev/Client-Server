<?php

    // Database connection details
    $servername = "localhost";  // Server where the database is hosted
    $username = "root";         // Username to connect to the database
    $password = "";             // Password to connect to the database
    $dbname = "demo";           // Name of the database

    // Establish a connection to the MySQL database
    $connection = mysqli_connect($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if (!$connection) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }
?>