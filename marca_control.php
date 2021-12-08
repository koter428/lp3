<?php
require 'ver_session.php'; /*VERIFICAR SESSION*/
require 'clases/conexion.php';
require 'funciones/lib_funciones.php';

@session_start();

$accion = $_REQUEST['accion'];
$accion_desde = $accion;
if(strcmp($accion,"5") == 0) $accion = "1";

if(strcmp($accion,"1") == 0 || strcmp($accion,"2") == 0){
    $sql = "select sp_marca(" . $accion . "," . (!empty($_REQUEST['vmar_cod']) ? $_REQUEST['vmar_cod'] : 0) . ",'" .
    (!empty($_REQUEST['vmar_descri']) ? $_REQUEST['vmar_descri'] : '') . "') as resul";
}
else if (strcmp($accion,"3") == 0){
    $sql = "select sp_marca(" . $accion . "," . $_REQUEST['vmar_cod']. ",'') as resul";
}
//echo $sql; return;

$mensaje = consultas::get_datos($sql);

if (isset($mensaje)) {
    if (strcmp($accion_desde,"5") == 0){ 
        header("location:articulo_add.php");
    }
    else{ 
        $mensaje = fn_separar_mensajebd($mensaje[0]["resul"]);
        $_SESSION['mensaje'] = $mensaje[0];
        header("location:" . $mensaje[1] . ".php");
    }
} else {
    $_SESSION['mensaje'] = "Error al procesar " . pg_last_error();
    header("location:" . "marca_index.php");
} 