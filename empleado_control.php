<?php
    require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';
    require 'funciones/lib_funciones.php';

    @session_start();

    $accion = $_REQUEST['accion'];

    if(strcmp($accion,"1") == 0 || strcmp($accion,"2") == 0){
        $sql = "select sp_empleado(" . $accion . "," . 
        (!empty($_REQUEST['vemp_cod']) ? $_REQUEST['vemp_cod'] : 0) . ",'" .
        (!empty($_REQUEST['vcar_descri']) ? $_REQUEST['vcar_descri'] : '') . "','" .
        (!empty($_REQUEST['vcar_cod']) ? $_REQUEST['vcar_cod'] : 0) . "','" .
        (!empty($_REQUEST['vemp_nombre']) ? $_REQUEST['vemp_nombre'] : '') . "','" .
        (!empty($_REQUEST['vemp_apellido']) ? $_REQUEST['vemp_apellido'] : '') . "','" .
        (!empty($_REQUEST['vemp_direcc']) ? $_REQUEST['vemp_direcc'] : 0) . "','" .
        (!empty($_REQUEST['vemp_tel']) ? $_REQUEST['vemp_tel'] : '') . "') as resul";
    }
    else if (strcmp($accion,"3") == 0){
        $sql = "select sp_clientes(" . $accion . "," . $_REQUEST['vemp_cod'] . ") as resul";
    }
    //  echo $sql; return;

    $mensaje = consultas::get_datos($sql);

    if (isset($mensaje)) {
        $mensaje = fn_separar_mensajebd($mensaje[0]["resul"]);
        $_SESSION['mensaje'] = $mensaje[0];
        header("location:" . $mensaje[1] . ".php");
    } else {
        $_SESSION['mensaje'] = "Error al procesar " . pg_last_error();
        header("location:" . "empleado_index.php");
    }