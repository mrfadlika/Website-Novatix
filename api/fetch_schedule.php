<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "nova";
$password = "Raffifadlika!&55";
$dbname = "realdatabasenovatix";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$day = date('l'); 

$sql = "SELECT subject, activity FROM schedules WHERE day='$day'";
$result = $conn->query($sql);

$schedules = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $schedules[] = $row;
    }
} 

echo json_encode($schedules);

$conn->close();
?>
