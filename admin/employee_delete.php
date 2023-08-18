<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		// Hapus data dari tabel employees
		$sql_employee = "DELETE FROM employees WHERE id = '$id'";
		if($conn->query($sql_employee)){
			$_SESSION['success'] = 'Employee deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

		// Hapus data dari tabel attendance berdasarkan employee_id
		$sql_attendance = "DELETE FROM attendance WHERE employee_id = '$id'";
		$conn->query($sql_attendance);

		// Hapus data dari tabel cashadvance berdasarkan employee_id
		$sql_cashadvance = "DELETE FROM cashadvance WHERE employee_id = '$id'";
		$conn->query($sql_cashadvance);

		// Hapus data dari tabel leave_requests berdasarkan user_id
		$sql_leave = "DELETE FROM leave_requests WHERE user_id = '$id'";
		$conn->query($sql_leave);

		// Hapus data dari tabel overtime berdasarkan employee_id
		$sql_overtime = "DELETE FROM overtime WHERE employee_id = '$id'";
		$conn->query($sql_overtime);
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: employee.php');
