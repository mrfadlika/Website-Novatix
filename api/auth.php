<?php
session_start();

// Informasi koneksi database
$host = 'localhost';
$dbname = 'db_novatix';
$username = 'nova'; // ganti dengan username MySQL Anda
$password = 'Raffifadlika!&55'; // ganti dengan password MySQL Anda

try {
    // Buat koneksi PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nim = $_POST['nim'];
        $input_password = $_POST['password'];

        // Siapkan dan jalankan query
        $stmt = $pdo->prepare("SELECT password FROM users WHERE nim = :nim");
        $stmt->bindParam(':nim', $nim);
        $stmt->execute();

        // Ambil hasil
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $stored_password = $row['password'];

            if ($input_password === $stored_password) {
                $_SESSION['logged_in'] = true;
                $_SESSION['nim'] = $nim;
                $redirect_url = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : '../index';
                unset($_SESSION['redirect_url']);
                header('Location: ' . $redirect_url);
                exit();
            } else {
                $_SESSION['error'] = "Password Salah";
            }
        } else {
            $_SESSION['error'] = "NIM Tidak Valid";
        }
        header('Location: login');
        exit();
    }
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
?>