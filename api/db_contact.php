<?php
$servername = "localhost";
$username = "nova";  
$password = "Raffifadlika!&55";     
$dbname = "realdatabasenovatix";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$role = isset($_GET['role']) ? $_GET['role'] : '';

$sql = "SELECT nama, role, nomor_hp FROM info WHERE 1=1";

if ($search != '') {
    $sql .= " AND nama LIKE '%$search%'";
}
if ($role != '') {
    $sql .= " AND role = '$role'";
}

$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "Tidak ada data yang ditemukan";
}

header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
