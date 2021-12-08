<?php
    require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';
    require 'funciones/lib_funciones.php';

    @session_start();

    $accion = $_REQUEST['accion'];
    $accion_anterior = $accion;
    if(strcmp($accion,"5") == 0) $accion = "1";

    if(strcmp($accion,"1") == 0 || strcmp($accion,"2") == 0){
        $sql = "select sp_clientes(" . $accion . "," . 
        (!empty($_REQUEST['vcli_cod']) ? $_REQUEST['vcli_cod'] : 0) . ",'" .
        (!empty($_REQUEST['vcli_ci']) ? $_REQUEST['vcli_ci'] : 0) . "','" .
        (!empty($_REQUEST['vcli_nombre']) ? $_REQUEST['vcli_nombre'] : '') . "','" .
        (!empty($_REQUEST['vcli_apellido']) ? $_REQUEST['vcli_apellido'] : '') . "','" .
        (!empty($_REQUEST['vcli_telefono']) ? $_REQUEST['vcli_telefono'] : 0) . "','" .
        (!empty($_REQUEST['vcli_direcc']) ? $_REQUEST['vcli_direcc'] : '') . "') as resul";
    }
    else if (strcmp($accion,"3") == 0){
        $sql = "select sp_clientes(" . $accion . "," . $_REQUEST['vcli_cod'] . ") as resul";
    }
    //  echo $sql; return;

    $mensaje = consultas::get_datos($sql);

    if(strcmp($accion_anterior,"5") == 0){
        header("location:pedventas_add.php");
    }
    else{
        if (isset($mensaje)) {
            $mensaje = fn_separar_mensajebd($mensaje[0]["resul"]);
            $_SESSION['mensaje'] = $mensaje[0];
            header("location:" . $mensaje[1] . ".php");
        } else {
            $_SESSION['mensaje'] = "Error al procesar " . pg_last_error();
            header("location:" . "cliente_index.php");
        }
    }