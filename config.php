<?php
// Database credentials
define('DB_HOST', 'expiration-tracker.cq6pwi5nmmet.us-east-1.rds.amazonaws.com');
define('DB_USER', 'admin');
define('DB_PASS', 'helloworld');
define('DB_NAME', 'expiration');

// Connect to database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}