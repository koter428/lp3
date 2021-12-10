<?php
    require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';
    @session_start();
    
        // print_r($_REQUEST); return;
        
    $sql="select sp_ventas(".$_REQUEST['accion'].",
    ".$_REQUEST['vven_cod'].", 
    ".$_SESSION['emp_cod'].", 
    ".(!empty($_REQUEST['vcli_cod'])?$_REQUEST['vcli_cod']:"0").", 
    ".(!empty($_REQUEST['vtipo_venta'])? "'".$_REQUEST['vtipo_venta']."'":"null").", 
    ".(!empty($_REQUEST['vcan_cuota'])?$_REQUEST['vcan_cuota']:"0").", 
    ".(!empty($_REQUEST['vven_plazo'])?$_REQUEST['vven_plazo']:"0").", 
    ".$_SESSION['id_sucursal'].",".(!empty($_REQUEST['vped_cod'])?$_REQUEST['vped_cod']:"0").") as resul";

    //echo $sql; return;
    $resultado = consultas::get_datos($sql);

    if ($resultado[0]['resul']!=null) {
        $valor = explode("*", $resultado[0]['resul']);
        $_SESSION['mensaje'] = $valor[0];
        header("location:".$valor[1]);
    }else{
        $_SESSION['mensaje'] ="Error:".pg_last_error();
        header("location:ventas_index.php");    
    }
