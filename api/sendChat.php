<?php
session_start();
$servername = 'localhost';
$username = 'nova';
$password = 'Raffifadlika!&55';
$dbname = 'realdatabasenovatix';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

$tujuan = $_POST['send_to'];
$dari = $_SESSION['nim'];
$subyek = $_POST['subyek'];
$isi = $_POST['isi_pesan'];
$filepath = '';

if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $filepath = $target_file;
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }
}

$sql = "INSERT INTO mailing (send_to, send_from, subyek, isi_pesan, filepath, tanggal_kirim) 
        VALUES ('$tujuan', '$dari', '$subyek', '$isi', '$filepath', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Pesan berhasil terkirim'); window.location.href = document.referrer;</script>";
    header('Location: ../mail');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
