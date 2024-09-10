<?php
include 'api/db_foto.php'
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Novatix</title>
  <base href="../../">
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
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Tambahkan Tugas</h5>
              <a href="dosen" class="btn btn-outline-primary" style="margin-right: 10px"><i class="ti ti-arrow-left"></i></a>
              <a href="dosen/add/materi" class="btn btn-outline-primary"><i class="ti ti-plus" style="margin-right: 5px"></i>Tambahkan Materi Baru</a>
              <div class="card">
                <div class="card-body">
                  <form action="api/input_tugas" method="post">
                    <div class="mb-3">
                      <label for="nama_tugas" class="form-label">Nama Tugas</label>
                      <input type="text" class="form-control" id="nama_tugas" name="nama_tugas" required>
                    </div>
                    <div class="mb-3">
                      <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
                      <select id="mata_kuliah" class="form-control" name="mata_kuliah" onchange="fetchDosen()" required>
                        <option selected disabled>Pilih Mata Kuliah</option>
                        <?php
            // Koneksi ke database
            $conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "realdatabasenovatix");
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            $sql = "SELECT id, mata_kuliah FROM diketahui";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['mata_kuliah'] . "</option>";
                }
            } else {
                echo "<option value=''>Tidak ada data</option>";
            }

            $conn->close();
            ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="penanggung_jawab" class="form-label">Dosen Penanggung Jawab</label>
                      <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" disabled>
                    </div>
                    <div class="mb-3">
                      <label for="deadline" class="form-label">Deadline</label>
                      <input type="date" class="form-control" id="deadline" name="deadline" required>
                    </div>
                    <div class="mb-3">
                      <label for="deskripsi" class="form-label">Deskripsi</label>
                      <textarea id="deskripsi" class="form-control" name="deskripsi" rows="4" cols="50" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
function fetchDosen() {
    var mataKuliahId = document.getElementById("mata_kuliah").value;
    if (mataKuliahId) {
        var xhr = new XMLHttpRequest();
        var url = "../../api/fetch_dosen?id=" + mataKuliahId;
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log("Respons dari server: ", xhr.responseText); // Tambahkan ini untuk debugging
                document.getElementById("penanggung_jawab").value = xhr.responseText;
            }
        };
        xhr.send();
    } else {
        document.getElementById("penanggung_jawab").value = "";
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