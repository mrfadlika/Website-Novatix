<?php
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "realdatabasenovatix");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT status FROM tugas WHERE id='$id'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentStatus = $row['status'];
        $newStatus = $currentStatus + 1;

        $sql = "UPDATE tugas SET status='$newStatus' WHERE id='$id'";

        if ($conn->query($sql)) {
            echo "Status tugas berhasil diupdate!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Tugas tidak ditemukan!";
    }

    $conn->close();
} else {
    echo "ID tugas tidak ditemukan!";
}
?>
