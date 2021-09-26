<?php
require 'clases/conexion.php';
session_start();

switch ($_REQUEST['accion']) {
    case 1:
        $sql = "insert into clientes(cli_cod,cli_ci,cli_nombre,cli_apellido,cli_telefono,cli_direcc) "
            . "values((select coalesce(max(cli_cod),0)+1 from clientes),"
            .$_REQUEST['vcli_ci'].",'".$_REQUEST['vcli_nombre']."','"
            .$_REQUEST['vcli_apellido']."','".$_REQUEST['vcli_telefono']."','".$_REQUEST['vcli_direcc']."')"; 
        $mensaje='Se inserto correctamente el cliente';
        break;

    case 2: //editar
        break;
    case 3: //borrar
        break;
}

if (consultas::ejecutar_sql($sql)) {
    $_SESSION['mensaje'] = $mensaje;
    header("location:cliente_index.php");
}else{
    $_SESSION['mensaje'] = "Error al procesar ".$sql;
    header("location:cliente_index.php");    
}