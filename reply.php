<?php
$servername = "localhost";
$username = "nova";
$password = "Raffifadlika!&55";
$namadatabase = "realdatabasenovatix";

$conn = new mysqli($servername, $username, $password, $namadatabase);
if ($conn->connect_error) {
    die("ERR: " . $conn->connect_error);
}

// Mendapatkan ID pesan dari query parameter
$pesan_id = isset($_GET['id']) ? $_GET['id'] : '';
$tujuan_nim = '';
$subyek_asal = '';

// Mengambil data pesan untuk balasan
if ($pesan_id) {
    $sql = "SELECT send_from, subyek FROM mailing WHERE id = '$pesan_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tujuan_nim = $row['send_from'];
        $subyek_asal = $row['subyek'];
    }
}

// Ambil data pengguna untuk dropdown jika perlu
$sql_users = "SELECT nim, nama FROM users";
$result_users = $conn->query($sql_users);

$conn->close();

include 'api/check_sesi.php';
include 'api/db_foto.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="../">
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
              <a class="sidebar-link" onclick="detectDevice(event)" aria-expanded="false">
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
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Lessons</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="materi" aria-expanded="false">
                <span>
                <i class="ti ti-books"></i>
                </span>
                <span class="hide-menu">Learning</span>
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
                  <?php 
                  if(empty($row['foto_profil'])) {
                      echo "<img src='images/profile/user-1.jpg' alt='' width='35' height='35' class='rounded-circle'>";
                  } else {
                      echo "<img src='uploads/".$row['foto_profil']."' alt='' width='35' height='35' class='rounded-circle'>"; } ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="profile" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="mail" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">Mail</p>
                    </a>
                    <a href="changePass" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">Change Password</p>
                    </a>
                    <a href="./logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
        </header>
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Balas Pesan</h5>
            <div class="card">
              <div class="card-body">
                <form action="api/sendChat" method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="send_to" class="form-label">Tujuan</label>
                    <input type="text" class="form-control" id="send_to" name="send_to" value="<?php echo htmlspecialchars($tujuan_nim); ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="subyek" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subyek" name="subyek" value="<?php echo 'Re: ' . htmlspecialchars($subyek_asal); ?>" required>
                  </div>
                  <div class="mb-3">
                    <label for="isi_pesan" class="form-label">Isi Pesan</label>
                    <textarea class="form-control" id="isi_pesan" name="isi_pesan" rows="5" required></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="file" class="form-label">Upload File</label>
                    <input type="file" class="form-control" id="file" name="file">
                  </div>
                  <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
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
