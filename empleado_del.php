<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <i class="fa fa-trash"></i>
                                    <h3 class="box-title">Borrar Empleado</h3>
                                    <div class="box-tools">
                                        <a href="empleado_index.php" class="btn btn-primary btn-sm" data-title="Volver" >
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div> 
                                <form action="empleado_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("select * from empleado where emp_cod=".$_GET['vemp_cod']);?>
                                        <div class="form-group">
                                            <input type="hidden" name="accion" value="3"/>
                                            <input type="hidden" name="vemp_cod" value="<?php echo $resultado[0]['emp_cod']?>"/>
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2">Cargo:</label>
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <input type="text" name="vcar_cod" class="form-control" disabled="" 
                                                       value="<?php echo $resultado[0]['car_cod']?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">  
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2">Nombres:</label>
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <input type="text" name="vemp_nombre" class="form-control" disabled="" 
                                                       value="<?php echo $resultado[0]['emp_nombre']?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">  
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2">Apellido:</label>
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <input type="text" name="vemp_apellido" class="form-control" disabled="" 
                                                       value="<?php echo $resultado[0]['emp_apellido']?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">  
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Teléfono:</label>
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <input type="text" name="vemp_tel " class="form-control" disabled="" 
                                                   value="<?php echo $resultado[0]['emp_tel']?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">  
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Dirección:</label>
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <input type="text" name="vemp_direcc" class="form-control" disabled="" 
                                                       value="<?php echo $resultado[0]['emp_direcc']?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default" data-title="Cancelar" > 
                                            <i class="fa fa-remove"></i> Cancelar</button>                                        
                                        <button type="submit" class="btn btn-danger pull-right" data-title="Guardar" > 
                                            <i class="fa fa-trash"></i> Borrar</button>
                                    </div>
                                </form>
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