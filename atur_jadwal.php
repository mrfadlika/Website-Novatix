<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "jadwal");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan hari ini dalam format nama hari (Senin, Selasa, dst.)
$today = date('l');

// Query untuk mendapatkan jadwal hari ini
$sql = "SELECT subject, activity FROM schedules WHERE day = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();

// Menyimpan jadwal ke dalam array
$todaySchedule = [];
while ($row = $result->fetch_assoc()) {
    $todaySchedule[] = $row;
}

$stmt->close();
$conn->close();
?>
