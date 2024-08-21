<?php
if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    
    $conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "input_tugas");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT penanggung_jawab FROM diketahui WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($penanggung_jawab);
        
        if ($stmt->fetch()) {
            echo $penanggung_jawab;
        } else {
            echo "Tidak ditemukan";
        }

        $stmt->close();
    } else {
        echo "Gagal menyiapkan statement";
    }
    
    $conn->close();
} else {
    echo "ID tidak ditemukan";
}
?>
