<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_tugas = $_POST['nama_tugas'];
    $mata_kuliah_id = $_POST['mata_kuliah'];  // Ini adalah ID dari mata kuliah yang dipilih
    $dosen_pengampu = $_POST['dosen_pengampu'];
    $deadline = $_POST['deadline'];
    $deskripsi = $_POST['deskripsi'];

    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "input_tugas");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil nama mata kuliah berdasarkan ID
    $sql = "SELECT mata_kuliah FROM diketahui WHERE id='$mata_kuliah_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $mata_kuliah = $result->fetch_assoc()['mata_kuliah'];
    } else {
        echo "Mata kuliah tidak ditemukan.";
        $conn->close();
        exit;
    }

    // Insert data ke tabel tugas
    $sql_insert = "INSERT INTO tugas (nama_tugas, mata_kuliah, dosen_pengampu, deadline, deskripsi, status)
                   VALUES ('$nama_tugas', '$mata_kuliah', '$dosen_pengampu', '$deadline', '$deskripsi', 0)";

    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href = document.referrer;</script>";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
