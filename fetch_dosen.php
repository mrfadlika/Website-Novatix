<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "input_tugas");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT penanggung_jawab FROM diketahui WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['penanggung_jawab'];
    } else {
        echo "Tidak ditemukan";
    }

    $conn->close();
}
?>
