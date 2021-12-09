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
                                    <h3 class="box-title">Editar Pedido de compra</h3>
                                    <div class="box-tools">
                                        <a href="pedcompra_index.php" class="btn btn-primary btn-sm" data-title="Volver" rel="tooltip">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div> 
                                <form action="pedcompra_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <?php 
                                    $sql = "select * from v_pedido_cabcompra where ped_com =".$_REQUEST['vped_com'];
                                    // echo $sql;return;
                                    $pedidos = consultas::get_datos($sql);
                                    ?>
                                    <div class="box-body">
                                        <input type="hidden" name="accion" value="2"/>
                                        <input type="hidden" name="vped_com" value="<?php echo $pedidos[0]['ped_com'];?>"/>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-xs-12">
                                                <label>Fecha:</label>
                                                <input type="text" name="vped_fecha" class="form-control" value="<?php echo $pedidos[0]['ped_fecha'];?>" readonly=""/>                                                
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <label>Proveedor:</label>
                                                    <div class="input-group">
                                                        <?php
                                                            $sql = "select * " .
                                                                   " from proveedor order by prv_cod=".$pedidos[0]['prv_cod']." desc";
                                                            // echo $sql; return;
                                                            // print_r($_SESSION); return;
                                                            $proveedores = consultas::get_datos($sql);?>
                                                        <select class="form-control select2" name="vprv_cod" required="">
                                                            <?php foreach ($proveedores as $prv) { ?>
                                                              <option value="<?php echo $prv['prv_cod'];?>"prv_cod><?php echo "(".$prv['prv_ruc'].") ".$prv['prv_razonsocial'];?></option>   
                                                            <?php }?>
                                                        </select>  
                                                        <span class="input-group-btn btn-flat">
                                                            <a class="btn btn-primary" data-title ="Agregar Proveedor " rel="tooltip" data-placement="top"
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
                                                                <input type="text" class="form-control" value="<?php echo $_SESSION["sucursal"];?>" readonly=""/>                                                
                                                            </div>      
                                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                                <label>Empleado:</label>
                                                                <input type="text" class="form-control" value="<?php echo $_SESSION["nombres"];?>" readonly=""/>                                                
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
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
                     <!-- MODAL REGISTRAR -->
                  <div class="modal fade" id="registrar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                  <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registrar Articulo</strong></h4>
                              </div>
                               <form action="proveedor_control" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body">
                                        <input type="hidden" name="vprv_cod" value="0"/>
                                        <input type="hidden" name="accion" value="1"/>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">RUC°:</label>
                                            <div class="col-lg-5">
                                                <input type="number" name="vemp_cod" class="form-control" required="" autofocus="" min="1" placeholder="Ingrese el C.I del cliente"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Nombres:</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="vprv_ruc" class="form-control" required="" placeholder="Ingrese el nombre del cliente"/>
                                            </div>
                                        </div>                  
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Apellidos:</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="vprv_razonsocial" class="form-control" required="" placeholder="Ingrese el apellido del cliente"/>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Teléfono:</label>
                                            <div class="col-lg-5">
                                                <input type="tel" name="vcli_apellido" class="form-control" placeholder="Ingrese el teléfono del cliente"/>
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


