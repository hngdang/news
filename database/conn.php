<?php
$servername = "us-cdbr-east-06.cleardb.net";
$username = "b8e5aa523d6d38";
$password = "9f31179e";
$db = "heroku_00de4ac6f63d075";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>