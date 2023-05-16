<?php

// Error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/* PDF CODE STARTS NOW */


// Custom function to insert the PDF cells

function insert_cell($pdf, $X = 0, $Y = 0, $CellWidth = 0, $CellHeight = 0, $text = "", $border = 0, $alignment = 'L', $fill = false)
{
    $pdf->SetY($Y);
    $pdf->SetX($X);
    $pdf->Cell($CellWidth, $CellHeight, $text, $border, 0, $alignment, $fill);
}






require_once('fpdf/fpdf.php');
require_once('fpdf/extension.php');

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddFont('PPL', '', 'Poppins-Light.php');
$pdf->AddFont('PPM', '', 'Poppins-Medium.php');
$pdf->AddFont('PPB', '', 'Poppins-ExtraBold.php');
$pdf->AddFont('OSB', '', 'OpenSans-ExtraBold.php');

$pdf->AddPage();




$pdf->SetAutoPageBreak(true,0);

/* Header Portion start */

// outer border
// $pdf->SetLineWidth(0.5);
// $pdf->SetDrawColor(12, 78, 173);
// insert_cell($pdf, $X = 0.2, $Y = 0.2, $CellWidth = 209.6, $CellHeight = 296.5, $text = "", $border = 1, $alignment = 'L', $fill = false);
// $pdf->SetLineWidth(0);
// $pdf->SetDrawColor(0, 0, 0);

// proforma polygon
$pdf->SetFillColor(32, 32, 32);
$pdf->Polygon(array(0,0,86.5,0,96.5,17.3,0,17.3),'F');
$pdf->SetFont("OSB", "", "32");
$pdf->SetTextColor(255,255,255);
insert_cell($pdf, $X = 0, $Y = 0, $CellWidth = 80, $CellHeight = 18, $text = "PROFORMA", $border = 0, $alignment = 'C', $fill = false);

$pdf->SetFillColor(12, 78, 173);
$pdf->Polygon(array(86.3,0,210,0,210,33.3,105.8,33.3),'F');
$pdf->SetFont("OSB", "", "42");
insert_cell($pdf, $X = 121, $Y = 6.2, $CellWidth = 80, $CellHeight = 18, $text = "INVOICE", $border = 0, $alignment = 'C', $fill = false);
$pdf->SetFont("PPL", "", "10");
insert_cell($pdf, $X = 155, $Y = 22, $CellWidth = 50, $CellHeight = 6, $text = "23/ FEB/ 2023", $border = 0, $alignment = 'C', $fill = false);

$pdf->SetFillColor(221, 221, 221);
$pdf->Polygon(array(0,17.3,96.7,17.3,101,25,0,24.5),'F');
$pdf->SetFont("PPM", "", "9");
$pdf->SetTextColor(0,0,0);
insert_cell($pdf, $X = 14, $Y = 12, $CellWidth = 80, $CellHeight = 18, $text = "DSO IFZA, Dubai digital park, Dubai Silicon Oasis, Dubai", $border = 0, $alignment = 'C', $fill = false);

$pdf->Image('src/flag.png', 5, 18, 5.5, 0);
$pdf->Image('src/blueMMlogo.png', 157, 34, 37, 0);
$pdf->SetFont("PPB", "", "10");
insert_cell($pdf, $X = 151, $Y = 63, $CellWidth = 50, $CellHeight = 6, $text = "MILLIONMINER.COM", $border = 0, $alignment = 'C', $fill = false);
$pdf->SetFont("PPM", "", "10");
insert_cell($pdf, $X = 151, $Y = 68, $CellWidth = 50, $CellHeight = 6, $text = "+49 (0)176 777 888 33", $border = 0, $alignment = 'C', $fill = false);


