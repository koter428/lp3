<?php
    require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';
    require 'funciones/lib_funciones.php';

    @session_start();
    $accion = $_REQUEST['accion'];

    //print_r($_SESSION); return;
        if(strcmp($accion,"1") == 0 || strcmp($accion,"2") == 0){
            $sql = "select sp_ajustes(" . $accion . "," . (!empty($_REQUEST['vaju_cod']) ? $_REQUEST['vaju_cod'] : 0) . "," .
            (!empty($_SESSION['vemp_cod']) ? strtoupper($_SESSION['vemp_cod']) : 1) . "," .
            (!empty($_REQUEST['vaju_total']) ? $_REQUEST['vaju_total'] : 0) . ",'" .
            (!empty($_REQUEST['vaju_obser']) ? strtoupper($_REQUEST['vaju_obser']) : "") . "'," .
            (!empty($_SESSION['vid_sucursal']) ? $_SESSION['vid_sucursal'] : 1) . ") as resul";
        }
    else if (strcmp($accion,"3") == 0){
        $sql = "select sp_ajustes(" . $accion . "," . $_REQUEST['vaju_cod']. ") as resul";
    } 
    //echo $sql; return;
    $mensaje = consultas::get_datos($sql);

    if (isset($mensaje)) {
        $mensaje = fn_separar_mensajebd($mensaje[0]["resul"]);
        $_SESSION['mensaje'] = $mensaje[0];
        header("location:" . $mensaje[1] . ".php");
    } else {
        $_SESSION['mensaje'] = "Error al procesar " . pg_last_error();
        header("location:" . "ajustes_index.php");
    }
    