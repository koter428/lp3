<?php
require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';
    require 'funciones/lib_funciones.php';

    // Validaciones
    /*$sms_error = "";
    $telefono = $_REQUEST["vcli_telefono"];
    if(!fn_validar_dato($telefono, "telefono"))
        $sms_error = "Teléfono incorrecto.";*/
    
    @session_start();
    /*if($sms_error != ""){
        $_SESSION['mensaje'] = $sms_error;
        header("location:cliente_index.php");
    }
    else{*/
        switch ($_REQUEST['accion']) {
            case 1:
                $sql =  "insert into clientes(cli_cod,cli_ci,cli_nombre,cli_apellido,cli_telefono,cli_direcc) " .
                        "values((select coalesce(max(cli_cod),0)+1 from clientes), '" .
                        $_REQUEST['vcli_ci'] . "','" .
                        strtoupper($_REQUEST['vcli_nombre']) . "','" .
                        strtoupper($_REQUEST['vcli_apellido']) ."','" .
                        $_REQUEST['vcli_telefono'] . "','" .
                        strtoupper($_REQUEST['vcli_direcc']) . "')"; 
                $mensaje='Se inserto correctamente el cliente';
                break;

            case 2: //actualizar
                $sql="update clientes set cli_ci = '".$_REQUEST['vcli_ci'] . "'," .
                    "cli_nombre='". strtoupper($_REQUEST['vcli_nombre']) . "'," .
                    "cli_apellido='".strtoupper($_REQUEST['vcli_apellido']) . "'," .
                    "cli_telefono='".$_REQUEST['vcli_telefono'] . "'," .
                    "cli_direcc='" . strtoupper($_REQUEST['vcli_direcc']) . "'" .
                    "where cli_cod='" . $_REQUEST['vcli_cod'] . "'";
                    $mensaje='Se actualizo correctamente';
                break;
            case 3: //borrar
                $sql="delete from clientes where cli_cod ='" . $_REQUEST['vcli_cod'] . "'";
                $mensaje = "Se borro correctamente";
                break;
        }
        // echo $sql; return;
        if (consultas::ejecutar_sql($sql)) {
            $_SESSION['mensaje'] = $mensaje;
            header("location:cliente_index.php");
        }else{
            $_SESSION['mensaje'] = "Error al procesar ". pg_last_error();
            header("location:cliente_index.php");    
        }
   // }