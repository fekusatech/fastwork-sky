<?php
include 'includes/session.php';

$range = $_POST['date_range'];
$ex = explode(' - ', $range);
$from = date('Y-m-d', strtotime($ex[0]));
$to = date('Y-m-d', strtotime($ex[1]));

$sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
$query = $conn->query($sql);
$drow = $query->fetch_assoc();
$deduction = $drow['total_amount'];

$from_title = date('M d, Y', strtotime($ex[0]));
$to_title = date('M d, Y', strtotime($ex[1]));

require_once('../tcpdf/tcpdf.php');
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Payslip: ' . $from_title . ' - ' . $to_title);
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 11);
$pdf->AddPage();
$contents = '';

$sql = "SELECT *, SUM(num_hr) AS total_hr, attendance.employee_id AS empid, employees.employee_id AS employee FROM attendance INNER JOIN employees ON employees.id=attendance.employee_id LEFT JOIN position ON position.id=employees.position_id WHERE date BETWEEN '$from' AND '$to' and employees.id = '{$user['id']}'  GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";

$query = $conn->query($sql);
while ($row = $query->fetch_assoc()) {
	$empid = $row['empid'];

	$casql = "SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";

	$caquery = $conn->query($casql);
	$carow = $caquery->fetch_assoc();
	$cashadvance = $carow['cashamount'];

	$gross = $row['rate'] * $row['total_hr'];
	$total_deduction = $deduction + $cashadvance;
	$lembur = "SELECT ifnull(sum(rate),0) as total_lembur from overtime where employee_id ='{$empid}' limit 1";
	$lmrquery = $conn->query($lembur);
	$datalmr = $lmrquery->fetch_assoc();
	$net = $gross - $total_deduction + $datalmr['total_lembur'];

	$contents .= '
			<h2 align="center">PT. Trisakti Manunggal Perkasa Internasional</h2>
			<h4 align="center">' . $from_title . " - " . $to_title . '</h4>
			<table cellspacing="0" cellpadding="3">  
    	       	<tr>  
            		<td width="25%" align="right">Nama Karyawan: </td>
                 	<td width="25%"><b>' . $row['firstname'] . " " . $row['lastname'] . '</b></td>
				 	<td width="25%" align="right">Upah per Jam: </td>
                 	<td width="25%" align="right">' . number_format($row['rate'], 2) . '</td>
    	    	</tr>
    	    	<tr>
    	    		<td width="25%" align="right">ID Karyawan: </td>
				 	<td width="25%">' . $row['employee'] . '</td>   
				 	<td width="25%" align="right">Total Jam: </td>
				 	<td width="25%" align="right">' . number_format($row['total_hr'], 2) . '</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Gaji Kotor: </b></td>
				 	<td width="25%" align="right"><b>' . number_format(($row['rate'] * $row['total_hr']), 2) . '</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">Asuransi: </td>
				 	<td width="25%" align="right">(' . number_format($deduction, 2) . ')</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">Pinjaman: </td>
				 	<td width="25%" align="right">(' . number_format($cashadvance, 2) . ')</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">Lembur: </td>
				 	<td width="25%" align="right">' . number_format($datalmr['total_lembur'], 2) . '</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Total Asuransi:</b></td>
				 	<td width="25%" align="right"><b>' . number_format($total_deduction, 2) . '</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Gaji Bersih:</b></td>
				 	<td width="25%" align="right"><b>' . number_format($net, 2) . '</b></td> 
    	    	</tr>
    	    </table>
    	    <br><hr>
		';
}

$contents .= "<br><br><p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>Mengetahui,&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Bandung, &hellip; ".date('M Y')." </span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp; Manajer &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Administrasi</span></p>";

$pdf->writeHTML($contents);
$pdf->Output('payslip.pdf', 'I');
