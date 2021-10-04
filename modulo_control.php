<?php

require 'clases/conexion.php';

switch ($_REQUEST['accion']) {
    case 1://insertar
        $sql = "insert into marca(mod_cod,mod_nombre) "
                . "values((select coalesce(max(mod_cod),0)+1 from marca),'" . $_REQUEST['vmod_nombre'] . "')";
        $mensaje = "Se guardo correctamente";
        break;

    case 2://actualizar
        $sql="update marca set mod_nombre = '".$_REQUEST['vmod_nombre']."' where mod_cod =".$_REQUEST['vmod_cod'];
        $mensaje = "Se actualizo correctamente";
        break;
    case 3://borrar
        $sql="delete from marca where mod_nombre =".$_REQUEST['vmod_cod'];
        $mensaje = "Se borro correctamente";
        break;    
}
session_start(); /* reanudar la sesión */

if (consultas::ejecutar_sql($sql)) {
    $_SESSION['mensaje'] = $mensaje;
    header("location:marca_index.php");
} else {
    $_SESSION['mensaje'] = 'Error al procesar \n' . $sql;
    header("location:marca_index.php");
}
