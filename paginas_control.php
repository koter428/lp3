<?php
require 'ver_session.php'; /*VERIFICAR SESSION*/
require 'clases/conexion.php';
require 'funciones/lib_funciones.php';

@session_start();

$accion = $_REQUEST['accion'];

if(strcmp($accion,"1") == 0 || strcmp($accion,"2") == 0){ 
    $sql = "select sp_paginas(" . $accion . "," . 
    (!empty($_REQUEST['vpag_cod']) ? $_REQUEST['vpag_cod'] : 0) . ",'" .
    (!empty($_REQUEST['vpag_direc']) ? strtolower($_REQUEST['vpag_direc']) : 0) . "','" .
    (!empty($_REQUEST['vpag_nombre']) ? strtoupper($_REQUEST['vpag_nombre']) : '') . "','" .
    (!empty($_REQUEST['vmod_cod']) ? $_REQUEST['vmod_cod'] : 0) . "') as resul";
}
else if (strcmp($accion,"3") == 0){
    $sql = "select sp_paginas(" . $accion . "," . $_REQUEST['vpag_cod'].  ") as resul";
}

// echo $sql;return;

$mensaje = consultas::get_datos($sql);

if (isset($mensaje)) {
        $mensaje = fn_separar_mensajebd($mensaje[0]["resul"]);
        $_SESSION['mensaje'] = $mensaje[0];
        header("location:" . $mensaje[1] . ".php");   
} else {
    $_SESSION['mensaje'] = "Error al procesar " . pg_last_error();
    header("location:" . "paginas_index.php");
}