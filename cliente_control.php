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
$Sql="update clientes set cli_ci = '".$_REQUEST['vcli_ci']
      ."',cli_nombre='".$REQUEST['vcli_nombre']
      ."',cli_apellido='".$REQUEST['vcli_apellido']
      ."',cli_telefono='".$REQUEST['vcli_telefono']
      ."',cli_direcc='".$REQUEST['vcli_direcc']
      ."',where cli_cod='".$REQUEST['vcli_cod'];
     $mensaje='se actualizo correctamente';
        break;
    case 3: //borrar
        $Sql="delete from  clientes set cli_ci = '".$_REQUEST['vcli_ci']
      ."',cli_nombre='".$REQUEST['vcli_nombre']
      ."',cli_apellido='".$REQUEST['vcli_apellido']
      ."',cli_telefono='".$REQUEST['vcli_telefono']
      ."',cli_direcc='".$REQUEST['vcli_direcc']
      ."',where cli_cod='".$REQUEST['vcli_cod'];
     $mensaje='se borro correctamente';
        break;
}

if (consultas::ejecutar_sql($sql)) {
    $_SESSION['mensaje'] = $mensaje;
    header("location:cliente_index.php");
}else{
    $_SESSION['mensaje'] = "Error al procesar ".$sql;
    header("location:cliente_index.php");    
}