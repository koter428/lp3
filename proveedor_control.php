<?php
    require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';
    require 'funciones/lib_funciones.php';

    @session_start();

    $accion = $_REQUEST['accion'];
    $accion_anterior = $accion;
    if(strcmp($accion,"5") == 0) $accion = "1";

    if(strcmp($accion,"1") == 0 || strcmp($accion,"2") == 0){
        $sql = "select sp_proveedor(" . $accion . "," . 
        (!empty($_REQUEST['vprv_cod']) ? $_REQUEST['vprv_cod'] : 0) . ",'" .
        (!empty($_REQUEST['vprv_ruc']) ? $_REQUEST['vprv_ruc'] : 0) . "','" .
        (!empty($_REQUEST['vprv_razonsocial']) ? $_REQUEST['vprv_razonsocial'] : '') . "','" .
        (!empty($_REQUEST['vprv_direccion']) ? $_REQUEST['vprv_direccion'] : 0) . "','" .
        (!empty($_REQUEST['vprv_telefono']) ? $_REQUEST['vprv_telefono'] : '') . "') as resul";
    }
    else if (strcmp($accion,"3") == 0){
        $sql = "select sp_proveedor(" . $accion . "," . $_REQUEST['vprv_cod'] . ") as resul";
    }
    // echo $sql; return;

    $mensaje = consultas::get_datos($sql);

    if (isset($mensaje)) {
        if(strcmp($accion_anterior,"5") == 0){
            header("location:pedcompra_add.php");
        }
        else{
            $mensaje = fn_separar_mensajebd($mensaje[0]["resul"]);
            $_SESSION['mensaje'] = $mensaje[0];
            header("location:" . $mensaje[1] . ".php");
        }
    } else {
        if(strcmp($accion_anterior,"5") == 0){
            header("location:pedcompra_add.php");
        }
        else{
            $_SESSION['mensaje'] = "Error al procesar " . pg_last_error();
            header("location:" . "proveedor_index.php");
        }
    }