<?php
$servername = "localhost";
$username = "nova";
$password = "Raffifadlika!&55";
$db_name = "realdatabasenovatix";

$conn = new mysqli($servername, $username, $password, $db_name);

if($conn->connect_error){
    die("Connection Failed:". $conn->connect_error);
}

$id = $_GET['id'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql1 = "SELECT id, nama_tugas, deadline, deskripsi FROM tugas WHERE id = ?";
    $stmt = $conn->prepare($sql1);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $current_nama_tugas = $row['nama_tugas'];
        $current_deadline = $row['deadline'];
        $current_deskripsi = $row['deskripsi'];
    }

    $nama_tugas = !empty($_POST['nama_tugas']) ? htmlspecialchars($_POST['nama_tugas'], ENT_QUOTES, 'UTF-8') : $current_nama_tugas;
    $deadline = !empty($_POST['deadline']) ? htmlspecialchars($_POST['deadline'], ENT_QUOTES, 'UTF-8') : $current_deadline;
    $deskripsi = !empty($_POST['deskripsi']) ? htmlspecialchars($_POST['deskripsi'], ENT_QUOTES, 'UTF-8') : $current_deskripsi;

    $query = "UPDATE tugas SET nama_tugas ='$nama_tugas', deadline = '$deadline', deskripsi = '$deskripsi' WHERE id = '$id'";
    mysqli_query($conn, $query);

    if ($conn->query($query) === true) {
        header("Location: ../assignment");
        exit;
    } else {
        echo "Error updating task: " . $stmt->error; 
    }
}

$sql = "SELECT * FROM tugas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
  $row = $result->fetch_assoc();
} else {
  exit;
}

$conn->close();

?>