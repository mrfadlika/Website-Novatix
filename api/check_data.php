<?php
// Koneksi ke database
$conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "input_tugas");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk tugas yang sudah selesai
$completed_tasks_query = "SELECT COUNT(*) as completed FROM tugas WHERE status = '1';";
$completed_result = $conn->query($completed_tasks_query);
$jumlah_tugas_selesai = $completed_result->fetch_assoc()['completed'];

// Query untuk tugas yang belum selesai
$not_completed_tasks_query = "SELECT COUNT(*) as not_completed FROM tugas WHERE status = '0';";
$not_completed_result = $conn->query($not_completed_tasks_query);
$jumlah_tugas_belum = $not_completed_result->fetch_assoc()['not_completed'];

$conn->close();

// Pastikan nilai yang dikirimkan dijumlahkan menjadi 100%
$total_tugas = $jumlah_tugas_selesai + $jumlah_tugas_belum;

// Kirim data dalam format JSON
echo json_encode(array(
    'selesai' => $jumlah_tugas_selesai,
    'belum' => $jumlah_tugas_belum,
    'total' => $total_tugas
));
?>
