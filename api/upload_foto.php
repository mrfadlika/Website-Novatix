<?php
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "db_novatix");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah request adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_SESSION['nim'];
    $upload_dir = 'uploads/';

    // Buat direktori jika belum ada
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Dapatkan informasi file
    $file_name = basename($_FILES["foto_profil"]["name"]);
    $file_tmp_name = $_FILES["foto_profil"]["tmp_name"];
    $target_file = $upload_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png'];

    // Validasi tipe file
    if (in_array($imageFileType, $allowed_types)) {
        $check = getimagesize($file_tmp_name);

        if ($check !== false) {
            if ($imageFileType == 'jpeg') {
                $file_name = pathinfo($file_name, PATHINFO_FILENAME) . '.jpg';
                $target_file = $upload_dir . $file_name;
            }

            // Pindahkan file ke direktori tujuan
            if (move_uploaded_file($file_tmp_name, $target_file)) {
                // Siapkan dan jalankan pernyataan SQL dengan parameter untuk keamanan
                $stmt = $conn->prepare("UPDATE users SET foto_profil = ? WHERE nim = ?");
                $stmt->bind_param("ss", $file_name, $nim);

                if ($stmt->execute()) {
                    echo "<script>alert('Foto profil berhasil diupload!'); window.location.href = '../profile';</script>";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error: Tidak dapat memindahkan file yang diupload.";
            }
        } else {
            echo "Error: File bukan gambar. Info Debug: " . print_r($check, true);
        }
    } else {
        echo "Error: Hanya file JPG, JPEG, dan PNG yang diperbolehkan. Anda mengunggah: " . $imageFileType;
    }
}

$conn->close();
?>
