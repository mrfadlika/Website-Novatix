<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("Location: verification");
  exit();
} 

$user_id = $_SESSION['user_id'];

$conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "realdatabasenovatix");

if($conn->connect_error){
  die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM info WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$conn->close();
$stmt->close();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="../../">
  <title>Novatix</title>
  <link rel="shortcut icon" type="image/png" href="images/logos/faviconnova.png" />
  <link rel="stylesheet" href="css/styles.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
  <script>
        function detectDevice(event) {
            event.preventDefault();
            var userAgent = navigator.userAgent.toLowerCase();
            var isMobile = /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(userAgent);

            if (isMobile) {
                window.location.href = "information_page";
            } else {
                window.location.href = "info";
            }
        }
  </script>
</head>

<body>
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Tambahkan Materi</h5>
              <a href="dosen" class="btn btn-outline-primary" style="margin-right: 10px"><i class="ti ti-arrow-left"></i></a>
              <a href="dosen/add/tugas" class="btn btn-outline-primary"><i class="ti ti-plus" style="margin-right: 5px"></i>Tambahkan Tugas Baru</a>
              <div class="card">
                <div class="card-body">
                  <form action="api/db_materi" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label for="judul_materi" class="form-label">Judul Materi</label>
                      <input type="text" class="form-control" id="judul_materi" name="judul_materi" required>
                    </div>
                    <div class="mb-3">
                      <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
                      <select id="mata_kuliah" class="form-control" name="mata_kuliah" required>
                        <option selected disabled>Pilih Mata Kuliah</option>
                        <?php
            // Koneksi ke database
            $conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "realdatabasenovatix");
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            $sql = "SELECT id, activity FROM schedules";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['activity'] . "</option>";
                }
            } else {
                echo "<option value=''>Tidak ada data</option>";
            }

            $conn->close();
            ?>
                      </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Materi</label>
                        <textarea id="deskripsi" class="form-control" name="deskripsi" rows="4" cols="50" required></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="file" class="form-label">Upload File</label>
                      <input type="file" class="form-control" id="file" name="file">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="libs/jquery/dist/jquery.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/sidebarmenu.js"></script>
  <script src="js/app.min.js"></script>
  <script src="libs/simplebar/dist/simplebar.js"></script>
</body>

</html>