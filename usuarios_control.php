<?php
    require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';
    require 'funciones/lib_funciones.php';

    @session_start();
    $accion = $_REQUEST['accion'];
    // print_r($_REQUEST); return;
        
    if(strcmp($accion,"1") == 0 || strcmp($accion,"2") == 0){
        $sql = "select sp_usuarios(" . $accion . "," . 
                (!empty($_REQUEST['vusu_cod']) ? $_REQUEST['vusu_cod'] : 0) . ",'" .
                (!empty($_REQUEST['vusu_nick']) ? strtoupper($_REQUEST['vusu_nick']) : "") . "','" .
                (!empty($_REQUEST['vusu_clave']) ? $_REQUEST['vusu_clave'] : 0) . "'," .
                (!empty($_REQUEST['vemp_cod']) ? strtoupper($_REQUEST['vemp_cod']) : "") . "," .
                (!empty($_REQUEST['vgru_cod']) ? $_REQUEST['vgru_cod'] : 0) . "," .
                (!empty($_REQUEST['vid_sucursal']) ?$_REQUEST['vid_sucursal'] : 1). ") as resul";
    }
    else if (strcmp($accion,"3") == 0){
        $sql = "select sp_usuarios(" . $accion . "," . $_REQUEST['vusu_cod']. ") as resul";
    }
    
    //echo $sql;return; 
    $mensaje = consultas::get_datos($sql);

    if (isset($mensaje)) {
        $mensaje = fn_separar_mensajebd($mensaje[0]["resul"]);
        $_SESSION['mensaje'] = $mensaje[0];
        header("location:usuarios_index.php");
    } else {
        $_SESSION['mensaje'] = "Error al procesar " . pg_last_error();
        header("location:" . "usuarios_index.php");
    }

    