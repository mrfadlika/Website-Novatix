<?php
$servername = "localhost";
$username = "nova";
$password = "Raffifadlika!&55";
$dbname = "realdatabasenovatix";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include 'api/check_sesi.php';
include 'api/db_foto.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_SESSION['nim'];
  
    // Ambil data dari database untuk mendapatkan nilai awal
    $sql = "SELECT nama, email, nomor_hp FROM users WHERE nim = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $current_nama = $row['nama'];
        $current_email = $row['email'];
        $current_nomor_hp = $row['nomor_hp'];
    } else {
        exit;
    }
  
    $nama = !empty($_POST['nama']) ? htmlspecialchars($_POST['nama'], ENT_QUOTES, 'UTF-8') : $current_nama;
    $email = !empty($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : $current_email;
    $nomor_hp = !empty($_POST['nomor_hp']) ? htmlspecialchars($_POST['nomor_hp'], ENT_QUOTES, 'UTF-8') : $current_nomor_hp;

    $query = "UPDATE users SET nama='$nama', email='$email', nomor_hp='$nomor_hp' WHERE nim='$nim'";

    if (mysqli_query($conn, $query)) {
        if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] == 0) {
            $foto_profil = $_FILES['foto_profil'];
            $file_name = basename($foto_profil['name']);
            $target_file = "uploads/" . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
          
            $check = getimagesize($foto_profil['tmp_name']);
            if($check !== false) {
                if ($imageFileType == 'jpeg') {
                    $file_name = pathinfo($file_name, PATHINFO_FILENAME) . '.jpg';
                    $target_file = "uploads/" . $file_name;
                }
                if (move_uploaded_file($foto_profil['tmp_name'], $target_file)) {
                    $update_foto_query = "UPDATE users SET foto_profil='$file_name' WHERE nim='$nim'";
                    mysqli_query($conn, $update_foto_query);
                }
            }
        }
        header("Location: ../profile");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$nim = $_SESSION['nim'];
$sql = "SELECT nama, email, nomor_hp, tanggal_lahir, foto_profil FROM users WHERE nim = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nim);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
  $row = $result->fetch_assoc();
} else {
  exit;
}
?>