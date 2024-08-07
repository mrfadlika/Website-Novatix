<?php
$conn = new mysqli("localhost", "root", "", "jadwal");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$today = date('l');

$sql = "SELECT subject, activity FROM schedules WHERE day = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();

$todaySchedule = [];
while ($row = $result->fetch_assoc()) {
    $todaySchedule[] = $row;
}

$stmt->close();
$conn->close();
?>
