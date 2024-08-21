<?php
session_start();

if (!isset($_SESSION['nim'])) {
    header('Location: login');
    exit();
}

// Ambil data pengguna dari sesi
$nim = $_SESSION['nim'];

// Koneksi ke database
$conn = new mysqli('localhost', 'nova', 'Raffifadlika!&55', 'db_novatix');

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mengambil data pengguna
$sql = "SELECT * FROM users WHERE nim = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $nim);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>