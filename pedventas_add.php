<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/lp3/user.png">
        <title>LP3</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php 
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
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-plus"></i>
                                    <h3 class="box-title">Agregar Pedido de Ventas</h3>
                                    <div class="box-tools">
                                        <a href="pedventas_index.php" class="btn btn-primary btn-sm" data-title="Volver" rel="tooltip">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div> 
                                <form action="pedventas_control.php" method="get" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <input type="hidden" name="accion" value="1"/>
                                        <input type="hidden" name="vped_cod" value="0"/>
                                        <div class="row">
                                            <?php $fecha = consultas::get_datos("select current_date as fecha");?>
                                            <div class="col-lg-3 col-md-6 col-xs-12">
                                                <label>Fecha:</label>
                                                <input type="date" name="vped_fecha" class="form-control" value="<?php echo $fecha[0]['fecha'];?>" readonly=""/>                                                
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <label>Cliente:</label>
                                                    <div class="input-group">
                                                        <?php $clientes = consultas::get_datos("select cli_cod,cli_ci,(cli_nombre||' '||cli_apellido) as nombres"
                                                                . " from clientes order by cli_nombre");?>
                                                        <select class="form-control select2" name="vcli_cod" required="">
                                                            <option value="">Seleccione un cliente</option>
                                                            <?php foreach ($clientes as $cliente) { ?>
                                                              <option value="<?php echo $cliente['cli_cod'];?>"><?php echo "(".$cliente['cli_ci'].") ".$cliente['nombres'];?></option>   
                                                            <?php }?>
                                                        </select>  
                                                        <span class="input-group-btn btn-flat">
                                                            <a class="btn btn-primary" data-title ="Agregar Clientes " rel="tooltip" data-placement="top"
                                                               data-toggle="modal" data-target="#registrar">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-xs-12">
                                                <label>Sucursal:</label>
                                                <input type="text" class="form-control" value="<?php echo $_SESSION['sucursal'];?>" readonly=""/>                                                
                                            </div>      
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <label>Empleado:</label>
                                                <input type="text" class="form-control" value="<?php echo $_SESSION['nombres'];?>" readonly=""/>                                                
                                            </div>                                                  
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default" data-title="Cancelar" rel="tooltip"> 
                                            <i class="fa fa-remove"></i> Cancelar</button>                                        
                                        <button type="submit" class="btn btn-primary pull-right" data-title="Guardar" rel="tooltip"> 
                                            <i class="fa fa-floppy-o"></i> Registrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS--> 
                    <!-- MODAL REGISTRAR -->
                  <div class="modal fade" id="registrar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                  <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registrar Articulo</strong></h4>
                              </div>
                               <form action="cliente_control" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <input type="hidden" name="vcli_cod" value="0"/>
                                        <input type="hidden" name="accion" value="1"/>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">C.I N°:</label>
                                            <div class="col-lg-5">
                                                <input type="number" name="vcli_ci" class="form-control" required="" autofocus="" min="1" placeholder="Ingrese el C.I del cliente"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Nombres:</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="vcli_nombre" class="form-control" required="" placeholder="Ingrese el nombre del cliente"/>
                                            </div>
                                        </div>                  
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Apellidos:</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="vcli_apellido" class="form-control" required="" placeholder="Ingrese el apellido del cliente"/>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Teléfono:</label>
                                            <div class="col-lg-5">
                                                <input type="tel" name="vcli_telefono" class="form-control" placeholder="Ingrese el teléfono del cliente"/>
                                            </div>
                                        </div>                  
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Dirección:</label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control" name="vcli_direcc" placeholder="Ingrese la dirección del cliente"></textarea>
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
                  <!-- FIN MODAL REGISTRAR -->
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
    </body>
</html>