/* Header Portion end */
$x = 17;
$y = 35;
$pdf->SetFont("PPM", "", "13");
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = iconv('UTF-8', 'windows-1252', "Invoice To"), $border = 0, $alignment = 'L', $fill = false);
$pdf->SetFont("PPL", "", "10");
$y+=7;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = iconv('UTF-8', 'windows-1252', "1Company Name (optional)"), $border = 0, $alignment = 'L', $fill = false);
$y+=6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = iconv('UTF-8', 'windows-1252', "Márton Érsek nächste heißen"), $border = 0, $alignment = 'L', $fill = false);
$y+=6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = "3Street Name(and no#)", $border = 0, $alignment = 'L', $fill = false);
$y+=6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = "4City, Country", $border = 0, $alignment = 'L', $fill = false);
$y+=6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = "5Postal Code: 123456", $border = 0, $alignment = 'L', $fill = false);
$y+=6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = "6Contact Phone", $border = 0, $alignment = 'L', $fill = false);
$y+=6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = "7Contact Email (optional)", $border = 0, $alignment = 'L', $fill = false);

$pdf->SetFont("PPM", "", "10");
$y = 88;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 65, $CellHeight = 6, $text = "Port of Loading", $border = 0, $alignment = 'L', $fill = false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 65, $CellHeight = 6, $text = "Port of Destination", $border = 0, $alignment = 'L', $fill = false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 45, $CellHeight = 6, $text = "Invoice No:", $border = 0, $alignment = 'R', $fill = false);

$pdf->SetFont("PPL", "", "10");
$y = 93;
$x = 17;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 65, $CellHeight = 6, $text = "8Hongkong", $border = 0, $alignment = 'L', $fill = false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 65, $CellHeight = 6, $text = "9Germany", $border = 0, $alignment = 'L', $fill = false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 45, $CellHeight = 6, $text = "12345678", $border = 0, $alignment = 'R', $fill = false);

$pdf->SetFillColor(32,32,32);
$pdf->Rect(17,110,145,15,"F");
$pdf->SetFillColor(12, 78, 173);
$pdf->Rect(161,110,30,15,"F");

$pdf->SetTextColor(255,255,255);
$pdf->SetFont("PPM", "", "11");
$x = 22;
$y = 115;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 95, $CellHeight = 6, $text = "PRODUCT", $border = 0, $alignment = 'L', $fill = false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 27, $CellHeight = 6, $text = "PRICE", $border = 0, $alignment = 'L', $fill = false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 6, $text = "QTY", $border = 0, $alignment = 'L', $fill = false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 20, $CellHeight = 6, $text = "TOTAL", $border = 0, $alignment = 'L', $fill = false);

/* Products Portion START */
$desc = "ASIC MINER
*Model: S19
*Condition: Brand new
*Hashrate: 96Th/s±5%
*After-sales service and
policy is subject
to official policy";


$pdf->SetFont("PPL", "", "10");
$pdf->SetTextColor(0,0,0);
$x = 22;
$y = 126;
$pdf->SetXY($x,$y);

// $this->MultiCell($w,5,$data[$i],0,$a);
$pdf->MultiCell(55,5,utf8_decode($desc),0,"L");
$height_of_multicell = $pdf->NbLines(55,$desc);
$height_of_multicell /= 2;
$height_of_multicell*=4;
$pdf->Image('images/img.png',$x+55,$y,35,0);
$x+=95;
insert_cell($pdf, $X = $x, $Y = $y+$height_of_multicell, $CellWidth = 20, $CellHeight = 6, $text = "1,866.5 $", $border = 0, $alignment = 'L', $fill = false);
$x+=29;
insert_cell($pdf, $X = $x, $Y = $y+$height_of_multicell, $CellWidth = 20, $CellHeight = 6, $text = "4", $border = 0, $alignment = 'L', $fill = false);
$x+=22;
insert_cell($pdf, $X = $x, $Y = $y+$height_of_multicell, $CellWidth = 20, $CellHeight = 6, $text = "7,466.00 $", $border = 0, $alignment = 'L', $fill = false);

$y = $pdf->GetY() + ($height_of_multicell*2);
$pdf->Line(17,$y,190,$y);

$y+=3;

