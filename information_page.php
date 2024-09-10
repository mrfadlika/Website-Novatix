<?php
session_start();
$servername = "localhost";
$username = "nova"; 
$password = "Raffifadlika!&55"; 
$dbname = "realdatabasenovatix";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
    /* Custom CSS */
    .form-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
        margin-bottom: 20px;
    }

    .form-container > div {
        flex: 1;
        min-width: 200px; /* Minimum width for each element */
    }

    .form-container input,
    .form-container select,
    .form-container button {
        width: 100%;
    }

    @media (max-width: 768px) {
        .form-container {
            flex-direction: column;
        }

        .form-container > div {
            min-width: 100%;
            margin-right: 0;
            margin-bottom: 10px;
        }
    }

    .card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .card-body img {
        margin-bottom: 10px;
    }

    .card-body .flex-grow-1 {
        margin-bottom: 10px;
    }

    @media (min-width: 769px) {
        .card-body {
            flex-direction: row;
            text-align: left;
        }

        .card-body img {
            margin-right: 20px;
            margin-bottom: 0;
        }

        .card-body .flex-grow-1 {
            margin-right: 20px;
        }
    }

    .card-body h3 {
        margin-bottom: 5px;
    }

    .card-body .posisi {
        display: block;
        margin-bottom: 10px;
    }
  </style>
  <script>
        function isDesktop() {
            return window.innerWidth > 768;
        }

        function redirectToInfoPage() {
            if (isDesktop()) {
                const queryString = window.location.search; 
                window.location.href = "info" + queryString;
            }
        }
        window.onload = redirectToInfoPage;
  </script>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Information Page</h5>
            <p>Only For Mobile Website</p>
            <div class="form-container">
            <form method="GET" action="information_page" class="form-container d-flex">
              <div>
                <input type="text" id="search" name="search" class="form-control" placeholder="Cari dengan Nama Dosen" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
              </div>
              <div>
                <select id="role" name="role" class="form-select">
                    <option value="">Role</option>
                    <option value="staff" <?php if(isset($_GET['role']) && $_GET['role'] == 'staff') echo 'selected'; ?>>Staff</option>
                    <option value="dosen" <?php if(isset($_GET['role']) && $_GET['role'] == 'dosen') echo 'selected'; ?>>Dosen</option>
                </select>
              </div>
              <div>
                <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
              </div>
</form>
            </div>
            <?php
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $role = isset($_GET['role']) ? $_GET['role'] : '';

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
                    echo "<h3 class='mb-0'>" . $row["nama"] . "</h3>";
                    echo "<span class='badge bg-primary text-white rounded-pill posisi'>" . $row["posisi"] . "</span>";
                    echo "<p class='mb-0' style='padding-bottom: 20px'>0" . $row["nomor_hp"] . "</p>";
                    echo "</div>";
                    echo "<button onclick=\"window.location.href='https://wa.me/62" . $row["nomor_hp"] . "'\" class='btn btn-primary'>Hubungi</button>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "<a href='info'>Saya menggunakan Desktop Website</a>";
            } else {
                echo "<p>Tidak ada data dosen yang tersedia.</p>";
            }

            $conn->close();
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="libs/jquery/dist/jquery.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/sideb..."></script>
</body>
</html>
