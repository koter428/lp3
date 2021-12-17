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
   // $pdf = new MYPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf=new MYPDF('L','mm','A4');
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('lp3');
    $pdf->SetTitle('REPORTE DE TRANSFERENCIAS');
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


// ---------------------------------------------------------
// TIPO DE LETRA
$pdf->SetFont('times', 'B', 12);

// AGREGAR PAGINA
$pdf->AddPage('P', 'LEGAL');
$pdf->Cell(0, 0, "REPORTE DE TRANSFERENCIAS", 0, 1, 'C');
//SALTO DE LINEA
$pdf->Ln();
if (!empty(isset($_REQUEST['opcion']))) {
    switch ($_REQUEST['opcion']) {
        case 1://fecha            
            $cabeceras = consultas::get_datos("select * from v_transfer "
                            . "where tra_fecha::date between '" . $_REQUEST['vdesde'] . "' and '" . $_REQUEST['vhasta'] . "'");
            break;
        case 2: //deposito
            $cabeceras = consultas::get_datos("select * from v_transfer where dep_cod in(" . $_REQUEST['vdep_cod'] . ")");
            break;
        case 3: //articulo
            $cabeceras = consultas::get_datos("select * from v_transfer "
                            . "where tra_cod in(select tra_cod from transferencia_detalle where art_cod in(" . $_REQUEST['vart_cod'] . "))");
            break;
        case 4: //empleado
            $cabeceras = consultas::get_datos("select * from v_transfer where emp_cod in(" . $_REQUEST['vempleado'] . ")");
            break;        
    }
} else {
    $cabeceras = consultas::get_datos("select * from v_transfer where tra_cod =" . $_REQUEST['vtra_cod']);
}

$pdf->SetFont('times', '', 8);
if (!empty($cabeceras)) {
    foreach ($cabeceras as $cabecera) {
        $pdf->Cell(80, 2, "FECHA: " . $cabecera['tra_fecha'], 0, 1);
        $pdf->Cell(130, 2, "ELABORADO POR: " . $cabecera['empleado'], 0, '', 'L');
        $pdf->Cell(130, 2, "SUCURSAL: " . $cabecera['suc_descri'], 0, '', 'L');         
        $pdf->Cell(130, 2, "OBSERVACION: " . $cabecera['tra_obser'], 0, '', 'L');         
        $pdf->Cell(0, 8, "", 0, '', 'L');
        $pdf->Ln();
//COLOR DE TABLA
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.2);

        $pdf->SetFont('', 'B', 6);
        // Header        
        $pdf->SetFillColor(180, 180, 180);
        
        $sql = "select origen.dep_descri as dep_ori,
                destino.dep_descri as dep_des,
                articulo.art_cod,
                articulo.art_descri,
                coalesce(transferencias_detalle.tra_cant,0) as tra_cant,
                coalesce(transferencias_detalle.tra_precio,0) as tra_precio,
                transferencias.tra_cod 
                from transferencias full outer join transferencias_detalle on transferencias.tra_cod = transferencias_detalle.tra_cod
                full outer join deposito as origen on transferencias_detalle.dep_ori = origen.dep_cod
                full outer join deposito as destino on transferencias_detalle.dep_des = destino.dep_cod
                full outer join articulo on transferencias_detalle.art_cod = articulo.art_cod,
                empleado
                where transferencias.emp_cod = empleado.emp_cod
                and transferencias.tra_cod = " . $cabecera['tra_cod'];
        //echo $sql; return; 
        $detalles = consultas::get_datos($sql);
        if (!empty($detalles)) {
            $pdf->Cell(24, 5, 'ORIGEN.', 1, 0, 'L', 1);
            $pdf->Cell(8, 5, 'COD.', 1, 0, 'C', 1);
            $pdf->Cell(53, 5, 'DESCRIPCION', 1, 0, 'C', 1);
            $pdf->Cell(24, 5, 'DESTINO', 1, 0, 'L', 1);
            $pdf->Cell(8, 5, 'PREC.', 1, 0, 'C', 1);
            $pdf->Cell(8, 5, 'CANT.', 1, 0, 'C', 1);
            $pdf->Cell(14, 5, 'SUBTOTAL', 1, 0, 'C', 1);
            $pdf->Ln();
            $pdf->SetFont('', '');
            $pdf->SetFillColor(255, 255, 255);

            foreach ($detalles as $det) {
                $pdf->Cell(24, 5, $det['dep_ori'], 1, 0, 'L', 1);
                $pdf->Cell(8, 5, $det['art_cod'], 1, 0, 'C', 1);
                $pdf->Cell(53, 5, $det['art_descri'], 1, 0, 'L', 1);
                $pdf->Cell(24, 5, $det['dep_des'], 1, 0, 'L', 1);
                $pdf->Cell(8, 5, number_format($det['tra_precio'], 0, "", "."), 1, 0, 'C', 1);
                $pdf->Cell(8, 5, number_format($det['tra_cant'],2,",","."), 1, 0, 'C', 1);
                $pdf->Cell(14, 5, number_format($det['tra_precio'] * $det['tra_cant'], 0, "", "."), 1, 0, 'C', 1);
                $pdf->Ln();
            }
            $pdf->SetFont('', 'B', 7);
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(139, 2, "TOTAL: " . number_format($cabeceras[0]['tra_total'],0 , "","."), 1, 0, 'L', 1);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetFont('times', '', 11);
        } else {
            $pdf->Cell(165, 2, "La transferencia no posee detalles", 0, '', 'L', 1);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetFont('times', '', 11);
        }
    }
} else {
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetLineWidth(0.2);
    $pdf->Cell(165, 2, "No se encontraron registros", 0, '', 'L', 1);
}

//SALIDA AL NAVEGADOR
$pdf->Output('reporte_transferencia.pdf', 'I');
?>