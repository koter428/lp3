<?php
    require 'clases/conexion.php';
    
    // Validaciones
    $sms_error = "";
    $porcentaje = $_REQUEST["vid_sucursal"];
    if($porcentaje < 0)
        $sms_error = "El porcentaje no debe ser negativo.";
    
    session_start();
    if($sms_error != ""){
        $_SESSION['mensaje'] = $sms_error;
        header("location:deposito_index.php");
    }
    else{
        switch ($_REQUEST['accion']){
            case 1: //insertar
                $sql =  "insert into deposito(dep_cod,dep_descri,id_sucursal) " .
                        "values((select coalesce(max(dep_cod),0)+1 from deposito),'" .
                        strtoupper($_REQUEST['vdep_descri']) . "','" . $_REQUEST['vid_sucursal'] . "')";
                $mensaje = "Se guardo correctamente";
                break;

            case 2: //actualizar
                $sql =  "update deposito set dep_cod = '" . strtoupper($_REQUEST['vdep_cod']) . "', " .
                        "tipo_descri='" . $_REQUEST['vdep_descri'] . "' " .
                        "where id_sucursal ='" . $_REQUEST['vid_sucursal'] . "'";
                $mensaje = "Se actualizo correctamente";
                break;

            case 3: //borrar
                $sql = "delete from deposito where dep_cod='" . $_REQUEST['vdep_cod'] . "'";
                $mensaje = "Se borro correctamente";
                break;
        }
        
        if (consultas::ejecutar_sql($sql)) {
            $_SESSION['mensaje'] = $mensaje;
            header("location:deposito_index.php");
        } else {
            $_SESSION['mensaje'] = 'Error al procesar \n' . pg_last_error();
            header("location:deposito_index.php");
        }
    }
    
    
  
