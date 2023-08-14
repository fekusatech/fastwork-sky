<?php
session_start();
include 'includes/conn.php';
$admin_url = str_replace("user", "admin", $base_url) . "index.php";
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	//login admin dulu di cek
	$sql = "SELECT * FROM admin WHERE username = '$username'";
	$query = $conn->query($sql);

	if ($query->num_rows < 1) {
		//Jika tidak ada cek user biasa
		$sql = "SELECT * FROM employees WHERE employee_id = '$username' AND password='$password'";
		$query = $conn->query($sql);

		if ($query->num_rows < 1) {
			$_SESSION['error'] = 'Cannot find account with the username';
		} else {
			$row = $query->fetch_assoc();
			$_SESSION['admin'] = $row['id'];
			$_SESSION['data'] = $row;
			header('location: index.php');
		}
	} else {
		$row = $query->fetch_assoc();
		if (password_verify($password, $row['password'])) {
			$_SESSION['admin'] = $row['id'];
			$_SESSION['data'] = $row;
			echo "<script>window.location.href = '$admin_url';</script>";
			exit;
		} else {
			$_SESSION['error'] = 'Incorrect password';
		}
	}
} else {
	$_SESSION['error'] = 'Input admin credentials first';
}

header('location: index.php');
