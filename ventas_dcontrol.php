<?php
    require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';

    @session_start();

    $sql = "select sp_detalle_ventas(
    ".$_REQUEST['accion'].",
    ".$_REQUEST['vven_cod'].", 
    ".$_REQUEST['vdep_cod'].",split_part('".$_REQUEST['vart_cod']."','_',1)::integer, 
    ".(!empty($_REQUEST['vven_cant'])?$_REQUEST['vven_cant']:"0").", 
    ".(!empty($_REQUEST['vven_precio'])?$_REQUEST['vven_precio']:"0").") as resul";

    // echo $sql; return;

    $resultado = consultas::get_datos($sql);

    if ($resultado[0]['resul']!=null) {
        $_SESSION['mensaje'] = $resultado[0]['resul'];
        header("location:ventas_det.php?vven_cod=".$_REQUEST['vven_cod']);    
    }else{
        $_SESSION['mensaje'] = "Error:".pg_last_error();
        header("location:ventas_det.php?vven_cod=".$_REQUEST['vven_cod']);    
    }