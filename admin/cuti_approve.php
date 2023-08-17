<?php
if (isset($_GET['id']) && isset($_GET['action'])) {
    include 'includes/session.php';
    $leave_request_id = $_GET['id']; // Ambil ID permintaan cuti dari URL
    $action = $_GET['action']; // Ambil tindakan (approve/reject) dari URL

    // Lakukan pengecekan status dan lakukan tindakan sesuai dengan action
    $sql = "SELECT * FROM leave_requests WHERE id = $leave_request_id";
    $query = $conn->query($sql);
    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        if ($action == 'approve' && $row['status'] == 'pending') {
            // Update status menjadi approved
            $update_sql = "UPDATE leave_requests SET status = 'approved' WHERE id = $leave_request_id";
            if ($conn->query($update_sql) === TRUE) {
                // Berhasil diapprove, tambahkan entri ke tabel attendance
                $employee_id = $row['user_id'];
                $start_date = $row['start_date'];
                $end_date = $row['end_date'];

                $attendance_date = new DateTime($start_date);
                while ($attendance_date <= new DateTime($end_date)) {
                    $attendance_date_str = $attendance_date->format('Y-m-d');
                    $attendance_sql = "INSERT INTO attendance (employee_id, date, time_in, status, status_in, time_out, num_hr) 
                               VALUES ('$employee_id', '$attendance_date_str', '08:00:00', 1, 'cuti', '17:00:00', 8)";
                    $conn->query($attendance_sql);

                    $attendance_date->modify('+1 day'); // Lanjutkan ke tanggal berikutnya
                }

                session_start();
                $_SESSION['success'] = "Permintaan cuti berhasil disetujui dan entri absensi ditambahkan.";
            } else {
                // Gagal update status
                session_start();
                $_SESSION['error'] = "Terjadi kesalahan: " . $conn->error;
            }
        } elseif ($action == 'reject' && $row['status'] == 'pending') {
            // Update status menjadi rejected
            $update_sql = "UPDATE leave_requests SET status = 'rejected' WHERE id = $leave_request_id";
            if ($conn->query($update_sql) === TRUE) {
                // Berhasil direject
                session_start();
                $_SESSION['success'] = "Permintaan cuti berhasil ditolak.";
            } else {
                // Gagal update status
                session_start();
                $_SESSION['error'] = "Terjadi kesalahan: " . $conn->error;
            }
        } else {
            // Tindakan tidak sesuai dengan status
            session_start();
            $_SESSION['error'] = "Tindakan tidak valid. Status permintaan cuti sudah berubah.";
        }
    } else {
        // Permintaan cuti tidak ditemukan
        session_start();
        $_SESSION['error'] = "Permintaan cuti tidak ditemukan.";
    }

    $conn->close();
} else {
    // ID atau action tidak ditemukan dalam URL
    session_start();
    $_SESSION['error'] = "ID atau tindakan permintaan cuti tidak valid.";
}

header('Location: cuti.php'); // Kembali ke halaman manajemen cuti
