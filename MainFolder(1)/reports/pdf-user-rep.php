<?php
include_once 'C:\web\Xampp\htdocs\MainFolder(1)\classes\user-class.php';
include 'C:\web\Xampp\htdocs\MainFolder(1)\user-main\config\config.php';
require('C:\web\Xampp\htdocs\MainFolder(1)\reports\fpdf\fpdf.php');

$user = new User();
$user_id_login = $user->get_user_id($_SESSION['user_email']);
$user_access_level = $user->get_user_access($user_id_login);

class PDF extends FPDF
{
//Page header
function Header(){
	 
	//Arial 12
	$this->SetFont('Arial','',12);
	//Background color
	$this->SetFillColor(200,220,255);
	//Title
	$this->Cell(0,6,"System Users",0,1,'L',1);
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
$pdf->Cell(70,12,"Name",1,0,'C');
$pdf->Cell(46,12,"Access Level",1,0,'C');
$pdf->Cell(60,12,"E-Mail",1,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',12);
$count = 1;
if($user->list_users() != false){
    foreach($user->list_users() as $value){
        extract($value);
        if($user_access_level == 'Owner' || $user_access_level == 'Staff'){
                $pdf->Cell(10,12,"  ".$count,0,0,'L');
                $pdf->Cell(70,12,$user_lastname.', '.$user_firstname,0,0,'L');
                $pdf->Cell(46,12,$user_access,0,0,'L');
                $pdf->Cell(60,12,$user_email,0,0,'L');
                $pdf->Ln(6);
                $count++;
        }
    }
}	

$pdf->SetFont('Arial','I',12);
$pdf->Cell(176,12,"--Nothing Follows--",0,0,'C');
$pdf->Output();
?>