<?php
require 'ver_session.php'; /*VERIFICAR SESSION*/
include_once './tcpdf/tcpdf.php';
include_once 'clases/conexion.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 0, 'Pag. ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }

}

// create new PDF document // CODIFICACION POR DEFECTO ES UTF-8
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('lp3');
$pdf->SetTitle('REPORTE DE AJUSTES DE MOTIVOS');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins POR DEFECTO
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(8,10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks SALTO AUTOMATICO Y MARGEN INFERIOR
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


// ---------------------------------------------------------
// TIPO DE LETRA
$pdf->SetFont('times', 'B', 18);

// AGREGAR PAGINA
$pdf->AddPage('P', 'LEGAL');
$pdf->Cell(0, 0, "REPORTE DE MOTIVO DE AJUSTES", 0, 1, 'C');
//SALTO DE LINEA
$pdf->Ln();
//COLOR DE TABLA
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);

$pdf->SetFont('', 'B', 12);
// Header        
$pdf->SetFillColor(180, 180, 180);
$pdf->Cell(10, 5, '#', 1, 0, 'C', 1);
$pdf->Cell(110, 5, 'DESCRIPCION', 1, 0, 'C', 1);
$pdf->Cell(0, 5, 'TIPO DE MOTIVO', 1, 0, 'C', 1);

$pdf->Ln();
$pdf->SetFont('', '');
$pdf->SetFillColor(255, 255, 255);
//CONSULTAS DE LOS REGISTROS
//print_r($_REQUEST);return;
if (!empty(isset($_REQUEST['vdesde'])) && !empty(isset($_REQUEST['vhasta']))) {
    if ($_REQUEST['opcion'] == 1) { //por codigo
        $ajustes = consultas::get_datos("select * from ajustes_motivos where mot_tipo between ".$_REQUEST['vdesde']." and ".$_REQUEST['vhasta']);
    }else{
        $ajustes = consultas::get_datos("select * from ajustes_motivos where mot_descri between '".$_REQUEST['vdesde']."' and '".$_REQUEST['vhasta']."'");
    }
}else{
    $ajustes = consultas::get_datos("select * from ajustes_motivos order by mot_cod");
}
if (!empty($ajustes)) {
    foreach ($ajustes as $ajus) {
        $pdf->Cell(10, 5, $ajus['mot_cod'], 1, 0, 'C', 1);
        $pdf->Cell(110, 5, $ajus['mot_descri'], 1, 0, 'L', 1);
        $pdf->Cell(0, 5, ($ajus['mot_tipo'] == "E" ? "ENTRADA" : "SALIDA"), 1, 0, 'L', 1);
        $pdf->Ln();
    }
}else{
    $pdf->Cell(0, 0, "No se han registrado motivos de ajustes", 1, 0, 'L', 1);
}


//SALIDA AL NAVEGADOR
$pdf->Output('reporte_ajustes_motivos.pdf', 'I');
?>