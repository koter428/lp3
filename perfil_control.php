<?php
require 'ver_session.php'; /*VERIFICAR SESSION*/
require 'clases/conexion.php';
@session_start();

$sql = "select sp_emp(".$_REQUEST['accion'].",".$_REQUEST['vemp_cod'].",".$_REQUEST['vcar_cod']
            .",'".$_REQUEST['vemp_nombre']."','".$_REQUEST['vemp_apellido']."','"
            .$_REQUEST['vemp_direcc']."','".$_REQUEST['vemp_tel']."') as result;
                
$sql = "select sp_usu(".$_REQUEST['accion'].",".$_REQUEST['vusu_cod'].",".$_REQUEST['vusu_nick'] 
            .",'".$_REQUEST['vusu_clave']."','".$_REQUEST['vemp_cod']."','"
            .$_REQUEST['vgru_cod']."','".$_REQUEST['vid_sucursal']."') as result";


if (consultas::ejecutar_sql($sql)) {
    $_SESSION['mensaje'] = $mensaje;
    header("location:cliente_index.php");
}else{
    $_SESSION['mensaje'] = "Error al procesar ".$sql;
    header("location:cliente_index.php");    
}
?>