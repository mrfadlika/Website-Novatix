<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Koneksi ke database
$servername = 'localhost';
$username = 'nova';
$password = 'Raffifadlika!&55';
$dbname = 'realdatabasenovatix';

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi database
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Ambil nama mahasiswa dari tabel user berdasarkan NIM dari session
$nim = $_SESSION['nim'];
$sql_user = "SELECT nama FROM users WHERE nim = '$nim'";
$result_user = $conn->query($sql_user);

if ($result_user->num_rows > 0) {
    $row = $result_user->fetch_assoc();
    $nama_mahasiswa = $row['nama'];
} else {
    echo "User tidak ditemukan.";
    exit();
}

if (isset($_POST['submit'])) {
    echo "Form dikirim dengan metode POST.<br>";
    echo "Dosen Tujuan: " . $_POST['dosen_tujuan'] . "<br>";
    echo "File Upload: " . $_FILES['file_upload']['name'] . "<br>";
    
    if (!empty($_POST['dosen_tujuan']) && isset($_FILES['file_upload'])) {
        $dosen_tujuan = $_POST['dosen_tujuan'];
        $deskripsi = $_POST['deskripsi']; // Perbaiki kesalahan ketik di sini
        $file_tmp = $_FILES['file_upload']['tmp_name'];
        $upload_dir = "uploads/";
        $file_name = $upload_dir . $_FILES['file_upload']['name'];

        // Cek apakah folder uploads ada dan dapat ditulisi
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true); 
        }

        // Cek apakah file berhasil di-upload
        if (move_uploaded_file($file_tmp, $file_name)) {
            // Gunakan prepared statements untuk menghindari SQL injection
            $stmt = $conn->prepare("INSERT INTO kumpul_tugas (dosen_tujuan, file_upload, nama_mahasiswa, deskripsi) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('isss', $dosen_tujuan, $file_name, $nama_mahasiswa, $deskripsi);

            // Cek apakah query berhasil dijalankan
            if ($stmt->execute()) {
                echo "Tugas Berhasil dikumpulkan!";
                echo "alert('Berhasil dikumpulkan!')";
                header("Location: ../kumpul_tugas"); // Pastikan ini adalah URL yang benar
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "File gagal di-upload.";
        }
    } else {
        echo "Dosen tujuan atau file belum diisi.";
    }
}

// Tutup koneksi database
$conn->close();
?>
