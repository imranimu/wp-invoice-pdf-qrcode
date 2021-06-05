<?php 

function qr_code($text){
    //$t=time();    

    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;

    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";

    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);    

    $filename = $PNG_TEMP_DIR.'invoice-qr.png';

    $errorCorrectionLevel = 'L';

    $matrixPointSize = 16;

    QRcode::png($text, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

    $qrImage = $PNG_WEB_DIR.basename($filename);

    return $qrImage; 

}

require('fpdf.php'); 

class PDF extends FPDF {  	 	   

    // Page header
    function Header(){
        // Pad Header
        $this->Image('tutorial/header.png',10,0,200);
        
        // Line break
        $this->Ln(25);
    }

    // Page footer
    function Footer(){       
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        //$this->Image( $qrImage,0,0,40);
        
        $this->SetFont('Arial','',10);
        
        $this->Cell(0,-20,'This is a computer generated Invoice does not require a signature and seal.',0,0,'R');

        // Arial italic 8        
        $this->SetFont('Arial','',10);
        // Page number        
        //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        $this->Cell(0,-5,'10, Chanmary Approse Road, Shipyard, Khulna',0,0,'R');
        
    }

}

$qrCodeText = '#'.$_POST['InvoiceNumber'].' - tk.'.$_POST['TotalAmount'].'/-';

$date = date("F j, Y");

// Instanciation of inherited class
$pdf = new PDF();

$pdf->AliasNbPages();

$pdf->AddPage();

$pdf->SetFont('Arial','',12);

$pdf->Image( 'tutorial/pad_03.jpg' ,10,55,190);

$pdf->Image( 'tutorial/footer.png',0,250,110);

$pdf->Image( qr_code($qrCodeText) ,10,260,30);

$pdf->Cell(0,6,'INVOICE TO:',0,1);
$pdf->Cell(0,6,'Greenovation Eng. & Con. LTD',0,1);
$pdf->Cell(0,6,'Nirala, Khulna,Bangladesh',0,1);

// Set font
$pdf->SetFont('Arial','B',18);

$pdf->Cell(0,-30,'Invoice #001',0,1,'R');

$pdf->SetFont('Arial','',12);

$pdf->Cell(0,43,'Date: '.$date,0,1,'R');

$pdf->SetFont('Arial','IU',12);

$pdf->Cell(0,-30,'www.salimbrothersbd.com',0,1,'R');

$pdf->Ln(25);

$pdf->SetFont('Arial','b',12);

$pdf->Cell(0,6,'Subject: Bill Invoice for Stone 3/4',0,1);


$pdf->Cell(50 ,10,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(69, 171, 82); 
$pdf->SetDrawColor(209, 212, 207);
$pdf->SetLineWidth(.3);
/*Heading Of the table*/
$pdf->Cell(10 ,6,'Sl',1,0,'C');
$pdf->Cell(30 ,6,'Date',1,0,'C');
$pdf->Cell(30 ,6,'Size',1,0,'C');
$pdf->Cell(28 ,6,'Truck Loads',1,0,'C');
$pdf->Cell(30 ,6,'Qty(CFT)',1,0,'C');
$pdf->Cell(30 ,6,'Price(CFT)',1,0,'C');
$pdf->Cell(30 ,6,'Total',1,1,'C');/*end of line*/
/*Heading Of the table end*/

$pdf->SetFont('Arial','',10);

for ($i = 0; $i <= 10; $i++) {
	$pdf->Cell(10 ,6,$i,1,0,'C');
	$pdf->Cell(30 ,6,$date,1,0,'C');
	$pdf->Cell(30 ,6,'3/4',1,0,'C');
	$pdf->Cell(28 ,6,'1',1,0,'C');
	$pdf->Cell(30 ,6,'1500',1,0,'C');
	$pdf->Cell(30 ,6,'100.00',1,0,'C');
	$pdf->Cell(30 ,6,'15100.00',1,1,'R');
}

$pdf->SetFont('Arial','B',10);

$pdf->Cell(70 ,6,'',0,0);
$pdf->Cell(28 ,6,'Total Quantity:',1,0,'R');
$pdf->Cell(30 ,6,'151000',1,0,'C');
$pdf->Cell(30 ,6,'Subtotal:',1,0,'R');
$pdf->Cell(30 ,6,'151000.00',1,1,'R');

$pdf->Cell(128 ,6,'',0,0);
$pdf->Cell(30 ,6,'Prev. Due:',0,0,'R');
$pdf->Cell(30 ,6,'151000.00',1,1,'R');

$pdf->Cell(118 ,6,'',0,0);
$pdf->Cell(40 ,6,'Deposite (20 Jan 2021) :',0,0,'R');
$pdf->Cell(30 ,6,'151000.00',1,1,'R');

$pdf->Cell(128 ,6,'',0,0);
$pdf->Cell(30 ,6,'Total Due :',0,0,'R');
$pdf->Cell(30 ,6,'151000.00',1,1,'R');
 

$pdf->Output();
 


