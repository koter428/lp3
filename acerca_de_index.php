<!-- menu -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="img/login.png">
    <title>LP3</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php
	require 'ver_session.php'; /*VERIFICAR SESSION*/
    @session_start();/*Reanudar sesion*/
    require 'menu/css_lte.ctp'; ?>
    <!--ARCHIVOS CSS-->

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php require 'menu/header_lte.ctp'; ?>
        <!--CABECERA PRINCIPAL-->
        <?php require 'menu/toolbar_lte.ctp'; ?>
        <!--MENU PRINCIPAL-->
        <div class="content-wrapper">
            <!-- CONTENEDOR PRINCIPAL -->
            <div class="content">
                <!-- FILA 1 -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box box-primary">
                        <i class="fa fa-question-circle"></i>
                        <h4 class="box-title"> ACERCA DE...</h4>
                        <div class="box-header">
                                <h4>Proyecto:</h4> 
                                <h5>Syslp3 - Sistema de Registro, Compras y Ventas</h5>
                                <h4>Desarrollado por:</h4>
                                <h4>Jeferzon Adrian Sosa (Alumno)</h4>
                                <h4>Email: Oculto</h4>
                                <h4>Teléfono: (Paraguay) Oculto</h4>
                        </div>
                    </div>
                </div>
                <!-- FIN DE LA FILA 1 -->
            </div>
        </div>
        <?php require 'menu/footer_lte.ctp'; ?>
        <!--ARCHIVOS JS-->
    </div>
    <?php require 'menu/js_lte.ctp'; ?>
    <!--ARCHIVOS JS-->
</body>

</html>