<?php
$servername = 'localhost';
$username = 'nova';
$password = 'Raffifadlika!&55';
$dbname = 'realdatabasenovatix';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

$id = $_POST['id'];

$sql = "SELECT file_path FROM pengumuman WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!empty($row['file_path'])) {
        unlink($row['file_path']); 
    }
}

$sql = "DELETE FROM pengumuman WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "Pengumuman berhasil dihapus";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
