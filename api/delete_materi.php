<?php
if(isset($_POST['id'])){
    $id = $_POST['id'];

    $conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "db_novatix");

    if($conn->connect_error){
        die("Connection Failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM materi WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if($stmt->execute()) {
        echo "Data Berhasil di Hapus";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else  {
    echo "ID tidak diberikan";
}

?>