$subheads_y = $y;
$pdf->SetFont("PPM", "", "11");
$x=95;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 70, $CellHeight = 6, $text = "SUB TOTAL", $border = 0, $alignment = 'L', $fill = false);
$y+=6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 70, $CellHeight = 6, $text = "DISCOUNT", $border = 0, $alignment = 'L', $fill = false);
$pdf->SetFont("PPL", "", "11");
$y = $subheads_y;
$x=$pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 6, $text = "7,466.00 $", $border = 0, $alignment = 'R', $fill = false);
$y+=6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 6, $text = "0.00 $", $border = 0, $alignment = 'R', $fill = false);

$y += 10;
$pdf->SetFillColor(12, 78, 173);
$pdf->Rect(90,$y,100,12,"F");

$pdf->SetFont("PPM", "", "12");
$pdf->SetTextColor(255,255,255);
$x = 95;
$y+=3;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 70, $CellHeight = 6, $text = "GRAND TOTAL", $border = 0, $alignment = 'L', $fill = false);
$x=$pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 6, $text = "7,466.00 ".chr(128), $border = 0, $alignment = 'R', $fill = false);
// $price = 12345678;
// $formatted_price = number_format($price, 2, '.', ','); // $formatted_price will be "1,234.56"
// insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 6, $text = $formatted_price."$", $border = 0, $alignment = 'R', $fill = false);


$y += 10;
$pdf->SetFillColor(12, 78, 173);
$pdf->Rect(90,$y,50,8,"F");
$x = 95;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 70, $CellHeight = 6, $text = "PAYMENT DETAILS", $border = 0, $alignment = 'L', $fill = false);

$pdf->SetMargins(0,0,0);
$pdf->SetXY(0,$y-10);
$pdf->Cell(0, 20, "", 0, 1, 'C',$pdf->Image('src/Payment/bank-transfer.png',20,$y-10,0,70));
// $pdf->Cell(0, 20, "", 0, 1, 'C',$pdf->Image('src/Payment/crypto-btc.png',0,$y-15,0,70));
// $pdf->Cell(0, 20, "", 0, 1, 'C',$pdf->Image('src/Payment/crypto-usdt.png',0,$y-15,0,70));


// $pdf->SetWidths(array(55,40, 27, 25, 25));
// for($i=0;$i<4;$i++)
// {
//     $pdf->Row(array(utf8_decode($desc), 'sentence','1,866.5 $', '4', '7,466.00 $'));
// }

/* Products Portion END */



/* Footer Portion START */
$pdf->SetTextColor(0,0,0);
$pdf->Image('src/signature.png', 90, 240, 32, 0);
$pdf->SetFont("PPL", "", "7");
$pdf->SetXY(0,255);
$pdf->MultiCell(210,3.7,"1. For stock order(new / used)
The price of miners has to be adjusted frequently in accordance with variables like the exchange rate of the cryptocurrency with fiat, the
cryptocurrency's network difficulty, or the expected difficulty increase, so the price is only valid on the China Timezone date of PI, If inventory or market
quotes fluctuate greatly, We reserve the right to change the price even after payment is done, just we will communicate with customers to reconfirm the
delivery date or price accordingly and friendly.
2. A request to cancel the order, refund any part of the ordered amount or change the ordered items to different items or
different batches will not be entertained.. We advise you to make any purchase only after consideration.
3. Shipping cost included, Trade term: DDP.",0,"C");

$pdf->SetFont("OSB", "", "10");
$pdf->SetDrawColor(12, 78, 173);
$pdf->SetLineWidth(3);
$pdf->SetFillColor(32, 32, 32);
$pdf->SetTextColor(255,255,255);
insert_cell($pdf, $X = 0, $Y = 287, $CellWidth = 210, $CellHeight = 10, $text = "", $border = "T", $alignment = 'C', $fill = true);
$y = 290;
$pdf->Image('src/wa.png', 36, 290, 40, 0);
$pdf->Image('src/mail.png', 80, 290, 45, 0);
$pdf->Image('src/web.png', 130, 290, 45, 0);
// $x = $pdf->GetX();
// insert_cell($pdf, $X = 50, $Y = $y, $CellWidth = 20, $CellHeight = 5, $text = "+49 (0)176 777 888 33", $border = 0, $alignment = 'C', $fill = true);
/* Footer  Portion end */

$pdf->Output("I", 'output.pdf');


// header("location:index.php");
