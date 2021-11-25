<?php
require 'ver_session.php'; /*VERIFICAR SESSION*/
require 'clases/conexion.php';

@session_start();

switch ($_REQUEST['accion']){
            case 1: //insertar
                $sql =  "insert into paginas(pag_cod,pag_nombre,pag_direc,mod_cod)" .
                        "values((select coalesce(max(pag_cod),0)+1 from paginas),'" .
                                   $_REQUEST['vpag_cod'] . "','" .
                        strtoupper($_REQUEST['vpag_nombre']) . "','" .
                                   $_REQUEST['vmod_cod']."','" .
                        strtoupper($_REQUEST['vpag_direc']) . "')"; 
                $mensaje='Se inserto correctamente la pagina';
                break;

            case 2: //actualizar
                $sql="update paginas set pag_cod = '".$_REQUEST['vpag_cod'] . "'," .
                "pag_nombre='".strtoupper($_REQUEST['vpag_nombre']) . "','" .
                "mod_cod='".$_REQUEST['vmod_cod'] . "','" .
                "where pag_direc='" .$_REQUEST['vpag_direc'] . "'";
        $mensaje='Se actualizo correctamente';
                break;
            case 3: //borrar
                $sql="delete from  paginas where vpag_cod ='" . $_REQUEST['vpag_cod'] . "'";
                $mensaje = "Se borro correctamente";
                break;
        }
$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje']= $resultado[0]['resul'];
    header("location:paginas_index.php");
}else{
    $_SESSION['mensaje']= "Error:".$sql;
    header("location:paginas_index.php");    
}