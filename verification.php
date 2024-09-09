<?php
$servername = 'localhost';
$username = 'nova';
$password = 'Raffifadlika!&55';
$dbname = 'db_novatix';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT id, nama FROM info";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="images/logos/faviconnova.png" />
    <title>Novatix</title>
    <link rel="stylesheet" href="css/styles.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Plus Jakarta Sans, sans-serif;
            background-color: #f0f0f0;
        }
        .login-box {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2{
            margin-bottom: 20px;
        }
        select, button {
            padding: 10px;
            width: 100%;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Verifikasi</h2>
        <form method="POST" action="api/proses_verifikasi">
            <label for="user_id">Pilih Nama:</label>
            <select name="user_id" id="user_id">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                    }
                } else {
                    echo "<option>Tidak ada pengguna</option>";
                }
                ?>
            </select>
            <br><br>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</body>
</html>