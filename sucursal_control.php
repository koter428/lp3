<?php
require 'ver_session.php'; /*VERIFICAR SESSION*/
require 'clases/conexion.php';
require 'funciones/lib_funciones.php';

@session_start();

$accion = $_REQUEST['accion'];

if(strcmp($accion,"1") == 0 || strcmp($accion,"2") == 0){
    $sql = "select sp_sucursal(" . $accion . "," . (!empty($_REQUEST['vid_sucursal']) ? $_REQUEST['vid_sucursal'] : 0) . ",'" .
    (!empty($_REQUEST['vsuc_descri']) ? $_REQUEST['vsuc_descri'] : "") . "') as resul";
}
else if (strcmp($accion,"3") == 0){
    $sql = "select sp_sucursal(" . $accion . "," . $_REQUEST['vid_sucursal']. ",'') as resul";
}
//echo $sql; return;

$mensaje = consultas::get_datos($sql);

if (isset($mensaje)) {
    $mensaje = fn_separar_mensajebd($mensaje[0]["resul"]);
    $_SESSION['mensaje'] = $mensaje[0];
    header("location:" . $mensaje[1] . ".php");
} else {
    $_SESSION['mensaje'] = "Error al procesar " . pg_last_error();
    header("location:" . "sucursal_index.php");
}