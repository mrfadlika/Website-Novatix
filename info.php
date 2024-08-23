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
include 'api/db_foto.php'
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
.card a { 
            text-decoration: none;
            color: white;
            background-color: #25D366;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            flex: 1;
        }
.info-dosen {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #fff;
    max-width: 600px;
    margin: auto;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.dosen-profile {
    display: flex;
    align-items: center;
}

.profile-picture {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-right: 20px;
}

.dosen-details {
    display: flex;
    flex-direction: column;
}

.dosen-details h3 {
    margin: 0;
    font-size: 1.5rem;
}

.dosen-details p {
    margin: 5px 0;
    color: #666;
}
.card-body {
    max-width: 100%; 
    padding: 20px; 
}

.form-container {
    display: flex;
    width: 100%;
    max-width: 100%; 
    margin: 0 auto;
    padding: 20px; 
}

.form-container input, .form-container select, .form-container button {
    flex: 1; 
    margin-right: 20px;
}

.form-container button {
    margin-right: 0; 
    width: auto;
}

.card {
    max-width: 100%; 
    margin: 0 auto;
}

    </style>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
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
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Information Page</h5>
            <div class="row mb-4" style="margin-right: 20px">
    <form method="GET" action="info" class="form-container d-flex">
        <div class="col-md-8 w-50" style="margin-right: 20px">
            <input type="text" id="search" name="search" class="form-control" placeholder="Cari dengan Nama Dosen" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        </div>
        <div class="col-md-2 w-25" style="margin-right: 20px">
            <select id="role" name="role" class="form-select">
                <option value="">Role</option>
                <option value="staff" <?php if(isset($_GET['role']) && $_GET['role'] == 'staff') echo 'selected'; ?>>Staff</option>
                <option value="dosen" <?php if(isset($_GET['role']) && $_GET['role'] == 'dosen') echo 'selected'; ?>>Dosen</option>
            </select>
        </div>
        <div class="col-md-2 w-25">
            <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
        </div>
    </form>
</div>        
            <?php
            $servername = "localhost";
            $username = "root"; 
            $password = "";     
            $dbname = "db_novatix";  
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $role = isset($_GET['role']) ? $_GET['role'] : '';

            // Buat query SQL
            $sql = "SELECT nama, posisi, nomor_hp FROM info WHERE 1=1";

            if ($search != '') {
                $sql .= " AND nama LIKE '%$search%'";
            }
            if ($role != '') {
                $sql .= " AND role = '$role'";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='card mb-3'>";
                    echo "<div class='card-body d-flex align-items-center'>";
                    echo "<img src='images/profile/user-1.jpg' alt='Foto Dosen' width='70' height='70' class='rounded-circle me-3'>";
                    echo "<div class='flex-grow-1'>";
                    echo "<div class='d-flex align-items-center mb-2'>";
                    echo "<h3 class='mb-0 me-3' style='padding-top: 20px'>" . $row["nama"] . "</h3>";
                    echo "<span class='badge bg-primary text-white rounded-pill' style='margin-top: 20px'>" . $row["posisi"] . "</span>";
                    echo "</div>";
                    echo "<p class='mb-0' style='padding-bottom: 20px'>0" . $row["nomor_hp"] . "</p>";
                    echo "</div>";
                    echo "<button onclick=\"window.location.href='https://wa.me/62" . $row["nomor_hp"] . "'\" class='btn btn-primary'>Hubungi</button>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Tidak ada data dosen yang tersedia.</p>";
            }

            // Tutup koneksi database
            $conn->close();
            ?>
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