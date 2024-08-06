<?php
include 'db_connect.php';

$judul = $_POST['judul'];
$konten = $_POST['konten'];
$file_path = '';

if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Check if the directory exists, if not create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $file_path = $target_file;
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }
}

$sql = "INSERT INTO pengumuman (judul, konten, file_path) VALUES ('$judul', '$konten', '$file_path')";

if ($conn->query($sql) === TRUE) {
    echo "<script> alert('Pengumuman berhasil ditambahkan!'); window.location.href = document.referrer;</script>";
    header('Location: ui-typography.php?nim=' . $_GET['nim']);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
