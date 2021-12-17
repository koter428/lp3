<?php
    require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';

    @session_start();

    // print_r($_REQUEST); return;

    $accion = $_REQUEST['accion'];
    // $accion_desde = $accion;
    // if(strcmp($accion,"5") == 0) $accion = "1";

    if(strcmp($accion,"1") == 0 || strcmp($accion,"2") == 0){
        $vart_cod = explode("_",$_REQUEST["vart_cod"]); $vart_cod = $vart_cod[0];
        $vmot_cod = explode("_",$_REQUEST["vmot_cod"]); $vmot_cod = $vmot_cod[0];
        $vajus_tipo = explode("_",$_REQUEST["vmot_cod"]); $vajus_tipo = $vajus_tipo[1];
    }
    elseif(strcmp($accion,"3") == 0){
        $vart_cod = explode("_",$_REQUEST["vart_cod"]); $vart_cod = $vart_cod[0];
        $vmot_cod = "0";
        $vajus_tipo = "0";
    }
    
    $sql = "select sp_detalle_ajustes(" .
    $_REQUEST['accion']."," .
    $_REQUEST['vaju_cod']."," .
    $_REQUEST['vdep_cod']."," .
    $vart_cod ."," .
    (!empty($_REQUEST['vaju_cant']) ? $_REQUEST['vaju_cant'] : "0") . "," . 
    (!empty($_REQUEST['vaju_precio']) ? $_REQUEST['vaju_precio'] :"0"). ",".
    $vmot_cod . ",'" .
    $vajus_tipo . "') as resul";

    // echo $sql; return;

    $resultado = consultas::get_datos($sql);

    if ($resultado[0]['resul']!=null) {
        $_SESSION['mensaje'] = $resultado[0]['resul'];
        header("location:ajustes_det.php?vaju_cod=".$_REQUEST['vaju_cod']);    
    }else{
        $_SESSION['mensaje'] = "Error:".pg_last_error();
        header("location:ajustes_det.php?vaju_cod=".$_REQUEST['vaju_cod']);    
    }