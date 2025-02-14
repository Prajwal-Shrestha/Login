<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "login";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Failed to connect DB: " . mysqli_connect_error());
}
?>