<?php
session_start();

$conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "realdatabasenovatix");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$password_lama = $_POST['old_password'];
$nim = $_SESSION['nim']; 

$sql = "SELECT password FROM users WHERE nim = '$nim'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($password_lama == $row['password']) {
    echo 'valid';
} else {
    echo 'invalid';
}

$conn->close();
?>
