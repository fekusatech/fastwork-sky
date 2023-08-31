<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
	$employee = $_POST['employee'];
	$amount = $_POST['amount'];

	$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
	$query = $conn->query($sql);
	if ($query->num_rows < 1) {
		$_SESSION['error'] = 'Employee not found';
	} else {
		$row = $query->fetch_assoc();
		if ((int)$row['max_payment'] > (int)$amount) {
			$employee_id = $row['id'];
			$sql = "INSERT INTO cashadvance (employee_id, date_advance, amount) VALUES ('$employee_id', NOW(), '$amount')";
			if ($conn->query($sql)) {
				$_SESSION['success'] = 'Pinjaman berhasil ditambahkan';
			} else {
				$_SESSION['error'] = $conn->error;
			}
		} else {
			$_SESSION['error'] = "Max pinjaman Rp " . number_format($row['max_payment']) . " dan anda mengajukan Rp " . number_format($amount);
		}
	}
} else {
	$_SESSION['error'] = 'Fill up add form first';
}

header('location: cashadvance.php');
