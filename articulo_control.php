<?php
require 'clases/conexion.php';
session_start();

switch ($_REQUEST['accion']) {
    case 1:
        $sql = "insert into articulo "
            . "values((select coalesce(max(art_cod),0)+1 from articulo), '"
            . $_REQUEST['vart_codbarra'] . "','"
            . $_REQUEST['vmar_cod'] . "','"
            . $_REQUEST['vart_descri'] . "','"
            . $_REQUEST['vart_precioc'] . "','"
            . $_REQUEST['vart_preciov'] . "','"
            . $_REQUEST['vtipo_cod'] . "')";

        $mensaje = 'Se inserto correctamente el cliente';
        break;

    case 2: //actualizar
        $sql = "update articulo set art_codbarra = '" . $_REQUEST['vart_codbarra']
            . "', mar_cod='" . $_REQUEST['vmar_cod']
            . "', art_descri='" . $_REQUEST['vart_descri']
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
    $_SESSION['mensaje'] = "Error al procesar " . $sql;
    header("location:articulo_index.php");
}
