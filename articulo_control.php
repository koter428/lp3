<?php
    require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';
    require 'funciones/lib_funciones.php';

    @session_start();
    $accion = $_REQUEST['accion'];
        
    if(strcmp($accion,"1") == 0 || strcmp($accion,"2") == 0){
        $sql = "select sp_articulo(" . $accion . "," . (!empty($_REQUEST['vart_cod']) ? $_REQUEST['vart_cod'] : 0) . ",'" .
                (!empty($_REQUEST['vart_codbarra']) ? strtoupper($_REQUEST['vart_codbarra']) : "") . "'," .
                (!empty($_REQUEST['vmar_cod']) ? $_REQUEST['vmar_cod'] : 0) . ",'" .
                (!empty($_REQUEST['vart_descri']) ? strtoupper($_REQUEST['vart_descri']) : "") . "'," .
                (!empty($_REQUEST['vart_precioc']) ? $_REQUEST['vart_precioc'] : 0) . "," .
                (!empty($_REQUEST['vart_preciov']) ?$_REQUEST['vart_preciov'] : 0). "," .
                (!empty($_REQUEST['vtipo_cod']) ? $_REQUEST['vtipo_cod'] : 0) . ") as resul";
    }
    else if (strcmp($accion,"3") == 0){
        $sql = "select sp_articulo(" . $accion . "," . $_REQUEST['vart_cod']. ",'',0,'',0,0,0) as resul";
    } 
    //echo $sql; return;
    $mensaje = consultas::get_datos($sql);

    if (isset($mensaje)) {
        $mensaje = fn_separar_mensajebd($mensaje[0]["resul"]);
        $_SESSION['mensaje'] = $mensaje[0];
        header("location:" . $mensaje[1] . ".php");
    } else {
        $_SESSION['mensaje'] = "Error al procesar " . pg_last_error();
        header("location:" . "articulo_index.php");
    }

  
