<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jadwal";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$today = date('l'); // Ambil hari saat ini, misal "Monday"
$current_time = date('H:i'); // Ambil waktu saat ini, misal "10:00"

$query = "SELECT * FROM schedules    WHERE day = '$today' ORDER BY activity ASC";
$result = mysqli_query($conn, $query);

$ongoing_subject = '';
$upcoming_subject = '';
while($row = mysqli_fetch_assoc($result)) {
    $time_range = explode('-', $row['activity']);
    $start_time = $time_range[0];
    $end_time = $time_range[1];

    if($current_time >= $start_time && $current_time <= $end_time) {
        $ongoing_subject = $row['subject'];
        break;
    } elseif ($current_time < $start_time) {
        $upcoming_subject = $row['subject'];
        break;
    }
}

$conn->close(); // Menutup koneksi database
?>