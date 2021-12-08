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
                                    <h3 class="box-title">Editar Paginas</h3>
                                    <div class="box-tools">
                                        <a href="paginas_index.php" class="btn btn-primary btn-sm" data-title="Volver">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div> 
                                <form action="paginas_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="box-body">
                                        <?php $resultado = consultas::get_datos("select * from paginas where pag_cod=".$_GET['vpag_cod']);?>
                                        <div class="form-group">
                                            <input type="hidden" name="accion" value="2"/>
                                            <input type="hidden" name="vpag_cod" value="<?php echo $resultado[0]['pag_cod']?>"/>
                                      <div class="form-group">
                                          <label class="control-label col-sm-2">Nombre:</label>
                                          <div class="col-sm-6">
                                              <input type="text" name="vpag_nombre" id="nombre" class="form-control" required="" autofocus="" value="<?php echo $resultado[0]['pag_nombre']?>"/>
                                          </div>
                                      </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2">Dirección:</label>
                                          <div class="col-sm-6">
                                              <input type="text" name="vpag_direc" id="direccion" class="form-control" required="" value="<?php echo $resultado[0]['pag_direc']?>" />
                                          </div>
                                      </div>
                                           <!-- AGREGAR LISTA DESPLEGABLE MODULO -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">modulo:</label>
                                            <div class="col-lg-6">
                                              <div class="input-group">
                                                   <?php
                                                    $sql = "SELECT * FROM modulos ORDER BY CASE WHEN mod_cod='" . $resultado[0]["mod_cod"] . "' THEN 1 ELSE 2 END, mod_cod desc;";
                                                    $modulos = consultas::get_datos($sql);
                                                    ?>
                                                    <select class="form-control select2" name="vmod_cod" required="">
                                                        <option value="">Seleccione un modulo</option>
                                                        <option value="<?php echo $modulos[0]['mod_cod'];?>" selected><?php echo $modulos[0]['mod_nombre'];?></option>
                                                        <?php foreach (array_slice($modulos,1) as $modulo) { ?>
                                                          <option value="<?php echo $modulo['mod_cod'];?>" ><?php echo $modulo['mod_nombre'];?></option>   
                                                        <?php }?>
                                                    </select>  
                                                    <span class="input-group-btn btn-flat">
                                                        <a class="btn btn-primary" data-title ="Agregar modulo " rel="tooltip" data-placement="top"
                                                           data-toggle="modal" data-target="#registrar">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                        </div>
                                    </div>
                                    <!-- FIN LISTA DESPLEGABLE MODULO -->
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                          <i class="fa fa-remove"></i> Cerrar</button>
                                          <button type="submit" class="btn btn-warning pull-right">
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
             <!-- MODAL REGISTRAR MODULO -->
             <div class="modal fade" id="registrar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                  <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registrar modulo</strong></h4>
                              </div>
                              <form action="cargo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="5">
                                  <input type="hidden" name="vcar_cod" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-sm-3">Agregar una modulo:</label>
                                          <div class="col-sm-9">
                                              <input type="text" name="vcar_descri" class="form-control" required="" autofocus=""/>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                          <i class="fa fa-remove"></i> Cerrar</button>
                                          <button type="submit" class="btn btn-primary pull-right">
                                          <i class="fa fa-floppy-o"></i> Registrar</button>                                          
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <!-- FIN MODAL REGISTRAR MODULO -->
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
    </body>
</html>
