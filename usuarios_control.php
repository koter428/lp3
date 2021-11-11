<?php
require 'clases/conexion.php';
session_start();

switch ($_REQUEST['accion']) {
    case 1:
        $sql = "insert into usuarios(usu_cod,usu_nick ,usu_clave,emp_cod,gru_cod,id_sucursal) "
            . "values((select coalesce(max(usu_cod),0)+1 from usuarios),"
            .$_REQUEST['vusu_cod'].",'"
            .$_REQUEST['vusu_nick']."','"
            .$_REQUEST['vusu_clave']."','"
            .$_REQUEST['vemp_cod']."','"
            .$_REQUEST['vgru_cod']."')"
            .$_REQUEST['vid_sucursal']; 
        $mensaje='Se inserto correctamente el  usuarios';
        break;

    case 2: //actualizar
        $sql="update usuarios set usu_cod = '".$_REQUEST['vusu_cod']
            ."',usu_nick='" .$_REQUEST['vusu_nick']
            ."',usu_clave='".$_REQUEST['vusu_clave']
            ."',emp_cod='"  .$_REQUEST['vemp_cod']
            ."',gru_cod='"  .$_REQUEST['vgru_cod']
            ."' where id_sucursal=".$_REQUEST['vid_sucursal'];
            $mensaje='Se actualizo correctamente';
        break;
    case 3: //borrar
              $sql="delete from usuarios where cli_cod ='".$_REQUEST['vcli_cod']
            ."',cli_nombre='"   .$_REQUEST['vcli_nombre']
            ."',cli_apellido='" .$_REQUEST['vcli_apellido']
            ."',cli_telefono= '".$_REQUEST['vcli_telefono']
            ."',cli_direcc='"   .$_REQUEST['vcli_direcc']
            ."' where cli_cod =".$_REQUEST['cli_cod'];
            $mensaje = "Se borro correctamente";
        break;
}

if (consultas::ejecutar_sql($sql)) {
    $_SESSION['mensaje'] = $mensaje;
    header("location:cliente_index.php");
}else{
    $_SESSION['mensaje'] = "Error al procesar ".$sql;
    header("location:cliente_index.php");    
}