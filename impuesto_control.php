<?php
require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';
    
    // Validaciones
    $sms_error = "";
    $porcentaje = $_REQUEST["vtipo_porcen"];
    if($porcentaje < 0)
        $sms_error = "El porcentaje no debe ser negativo.";
    
    session_start();
    if($sms_error != ""){
        $_SESSION['mensaje'] = $sms_error;
        header("location:impuesto_index.php");
    }
    else{
        switch ($_REQUEST['accion']){
            case 1: //insertar
                $sql =  "insert into tipo_impuesto(tipo_cod,tipo_descri,tipo_porcen) " .
                        "values((select coalesce(max(tipo_cod),0)+1 from tipo_impuesto),'" .
                        strtoupper($_REQUEST['vtipo_descri']) . "','" . $_REQUEST['vtipo_porcen'] . "')";
                $mensaje = "Se guardo correctamente";
                break;

            case 2: //actualizar
                $sql =  "update tipo_impuesto set tipo_descri = '" . strtoupper($_REQUEST['vtipo_descri']) . "', " .
                        "tipo_porcen='" . $_REQUEST['vtipo_porcen'] . "' " .
                        "where tipo_cod ='" . $_REQUEST['vtipo_cod'] . "'";
                $mensaje = "Se actualizo correctamente";
                break;

            case 3: //borrar
                $sql = "delete from tipo_impuesto where tipo_cod='" . $_REQUEST['vtipo_cod'] . "'";
                $mensaje = "Se borro correctamente";
                break;
        }
        
        if (consultas::ejecutar_sql($sql)) {
            $_SESSION['mensaje'] = $mensaje;
            header("location:impuesto_index.php");
        } else {
            $_SESSION['mensaje'] = 'Error al procesar \n' . pg_last_error();
            header("location:impuesto_index.php");
        }
    }
    
    
    
