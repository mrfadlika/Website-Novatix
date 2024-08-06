<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jadwal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$day = date('l'); // Get today's day

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
