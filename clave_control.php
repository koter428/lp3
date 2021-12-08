<?php
require 'ver_session.php'; /*VERIFICAR SESSION*/
require 'clases/conexion.php';
@session_start();

if  ($_REQUEST['vusu_nick'] == null){
    $_SESSION['mensaje'] = "este mensaje esta vacio";
    header("location:clave_index.php"); 
}
if ($_REQUEST['vusu_clave_1'] != $_REQUEST['vusu_clave_2']) {
    $_SESSION['mensaje'] = "error contraseña no consuide";
   header("location:clave_index.php"); 
}
//die($_REQUEST['vusu_nick']);
$sql = "select usu_clave from usuarios where usu_cod = '" . $_REQUEST['vusu_cod'] . "'
 and usu_clave ='" . md5($_REQUEST['vusu_clave_0']) . "'";
$verificar = consultas::get_datos($sql);
if($verificar == null){
    $_SESSION['mensaje'] = "LASTIMA LA CONTRASEÑA NO PUDO SER CAMBIADA";
header("location:clave_index.php");
die();
}
//echo $sql; return;
$sql = "update usuarios set usu_clave = '". md5($_REQUEST['vusu_clave_1']) ."' where usu_cod = '" . $_REQUEST['vusu_cod'] . "'
and usu_clave ='" . md5($_REQUEST['vusu_clave_0']) . "'";

if (consultas::ejecutar_sql($sql)) {
    $_SESSION['mensaje'] = "se a cambiado exitosamente!";
    header("location:clave_index.php");
    
} else {
    $_SESSION['mensaje'] = "no se pudo actualizar contraseña " . pg_last_error();
    header("location:clave_index.php");
}
