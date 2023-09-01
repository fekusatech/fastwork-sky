<?php
include 'includes/session.php';
include '../conn.php';
include '../timezone.php';

$datenow = date('Y-m-d');
$timenow = date('H:i');
$datelimit = "15:00";
$sql = "SELECT * FROM employees";
$squery = $conn->query($sql);

// $logstatus = ($lognow > $srow['time_in']) ? 0 : 1;
//
$status = false;
$_SESSION['success'] = 'Tidak ada data sync';
while ($em = $squery->fetch_assoc()) {
    echo $em['id'] . "<br>";
    $sql = "SELECT * FROM attendance where employee_id ='{$em['id']}' and date ='{$datenow}'";
    $query = $conn->query($sql);
    $dataabsen = $query->fetch_assoc();
    if ($dataabsen == NULL) {
        if ($timenow > $datelimit) {
            $status = true;
            $sql = "INSERT INTO attendance_tidakhadir (employee_id, date, status, status_in) VALUES ('{$em['id']}', '$datenow', '0','no')";
            if ($conn->query($sql)) {
                // $output['message'] = 'Time in: ' . $row['firstname'] . ' ' . $row['lastname'];
            } else {
                // $output['error'] = true;
                // $output['message'] = $conn->error;
            }
        }
    }
}
if($status){
    $_SESSION['success'] = 'Ada karyawan yang tidak masuk hari ini';
}
header('location:attendance_tidakhadir.php');
// echo json_encode($output);
