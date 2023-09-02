<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
	$employee = $_POST['employee'];
	$amount = $_POST['amount'];

	$sql = "select (IFNULL((e.max_payment - (select sum(amount) from cashadvance where cashadvance.employee_id = e.id)),e.max_payment)) as sisa,e.* from employees e WHERE e.employee_id = '$employee'";
	$query = $conn->query($sql);
	if ($query->num_rows < 1) {
		$_SESSION['error'] = 'Employee not found';
	} else {
		$row = $query->fetch_assoc();
		if ((int)$row['sisa'] > (int)$amount) {
			$employee_id = $row['id'];
			$sql = "INSERT INTO cashadvance (employee_id, date_advance, amount) VALUES ('$employee_id', NOW(), '$amount')";
			if ($conn->query($sql)) {
				$_SESSION['success'] = 'Pinjaman berhasil ditambahkan';
			} else {
				$_SESSION['error'] = $conn->error;
			}
		} else {
			$_SESSION['error'] = "Max pinjaman Rp " . number_format($row['sisa']) . " dan anda mengajukan Rp " . number_format($amount);
		}
	}
} else {
	$_SESSION['error'] = 'Fill up add form first';
}

header('location: cashadvance.php');
