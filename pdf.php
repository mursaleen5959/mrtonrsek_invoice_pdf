<?php

// Error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_POST['generatePDF'])) {
    $companyname = $_POST['companyname'];
    $customername = $_POST['customername'];
    $streetname = $_POST['streetname'];
    $cityname = $_POST['cityname'];
    $countryname = $_POST['countryname'];
    $postalcode = $_POST['postalcode'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $portloading = $_POST['portloading'];
    $portdestination = $_POST['portdestination'];
    $invoice = $_POST['invoice'];
    $autoDate = $_POST['autoDate'];
    $payment = $_POST['payment'];          // payment method to be used
    $noProducts = $_POST['noProducts'];    // number of products
    $discount = $_POST['discount']!=''?$_POST['discount']:0;
    $currency = $_POST['currency'] == 'dollar' ? '$':chr(128);

    $prodname = $_POST['prodname'];
    $model = $_POST['model'];
    $condition = $_POST['condition'];
    $hashrate = $_POST['hashrate'];
    $more = $_POST['more'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];
}


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
$pdf->SetAutoPageBreak(true, 0);

/* Header Portion start */

// proforma polygon
$pdf->SetFillColor(32, 32, 32);
$pdf->Polygon(array(0, 0, 86.5, 0, 96.5, 17.3, 0, 17.3), 'F');
$pdf->SetFont("OSB", "", "32");
$pdf->SetTextColor(255, 255, 255);
insert_cell($pdf, $X = 0, $Y = 0, $CellWidth = 80, $CellHeight = 18, $text = "PROFORMA", $border = 0, $alignment = 'C', $fill = false);

$pdf->SetFillColor(12, 78, 173);
$pdf->Polygon(array(86.3, 0, 210, 0, 210, 33.3, 105.8, 33.3), 'F');
$pdf->SetFont("OSB", "", "42");
insert_cell($pdf, $X = 121, $Y = 6.2, $CellWidth = 80, $CellHeight = 18, $text = "INVOICE", $border = 0, $alignment = 'C', $fill = false);
$pdf->SetFont("PPL", "", "10");
insert_cell($pdf, $X = 155, $Y = 22, $CellWidth = 50, $CellHeight = 6, $text = $autoDate, $border = 0, $alignment = 'C', $fill = false);

$pdf->SetFillColor(221, 221, 221);
$pdf->Polygon(array(0, 17.3, 96.7, 17.3, 101, 25, 0, 24.5), 'F');
$pdf->SetFont("PPM", "", "9");
$pdf->SetTextColor(0, 0, 0);
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
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = "Invoice To", $border = 0, $alignment = 'L', $fill = false);
$pdf->SetFont("PPL", "", "10");
$y += 7;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = iconv('UTF-8', 'windows-1252', $companyname), $border = 0, $alignment = 'L', $fill = false);
$y += 6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = iconv('UTF-8', 'windows-1252', $customername), $border = 0, $alignment = 'L', $fill = false);
$y += 6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = iconv('UTF-8', 'windows-1252', $streetname), $border = 0, $alignment = 'L', $fill = false);
$y += 6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = iconv('UTF-8', 'windows-1252', $cityname . ", " . $countryname), $border = 0, $alignment = 'L', $fill = false);
$y += 6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = "Postal Code: " . $postalcode, $border = 0, $alignment = 'L', $fill = false);
$y += 6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = $contact, $border = 0, $alignment = 'L', $fill = false);
$y += 6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 50, $CellHeight = 6, $text = $email, $border = 0, $alignment = 'L', $fill = false);

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
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 65, $CellHeight = 6, $text = iconv('UTF-8', 'windows-1252', $portloading), $border = 0, $alignment = 'L', $fill = false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 65, $CellHeight = 6, $text = iconv('UTF-8', 'windows-1252', $portdestination), $border = 0, $alignment = 'L', $fill = false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 45, $CellHeight = 6, $text = iconv('UTF-8', 'windows-1252', $invoice), $border = 0, $alignment = 'R', $fill = false);

$y = 102;
$pdf->SetFillColor(32, 32, 32);
$pdf->Rect(17, $y, 145, 15, "F");
$pdf->SetFillColor(12, 78, 173);
$pdf->Rect(161, $y, 30, 15, "F");

$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont("PPM", "", "11");
$x = 22;
$y = 107;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 95, $CellHeight = 6, $text = "PRODUCT", $border = 0, $alignment = 'L', $fill = false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 27, $CellHeight = 6, $text = "PRICE", $border = 0, $alignment = 'L', $fill = false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 6, $text = "QTY", $border = 0, $alignment = 'L', $fill = false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 20, $CellHeight = 6, $text = "TOTAL", $border = 0, $alignment = 'L', $fill = false);

/* Products Portion START */


$y = 117;

switch ($noProducts) {
    case '1':
        include_once('product_1.php');
        break;
    case '2':
        include_once('product_2.php');
        break;
    case '3':
        include_once('product_3.php');
        break;
    case '4':
        include_once('product_4.php');
        break;
    default:
        # code...
        break;
}




$pdf->SetFont("OSB", "", "10");
$pdf->SetDrawColor(12, 78, 173);
$pdf->SetLineWidth(3);
$pdf->SetFillColor(32, 32, 32);
$pdf->SetTextColor(255, 255, 255);
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
