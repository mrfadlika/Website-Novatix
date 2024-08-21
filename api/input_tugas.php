<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_tugas = $_POST['nama_tugas'];
    $mata_kuliah_id = $_POST['mata_kuliah'];
    $deadline = $_POST['deadline'];
    $deskripsi = $_POST['deskripsi'];

    $conn = new mysqli("localhost", "root", "", "input_tugas");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT mata_kuliah, penanggung_jawab FROM diketahui WHERE id='$mata_kuliah_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $mata_kuliah = $row['mata_kuliah'];
        $dosen_pengampu = $row['penanggung_jawab']; 
    } else {
        echo "Mata kuliah tidak ditemukan.";
        $conn->close();
        exit;
    }

    $sql_insert = "INSERT INTO tugas (nama_tugas, mata_kuliah, dosen_pengampu, deadline, deskripsi, status)
                   VALUES ('$nama_tugas', '$mata_kuliah', '$dosen_pengampu', '$deadline', '$deskripsi', 0)";

    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href = document.referrer;</script>";

        $chat_id = '1195226552';
        $bot_token = '7260988044:AAGOlttmGoi1kHCnp49qiPGSeNCNvzk92V0';
        $message = "Tugas baru telah ditambahkan:\n\n"
                 . "Nama Tugas: $nama_tugas\n"
                 . "Mata Kuliah: $mata_kuliah\n"
                 . "Dosen Pengampu: $dosen_pengampu\n"
                 . "Deadline: $deadline\n"
                 . "Deskripsi: $deskripsi";

        $url = "https://api.telegram.org/bot$bot_token/sendMessage?chat_id=$chat_id&text=" . urlencode($message);
        file_get_contents($url);
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
