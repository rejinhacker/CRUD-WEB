<?php
$servername = "localhost";
$username = "admin";
$password = "Toiohomai1234";
$dbname = "scpdata";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
