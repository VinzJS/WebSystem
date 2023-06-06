<?php
include_once 'C:\web\Xampp\htdocs\MainFolder(1)\classes\class.taxi.php';
include 'C:\web\Xampp\htdocs\MainFolder(1)\user-main\config\config.php';
require('C:\web\Xampp\htdocs\MainFolder(1)\reports\fpdf\fpdf.php');

$taxi = new taxi();

class PDF extends FPDF
{
//Page header
function Header(){
	 
	//Arial 12
	$this->SetFont('Arial','',12);
	//Background color
	$this->SetFillColor(200,220,255);
	//Title
	$this->Cell(0,6,"Taxi Vehicles",0,1,'L',1);
	$this->SetFont('Arial','BIU',10);
	$this->Cell(0,6,"Date Generated ".date("Y-m-d h:i:s A")." ",0,1,'L',1);
	$this->SetFont('Arial','',12);
    
   
    //Line break
    $this->Ln(4);
}
function BasicTable($header){
    //Header
    foreach($header as $col)
        $this->Cell(47,7,$col,0,0,'C');
	$this->Ln();
}
//Page footer
function Footer(){
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Instanciation of inherited class
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
// Default Header
//$header=array('Nbr','Name','Access Level','E-Mail');
//$pdf->BasicTable($header);
// Custom Header
$pdf->Cell(10,12,"Nbr",1,0,'C');
$pdf->Cell(30,12,"Plate Number",1,0,'C');
$pdf->Cell(30,12,"Model",1,0,'C');
$pdf->Cell(30,12,"Car Type",1,0,'C');
$pdf->Cell(40,12,"Car Capacity",1,0,'C');
$pdf->Cell(40,12,"Car Transmission",1,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',12);
$count = 1;
if($taxi->list_taxi() != false){
    foreach($taxi->list_taxi() as $value){
        extract($value);
        
                $pdf->Cell(10,12,"  ".$count,0,0,'L');
                $pdf->Cell(30,12,$taxi_plate,0,0,'L');
                $pdf->Cell(30,12,$taxi_model,0,0,'L');
                $pdf->Cell(30,12,$taxi_type,0,0,'L');
                $pdf->Cell(40,12,$taxi_capacity,0,0,'L');
                $pdf->Cell(40,12,$taxi_transmission,0,0,'L');
                $pdf->Ln(6);
                $count++;
        
    }
}	

$pdf->SetFont('Arial','I',12);
$pdf->Cell(176,12,"--Nothing Follows--",0,0,'C');
$pdf->Output();
?>