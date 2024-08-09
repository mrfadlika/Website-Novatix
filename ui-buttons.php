<?php include 'db_foto.php' ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Novatix</title>
  <link rel="shortcut icon" type="image/png" href="images/logos/faviconnova.png" />
  <link rel="stylesheet" href="css/styles.min.css" />
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
            max-width: 200px; /* Sesuaikan dengan lebar kolom yang diinginkan */
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
              <a class="sidebar-link" href="./main.php?nim=<?php echo $_GET['nim'];?>" aria-expanded="false">
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
              <a class="sidebar-link" href="./ui-forms.php?nim=<?php echo $_GET['nim']; ?>" aria-expanded="false">
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
              <a class="sidebar-link" href="./ui-card.php?nim=<?php echo $_GET['nim'];?>" aria-expanded="false">
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
              <a href="https://wa.me/62882020802944" target="_blank" class="btn btn-primary">Hubungi Admin</a>
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
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <!-- <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Buttons</h5>
              <div class="card">
                <div class="card-body p-4">
                  <button type="button" class="btn btn-primary m-1">Primary</button>
                  <button type="button" class="btn btn-secondary m-1">Secondary</button>
                  <button type="button" class="btn btn-success m-1">Success</button>
                  <button type="button" class="btn btn-danger m-1">Danger</button>
                  <button type="button" class="btn btn-warning m-1">Warning</button>
                  <button type="button" class="btn btn-info m-1">Info</button>
                  <button type="button" class="btn btn-light m-1">Light</button>
                  <button type="button" class="btn btn-dark m-1">Dark</button>
                  <button type="button" class="btn btn-link m-1">Link</button>
                </div>
              </div>
              <h5 class="card-title fw-semibold mb-4">Outline buttons</h5>
              <div class="card mb-0">
                <div class="card-body p-4">
                  <button type="button" class="btn btn-outline-primary m-1">Primary</button>
                  <button type="button" class="btn btn-outline-secondary m-1">Secondary</button>
                  <button type="button" class="btn btn-outline-success m-1">Success</button>
                  <button type="button" class="btn btn-outline-danger m-1">Danger</button>
                  <button type="button" class="btn btn-outline-warning m-1">Warning</button>
                  <button type="button" class="btn btn-outline-info m-1">Info</button>
                  <button type="button" class="btn btn-outline-light m-1">Light</button>
                  <button type="button" class="btn btn-outline-dark m-1">Dark</button>
                  <button type="button" class="btn btn-outline-link m-1">Link</button>
                </div>
              </div>
            </div> -->
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
        $conn = new mysqli("localhost", "root", "", "input_tugas");
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
                fetch('delete_tugas.php', {
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
                fetch('update_status.php', {
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
  <script src="js/sidebarmenu.js"></script>
  <script src="js/app.min.js"></script>
  <script src="libs/simplebar/dist/simplebar.js"></script>
</body>

</html>