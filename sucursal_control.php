<?php

require 'clases/conexion.php';

switch ($_REQUEST['accion']) {
    case 1://insertar
        $sql = "insert into sucursal(id_sucursal,suc_descri) "
                . "values((select coalesce(max(id_sucursal),0)+1 from sucursal),'".$_REQUEST['vsuc_descri']."')";
        $mensaje = "Se guardo correctamente";
        break;

     case 2://actualizari
        $sql="update sucursal set suc_descri = '".$_REQUEST['vsuc_descri']."' where  id_sucursal =".$_REQUEST['vid_sucursal'];
        $mensaje = "Se actualizo correctamente";
        break;
    case 3://borrar
        $sql="delete from sucursal where  id_sucursal =".$_REQUEST['vid_sucursal'];
        $mensaje = "Se borro correctamente";
        break;    
}
session_start(); /* reanudar la sesión */

if (consultas::ejecutar_sql($sql)) {
    $_SESSION['mensaje'] = $mensaje;
    header("location:sucursal_index.php");
} else {
    $_SESSION['mensaje'] = 'Error al procesar \n' . $sql;
    header("location:sucursal_index.php");
}

