<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password_lama = $_POST['old_password'];
    $password_baru = $_POST['new_password'];
    $ulangi_password_baru = $_POST['confirm_password'];
    $nim = $_SESSION['nim'];

    $conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "realdatabasenovatix");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT password FROM users WHERE nim = '$nim'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($password_lama == $row['password']) {
        if ($password_baru == $ulangi_password_baru) {
            $update_sql = "UPDATE users SET password='$password_baru' WHERE nim='$nim'";

            if ($conn->query($update_sql) === TRUE) {
                echo "<script>alert('Password berhasil diubah!'); window.location.href = '../index';</script>";
            } else {
                echo "<script>alert('Gagal mengubah password.'); window.location.href = '../changePass';</script>";
            }
        } else {
            echo "<script>alert('Password baru dan konfirmasi tidak cocok.'); window.location.href = '../changePass';</script>";
        }
    } else {
        echo "<script>alert('Password lama salah.'); window.location.href = '../changePass.php';</script>";
    }

    $conn->close();
}
?>
