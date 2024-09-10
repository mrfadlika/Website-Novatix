<?php
$conn = new mysqli('localhost', 'nova', 'Raffifadlika!&55', 'realdatabasenovatix');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM tugas WHERE status = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    require('fpdf186/fpdf.php');

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(190, 10, 'DAFTAR TUGAS YANG BELUM SELESAI', 0, 1, 'C');
    $pdf->Ln(10);

    while ($row = $result->fetch_assoc()) {
        $nama_tugas = $row['nama_tugas'];
        $mata_kuliah = $row['mata_kuliah'];
        $dosen_pengampu = $row['dosen_pengampu'];
        $deadline = $row['deadline'];
        $deskripsi = $row['deskripsi'];

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(40, 10, 'Nama Tugas', 0, 0);
        $pdf->Cell(3, 10, ':', 0, 0);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, $nama_tugas, 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(40, 10, 'Mata Kuliah', 0, 0);
        $pdf->Cell(3, 10, ':', 0, 0);
        $pdf->Cell(40, 10, $mata_kuliah, 0, 1);
        $pdf->Cell(40, 10, 'Dosen Pengampu', 0, 0);
        $pdf->Cell(3, 10, ':', 0, 0);
        $pdf->Cell(40, 10, $dosen_pengampu, 0, 1);
        $pdf->Cell(40, 10, 'Deskripsi Tugas', 0, 0);
        $pdf->Cell(3, 10, ':', 0, 0);
        $pdf->MultiCell(140, 10, $deskripsi, 0, 1);
        $pdf->Cell(40, 10, 'Deadline', 0, 0);
        $pdf->Cell(3, 10, ':', 0, 0);
        $pdf->Cell(40, 10, $deadline, 0, 1);
        $pdf->Cell(40, 10, 'Status', 0, 0);
        $pdf->Cell(3, 10, ':', 0, 0);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(40, 10, 'Belum Selesai', 0, 1);
        $pdf->Ln(10);
        $pdf->SetTextColor(0, 0, 0);
    }

    $pdf->Output('I', 'daftar_tugas_belum_selesai.pdf');
} else {
    echo "Tidak ada tugas yang belum selesai.";
}

$conn->close();
?>
