<?php
    require 'clases/conexion.php';
   // Validaciones
    $sms_error = "";
    $precio = $_REQUEST["vart_precioc"];
    if($precio < 0)
        $sms_error = "El precio de compra no debe ser negativo.";
    $precio = $_REQUEST["vart_preciov"];
    if($precio < 0)
        $sms_error = "El precio de venta no debe ser negativo.";
    
    session_start();
    if($sms_error != ""){
        $_SESSION['mensaje'] = $sms_error;
        header("location:articulo_index.php");
    }
    else{
        switch ($_REQUEST['accion']) {
        case 1:
            $sql = "select sp_articulo(" . $_REQUEST['accion'] . "," . $_REQUEST['vart_cod']
            . ",'" . $_REQUEST['vart_codbarra'] . "'," . (!empty($_REQUEST['vmar_cod'])?$_REQUEST['vmar_cod']:"0")
            . ",'" . strtoupper($_REQUEST['vart_descri']) . "'," . (!empty($_REQUEST['vart_precioc'])?$_REQUEST['vart_precioc']:"0")
            . ", " . (!empty($_REQUEST['vart_preciov'] )?$_REQUEST['vart_preciov']:"0")
            . "," . (!empty($_REQUEST['vtipo_cod'])?$_REQUEST['vtipo_cod']:"0") . ") as resul";

            $mensaje = 'Se inserto correctamente el cliente';
            break;

        case 2: //actualizar
            $sql = "update articulo set art_codbarra = '" . $_REQUEST['vart_codbarra']
                . "', mar_cod='" . $_REQUEST['vmar_cod']
                . "', art_descri='" . strtoupper($_REQUEST['vart_descri'])
                . "', art_precioc='" . $_REQUEST['vart_precioc']
                . "', art_preciov='" . $_REQUEST['vart_preciov']
                . "', tipo_cod='" . $_REQUEST['vtipo_cod']
                . "' where art_cod=" . $_REQUEST['vart_cod'];
            $mensaje = 'Se actualizo correctamente';
            break;

        case 3: //borrar
            $sql = "delete from articulo where art_cod ='" . $_REQUEST['vart_cod'] . "'";
            $mensaje = "Se borro correctamente";
            break;
        }

        if (consultas::ejecutar_sql($sql)) {
            $_SESSION['mensaje'] = $mensaje;
            header("location:articulo_index.php");
        } else {
            $_SESSION['mensaje'] = "Error al procesar " . pg_last_error();
            header("location:articulo_index.php");
        }
    }