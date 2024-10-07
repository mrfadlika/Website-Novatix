<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_tugas = $_POST['nama_tugas'];
    $mata_kuliah_id = $_POST['mata_kuliah'];
    $deadline = $_POST['deadline'];
    $deskripsi = $_POST['deskripsi'];

    $conn = new mysqli("localhost", "nova", "Raffifadlika!&55", "realdatabasenovatix");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT activity, penanggungjawab FROM schedules WHERE id='$mata_kuliah_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $mata_kuliah = $row['activity'];
        $dosen_pengampu = $row['penanggungjawab'];
    } else {
        echo "Mata kuliah tidak ditemukan.";
        $conn->close();
        exit;
    }

    $sql_insert = "INSERT INTO tugas (nama_tugas, mata_kuliah, dosen_pengampu, deadline, deskripsi, status)
                   VALUES ('$nama_tugas', '$mata_kuliah', '$dosen_pengampu', '$deadline', '$deskripsi', 0)";

    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href = document.referrer;</script>";

        $chat_id = '1195226552';
        $bot_token = '7260988044:AAGOlttmGoi1kHCnp49qiPGSeNCNvzk92V0';
        $message = "Tugas baru telah ditambahkan:\n\n"
            . "Nama Tugas: $nama_tugas\n"
            . "Mata Kuliah: $mata_kuliah\n"
            . "Dosen Pengampu: $dosen_pengampu\n"
            . "Deadline: $deadline\n"
            . "Deskripsi: $deskripsi";

        $url = "https://api.telegram.org/bot$bot_token/sendMessage?chat_id=$chat_id&text=" . urlencode($message);
        file_get_contents($url);

        $wa_sid = 'AC6e2d94bbece89be03f116efe238d231e'; // Ganti dengan Account SID Anda
        $wa_token = 'cc5add92e1cc16e50a9d3fb1d313d4e4'; // Ganti dengan Auth Token Anda
        $wa_twilio_number = 'whatsapp:+14155238886'; // Nomor pengirim Twilio (format WhatsApp)
        $wa_recipient_number = 'whatsapp:+62882020802944'; // Ganti dengan nomor penerima

        // Siapkan data pesan untuk WhatsApp
        $wa_message = "Tugas baru telah ditambahkan:\n\n"
            . "Nama Tugas: $nama_tugas\n"
            . "Mata Kuliah: $mata_kuliah\n"
            . "Dosen Pengampu: $dosen_pengampu\n"
            . "Deadline: $deadline\n"
            . "Deskripsi: $deskripsi";

        // URL untuk mengirim pesan WhatsApp
        $wa_url = "https://api.twilio.com/2010-04-01/Accounts/$wa_sid/Messages.json";
        $data = [
            'From' => $wa_twilio_number,
            'To' => $wa_recipient_number,
            'Body' => $wa_message,
        ];

        // Kirim pesan melalui Twilio
        $ch = curl_init($wa_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$wa_sid:$wa_token");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        // Eksekusi permintaan dan ambil respons
        $response = curl_exec($ch);

        // Periksa apakah ada kesalahan
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            echo 'Pesan WhatsApp berhasil dikirim! Respons: ' . $response;
        }
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }

    $conn->close();
}
