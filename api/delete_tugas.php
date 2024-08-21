<?php
// Pastikan ID diberikan
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "input_tugas");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Hapus tugas berdasarkan ID
    $sql = "DELETE FROM tugas WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect kembali ke halaman daftar tugas setelah penghapusan
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID tidak diberikan.";
}
?>
