<?php
include 'db_connect.php';

$id = $_POST['id'];

// Get the file path to delete the file from the server
$sql = "SELECT file_path FROM pengumuman WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!empty($row['file_path'])) {
        unlink($row['file_path']); // Delete the file from the server
    }
}

// Delete the announcement from the database
$sql = "DELETE FROM pengumuman WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "Pengumuman berhasil dihapus";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
