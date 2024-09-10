<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "nova";
$password = "Raffifadlika!&55";
$dbname = "realdatabasenovatix";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, title, start, end FROM events";
$result = $conn->query($sql);

$data = array();
$colors = array("#5d87ff", "#a0c4ff", "#87bfff", "#cce7ff", "#5dcaff", "#d0f4ff", "#98aaff");

$index = 0;
while($row = $result->fetch_assoc()) {
    if ($row['start'] === $row['end']) {
        $end = $row['end'];
    } else {
        $end = date('Y-m-d', strtotime($row['end'] . ' +1 day'));
    }
    $item = array(
        'title' => $row['title'],
        'start' => $row['start'],
        'end' => $end,
        'backgroundColor' => $colors[$index % count($colors)],
        'borderColor' => $colors[$index % count($colors)]
    );
    array_push($data, $item);
    $index++;
}

echo json_encode($data);

$conn->close();
?>
