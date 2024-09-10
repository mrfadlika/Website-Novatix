<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost"; 
        $username = "nova";
        $password = "Raffifadlika!&55";
        $dbname = "realdatabasenovatix";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $name = $conn->real_escape_string($_POST['nama']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $birthdate = $conn->real_escape_string($_POST['birthdate']);
        $nim = $conn->real_escape_string($_POST['nim']);
        $password =  $conn->real_escape_string($_POST['password']);

        $sql = "INSERT INTO users (nama, email, nomor_hp, tanggal_lahir, nim, password) VALUES ('$name', '$email', '$phone', '$birthdate', '$nim', '$password')";

        if ($conn->query($sql) === TRUE) {
            header('Location: ../login');
            exit();
        } else {
            $_SESSION['error'] = "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
    ?>