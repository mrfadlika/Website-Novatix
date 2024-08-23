<?php
$servername = "localhost";
$username = "nova";
$password = "Raffifadlika!&55"; 
$dbname = "db_novatix";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nim = $_SESSION['nim'];
$sql = "SELECT foto_profil FROM users WHERE nim = '$nim'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>