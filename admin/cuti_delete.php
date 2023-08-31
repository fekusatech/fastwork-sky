<?php
if (isset($_GET['id'])) {
    include 'includes/session.php';
    $leave_request_id = $_GET['id']; // Ambil ID permintaan cuti dari URL
    $action = $_GET['action']; // Ambil tindakan (approve/reject) dari URL


    $update_sql = "delete from leave_requests WHERE id = $leave_request_id";
    if ($conn->query($update_sql) === TRUE) {
        // Berhasil direject
        session_start();
        $_SESSION['success'] = "Delete cuti berhasil.";
    } else {
        // Gagal update status
        session_start();
        $_SESSION['error'] = "Terjadi kesalahan: " . $conn->error;
    }

} else {
    // ID atau action tidak ditemukan dalam URL
    session_start();
    $_SESSION['error'] = "ID atau tindakan permintaan cuti tidak valid.";
}

header('Location: cuti.php'); // Kembali ke halaman manajemen cuti
