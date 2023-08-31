<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$address = $_POST['address'];
	$birthdate = $_POST['birthdate'];
	$contact = $_POST['contact'];
	$gender = $_POST['gender'];
	$jatah_cuti = $_POST['jatah_cuti'];
	$max_payment = $_POST['max_payment'];
	$position = $_POST['position'];
	$schedule = $_POST['schedule'];
	$filename = $_FILES['photo']['name'];
	if (!empty($filename)) {
		move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $filename);
	}
	//Get ID LAST
	$querycek = "SELECT employee_id from employees ORDER  BY created_on DESC LIMIT 1";
	$query = $conn->query($querycek);
	$row = $query->fetch_assoc();
	if (!is_numeric($row['employee_id'])) {
		$employee_id = date('dmY') . "001";
	} else {
		// Nilai dari input data form karyawan
		$nilai = $row['employee_id'];
		// Mengambil 3 karakter terakhir dari nilai
		$bagianAkhir = substr($nilai, -3);
		// Menambahkan 1 ke nilai bagian akhir
		$nextValue = intval($bagianAkhir) + 1;
		// Memastikan nilai tidak melebihi 999
		if ($nextValue > 999) {
			$nextValue = 1; // Kembali ke 001 jika melebihi 999
		}
		// Format nilai yang sudah diperbarui dengan leading zeros
		$formattedNextValue = sprintf('%03d', $nextValue);
		// Menggabungkan nilai bagian awal dengan nilai yang sudah diperbarui
		$employee_id = substr($nilai, 0, -3) . $formattedNextValue;
	}
	$sql = "INSERT INTO employees (employee_id, firstname, lastname, address, birthdate, contact_info, gender, position_id, schedule_id, photo,jatah_cuti,max_payment) VALUES ('$employee_id', '$firstname', '$lastname', '$address', '$birthdate', '$contact', '$gender', '$position', '$schedule', '$filename', '$jatah_cuti', '$max_payment')";
	if ($conn->query($sql)) {
		$_SESSION['success'] = 'Employee added successfully';
	} else {
		$_SESSION['error'] = $conn->error;
	}
} else {
	$_SESSION['error'] = 'Fill up add form first';
}

header('location: employee.php');
