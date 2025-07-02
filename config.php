<?php
// config.php

$host = 'mysql.railway.internal';
$db   = 'railway';
$user = 'root';
$pass = 'wdoDcTImfbeaHaRXlJxKOtvKfTPiGsnV';
$port = 3306;

$conn = new mysqli($host, $user, $pass, $db, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
