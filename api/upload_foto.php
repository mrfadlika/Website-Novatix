<?php
session_start(); // Pastikan session sudah dimulai jika menggunakan session

// Koneksi ke database
$conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "db_novatix");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_SESSION['nim'];
    $upload_dir = 'uploads/';
    
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true); 
    }


    $file_name = basename($_FILES["foto_profil"]["name"]);
    $target_file = $upload_dir . $file_name;


    if (move_uploaded_file($_FILES["foto_profil"]["tmp_name"], $target_file)) {
        $sql = "UPDATE users SET foto_profil='$file_name' WHERE nim='$nim'";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Foto profil berhasil diupload!'); window.location.href = '../profile';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Tidak dapat memindahkan file yang diupload.";
    }
}

$conn->close();
?>
