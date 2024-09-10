<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['search'];
    $role = $_POST['role'];

    $servername = "localhost";
    $username = "nova";
    $password = "Raffifadlika!&55";
    $dbname = "realdatabasenovatix";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT info (title, start, end) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $start, $end);

    if ($stmt->execute()) {
        echo "Event added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
