<?php
$servername = "localhost";
$username = "nova";
$password = "Raffifadlika!&55";
$db_name = "realdatabasenovatix";

$conn = new mysqli($servername, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
        $user_id = intval($_POST['user_id']); 

        echo "User ID yang diterima: " . htmlspecialchars($user_id) . "<br>";

        $sql = "SELECT * FROM info WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            die("Error dalam prepare statement: " . $conn->error);
        }

        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "Jumlah hasil: " . $result->num_rows . "<br>";

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo "Pengguna ditemukan: " . htmlspecialchars($user['name']) . "<br>";
            
            $_SESSION['user_id'] = $user['id'];

            header("Location: ../dosen");
            exit();
        } else {
            echo "Pengguna tidak ditemukan";
        }

        $stmt->close();
    } else {
        echo "User ID tidak diset atau kosong";
    }
}

$conn->close();
?>
