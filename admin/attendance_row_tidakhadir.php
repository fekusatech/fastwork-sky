<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, attendance_tidakhadir.id as attid FROM attendance_tidakhadir INNER JOIN employees ON employees.id=attendance_tidakhadir.employee_id WHERE attendance_tidakhadir.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>