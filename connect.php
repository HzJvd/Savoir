<?php
// database credentials
$servername = "localhost";
$username = "hamzah";
$password = "hamzah";
$dbname = "savoir";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>