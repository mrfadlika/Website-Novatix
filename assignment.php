<?php
session_start();

if (!isset($_SESSION['nim'])) {
  $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header('Location: login'); 
    exit();
}

$nim = $_SESSION['nim'];

$conn = new mysqli('localhost', 'root', '', 'db_novatix');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE nim = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $nim);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$conn->close(); 
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Novatix</title>
  <link rel="shortcut icon" type="image/png" href="images/logos/faviconnova.png" />
  <link rel="stylesheet" href="css/styles.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@1.39.1/iconfont/tabler-icons.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
  <style>
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        #receipt-content {
            width: 100%;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
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
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="index" class="text-nowrap logo-img">
            <img src="images/logos/logoNova.svg" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="index" aria-expanded="false">
                <span>
                  <i class="ti ti-home"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">TASK & EXAM</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="assignment" aria-expanded="false">
                <span>
                <i class="ti ti-list-check"></i>
                </span>
                <span class="hide-menu">Assignment</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="forms" aria-expanded="false">
                <span>
                  <i class="ti ti-file-upload"></i>
                </span>
                <span class="hide-menu">Forms</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="calendar" aria-expanded="false">
                <span>
                  <i class="ti ti-calendar"></i>
                </span>
                <span class="hide-menu">Calendar</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="info" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Info Dosen & Staff</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="pengumuman" aria-expanded="false">
                <span>
                  <i class="ti ti-bell-ringing"></i>
                </span>
                <span class="hide-menu">Announcement</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <a href="https://wa.me/62882020802944" target="_blank" class="btn btn-primary">Hubungi Admin</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <?php if(empty($row['foto_profil'])) {
                      echo "<img src='images/profile/user-1.jpg' alt='' width='35' height='35' class='rounded-circle'>";
                  } else {
                      echo "<img src='uploads/".$row['foto_profil']."' alt='' width='35' height='35' class='rounded-circle'>"; } ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="./profile" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">Mail</p>
                    </a>
                    <a href="changePass" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">Change Password</p>
                    </a>
                    <a href="logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div id="receipt-content">
            <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Nama Tugas</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Mata Kuliah</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Deadlines</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Deskripsi</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Status</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Aksi</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
        // Koneksi ke database
        $conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "input_tugas");
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Ambil data dari tabel tugas
        $sql = "SELECT id, nama_tugas, mata_kuliah, deadline, deskripsi, status FROM tugas ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $statusText = $row['status'] ? "<span class='badge bg-secondary rounded-3 fw-semibold'>Selesai</span>" : "<span class='badge bg-danger rounded-3 fw-semibold'>Belum Selesai</span>";

                $description = $row['deskripsi'];
                $descriptionLines = explode(' ', $description);
                $shortDescription = implode(' ', array_slice($descriptionLines, 0, 5));
                if (count($descriptionLines) > 5) {
                    $shortDescription .= '...';
                }
                
                $actionText = "<span class='ti ti-trash fs-6' style='margin-right: 20px' onclick='deleteTugas(" . $row['id'] . ")'></span>";
                if ($row['status'] == 0) {
                  $actionText .= " <span class='ti ti-circle-check fs-6' onclick='updateStatus(" . $row['id'] . ")'></span>";
                }
                  
                echo "<tr>";
                echo "<td>" . $row['nama_tugas'] . "</td>";
                echo "<td>" . $row['mata_kuliah'] . "</td>";
                echo "<td>" . $row['deadline'] . "</td>";
                echo "<td>
                <div class='description'>
                    <span class='description-text'>" . $description . "</span>
                    <a href='#' class='toggle-description' data-id='" . $row['id'] . "'>Lihat Selengkapnya</a>
                </div>
              </td>";
                echo "<td>" . $statusText . "</td>";
                echo "<td>" . $actionText . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data tugas</td></tr>";
        }

        $conn->close();
        ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <button class="btn btn-outline-secondary m-1" onclick="generatePDF()">Generate PDF</button>
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
          function deleteTugas(id) {
            if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                fetch('api/delete_tugas', {
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
          function updateStatus(id) {
            if (confirm('Apakah Anda yakin telah menyelesaikan tugas ini?')) {
                fetch('api/update_status', {
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script>
        function generatePDF() {
            html2canvas(document.getElementById('receipt-content')).then(function(canvas) {
                var imgData = canvas.toDataURL('image/png');
                var doc = new jsPDF('landscape', 'mm', 'a4');
                var imgWidth = 297;
                var pageHeight = 210;
                var imgHeight = canvas.height * imgWidth / canvas.width;
                var heightLeft = imgHeight;

                var position = 0;

                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
                doc.save('pdf_tugas.pdf');
            });
        }
    </script>
  <script src="libs/jquery/dist/jquery.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/sidebarmenu.js"></script>
  <script src="js/app.min.js"></script>
  <script src="libs/simplebar/dist/simplebar.js"></script>
</body>

</html>