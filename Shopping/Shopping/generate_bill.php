<?php
include 'config.php';
session_start();

$user_id = $_GET['user_id'];

if (!isset($user_id)) {
    header('Location: cart.php');
    exit;
}

// Fetch cart items for the user
$cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die('query failed');
$cart_items = [];
$total_price = 0;

while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
    $cart_items[] = $fetch_cart;
    $total_price += $fetch_cart['price'] * $fetch_cart['quantity'];
}

// Load FPDF library for PDF generation
require('fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Title of the bill
$pdf->Cell(200, 10, 'Invoice', 0, 1, 'C');
$pdf->Ln(10);

// Add cart items
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Item', 1);
$pdf->Cell(40, 10, 'Price', 1);
$pdf->Cell(40, 10, 'Quantity', 1);
$pdf->Cell(50, 10, 'Total', 1);
$pdf->Ln();

foreach ($cart_items as $item) {
    $pdf->Cell(50, 10, $item['name'], 1);
    $pdf->Cell(40, 10, '$' . $item['price'], 1);
    $pdf->Cell(40, 10, $item['quantity'], 1);
    $pdf->Cell(50, 10, '$' . ($item['price'] * $item['quantity']), 1);
    $pdf->Ln();
}

// Add the total price at the bottom
$pdf->Ln(10);
$pdf->Cell(110);
$pdf->Cell(30, 10, 'Grand Total: $' . $total_price, 0, 1, 'R');

// Output PDF to the browser
$pdf->Output();
exit;
?>
