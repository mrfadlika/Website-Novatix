<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "nim_authentication";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nim = $_GET['nim'];
$sql = "SELECT nama, email, nomor_hp, tanggal_lahir, foto_profil FROM users WHERE nim = '$nim'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>