<?php
require 'clases/conexion.php';
session_start();

switch ($_REQUEST['accion']) {
    case 1:
        $sql = "insert into articulo"
            . "values((select coalesce(max(art_cod),0)+1 from articulo), '"
            . $_REQUEST['art_precioc'] . "','"
            . $_REQUEST['art_preciov'] . "','"
            . $_REQUEST['art_descri'] . "','"
            . $_REQUEST['tipo_cod'] . "')";

        $mensaje = 'Se inserto correctamente el cliente';
        break;

    case 2: //actualizar
        $sql = "update clientes set cli_ci = '" . $_REQUEST['vcli_ci']
            . "',cli_nombre='" . $_REQUEST['vcli_nombre']
            . "',cli_apellido='" . $_REQUEST['vcli_apellido']
            . "',cli_telefono='" . $_REQUEST['vcli_telefono']
            . "',cli_direcc='" . $_REQUEST['vcli_direcc']
            . "' where cli_cod=" . $_REQUEST['vcli_cod'];
        $mensaje = 'Se actualizo correctamente';
        break;
    case 3: //borrar
        $sql = "delete from clientes where cli_cod ='" . $_REQUEST['vcli_cod']
            . "',cli_nombre='" . $_REQUEST['vcli_nombre']
            . "',cli_apellido='" . $_REQUEST['vcli_apellido']
            . "',cli_telefono= '" . $_REQUEST['vcli_telefono']
            . "',cli_direcc='" . $_REQUEST['vcli_direcc']
            . "' where cli_cod =" . $_REQUEST['cli_cod'];
        $mensaje = "Se borro correctamente";
        break;
}

if (consultas::ejecutar_sql($sql)) {
    $_SESSION['mensaje'] = $mensaje;
    header("location:cliente_index.php");
} else {
    $_SESSION['mensaje'] = "Error al procesar " . $sql;
    header("location:cliente_index.php");
}
