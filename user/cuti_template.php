<?php
include 'includes/session.php';

function generateRow($id, $conn)
{
    $contents = '';

    $sql = "SELECT (SELECT description from position where id =e.position_id) as jabatan, e.employee_id ,e.firstname, e.lastname ,lr.* FROM `leave_requests` lr inner join employees e on lr.user_id = e.id WHERE lr.id = '$id'";

    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $contents .= "
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>Tanggal : " . date('d M Y') . "</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>Perihal : Cuti</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>Kepada Yth</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>Manajer</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>Di tempat</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>Dengan hormat,</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>Yang bertanda tangan dibawah ini:</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Nama &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : {$row['firstname']} {$row['lastname']} &nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ID Karyawan &nbsp; &nbsp; : {$row['employee_id']}</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Jabatan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <span style='color: rgb(0, 0, 0); font-family: 'Times New Roman', serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;'>{$row['jabatan']}</span></span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Alasan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: {$row['keterangan']}</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Dari tanggal &nbsp; &nbsp; &nbsp; : ".date('d M Y',strtotime($row['start_date'])). "</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Sampai tanggal &nbsp;: " . date('d M Y', strtotime($row['end_date'])) . "</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>Demikian permohonan cuti yang saya buat, atas perhatian Bapak/Ibu saya ucapkan terima kasih.</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>Hormat saya,</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'><span style='font-size:16px;line-height:107%;font-family:'Times New Roman',serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:'Calibri',sans-serif;'>{$row['firstname']} {$row['lastname']}</p>";
    return $contents;
}

$id = $_REQUEST['id'];
require_once('../tcpdf/tcpdf.php');
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Form Cetak Cuti');
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
$content .= generateRow($id,$conn);
// Set font
$pdf->SetFont('times', '', 12);
// Center-align text
$pdf->Cell(0, 10, 'FORMULIR CUTI KARYAWAN', 0, 1, 'C');
$pdf->writeHTML($content);

// Menentukan nama file dan mengirim PDF ke browser
$filename = 'cutiform.pdf';
ob_end_clean(); // Clear output buffer before sending the PDF data
$pdf->Output($filename, 'I'); // 'I' berarti otomatis diunduh oleh browser
