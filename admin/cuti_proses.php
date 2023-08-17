<?php
include 'includes/session.php';


if (isset($_POST['employee_id']) && isset($_POST['tanggal_mulai']) && isset($_POST['tanggal_selesai']) && isset($_POST['alasan'])) {
    $employee_id = $_POST['employee_id']; // Ambil ID karyawan dari formulir
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $alasan = $_POST['alasan']; // Ambil data alasan dari formulir
    $status = $_POST['status'];

    // Lakukan validasi tanggal dan lainnya sesuai kebutuhan

    // Cek sisa cuti karyawan

    $sql = "SELECT SUM(DATEDIFF(end_date, start_date)) AS total_days FROM leave_requests WHERE user_id = $employee_id AND status = 'approved'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $total_days_taken = $row['total_days'] == null ? 0 : $row['total_days'];

    $remaining_days = 21 - $total_days_taken; // Batasan 21 hari cuti per tahun
    if ($remaining_days <= 0) {
        $_SESSION['error'] = "Karyawan telah melebihi kuota cuti tahunan.";
        header('Location: cuti.php');
        exit();
    }

    // Lakukan insert data ke tabel permintaan_cuti
    $sql = "INSERT INTO leave_requests (id,user_id,start_date,end_date,status,keterangan) VALUES (null, '$employee_id', '$tanggal_mulai', '$tanggal_selesai', '$status','$alasan')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Permintaan cuti berhasil diajukan.";
    } else {
        $_SESSION['error'] = "Terjadi kesalahan: " . $conn->error;
    }
    $conn->close();
}

header('Location: cuti.php'); // Kembali ke halaman manajemen cuti
