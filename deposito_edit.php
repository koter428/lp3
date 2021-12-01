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
                                    <h3 class="box-title">Editar Deposito</h3>
                                    <div class="box-tools">
                                        <a href="deposito_index.php" class="btn btn-primary btn-sm" data-title="Volver" rel="tooltip">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div> 
                                <form action="deposito_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $deposito = consultas::get_datos("select * from deposito where dep_cod=".$_GET['vdep_cod']);
                                        // $sql = "SELECT * FROM sucursal ORDER BY CASE WHEN id_sucursal='" . $sucursal[0]["id_sucursal"] . "' THEN 1 ELSE 2 END, id_sucursal;";
                                        // $sucursal = consultas::get_datos($sql);
                                        ?>
                                        <div class="form-group">
                                            <input type="hidden" name="accion" value="2"/>
                                            <input type="hidden" name="vdep_cod" value="<?php echo $deposito[0]['dep_cod']?>"/>
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Descripción:</label>
                                            <div class="col-lg-7 col-md-7 col-sm-7">
                                                <input type="text" name="vdep_descri" class="form-control" required="" autofocus="" 
                                                       value="<?php echo $deposito[0]['dep_descri']?>"/>
                                                    </div>
                                                </div>
                                                <!-- AGREGAR LISTA DESPLEGABLE SUCURSAL -->
                                                <div class="form-group">
                                                    <label class="control-label col-lg-2">Sucursal:</label>
                                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                                        <div class="input-group">
                                                            <?php
                                                                $sql = "select * from sucursal order by id_sucursal = " . $deposito[0]["id_sucursal"];
                                                                $sucursal = consultas::get_datos($sql);
                                                            ?>
                                                            <select class="form-control select2" name="vid_sucursal" required="">
                                                                <option value="">Seleccione una Sucursal</option>
                                                                <?php foreach ($sucursal as $sucur) { ?>
                                                                <option value="<?php echo $sucur['id_sucursal'];?>" selected><?php echo $sucur['id_sucursal'];?></option>   
                                                                <?php }?>
                                                            </select>  
                                                            <span class="input-group-btn btn-flat">
                                                            <a class="btn btn-primary" data-title ="Agregar Sucursal " rel="tooltip" data-placement="top"
                                                           data-toggle="modal" data-target="#registrar">
                                                            <i class="fa fa-plus"></i>
                                                            </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FIN LISTA DESPLEGABLE SUCURSAL -->
                                    </div>
                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-warning" data-title="Cancelar" rel="tooltip"> 
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
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
    </body>
</html>


