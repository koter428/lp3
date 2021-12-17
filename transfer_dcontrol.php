<?php
    require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';

    @session_start();

    // print_r($_REQUEST); return;

    $accion = $_REQUEST['accion'];
    
    $vart_cod = explode("_",$_REQUEST["vart_cod"]); $vart_cod = $vart_cod[0];
    
    $sql = "select sp_detalle_transfer(" .
        $_REQUEST['accion']."," .
        $_REQUEST['vtra_cod']."," .
        $_REQUEST['vdep_ori']."," .
        $_REQUEST['vdep_des']."," .
        $vart_cod ."," .
        (!empty($_REQUEST['vtra_cant']) ? $_REQUEST['vtra_cant'] : "0") . "," . 
        (!empty($_REQUEST['vtra_precio']) ? $_REQUEST['vtra_precio'] :"0"). ") as resul";

    // echo $sql; return;

    $resultado = consultas::get_datos($sql);

    if ($resultado[0]['resul']!=null) {
        $_SESSION['mensaje'] = $resultado[0]['resul'];
        header("location:transfer_det.php?vtra_cod=".$_REQUEST['vtra_cod']);    
    }else{
        $_SESSION['mensaje'] = "Error:".pg_last_error();
        header("location:transfer_det.php?vtra_cod=".$_REQUEST['vtra_cod']);    
    }