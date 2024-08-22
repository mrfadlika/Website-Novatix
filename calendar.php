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
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
  <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
        .today-cell {
            background-color: #d3d3d3 !important; 
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
                    <a href="./profile class="d-flex align-items-center gap-2 dropdown-item">
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
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Calendar</h5>
              <a type="button" href="calendar/add_event" class="btn btn-outline-secondary m-1" style="margin-bottom: 500px">Tambahkan Event</a>
              <div id="calendar" style="margin-top: 50px"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: 'api/events',
                datesSet: function(info) {
                    hideOutOfMonthWeeks(info);
                },
                dayCellClassNames: function(arg) {
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    const cellDate = new Date(arg.date);
                    cellDate.setHours(0, 0, 0, 0);

                    if (cellDate.getTime() === today.getTime()) {
                        return ['today-cell'];
                    }
                }
            });

            calendar.render();

            function hideOutOfMonthWeeks(info) {
                var weeks = document.querySelectorAll('.fc-daygrid-week');

                weeks.forEach(function(week) {
                    var allDaysOutOfMonth = true;

                    week.querySelectorAll('.fc-daygrid-day').forEach(function(day) {
                        var date = new Date(day.dataset.date);

                        if (date.getMonth() === info.view.currentStart.getMonth()) {
                            allDaysOutOfMonth = false;
                        }
                    });

                    if (allDaysOutOfMonth) {
                        week.style.display = 'none';
                    }
                });
            }
        });
    </script>
  <script src="libs/jquery/dist/jquery.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/sidebarmenu.js"></script>
  <script src="js/app.min.js"></script>
  <script src="libs/simplebar/dist/simplebar.js"></script>
</body>

</html>