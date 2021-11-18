<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/lp3/favicon.ico">
        <title>LP3</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php 
        require 'ver_session.php'; /*VERIFICAR SESSION*/
        session_start();/*Reanudar sesion*/
        require 'menu/css_lte.ctp'; ?><!--ARCHIVOS CSS-->

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require 'menu/header_lte.ctp'; ?><!--CABECERA PRINCIPAL-->
            <?php require 'menu/toolbar_lte.ctp';?><!--MENU PRINCIPAL-->
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-clipboard"></i>
                                    <h3 class="box-title">Reporte Tipos De impuesto</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <?php $opcion = "2";
                                                 if (isset($_GET['opcion'])) {
                                                  $opcion = $_GET['opcion'];
                                                }
                                            ?>
                                            <form action="impuesto_print.php" method="get" accept-charset="utf-8" class="form-horizontal">
                                                <input type="hidden" name="opcion" value="<?php echo $opcion;?>"/>
                                                <div class="box-body">
                                                    <div class="col-lg-4">
                                                        <div class="panel panel-primary">
                                                            <div class="panel-heading">
                                                                <strong>OPCIONES</strong>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="list-group">
                                                                    <a href="impuesto_rpt.php?opcion=1" class="list-group-item">Por Codigo</a>
                                                                    <a href="impuesto_rpt.php?opcion=2" class="list-group-item">Por Descripción</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="panel panel-primary">
                                                            <div class="panel-heading">
                                                                <strong>FILTROS</strong>
                                                            </div>
                                                            <div class="panel-body">
                                                            <?php $impuesto = consultas::get_datos("select * from tipo_impuesto order by tipo_cod");?>
                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3">Desde:</label>
                                                                    <div class="col-lg-6 col-md-5 col-sm-5">                                                                    
                                                                            <select class="form-control select2" name="vdesde" required="">
                                                                                <?php foreach ($impuesto as $tipo) { ?>
                                                                                  <option value="<?php echo ($opcion==1)?$tipo['tipo_cod']:$tipo['tipo_descri'];?>"><?php echo ($opcion==1)?$tipo['tipo_cod']:$tipo['tipo_descri'];?></option>   
                                                                                <?php }?>
                                                                            </select>  
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3">Hasta:</label>
                                                                    <div class="col-lg-6 col-md-5 col-sm-5">                                                                    
                                                                            <select class="form-control select2" name="vhasta" required="">
                                                                                <?php foreach ($impuesto as $tipo) { ?>
                                                                                  <option value="<?php echo ($opcion==1)?$tipo['tipo_cod']:$tipo['tipo_descri'];?>"><?php echo ($opcion==1)?$tipo['tipo_cod']:$tipo['tipo_descri'];?></option>   
                                                                                <?php }?>
                                                                            </select>  
                                                                    </div>
                                                                </div>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="box-footer">
                                                    <button type="submit" class="btn btn-primary pull-right">
                                                        <i class="fa fa-print"></i> Listar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
    </body>
</html>


