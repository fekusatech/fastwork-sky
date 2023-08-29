<?php
include 'includes/session.php';

function generateRow($idemployee, $from, $to, $conn)
{
    $contents = '';

    $sql = "SELECT leave_requests.*, employees.firstname, employees.lastname
        FROM leave_requests
        JOIN employees ON leave_requests.user_id = employees.id
        WHERE  employees.id = '$idemployee' AND leave_requests.start_date BETWEEN '$from' AND '$to' 
        ORDER BY leave_requests.start_date DESC";
        // echo $sql; exit;
    $query = $conn->query($sql);
    while ($row = $query->fetch_assoc()) {
        if ($row['status'] == "pending") {
            $status = "<span class='label label-primary badge-pill'>" . ucwords($row['status']) . "</span>";
            $approve_button = "<a href='cuti_approve.php?id=" . $row['id'] . "&action=approve' class='btn btn-success btn-sm' onclick='return confirmAction(\"approve\")'>Approve</a>&nbsp;";
            $approve_button .= "<a href='cuti_approve.php?id=" . $row['id'] . "&action=reject' class='btn btn-danger btn-sm' onclick='return confirmAction(\"reject\")'>Reject</a>";
        } else if ($row['status'] == "rejected") {
            $status = "<span class='label label-danger badge-pill'>" . ucwords($row['status']) . "</span>";
            $approve_button = "<a href='#' disabled class='btn btn-success btn-sm'>Approve</a>&nbsp;";
            $approve_button .= "<a href='#' disabled class='btn btn-danger btn-sm'>Reject</a>";
        } else {
            $status = "<span class='label label-success badge-pill'>" . ucwords($row['status']) . "</span>";
            $approve_button = "<a href='#' disabled class='btn btn-success btn-sm'>Approve</a>&nbsp;";
            $approve_button .= "<a href='#' disabled class='btn btn-danger btn-sm'>Reject</a>";
        }
        $contents .= "<tr>
                        <td>" . $row['firstname'] . " " . $row['lastname'] . "</td>
                        <td>" . date('M d, Y', strtotime($row['start_date'])) . "</td>
                        <td>" . date('M d, Y', strtotime($row['end_date'])) . "</td>
                        <td>" . $row['keterangan'] . "</td>
                        <td>" . $status . "</td>
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
                <th>Nama Karyawan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Alasan</th>
                <th>Status</th>
           </tr>
           
      ';
$content .= generateRow($id_employee, $from, $to, $conn);
$content .= '</table>';

$pdf->writeHTML($content);

// Menentukan nama file dan mengirim PDF ke browser
$filename = 'cuti.pdf';
ob_end_clean(); // Clear output buffer before sending the PDF data
$pdf->Output($filename, 'I'); // 'I' berarti otomatis diunduh oleh browser
