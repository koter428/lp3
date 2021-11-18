<?php
require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';

    switch ($_REQUEST['accion']) {
        case 1: //insertar
            $sql = "insert into marca(mar_cod,mar_descri) "
                . "values((select coalesce(max(mar_cod),0)+1 from marca),'" . strtoupper($_REQUEST['vmar_descri']) . "')";
            $mensaje = "Se guardo correctamente";
            break;

        case 2: //actualizar
            $sql = "update marca set mar_descri = '" . strtoupper($_REQUEST['vmar_descri']) . 
                   "' where  mar_cod ='" . $_REQUEST['vmar_cod'];
            $mensaje = "Se actualizo correctamente";
            break;

        case 3: //borrar
            $sql = "delete from marca where mar_cod = '" . $_REQUEST['vmar_cod'] . "'";
            $mensaje = "Se borro correctamente";
            
            $consulta = consultas::get_datos("select * from marca order by mar_descri");
            break;
    }
    session_start(); /* reanudar la sesión */

    if (consultas::ejecutar_sql($sql)) {
        $_SESSION['mensaje'] = $mensaje;
        header("location:marca_index.php");
    } else {
        $_SESSION['mensaje'] = 'Error al procesar \n' . pg_last_error();
        header("location:marca_index.php");
    }
?>