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
                                    <h3 class="box-title">Editar Ajustes</h3>
                                    <div class="box-tools">
                                        <a href="ajustes_index.php" class="btn btn-primary btn-sm" data-title="Volver" rel="tooltip">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div> 
                                <form action="ajustes_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <?php
                                    // echo $sql; return;
                                    //print_r($_SESSION); return;
                                     $sql = "select  *  from v_ajustes where aju_cod =".$_GET['vaju_cod'];
                                      $resultado = consultas::get_datos($sql);?>
                                    <div class="box-body">
                                        <input type="hidden" name="accion" value="2"/>
                                        <input type="hidden" name="vaju_cod" value="<?php echo $resultado[0]['aju_cod'];?>"/>
                                        <div class="row">
                                                   <label class="control-label col-lg-2 col-md-2 col-sm-2"> Fecha:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5"> 
                                                <input type="date" name="vaju_fecha" class="form-control" readonly="" value="<?php echo $fecha[0]['fecha'];?>"/>
                                            </div>
                                            <label class="control-label col-lg-2 col-md-2">Empleado:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5">
                                            <input type="text" class="form-control" value="<?php echo $_SESSION['nombres'];?>" readonly=""/>
                                            </div>                                            
                                        </div>     
                                        <div class="form-group">                                            
                                            <label class="control-label col-lg-2">Observacion</label>
                                            <div class="col-lg-4">
                                                <textarea class="form-control" name="vaju_obser" placeholder="Ingrese la Observacion correspondiente..."></textarea>
                                            </div>
                                            <label class="control-label col-lg-2 col-md-2">Depósito:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5">
                                                <input type="text" class="form-control" value="<?php echo $_SESSION['dep_descri'];?>" readonly=""/>
                                            </div>                                            
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
        <!-- MODAL REGISTRAR -->
        <div class="modal fade" id="registrar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registrar Articulo</strong></h4>
                    </div>
                     <form action="ajustes_control" method="post" accept-charset="utf-8" class="form-horizontal">
                         <div class="box-body">
                             <input type="hidden" name="accion" value="1"/>
                                  <input type="hidden" name="vprv_cod" value="0"/>                                             
                                  <label class="control-label col-lg-2 col-md-2 col-sm-2"> Ruc:</label>
                                  <div class="col-lg-8 col-md-8 col-sm-8">
                                      <input type="text" name="vprv_ruc" class="form-control" required="" autofocus=""/>
                                  </div>               
                              </div>
                              <div class="form-group">
                                  
                                  <label class="control-label col-lg-2 col-md-2 col-sm-2"> Razon Social:</label>
                                  <div class="col-lg-8 col-md-8 col-sm-8">
                                      <input type="text" name="vprv_razonsocial" class="form-control" required="" autofocus=""/>
                                  </div>               
                              </div> <div class="form-group">
                                  
                                  <label class="control-label col-lg-2 col-md-2 col-sm-2"> Direccion:</label>
                                  <div class="col-lg-8 col-md-8 col-sm-8">
                                      <input type="text" name="vprv_direccion" class="form-control" required="" autofocus=""/>
                                  </div>               
                              </div>
                              <div class="form-group">
                                  
                                  <label class="control-label col-lg-2 col-md-2 col-sm-2"> Telefono:</label>
                                  <div class="col-lg-8 col-md-8 col-sm-8">
                                      <input type="text" name="vprv_telefono" class="form-control" required="" autofocus=""/>
                                  </div>               
                              </div>
                              <div class="modal-footer">
                                  <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                      <i class="fa fa-remove"></i> Cerrar</button>
                                      <button type="submit" class="btn btn-primary pull-right">
                                          <i class="fa fa-floppy-o"></i> Editar</button>                                          
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <!-- FIN MODAL REGISTRAR -->
    </body>
</html>