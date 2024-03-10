<?php
$servername = "localhost";
$username = "id21964167_rondb";
$password = "Rondb82*";
$dbname = "id21964167_ron_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>