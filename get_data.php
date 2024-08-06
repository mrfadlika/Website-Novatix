<?php
header('Content-Type: application/json');

$type = $_GET['type'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($type == 'dosen') {
    $sql = "SELECT * FROM dosen";
} else {
    $sql = "SELECT * FROM staff";
}

$result = $conn->query($sql);

$data = array();

while($row = $result->fetch_assoc()) {
    $item = array(
        'name' => $row['name'],
        'email' => $row['email'],
        'phone' => $row['phone']
    );
    array_push($data, $item);
}

echo json_encode($data);

$conn->close();
?>
