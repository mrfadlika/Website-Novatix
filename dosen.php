<?php
session_start();
$servername = "localhost";
$username = "nova"; 
$password = "Raffifadlika!&55"; 
$dbname = "db_novatix";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Novatix</title>
  <link rel="shortcut icon" type="image/png" href="images/logos/faviconnova.png" />
  <link rel="stylesheet" href="css/styles.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h3 align="center">Selamat Datang</h3>
                <p align="center">Selamat Datang di Portal Dosen Mahasiswa Teknik Multimedia dan Jaringan Angkatan 23 Kelas A</p>
                <div align="center">
                    <button class="btn btn-primary" style="margin-right: 15px">Upload Materi</button>
                    <button class="btn btn-outline-primary">Data Mahasiswa</button>
                </div>
            </div>
        </div>
    </div>
  </div>
  <script src="libs/jquery/dist/jquery.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/sideb..."></script>
</body>
</html>
