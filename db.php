<?php

// Insert the image name into a MySQL database
$db_host = "localhost";  // Your database host
$db_user = "root";  // Your database username
$db_pass = "";  // Your database password
$db_name = "mrtonrsek_db";  // Your database name

// Create a connection to the database
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

