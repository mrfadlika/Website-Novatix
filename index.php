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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@1.39.1/iconfont/tabler-icons.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
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
              <a class="sidebar-link" href="./forms" aria-expanded="false">
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
      <div class="row">
    <div class="col-lg-6 d-flex align-items-stretch">
        <!-- Yearly Breakup -->
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title mb-9 fw-semibold">Summary Tugas</h5>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="fw-semibold mb-3" id='total-tugas'></h4>
                        <i class="ti ti-check text-success"></i>
                        <h7 class="fw-semibold mb-3" id='jumlah_tugas_selesai'></h7><br/>
                        <i class="ti ti-alert-octagon text-danger"></i>
                        <h7 class="fw-semibold mb-3" id='jumlah_tugas_belum'></h7><br/><br/>
                        <div class="d-flex align-items-center">
                            <div class="me-4">
                                <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                <span class="fs-2">Selesai</span>
                            </div>
                            <br/>
                            <div>
                                <span class="round-8 bg-light-primary rounded-circle me-2 d-inline-block"></span>
                                <span class="fs-2">Belum Selesai</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center">
                            <div id="breakup"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Today Schedule</h5>
                </div>
                <ul id="today-schedule" class="timeline-widget mb-0 position-relative mb-n5">
                </ul>
            </div>
        </div>
    </div>
</div>

        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Upcoming Deadlines</h5>
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
                      </tr>
                    </thead>
                    <tbody>
                      <?php
            $conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "input_tugas");
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            $sql = "SELECT nama_tugas, mata_kuliah, deadline, deskripsi FROM tugas WHERE status = '0' ORDER BY deadline LIMIT 3";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $description = $row['deskripsi'];
                    $descriptionWords = explode(' ', $description);
                    $shortDescription = implode(' ', array_slice($descriptionWords, 0, 5));
                    if (count($descriptionWords) > 5) {
                        $shortDescription .= '...';
                    }

                    echo "<tr>";
                    echo "<td>" . $row['nama_tugas'] . "</td>";
                    echo "<td>" . $row['mata_kuliah'] . "</td>";
                    echo "<td>" . $row['deadline'] . "</td>";
                    echo "<td>" . $shortDescription . "</td>";
                    echo "<td class='border-bottom-0'><span class='badge bg-danger rounded-3 fw-semibold'>Upcoming</span></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada data tugas</td></tr>";
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
  </div>
  <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('api/fetch_schedule')
                .then(response => response.json())
                .then(data => {
                    const todaySchedule = document.getElementById("today-schedule");

                    if (data.length === 0) {
                        todaySchedule.innerHTML = "<li class='timeline-item'><div class='timeline-desc fs-3 text-dark mt-n1'>No activities scheduled for today.</div></li>";
                    } else {
                        data.forEach(activity => {
                            const item = document.createElement("li");
                            item.className = "timeline-item d-flex position-relative overflow-hidden";
                            item.innerHTML = `
                                <div class="timeline-time text-dark flex-shrink-0 text-end">${activity.subject}</div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n1">${activity.activity}</div>
                            `;
                            todaySchedule.appendChild(item);
                        });
                    }
                });
        });
    </script>
  <script src="libs/jquery/dist/jquery.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/sidebarmenu.js"></script>
  <script src="js/app.min.js"></script>
  <script src="libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="libs/simplebar/dist/simplebar.js"></script>
  <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('api/check_data') 
                .then(response => response.json())
                .then(data => {
                    document.getElementById('total-tugas').textContent = `${data.total} Total Tugas`;
                    document.getElementById('jumlah_tugas_selesai').textContent = `${data.selesai} Tugas Selesai`;
                    document.getElementById('jumlah_tugas_belum').textContent = `${data.belum} Tugas Belum Selesai`;
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
  <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch('api/check_data')
    .then(response => response.json())
    .then(data => {
        // Hitung persentase tugas selesai dan belum selesai
        var selesai_percentage = (data.selesai / data.total) * 100;
        var belum_percentage = (data.belum / data.total) * 100;

        // Setup chart data
        var breakup = {
            color: "#adb5bd",
            series: [selesai_percentage, belum_percentage],
            labels: ["Selesai", "Belum Selesai"],
            chart: {
                width: 180,
                type: "donut",
                fontFamily: "'Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },
            stroke: {
                show: false,
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: false,
            },
            colors: ["#5D87FF", "#ecf2ff"],
            responsive: [
                {
                    breakpoint: 991,
                    options: {
                        chart: {
                            width: 150,
                        },
                    },
                },
            ],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
        chart.render();
    })
    .catch(error => console.error('Error:', error));
        });
</script>
<!-- <script src="js/dashboard.js"></script> -->
</body>

</html>