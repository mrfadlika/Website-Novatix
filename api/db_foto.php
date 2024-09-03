<?php
$servername = "localhost";
$username = "nova";
$password = "Raffifadlika!&55"; 
$dbname = "db_novatix";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed:" . $conn->connect_error);
}

if(isset($_SESSION['nim'])) {
    $nim = $_SESSION['nim'];
    $sql = "SELECT foto_profil FROM users WHERE nim = '$nim'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        $row = null;
    }
} else {
    $row = null;
}

?>