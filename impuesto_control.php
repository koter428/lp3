<?php

require 'clases/conexion.php';

switch ($_REQUEST['accion']) {
    case 1: //insertar
        $sql = "insert into tipo_impuesto(tipo_cod,tipo_descri,tipo_porcen) "
            . "values((select coalesce(max(tipo_cod),0)+1 from tipo_impuesto),'"
            . $_REQUEST['vtipo_descri'] . "'," . $_REQUEST['vtipo_porcen'] . ")";
        $mensaje = "Se guardo correctamente";
        break;

    case 2: //actualizar
        $sql = "update tipo_impuesto set tipo_descri = '" . $_REQUEST['vtipo_descri']
            . "', tipo_porcen='" . $_REQUEST['vtipo_porcen']
            . "' where tipo_cod ='" . $_REQUEST['vtipo_cod']
            . "'";
        $mensaje = "Se actualizo correctamente";
        break;

    case 3: //borrar
        $sql = "UPDATE articulo "
            . "SET tipo_cod=0 "
            . "WHERE tipo_cod='"
            . $_REQUEST['vtipo_cod'] . "';"
            . "delete from tipo_impuesto where tipo_cod='"
            . $_REQUEST['vtipo_cod'] . "'";
        $mensaje = "Se borro correctamente";
        break;
}
session_start(); /* reanudar la sesión */

if (consultas::ejecutar_sql($sql)) {
    $_SESSION['mensaje'] = $mensaje;
    header("location:impuesto_index.php");
} else {
    $_SESSION['mensaje'] = 'Error al procesar \n' . $sql;
    header("location:impuesto_index.php");
}
