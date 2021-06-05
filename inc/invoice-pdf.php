<?php

if( isset($_POST['generate_posts_pdf'])){

    if (isset($_POST['post_id'])) {
        
        $post_id = $_POST['post_id']; 

    }

    output_pdf($post_id);

}

function qr_code($text){
    //$t=time();    

    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;

    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "invoice/qrlib.php";

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

/*add_action( 'admin_menu', 'as_fpdf_create_admin_menu' );
function as_fpdf_create_admin_menu() {
    $hook = add_submenu_page(
        'edit.php?post_type=invoice',
        'Atomic Smash PDF Generator',
        'Atomic Smash PDF Generator',
        'manage_options',
        'as-fdpf-tutorial',
        'as_fpdf_create_admin_page'
    );
}

function as_fpdf_create_admin_page() {    

?>
<div class="wrap">
    
    <form method="post">

        <button class="button button-primary" type="submit" name="generate_posts_pdf" value="generate">Download</button>

    </form>
</div>
<?php
}*/

function output_pdf($post_id) {  

    require('invoice/fpdf.php');   

    class PDF extends FPDF {           
        
        // Page header
        function Header(){
            
            $headerImage = get_template_directory_uri().'/inc/invoice/tutorial/header.png';

            // Pad Header
            $this->Image($headerImage,10,0,200);
            
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

    /*
    ## 
    *************************/     
    $order_date     = get_post_meta($post_id, 'order_date', true );
    $product_size   = get_post_meta($post_id, 'product_size', true );
    $truck_number   = get_post_meta($post_id, 'truck_number', true );
    $get_qty        = get_post_meta($post_id, 'quantity', true );
    $get_price      = get_post_meta($post_id, 'price', true );
    $get_total      = get_post_meta($post_id, 'total_price', true );

    $paid_amount    = get_post_meta($post_id, 'paid_amount', true );    

    $quantity       = ($get_qty) ? $get_qty : 0;    
    $price          = ($get_price) ? $get_price : 0;    
    $unit_total     = ($get_total) ? $get_total : 0;

    $subtotal       += $unit_total;
    $total_qty      += $quantity;
    $pre_due        = 150000;
    $deposite       = 100000;

    $type_nb        = get_post_meta($post_id, 'type_nb', true );
    

    $date = date("F j, Y");

    $padImage = get_template_directory_uri().'/inc/invoice/tutorial/pad_03.jpg';

    $footerImage = get_template_directory_uri().'/inc/invoice/tutorial/footer.png';


    /*
    ## 
    **************************************/
    $qrCodeText = '#'.$post_id.' - tk.70500/-';

    $qr_code = qr_code($qrCodeText);

    $qr_code_image = get_template_directory_uri().'/'.$qr_code;

    // Instanciation of inherited class
    $pdf = new PDF();

    $pdf->AliasNbPages();

    $pdf->AddPage();

    $pdf->SetFont('Arial','',12);

    $pdf->Image( $padImage ,10,55,190);

    $pdf->Image( $footerImage,0,250,110);

    $pdf->Image( $qr_code_image ,10,260,30);

    $pdf->Cell(0,6,'INVOICE TO:',0,1);
    $pdf->Cell(0,6,'Greenovation Eng. & Con. LTD',0,1);
    $pdf->Cell(0,6,'Nirala, Khulna,Bangladesh',0,1);

    // Set font
    $pdf->SetFont('Arial','B',18);

    $pdf->Cell(0,-30,'Invoice #'.$post_id,0,1,'R');

    $pdf->SetFont('Arial','',12);

    $pdf->Cell(0,43,'Date: '.$order_date,0,1,'R');

    $pdf->SetFont('Arial','IU',12);

    $pdf->Cell(0,-30,'www.salimbrothersbd.com',0,1,'R');

    $pdf->Ln(25);

    $pdf->SetFont('Arial','b',12);

    $pdf->Cell(0,6,'Subject: '.get_the_title($post_id) ,0,1);


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

    $pdf->Cell(10 ,6,$i+1,1,0,'C');
    $pdf->Cell(30 ,6,$order_date,1,0,'C');
    $pdf->Cell(30 ,6,$product_size,1,0,'C');
    $pdf->Cell(28 ,6,$truck_number,1,0,'C');
    $pdf->Cell(30 ,6,$quantity,1,0,'C');
    $pdf->Cell(30 ,6,'Tk. '.$price,1,0,'C');
    $pdf->Cell(30 ,6,'Tk. '.$unit_total,1,1,'R');

    //for ($i = 0; $i <= 10; $i++) {
    for ($counter = 1; $counter <= $type_nb; $counter++) { 

        ${'order_date'.$counter} = get_post_meta($post_id, 'order_date'.$counter.'', true ); 
        ${'product_size'.$counter} = get_post_meta($post_id, 'product_size'.$counter.'', true ); 
        ${'truck_number'.$counter} = get_post_meta($post_id, 'truck_number'.$counter.'', true ); 
        ${'get_qty'.$counter} = get_post_meta($post_id, 'quantity'.$counter.'', true );
        ${'get_price'.$counter} = get_post_meta($post_id, 'price'.$counter.'', true );
        ${'get_total'.$counter} = get_post_meta($post_id, 'total_price'.$counter.'', true );

        ${'quantity'.$counter} = (${'get_qty'.$counter}) ? ${'get_qty'.$counter} : 0;   
        ${'price'.$counter}  = (${'get_price'.$counter}) ? ${'get_price'.$counter} : 0; 
        ${'unit_total'.$counter} = (${'get_total'.$counter}) ? ${'get_total'.$counter} : 0; 

        $subtotal += ${'unit_total'.$counter};        
        $total_qty += ${'quantity'.$counter};

        $pdf->Cell(10 ,6,$counter+1,1,0,'C');
        $pdf->Cell(30 ,6,${'order_date'.$counter},1,0,'C');
        $pdf->Cell(30 ,6,${'product_size'.$counter},1,0,'C');
        $pdf->Cell(28 ,6,${'truck_number'.$counter},1,0,'C');
        $pdf->Cell(30 ,6,${'quantity'.$counter},1,0,'C');
        $pdf->Cell(30 ,6,'Tk. '.${'price'.$counter},1,0,'C');
        $pdf->Cell(30 ,6,'Tk. '.${'unit_total'.$counter},1,1,'R');
    }

    $pdf->SetFont('Arial','B',10);

    $pdf->Cell(70 ,6,'',0,0);
    $pdf->Cell(28 ,6,'Total Quantity:',1,0,'R');
    $pdf->Cell(30 ,6,$total_qty,1,0,'C');
    $pdf->Cell(30 ,6,'Subtotal:',1,0,'R');
    $pdf->Cell(30 ,6,'Tk. '.$subtotal,1,1,'R');

    $pdf->Cell(128 ,6,'',0,0);
    $pdf->Cell(30 ,6,'Prev. Due:',0,0,'R');
    $pdf->Cell(30 ,6,'Tk. '.$pre_due,1,1,'R');

    $pdf->Cell(118 ,6,'',0,0);
    $pdf->Cell(40 ,6,'Deposite (20 Jan 2021) :',0,0,'R');
    $pdf->Cell(30 ,6,'Tk. '.$deposite,1,1,'R');

    $pdf->Cell(118 ,6,'',0,0);
    $pdf->Cell(40 ,6,'Paid Amount :',0,0,'R');
    $pdf->Cell(30 ,6,'Tk. '.$paid_amount,1,1,'R');

    $total_due = ($subtotal + $pre_due) - $deposite - $paid_amount;

    $pdf->Cell(128 ,6,'',0,0);
    $pdf->Cell(30 ,6,'Total Due :',0,0,'R');
    $pdf->Cell(30 ,6, 'Tk. '.$total_due,1,1,'R');     

    //$pdf->Output();

    $pdf->Output('D', $post_id.'_invoice.pdf');

}