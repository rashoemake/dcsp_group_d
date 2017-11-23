<?php
    // Database connection settings
    $hostname = "localhost";
    $database = "bindr";
    $username = "root";
    $password = "";

    $conn = new mysqli($hostname, $username, $password, $database);
    if ($conn->connect_error) {
        die($conn->connect_error);
    }
?>