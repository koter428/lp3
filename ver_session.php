<?php 
 @session_start();
if ($_SESSION['usu_cod']==null) {
    $_SESSION['error'] = "Porfavor Ingrese Su Usuario";
    header("location:http://localhost/lp3/");
    exit();
}
?>