<?php 
require('fpdf186/fpdf.php');
include 'conn.php';
$pull=$conn->query(" SELECT * from cars WHERE status='2' ");


$pdf=new FPDF ('P','mm','A4');
$pdf->SetLeftMargin(11);
$pdf->AddPage();
$pdf->Image('images/logo2.jpg', 10, 10, -500);
$pdf->cell(36,22,"",0,0,'');
$pdf->cell(149,22,"",0,1,'');

$pdf->SetFont('Arial','B',14);

$pdf->SetTextColor(12,5,71);
$pdf->cell(185,15,'AVAILABLE CARS' ,0,1,'');
$pdf->SetFont('Arial','B',10);

$pdf->SetTextColor(0,0,0);
$pdf->cell(60,5, 'Car Model' ,1,0,'');
$pdf->cell(50,5, 'Color' ,1,0,'');    
$pdf->cell(75,5, 'N Sachet' ,1,1,'');

$pdf->SetFont('Arial','',10);
while ($fetch=mysqli_fetch_array($pull)) {

    $pdf->cell(60,5, $fetch['model'] ,1,0,'');
    $pdf->cell(50,5, $fetch['color'] ,1,0,'');
    $pdf->cell(75,5, $fetch['chasse'] ,1,0,'');
}

$pdf->Output();

?>