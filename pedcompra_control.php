<?php
    require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';
    require 'funciones/lib_funciones.php';

    @session_start();
    $accion = $_REQUEST['accion'];
    // print_r($_REQUEST); return;
    // print_r($_SESSION);return;
        
    if(strcmp($accion,"1") == 0 || strcmp($accion,"2") == 0){
        $sql = "select sp_pedcompra(" . $accion . "," . 
                (!empty($_REQUEST['vped_com']) ? $_REQUEST['vped_com'] : 0) . ",'" .
                (!empty($_REQUEST['vemp_cod']) ? strtoupper($_REQUEST['vemp_cod']) : 0) . "','" .
                (!empty($_REQUEST['vprv_cod']) ? strtoupper($_REQUEST['vprv_cod']) : 0) . "','" .
                (!empty($_REQUEST['vid_sucursal']) ?$_REQUEST['vid_sucursal'] : 1). "') as resul";
        }
    else if (strcmp($accion,"3") == 0){
        $sql = "select sp_pedcompra(" . $accion . "," . $_REQUEST['vped_com'].") as resul";
    }
    
    // echo $sql;return; 
    $mensaje = consultas::get_datos($sql);

    if (isset($mensaje)) {
        $mensaje = fn_separar_mensajebd($mensaje[0]["resul"]);
        $_SESSION['mensaje'] = $mensaje[0];
        header("location:pedcompra_index.php");
    } else {
        $_SESSION['mensaje'] = "Error al procesar " . pg_last_error();
        header("location:" . "pedcompra_index.php");
    }