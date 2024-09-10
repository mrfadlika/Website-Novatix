<?php
$servername = 'localhost';
$username = 'nova';
$password = 'Raffifadlika!&55';
$dbname = 'realdatabasenovatix';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

$judul = $_POST['judul'];
$konten = $_POST['konten'];
$konten = $conn->real_escape_string($konten);
$file_path = '';

if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $file_path = $target_file;
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }
}

$sql = "INSERT INTO pengumuman (judul, konten, file_path) VALUES ('$judul', '$konten', '$file_path')";

if ($conn->query($sql) === TRUE) {
    echo "<script> alert('Pengumuman berhasil ditambahkan!'); window.location.href = document.referrer;</script>";
    header('Location: ../pengumuman');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
