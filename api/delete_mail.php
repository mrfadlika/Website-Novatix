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

$sql = "SELECT filepath FROM mailing WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!empty($row['filepath'])) {
        unlink($row['filepath']); 
    }
}

$sql = "DELETE FROM mailing WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "Pesan berhasil dihapus";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
