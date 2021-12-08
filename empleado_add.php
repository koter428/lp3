<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/Lp3/img/avatar_1.png">
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-android-person-add"></i>
                                    <h3 class="box-title">Agregar Empleado</h3>
                                    <div class="box-tools">
                                        <a href="empleado_index.php" class="btn btn-primary pull-right btn-sm" data-title="Volver" rel="tooltip">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="empleado_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <input type="hidden" name="vemp_cod" value="0"/>
                                        <input type="hidden" name="accion" value="1"/>
                                          <!-- AGREGAR LISTA DESPLEGABLE CARGO -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2">Cargo:</label>
                                            <div class="col-lg-6">
                                              <div class="input-group">
                                                    <?php $cargo = consultas::get_datos("select * from cargo order by car_cod");?>
                                                    <select class="form-control select2" name="vcar_cod" required="">
                                                        <option value="">Seleccione un cargo</option>
                                                        <?php foreach ($cargo as $car) { ?>
                                                          <option value="<?php echo $car['car_cod'];?>" selected><?php echo $car['car_descri'];?></option>   
                                                        <?php }?>
                                                    </select>  
                                                    <span class="input-group-btn btn-flat">
                                                        <a class="btn btn-primary" data-title ="Agregar Cargo " rel="tooltip" data-placement="top"
                                                           data-toggle="modal" data-target="#registrar">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                        </div>
                                    </div>
                                    <!-- FIN LISTA DESPLEGABLE CARGO -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Nombres:</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="vemp_nombre" class="form-control" required="" placeholder="Ingrese el nombre del empleado"/>
                                            </div>
                                        </div>                  
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Apellidos:</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="vemp_apellido" class="form-control" required="" placeholder="Ingrese el apellido del empleado"/>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Teléfono:</label>
                                            <div class="col-lg-4">
                                                <input type="tel" name="vemp_tel" class="form-control" placeholder="Ingrese el teléfono del empleado" maxlength="20"/>
                                            </div>
                                        </div>                  
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Dirección:</label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control" name="vemp_direcc" placeholder="Ingrese la dirección del empleado"></textarea>
                                            </div>
                                        </div>                                                          
                                    </div>  
                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default">
                                            <i class="fa fa-remove"></i> Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-floppy-o"></i> Guardar
                                        </button>                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
            </div>                  
              <!-- MODAL REGISTRAR CARGO -->
              <div class="modal fade" id="registrar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                  <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registrar Cargo</strong></h4>
                              </div>
                              <form action="cargo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="5">
                                  <input type="hidden" name="vcar_cod" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-sm-3">Agregar una Cargo:</label>
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
                  <!-- FIN MODAL REGISTRAR CARGO -->
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
    </body>
</html>


