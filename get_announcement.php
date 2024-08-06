<?php
include 'db_connect.php';

$id = $_GET['id'];

$sql = "SELECT judul, konten, file_path, created_at FROM pengumuman WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<h2>" . $row["judul"] . "</h2>";
        echo "<p>" . $row["konten"] . "</p>";
        echo "<p><a href='" . $row["file_path"] . "' download>Download File</a></p>";
        echo "<p><em>Dibuat pada: " . $row["created_at"] . "</em></p>";
    }
} else {
    echo "Pengumuman tidak ditemukan.";
}

$conn->close();
?>
