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
        @session_start();/*Reanudar sesion*/
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
                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="fa fa-edit"></i>
                                    <h3 class="box-title">Editar Transferencias</h3>
                                    <div class="box-tools">
                                        <a href="transfer_index.php" class="btn btn-primary btn-sm" data-title="Volver" rel="tooltip">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div> 
                                <form action="transfer_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <?php
                                        // print_r($_SESSION); return;
                                        $sql = "select * from v_transfer where tra_cod =".$_GET['vtra_cod'];
                                        // echo $sql; return;
                                        $resultado = consultas::get_datos($sql);
                                        // print_r($resultado);return;
                                    ?>
                                    <div class="box-body">
                                        <input type="hidden" name="accion" value="2"/>
                                        <input type="hidden" name="vtra_cod" value="<?php echo $resultado[0]['tra_cod'];?>"/>
                                        <div class="row">
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Fecha:</label>
                                            <div class="col-lg-3 col-md-4 col-sm-3"> 
                                                <input type="date" name="vtra_fecha" class="form-control" readonly="" value="<?php echo $resultado[0]['tra_fecha'];?>"/>
                                            </div>
                                            <label class="control-label col-lg-2 col-md-2">Empleado:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                            <input type="text" class="form-control" value="<?php echo $_SESSION['nombres'];?>" readonly=""/>
                                            </div>                                                                         
                                        </div>     
                                    </div>                                   
                                    <div class="form-group">                                            
                                        <label class="control-label col-lg-2 col-md-2">Observación</label>
                                        <div class="col-lg-4">
                                            <textarea class="form-control" name="vtra_obser" rows=3 cols=60 placeholder="Ingrese la Observacion correspondiente..."><?php echo $resultado[0]['tra_obser'];?></textarea>
                                        </div>
                                        <label class="control-label col-lg-1">Sucursal</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" value="<?php echo $resultado[0]['suc_descri'];?>" readonly=""/>                                                
                                        </div>                                            
                                    </div>
                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default" data-title="Cancelar" rel="tooltip"> 
                                            <i class="fa fa-remove"></i> Cancelar</button>                                        
                                        <button type="submit" class="btn btn-warning pull-right" data-title="Guardar" rel="tooltip"> 
                                            <i class="fa fa-edit"></i> Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
    </body>
</html>