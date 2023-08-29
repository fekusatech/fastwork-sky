<?php
include 'includes/session.php';

function generateRow($from, $to, $conn)
{
    $contents = '';

    $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance INNER JOIN employees ON employees.id=attendance.employee_id  WHERE attendance.date BETWEEN '$from' AND '$to'";
    // echo $sql; exit;
    $query = $conn->query($sql);
    while ($row = $query->fetch_assoc()) {
        $status = ($row['status']) ? '<span class="label label-warning pull-right">ontime</span>' : '<span class="label label-danger pull-right">late</span>';
        $contents .= "<tr>
                         <td>" . date('M d, Y', strtotime($row['date'])) . "</td>
                          <td>" . $row['empid'] . "</td>
                          <td>" . $row['firstname'] . ' ' . $row['lastname'] . "</td>
                          <td>" . date('h:i A', strtotime($row['time_in'])) ."</td>
                          <td>" . date('h:i A', strtotime($row['time_out'])) . "</td>
                          <td>" . ucwords($row['status_in']) . "</td>
                      </tr>";
    }
    return $contents;
}

$id_employee = $_REQUEST['id_employee'];
$range = $_REQUEST['date_range'];
$ex = explode(' - ', $range);
$from = date('Y-m-d', strtotime($ex[0]));
$to = date('Y-m-d', strtotime($ex[1]));

$from_title = date('M d, Y', strtotime($ex[0]));
$to_title = date('M d, Y', strtotime($ex[1]));

require_once('../tcpdf/tcpdf.php');
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Payroll: ' . $from_title . ' - ' . $to_title);
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
$content = '';
$content .= '
      	<h2 align="center">PT. Trisakti Manunggal Perkasa Internasional</h2>
      	<h4 align="center">' . $from_title . " - " . $to_title . '</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>
                <th>Tanggal</th>
                <th>ID Karyawan</th>
                <th>Nama</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Keterangan</th>
           </tr>
           
      ';
$content .= generateRow($from, $to, $conn);
$content .= '</table>';

$pdf->writeHTML($content);

// Menentukan nama file dan mengirim PDF ke browser
$filename = 'attendance.pdf';
ob_end_clean(); // Clear output buffer before sending the PDF data
$pdf->Output($filename, 'I'); // 'I' berarti otomatis diunduh oleh browser
