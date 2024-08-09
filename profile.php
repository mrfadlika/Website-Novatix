<?php
$servername = "localhost";
$username = "root"; // sesuaikan dengan username database Anda
$password = ""; // sesuaikan dengan password database Anda
$dbname = "nim_authentication";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include 'db_foto.php'
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Novatix</title>
  <link rel="shortcut icon" type="image/png" href="images/logos/faviconnova.png" />
  <link rel="stylesheet" href="css/styles.min.css" />
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
          <a href="./main.php?nim=<?php echo $_GET['nim']; ?>" class="text-nowrap logo-img">
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
              <a class="sidebar-link" href="./main.php?nim=<?php echo $_GET['nim']; ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">TASK & EXAM</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-buttons.php?nim=<?php echo $_GET['nim']; ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Assignment</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./forms.php?nim=<?php echo $_GET['nim']; ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i> 
                </span>
                <span class="hide-menu">Forms</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-alerts.php?nim=<?php echo $_GET['nim']; ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-calendar"></i>
                </span>
                <span class="hide-menu">Calendar</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-card.php?nim=<?php echo $_GET['nim']; ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Info Dosen & Staff</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-typography.php?nim=<?php echo $_GET['nim']; ?>" aria-expanded="false">
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
              <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <?php echo "<img src='uploads/".$row['foto_profil']."' alt='' width='35' height='35' class='rounded-circle'>"; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="./profile.php?nim=<?php echo $_GET['nim']; ?>" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">Mail</p>
                    </a>
                    <a href="changePass.php?nim=<?php echo $_GET['nim']; ?>" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">Change Password</p>
                    </a>
                    <a href="./index.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
      $nim = $_GET['nim'];
    $sql = "SELECT nama, email, nomor_hp, tanggal_lahir, foto_profil FROM users WHERE nim = '$nim'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='card'><div class='card-body' style='display: flex; align-items: center;'>";
            if(!empty($row['foto_profil'])){
              echo "<img src='uploads/".$row['foto_profil']."' alt='Foto Mahasiswa' width='80' height='80' class='rounded-circle' style='margin-right: 50px'>";
            } else {
              echo "<img src='images/profile/user-1.jpg ' alt='Foto Mahasiswa' width='80' height='80' class='rounded-circle' style='margin-right: 50px'>";
            }
            echo "<div class='info' style='flex: 1;'>";
            echo "<h3 style='margin-right: 200px'>" . $row["nama"] . "</h3>";
            echo "<p>Mahasiswa</p>";  
            if(empty($row['foto_profil'])){
              echo "<label class='form-label'>Upload Foto Profil</p>";
              echo "<form action='upload_foto.php?nim=" . $_GET['nim'] . "' method='post' enctype='multipart/form-data'>";
              echo "<div><input type='file' class='form-control' id='foto_profil' name='foto_profil' required></div>";
              echo "<button type='submit' class='btn btn-primary' style='margin-top: 20px;'>Upload</button>";
              echo "</form>";
            }          
            echo "</div></div>";
            echo "<div class='card-body'><div class='personal-info'>";
            echo "<h4>Personal Information</h4><div class='info-grid'>";
            function split_name($full_name) {
              $name_parts = explode(" ", trim($full_name));
              $first_name = $name_parts[0];
              $last_name = isset($name_parts[1]) ? implode(" ", array_slice($name_parts, 1)) : "";
              return array('first_name' => $first_name, 'last_name' => $last_name);
          }
          $name = split_name($row['nama']);
            echo "<div><label>First Name</label><p>" . $name['first_name'] . "</p></div>";
            echo "<div><label>Last Name</label><p>" . $name['last_name'] . "</p></div>";
            echo "<div><label>Email</label><p>" . $row['email'] . "</p></div>";
            echo "<div><label>Phone</label><p>" . $row['nomor_hp'] . "</p></div>";
            echo "</div></div>";
            echo "<div class='address-info'><h4>Discourse</h4>";
            echo "<div class='info-grid'>";
            echo "<div><label>Prodi</label><p>Teknik Multimedia dan Jaringan</p></div>";
            echo "<div><label>Jurusan</label><p>Teknik Informatika dan Komputer</p></div>";
            echo "<div><label>Kampus</label><p>Politeknik Negeri Ujung Pandang</p></div></div></div>";
            if(empty($row['foto_profil'])){
              echo "<div><i class='ti ti-alert-octagon text-danger' style='margin-right: 20px;'></i><h7 class='fw-semibold mb-3'>Anda belum mengupload foto profil</h7></div>";
            }
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