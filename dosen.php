<?php
session_start();

if(!isset($_SESSION['user_id'])){
  header("Location: verification");
}
$servername = "localhost";
$username = "nova"; 
$password = "Raffifadlika!&55"; 
$dbname = "realdatabasenovatix";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_SESSION['user_id'];
$sql = "SELECT * FROM info WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
  $user = $result->fetch_assoc();
  $name = $user['nama'];
} else {
  echo "Dosen tidak ditemukan";
  exit();
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
  <style>
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 12px 15px;
            vertical-align: middle;
            word-wrap: break-word;
        }

        .description {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            position: relative;
        }

        .description.expanded {
            white-space: normal;
        }

        .toggle-description {
            color: #007bff;
            cursor: pointer;
            display: block;
            margin-top: 5px;
        }
    </style>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h3 align="center">Selamat Datang</h3>
                <p align="center">Selamat Datang <?php echo $name ?> di Portal Dosen Mahasiswa Teknik Multimedia dan Jaringan Angkatan 23 Kelas A</p>
                <div align="center">
                    <a href="dosen/add/tugas" class="btn btn-outline-primary" style="margin-right: 15px">Upload Tugas</a>
                    <a href="dosen/add/materi" class="btn btn-primary" style="margin-right: 15px">Upload Materi</a>
                    <a href="#" class="btn btn-outline-primary">Data Mahasiswa</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
          <div class="container-fluid">
          <div class="card">
          <div class="card-body">
            <h3 align="center">Materi dari Anda</h3>
            <div class="table-responsive">
              <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                  <tr>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Judul Materi</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Deskripsi</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Dibuat Pada</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Aksi</h6>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "realdatabasenovatix");

                  if($conn->connect_error){
                    die("Connection Failed:" . $conn->connect_error);
                  }
                  $user_id = $_SESSION['user_id'];
                  $sql = "SELECT id, judul, deskripsi, created_at FROM materi WHERE user_id='$user_id '";
                  $result = $conn->query($sql);

                  if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                      $description = $row['deskripsi'];
                      $descriptionLines = explode(' ', $description);
                      $shortDescription = implode(' ', array_slice($descriptionLines, 0, 5));
                      if (count($descriptionLines) > 5) {
                        $shortDescription .= '...';
                      }

                      $actionText = "<span class='ti ti-trash fs-6' style='margin-right: 20px' onclick='deleteMateri(" . $row['id'] . ")'></span>";

                      echo "<tr>";
                      echo "<td>" . $row['judul'] . "</td>";
                      echo "<td>
                        <div class='description'>
                          <span class='description-text'>" . $row['deskripsi'] . "</span>
                          <a href='#' class='toggle-description' data-id='" . $row['id'] . "'>Lihat Selengkapnya</a>
                        </div>
                      </td>";
                      echo "<td>" . $row['created_at'] . "</td>";
                      echo "<td style='cursor: pointer'>" . $actionText . "</td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='6'>Tidak ada data materi</td></tr>";
                  }

                  $conn->close();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
          </div>
        </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggles = document.querySelectorAll('.toggle-description');
        toggles.forEach(toggle => {
            const descriptionDiv = toggle.closest('.description');
            const descriptionText = descriptionDiv.querySelector('.description-text').textContent;
            const wordCount = descriptionText.trim().split(/\s+/).length;

            if (wordCount <= 5) {
                toggle.style.display = 'none';
            }

            toggle.addEventListener('click', function(event) {
                event.preventDefault();

                if (descriptionDiv.classList.contains('expanded')) {
                    this.textContent = 'Lihat Selengkapnya';
                } else {
                    this.textContent = 'Lihat Lebih Sedikit';
                }

                descriptionDiv.classList.toggle('expanded');
            });
        });
    });
</script>
  <script>
    function deleteMateri(id) {
      if(confirm("Apakah anda yakin ingin menghapus materi ini?")) {
        fetch('api/delete_materi', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: 'id=' + id
        })
        .then(response => response.text())
        .then(data => {
          alert(data);
          location.reload();
        });
      }
    }
  </script>
  <script src="libs/jquery/dist/jquery.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/sideb..."></script>
</body>
</html>
