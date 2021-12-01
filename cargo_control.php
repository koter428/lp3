<?php
require 'ver_session.php'; /*VERIFICAR SESSION*/
require 'clases/conexion.php';
require 'funciones/lib_funciones.php';

@session_start();

$accion = $_REQUEST['accion'];

if(strcmp($accion,"1") == 0 || strcmp($accion,"2") == 0){
    $sql = "select sp_cargo(" . $accion . "," . (!empty($_REQUEST['vcar_cod']) ? $_REQUEST['vcar_cod'] : 0) . ",'" .
    (!empty($_REQUEST['vcar_descri']) ? $_REQUEST['vcar_descri'] : "") . "') as resul";
}
else if (strcmp($accion,"3") == 0){
    $sql = "select sp_cargo(" . $accion . "," . $_REQUEST['vcar_cod']. ",'') as resul";
}
//echo $sql; return;

$mensaje = consultas::get_datos($sql);

if (isset($mensaje)) {
    $mensaje = fn_separar_mensajebd($mensaje[0]["resul"]);
    $_SESSION['mensaje'] = $mensaje[0];
    header("location:" . $mensaje[1] . ".php");
} else {
    $_SESSION['mensaje'] = "Error al procesar " . pg_last_error();
    header("location:" . "cargo_index.php");
}