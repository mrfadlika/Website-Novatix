<?php
$servername = "localhost";
$username = "nova";
$password = "Raffifadlika!&55";
$dbname = "db_novatix";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include 'api/check_sesi.php';
include 'api/db_foto.php';
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
    .profile-container {
    max-width: 800px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.profile-header h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

.profile-details {
    display: flex;
    align-items: center;
    margin-bottom: 40px;
}

.profile-picture {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-right: 20px;
}

.profile-info h2 {
    font-size: 20px;
    margin: 0;
}

.profile-info p {
    margin: 2px 0;
    color: #666;
}

.personal-info, .address-info {
    margin-bottom: 20px;
}

.personal-info h2, .address-info h2 {
    font-size: 18px;
    margin-bottom: 10px;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

label {
    font-weight: bold;
    color: #333;
}

p {
    margin: 5px 0;
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
              <a href="https:wa.me/62882020802944" target="_blank" class="btn btn-primary">Hubungi Admin</a>
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
                    <a href="mail" class="d-flex align-items-center gap-2 dropdown-item">
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
      <div class="container-fluid"> <div class="profile-header">
      <h5 class="card-title fw-semibold mb-4">My Profile</h5>
      <?php
$nim = $_SESSION['nim'];

// Query untuk mengambil data mahasiswa berdasarkan NIM
$sql = "SELECT nama, email, nomor_hp, tanggal_lahir, foto_profil FROM users WHERE nim = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nim);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='card'><div class='card-body' style='display: flex; align-items: center;'>";
        
        // Cek apakah foto profil tersedia
        if (!empty($row['foto_profil'])) {
            echo "<img src='uploads/".$row['foto_profil']."' alt='Foto Mahasiswa' width='80' height='80' class='rounded-circle' style='margin-right: 50px'>";
        } else {
            echo "<img src='images/profile/user-1.jpg' alt='Foto Mahasiswa' width='80' height='80' class='rounded-circle' style='margin-right: 50px'>";
        }
        
        echo "<div class='info' style='flex: 1;'>";
        if (!empty($row['nama'])){
          echo "<h3 style='margin-right: 200px'>" . $row["nama"] . "</h3>";
        } else {
          echo "<h3 style='margin-right: 200px'>-</h3>";
        }
        echo "<p>Mahasiswa</p>";
        
        // Jika foto profil belum diunggah, tampilkan form upload
        // if (empty($row['foto_profil'])) {
        //     echo "<label class='form-label'>Upload Foto Profil</label>";
        //     echo "<form action='api/upload_foto' method='post' enctype='multipart/form-data'>";
        //     echo "<div><input type='file' class='form-control' id='foto_profil' name='foto_profil' required></div>";
        //     echo "<button type='submit' class='btn btn-primary' style='margin-top: 20px;'>Upload</button>";
        //     echo "</form>";
        // }
        
        echo "</div></div>";
        
        echo "<div class='card-body'><div class='personal-info'>";
        echo "<h4>Personal Information</h4><div class='info-grid'>";
        
        // Split nama menjadi nama depan dan belakang
        // function split_name($full_name) {
        //     $name_parts = explode(" ", trim($full_name));
        //     $first_name = $name_parts[0];
        //     $last_name = isset($name_parts[1]) ? implode(" ", array_slice($name_parts, 1)) : "";
        //     return array('first_name' => $first_name, 'last_name' => $last_name);
        // }
        
        // $name = split_name($row['nama']);
        if(!empty($row['nama'])) {
          echo "<div><label>Name</label><p>" . $row['nama'] . "</p></div>";
        } else {
          echo "<div><label>Name</label><p>-</p></div>";
        }

        echo "<div><label>NIM</label><p>" . $_SESSION['nim'] . "</p></div>";

        if(!empty($row['email'])){
          echo "<div><label>Email</label><p>" . $row['email'] . "</p></div>";  
        } else {
          echo "<div><label>Email</label><p>-</p></div>";
        }

        if(!empty($row['nomor_hp'])){
          echo "<div><label>Phone</label><p>" . $row['nomor_hp'] . "</p></div>";
        } else {
          echo "<div><label>Phone</label><p>-</p></div>";
        }

        echo "</div></div>";
        
        echo "<div class='address-info'><h4>Discourse</h4>";
        echo "<div class='info-grid'>";
        echo "<div><label>Kampus</label><p>Politeknik Negeri Ujung Pandang</p></div>";
        echo "<div><label>Jurusan</label><p>Teknik Informatika dan Komputer</p></div>";
        echo "<div><label>Prodi</label><p>Teknik Multimedia dan Jaringan</p></div></div></div>";


        if (empty($row['nama']) || empty($row['email']) || empty($row['nomor_hp']) || empty($row['foto_profil'])) {
          echo "<div><i class='ti ti-alert-octagon text-danger' style='margin-right: 20px;'></i><h7 class='fw-semibold mb-3'>Anda belum melengkapi data anda</h7></div>";
        }

        echo "<a href='profile/edit' class='btn btn-primary' style='margin-top: 20px'>Edit Profile</a>";
        
    }
} else {
    echo "<p>Tidak ada data mahasiswa</p>";
}
?>

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