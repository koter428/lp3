<?php
require 'ver_session.php'; /*VERIFICAR SESSION*/
require 'clases/conexion.php';

switch ($_REQUEST['accion']) {
    case 1://insertar
        $sql = "insert into proveedor values((select coalesce(max(prv_cod),0)+1 from proveedor),'"
                . $_REQUEST['vprv_ruc'] . "', '"
                . $_REQUEST['vprv_razonsocial'] . "', '"
                . $_REQUEST['vprv_direccion'] . "', '" . $_REQUEST['vprv_telefono'] . "')";

        $mensaje = "Se guardo correctamente";
        break;

    case 2://actualizar
        $sql = "update proveedor set prv_ruc='" . $_REQUEST['vprv_ruc'] 
            . "', prv_razonsocial='" . $_REQUEST['vprv_razonsocial'] 
            . "', prv_direccion='" . $_REQUEST['vprv_direccion'] 
            . "', prv_telefono='" . $_REQUEST['vprv_telefono'] 
            . "' where  prv_cod=" . $_REQUEST['vprv_cod'];

        $mensaje = "Se actualizo correctamente";
        break;

    case 3://borrar
        $sql = "delete from proveedor where  prv_cod =" . $_REQUEST['vprv_cod'];
        $mensaje = "Se borro correctamente";
        break;
}
@session_start(); /* reanudar la sesión */

if (consultas::ejecutar_sql($sql)) {
    $_SESSION['mensaje'] = $mensaje;
    header("location:proveedor_index.php");
} else {
    $_SESSION['mensaje'] = 'Error al procesar \n' . $sql;
    header("location:proveedor_index.php");
}
