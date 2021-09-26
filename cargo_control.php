<?php

require 'clases/conexion.php';

switch ($_REQUEST['accion']) {
    case 1://insertar
        $sql = "insert into cargo(car_cod,car_descri) "
                . "values((select coalesce(max(car_cod),0)+1 from cargo),'" . $_REQUEST['vcar_descri'] . "')";
        $mensaje = "Se guardo correctamente";
        break;

    case 2://actualizar
        $sql="update cargo set car_descri = '".$_REQUEST['vcar_descri']."' where car_cod =".$_REQUEST['vcar_cod'];
        $mensaje = "Se actualizo correctamente";
        break;
    case 3://borrar
        $sql="delete from cargo where car_cod =".$_REQUEST['vcar_cod'];
        $mensaje = "Se borro correctamente";
        break;    
}
session_start(); /* reanudar la sesión */

if (consultas::ejecutar_sql($sql)) {
    $_SESSION['mensaje'] = $mensaje;
    header("location:cargo_index.php");
} else {
    $_SESSION['mensaje'] = 'Error al procesar \n' . $sql;
    header("location:cargo_index.php");
}
