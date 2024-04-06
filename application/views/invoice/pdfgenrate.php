<?php

ini_set('display_errors', 1);
error_reporting(0);
// $path = "/assets/library/mpdf61/mpdf.php";

$path = "plugin/mpdf61/mpdf.php";

include $path;
$html = array();
ob_start();
$this->load->view('Invoice/pdf',$data);
$html[0] = ob_get_clean();
ob_end_flush();

function downloadPdf($invoice, $html, $mr = 2, $mode = 'I')
{

        $mpdf = new mPDF('utf-8', 'A4', '', '', $mr, $mr, $mr, $mr);

        foreach ($html as $key => $content) {

            if ($key > 0) {
                $mpdf->AddPage();
            }
            $mpdf->WriteHTML($content);
        }
        if( $mode =='F') {
            return $mpdf->Output($invoice, $mode);
        } else {
            return $mpdf->Output($invoice, $mode);

        }
}


?>


