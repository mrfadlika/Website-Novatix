<?php
session_start();
$judul = $_POST['judul_materi'];
$matkul_id = $_POST['mata_kuliah'];
$konten = $_POST['deskripsi'];
$file_path = '';

$conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "realdatabasenovatix");

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT activity, penanggungjawab FROM schedules WHERE id='$matkul_id'"; 
$result = $conn->query($sql);
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $mata_kuliah = $row['mata_kuliah'];
} else {
    echo "Mata kuliah tidak ditemukan";
    $conn->close();
    exit;
}

$servername = 'localhost';
$username = 'nova';
$password = 'Raffifadlika!&55';
$dbname = 'realdatabasenovatix';

$connect = new mysqli($servername, $username, $password, $dbname);

if($connect->connect_error){
    die("Connection Failed: " . $connect->connect_error);
}



if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $target_dir = "uploads/";
    $file_name = basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if($imageFileType == 'jpeg'){
        $file_name = pathinfo($file_name, PATHINFO_EXTENSION) . '.jpg';
        $target_file = $target_dir . $file_name;
    }

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $file_path = $target_file;
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }
}

$user_id = $_SESSION['user_id'];

$sql = "INSERT INTO materi (judul, matkul, deskripsi, file_path, user_id) VALUES ('$judul', '$mata_kuliah' , '$konten', '$file_path', '$user_id')";

if ($connect->query($sql) === TRUE) {
    echo "<script> alert('Materi berhasil ditambahkan!'); window.location.href = document.referrer;</script>";
    header('Location: ../dosen');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$connect->close();
?>
