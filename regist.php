<?php
    // Memproses data form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Koneksi ke database
        $servername = "localhost"; // Ganti dengan nama server database Anda
        $username = "root";        // Ganti dengan username database Anda
        $password = "";            // Ganti dengan password database Anda
        $dbname = "nim_authentication";    // Ganti dengan nama database Anda

        // Membuat koneksi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Memeriksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Mengambil data dari form
        $name = $conn->real_escape_string($_POST['nama']);
        $nim = $conn->real_escape_string($_POST['nim']);
        $password =  $conn->real_escape_string($_POST['password']);

        // Menyimpan data ke database
        $sql = "INSERT INTO users (name, nim, password) VALUES ('$name', '$nim', '$password')";

        if ($conn->query($sql) === TRUE) {
            //echo "Registrasi berhasil!";
            header('Location: index.php');
            exit();
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
            $_SESSION['error'] = "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
    ?>