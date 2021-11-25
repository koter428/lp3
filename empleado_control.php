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
        header("location:empleado_index.php");
    }
    else{*/
        switch ($_REQUEST['accion']) {
            case 1:
                $sql =  "insert into empleado(emp_cod,car_cod,emp_nombre,emp_apellido,"
                        . "emp_direcc,emp_tel) " .
                        "values((select coalesce(max(emp_cod),0)+1 from empleado), '" .
                        $_REQUEST['vcar_cod'] . "','" .
                        strtoupper($_REQUEST['vemp_nombre']) . "','" .
                        strtoupper($_REQUEST['vemp_apellido']) ."','" .
                        $_REQUEST['vemp_direcc'] . "','" .
                        strtoupper($_REQUEST['vemp_tel']) . "')"; 
                $mensaje='Se inserto correctamente el empleado';
                break;

            case 2: //actualizar
                $sql="update empleado set car_cod = '".$_REQUEST['vcar_cod'] . "'," .
                    "emp_nombre='". strtoupper($_REQUEST['vemp_nombre']) . "'," .
                    "emp_apellido='".strtoupper($_REQUEST['vemp_apellido']) . "'," .
                    "emp_tel='".$_REQUEST['vemp_tel'] . "'," .
                    "emp_direcc='" . strtoupper($_REQUEST['vemp_direcc']) . "'" .
                    "where emp_cod='" . $_REQUEST['vemp_cod'] . "'";
                    $mensaje='Se actualizo correctamente';
                break;
            case 3: //borrar
                $sql="delete from empleado where emp_cod ='" . $_REQUEST['vemp_cod'] . "'";
                $mensaje = "Se borro correctamente";
                break;
        }
        // echo $sql; return;
        if (consultas::ejecutar_sql($sql)) {
            $_SESSION['mensaje'] = $mensaje;
            header("location:empleado_index.php");
        }else{
            $_SESSION['mensaje'] = "Error al procesar ". pg_last_error();
            header("location:empleado_index.php");    
        }
   // }
        
      
        