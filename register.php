<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Novatix</title>
  <link rel="shortcut icon" type="image/png" href="images/logos/faviconnova.png" />
  <link rel="stylesheet" href="css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="images/logos/logoNova.svg" width="180" alt="">
                </a>
                <p class="text-center">Official Website</p>
                <form method="post" action="api/regist">
                  <div class="mb-3">
                    <label for="nama" class="form-label">Name</label>
                    <input type="nama" class="form-control" placeholder="Nama" id="nama" name="nama" required>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Email" id="email" name="email" required>
                  </div>
                  <div class="mb-3">
                    <label for="phone" class="form-label">Nomor HP</label>
                    <input type="phone" class="form-control" placeholder="Nomor HP" id="phone" name="phone" required>
                  </div>
                  <div class="mb-3">
                    <label for="birthdate" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" placeholder="Tanggal Lahir" id="birthdate" name="birthdate" required>
                  </div>
                  <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="nim" class="form-control" placeholder="NIM" id="nim" name="nim" required>
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                  </div>
                  <input type="submit" value="Sign Up" href="api/regist" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href="login">Sign In</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="popup" id="popup">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <div class="icon-container">
                <img src="cross.png" alt="error icon" class="error-icon">
            </div>
            <h3> Autentikasi Gagal </h3>
            <p id="errorMessage"> Password is Incorrect </p>
            <button id="closePopupBtn">OK</button>
        </div>
  </div>

  <?php
  if (isset($_SESSION['error'])) {
      echo '<script>
          window.onload = function() {
              showPopup("' . $_SESSION['error'] . '");
          }
      </script>';
      unset($_SESSION['error']);
  }
  ?>
  
  <script src="script.js"></script>
  <script src="libs/jquery/dist/jquery.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>