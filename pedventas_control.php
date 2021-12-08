<?php
    require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';
    @session_start();

    $accion = $_REQUEST['accion'];
    
    $sql = "select sp_pedventas(".$_REQUEST['accion'].",".$_REQUEST['vped_cod'].","
            .$_SESSION['emp_cod'].",".(!empty($_REQUEST['vcli_cod'])?$_REQUEST['vcli_cod']:"0").",".$_SESSION['id_sucursal'].") as resul";

    $resultado = consultas::get_datos($sql);

    if ($resultado[0]['resul']!=null) {    
        $valor = explode("*",$resultado[0]['resul']);
        $_SESSION['mensaje'] = $valor[0];
        // header("location:".$valor[1]); 
        header("location:pedventas_index.php"); 
    }else{
        $_SESSION['mensaje'] = "Error:". pg_last_error();
        header("location:pedventas_index.php"); 
    }

