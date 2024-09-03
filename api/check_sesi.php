<?php
session_start();

if (!isset($_SESSION['nim'])) {
  $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header('Location: ../../login'); 
    exit();
}

$nim = $_SESSION['nim'];

$conn = new mysqli('localhost', 'root', '', 'db_novatix');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE nim = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $nim);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$conn->close(); 

?>