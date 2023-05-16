<?php

$subtotal = 0;

for ($i = 0; $i < 2; $i++) {

    $desc = $prodname[$i]."
    *Model: {$model[$i]}
    *Condition: {$condition[$i]}
    *Hashrate: {$hashrate[$i]}
    *{$more[$i]}";

    $total = $price[$i]*$quantity[$i];
    $subtotal += $total;

    $pdf->SetFont("PPL", "", "8");
    $pdf->SetTextColor(0, 0, 0);
    $x = 22;
    $pdf->SetXY($x, $y + 1);
    // $this->MultiCell($w,5,$data[$i],0,$a);
    $pdf->MultiCell(55, 3, iconv('UTF-8', 'windows-1252', $desc), 0, "L");
    $lines = $pdf->NbLines(55, $desc);
    if($lines > 7 )
    {
        $lines *= 2.7;
        $buffer = $lines;
    }
    else{
        $buffer = 17;
    }
    $pdf->Image('images/'.$image[$i], $x + 55, $y + 1, 25, 20);
    $pdf->SetFont("PPL", "", "10");
    $x += 95;
    insert_cell($pdf, $X = $x, $Y = $y + $buffer/2, $CellWidth = 20, $CellHeight = 6, $text = number_format($price[$i], 2, '.', ',').' '.$currency, $border = 0, $alignment = 'L', $fill = false);
    $x += 29;
    insert_cell($pdf, $X = $x, $Y = $y + $buffer/2, $CellWidth = 20, $CellHeight = 6, $text = $quantity[$i], $border = 0, $alignment = 'L', $fill = false);
    $x += 22;
    insert_cell($pdf, $X = $x, $Y = $y + $buffer/2, $CellWidth = 20, $CellHeight = 6, $text = number_format($total, 2, '.', ',').' '.$currency, $border = 0, $alignment = 'L', $fill = false);

    $y = $pdf->GetY() + $buffer-4;
    $pdf->Line(17, $y, 190, $y);
}


$y += 3;
$subheads_y = $y;
$pdf->SetFont("PPM", "", "11");
$x = 95;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 70, $CellHeight = 6, $text = "SUB TOTAL", $border = 0, $alignment = 'L', $fill = false);
$y += 6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 70, $CellHeight = 6, $text = "DISCOUNT", $border = 0, $alignment = 'L', $fill = false);
$pdf->SetFont("PPL", "", "11");
$y = $subheads_y;
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 6, $text = number_format($subtotal, 2, '.', ',').' '.$currency, $border = 0, $alignment = 'R', $fill = false);
$y += 6;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 6, $text = number_format($discount, 2, '.', ',').' '.$currency, $border = 0, $alignment = 'R', $fill = false);

$y += 10;
$pdf->SetFillColor(12, 78, 173);
$pdf->Rect(90, $y, 100, 12, "F");

$pdf->SetFont("PPM", "", "12");
$pdf->SetTextColor(255, 255, 255);
$x = 95;
$y += 3;
$grand_total = $subtotal - $discount;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 70, $CellHeight = 6, $text = "GRAND TOTAL", $border = 0, $alignment = 'L', $fill = false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 6, $text = number_format($grand_total, 2, '.', ',').' '.$currency, $border = 0, $alignment = 'R', $fill = false);


$y += 10;
$pdf->SetFillColor(12, 78, 173);
$pdf->Rect(90, $y, 50, 8, "F");
$x = 95;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 70, $CellHeight = 6, $text = "PAYMENT DETAILS", $border = 0, $alignment = 'L', $fill = false);



$pdf->SetMargins(0, 0, 0);
$pdf->SetXY(0, $y - 10);

switch ($payment) {
    case 'bank':
        $pdf->Cell(0, 20, "", 0, 1, 'C', $pdf->Image('src/Payment/bank-transfer.png', 20, $y - 10, 0, 70));
        break;
    case 'btc':
        $pdf->Cell(0, 20, "", 0, 1, 'C',$pdf->Image('src/Payment/crypto-btc.png',0,$y-15,0,70));
        break;
    case 'usdt':
        $pdf->Cell(0, 20, "", 0, 1, 'C',$pdf->Image('src/Payment/crypto-usdt.png',0,$y-15,0,70));
        break;
    default:
        # code...
        break;
}

/* Products Portion END */



/* Footer Portion START */
$pdf->SetTextColor(0, 0, 0);
$pdf->Image('src/signature.png', 90, 245, 32, 0);
$pdf->SetFont("PPL", "", "6");
$pdf->SetXY(0, 260);
$pdf->MultiCell(210, 3, "1. For stock order(new / used)
The price of miners has to be adjusted frequently in accordance with variables like the exchange rate of the cryptocurrency with fiat, the
cryptocurrency's network difficulty, or the expected difficulty increase, so the price is only valid on the China Timezone date of PI, If inventory or market
quotes fluctuate greatly, We reserve the right to change the price even after payment is done, just we will communicate with customers to reconfirm the
delivery date or price accordingly and friendly.
2. A request to cancel the order, refund any part of the ordered amount or change the ordered items to different items or
different batches will not be entertained.. We advise you to make any purchase only after consideration.
3. Shipping cost included, Trade term: DDP.", 0, "C");