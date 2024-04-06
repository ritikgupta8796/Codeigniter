<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . "plugin/fpdf/fpdf.php";

class Generatepdf
{
    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function DownloadPdf($invoice, $html, $data)
    {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $pdf->Image('Sansoftwares-logo-1.png', 120, 12, 0, 0, 'PNG', 'https://sansoftwares.com/');
        // $pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/assets/img/Sansoftwares-logo-1.png', 10, 10, 50);
        // Adjust the path and position as needed

        // Header
        // $pdf->SetFillColor(176, 5, 24);
        // $pdf->SetTextColor(255, 255, 255);
        // $pdf->Cell(0, 10, "SAN Softwares Pvt Ltd", 0, 1, 'C', true);
        // $pdf->Ln(10);

        // Client Details
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, "Client Details", 0, 21, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(30, 10, "Name:", 0, 0);
        $pdf->Cell(0, 10, $data['cleint_data'][0]['client_name'], 0, 1);
        $pdf->Cell(30, 10, "Email:", 0, 0);
        $pdf->Cell(0, 10, $data['cleint_data'][0]['client_email'], 0, 1);
        $pdf->Cell(30, 10, "Mobile No.:", 0, 0);
        $pdf->Cell(0, 10, $data['cleint_data'][0]['client_phone'], 0, 1);
        $pdf->Cell(30, 10, "Address:", 0, 0);
        $pdf->MultiCell(0, 10, $data['cleint_data'][0]['address'], 0);
        $pdf->Cell(30, 10, "Invoice No.:", 0, 0);
        $pdf->Cell(0, 10, $data['cleint_data'][0]['id'], 0, 1);
        $pdf->Cell(30, 10, "Invoice Date:", 0, 0);
        $pdf->Cell(0, 10, date_format(new DateTime($data['cleint_data'][0]['invoice_date']), "d/M/Y"), 0, 1);
        $pdf->Ln(10);

        // Item Details
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, "Item Details", 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(20, 10, "Sno", 1, 0, 'C', true);
        $pdf->Cell(60, 10, "Item Name", 1, 0, 'C', true);
        $pdf->Cell(40, 10, "Price", 1, 0, 'C', true);
        $pdf->Cell(30, 10, "Quantity", 1, 0, 'C', true);
        $pdf->Cell(40, 10, "Amount", 1, 1, 'C', true);

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetFillColor(239, 239, 239);

        $Sno = 1;
        foreach ($data['item_data'] as $value) {
            $pdf->Cell(20, 10, $Sno, 1, 0, 'C', true);
            $pdf->Cell(60, 10, $value['item_name'], 1, 0, 'C', true);
            $pdf->Cell(40, 10, $value['item_price'], 1, 0, 'R', true);
            $pdf->Cell(30, 10, $value['item_qty'], 1, 0, 'R', true);
            $pdf->Cell(40, 10, $value['common_amount'], 1, 1, 'R', true);
            $Sno++;
        }
        $pdf->Ln(10);

        // Total Amount
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, "Total Amount:", 0, 0, 'L');
        $pdf->SetFont('Arial', '', 14);
        $pdf->Cell(0, 10, $data['cleint_data'][0]['total_amount']. ".00", 0, 1, 'R');
        $pdf->Ln(20);


        $pdf->SetFillColor(176, 5, 24);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 10, "SAN Softwares Pvt Ltd", 0, 1, 'C', true);
        $pdf->Ln(10);

        // Thank You
        $pdf->SetFont('Arial', 'I', 16);
        $pdf->SetTextColor(176, 5, 24);
        $pdf->Cell(0, 10, "Thank You", 0, 1, 'C');

        $pdf->Output($invoice, 'F');
    }
}

?>

















