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
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-plus"></i>
                                    <h3 class="box-title">Agregar Ventas</h3>
                                    <div class="box-tools">
                                        <a href="ventas_index.php" class="btn btn-primary btn-sm" data-title="Volver" rel="tooltip">
                                            <i class="fa fa-arrow-left"></i> VOLVER
                                        </a>
                                    </div>
                                </div> 
                                <form action="ventas_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <input type="hidden" name="accion" value="1">
                                    <input type="hidden" name="vven_cod" value="0">
                                    <div class="box-body">
                                        <div class="form-group">                                            
                                            <?php $fecha = consultas::get_datos("select current_date as fecha");?>
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Fecha:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5"> 
                                                <input type="date" name="vven_fecha" class="form-control" readonly="" value="<?php echo $fecha[0]['fecha'];?>"/>
                                            </div>
                                            <label class="control-label col-lg-2 col-md-2">Condición:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5">
                                                <select class="form-control select2" name="vtipo_venta" required="" id="tipo_venta" onchange="tipoventa()">
                                                    <option value="CONTADO">CONTADO</option>
                                                    <option value="CREDITO">CREDITO</option>
                                                </select>    
                                            </div>                                            
                                        </div>  
                                        <!-- AGREGAR LISTA DESPLEGABLE CLIENTES -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-md-2">Clientes:</label>
                                            <div class="col-lg-6 col-md-6 col-sm-5">
                                                <div class="input-group">
                                                    <?php $clientes = consultas::get_datos("select * from clientes order by cli_nombre");?>
                                                    <select class="form-control select2" name="vcli_cod" required="" id="cliente" onchange="pedidos()">
                                                        <option value="">Seleccione un cliente</option>
                                                        <?php foreach ($clientes as $cliente) { ?>
                                                          <option value="<?php echo $cliente['cli_cod'];?>"><?php echo "(".$cliente['cli_ci'].") ".$cliente['cli_nombre']." ".$cliente['cli_apellido'];?></option>   
                                                        <?php }?>
                                                    </select>  
                                                    <span class="input-group-btn btn-flat">
                                                        <a class="btn btn-primary" data-title ="Agregar Cliente " rel="tooltip" data-placement="top"
                                                           data-toggle="modal" data-target="#registrar">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div id="det_pedidos"></div>
                                        </div>
                                        <!-- FIN LISTA DESPLEGABLE MARCA -->  
                                        <div class="form-group tipo" style="display: none;">                                            
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Cant. Cuotas:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5"> 
                                                <input type="number" name="vcan_cuota" class="form-control" min="1" value="1" required="" id="cuotas"/>
                                            </div>
                                            <label class="control-label col-lg-2 col-md-2">Intervalo:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5">
                                                <input type="number" name="vven_plazo" class="form-control" min="0" max="36" value="0" required="" id="intervalo"/>
                                            </div>                                            
                                        </div>   
                                        <div class="form-group">                                            
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Empleado:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5"> 
                                                <input type="text" class="form-control" value="<?php echo $_SESSION['nombres'];?>" readonly=""/>
                                            </div>
                                            <label class="control-label col-lg-2 col-md-2">Sucursal:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5">
                                                <input type="text" class="form-control" value="<?php echo $_SESSION['sucursal'];?>" readonly=""/>
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
        <script>
            function tipoventa(){
//                alert($("#tipo_venta").val())
                  if ($('#tipo_venta').val()==='CONTADO') {
                      $('.tipo').hide();
                      $("#cuotas").val(1);
                      $("#cuotas").prop('readonly',true);
                      $("#intervalo").val(0);                      
                      $("#intervalo").prop('readonly',true);                                              
                  }else{
                      $('.tipo').show();
                      $("#cuotas").prop('readonly',false);
                      $("#intervalo").prop('readonly',false);  
                  }
            };
            /*FUNCION PARA OBTENER LOS PEDIDOS 
             * DEL CLIENTE SELECCCIONADO*/
            function pedidos(){
                $.ajax({
                   type     : "GET",
                   url      : "/lp3/ventas_pedidos.php?vcli_cod="+$('#cliente').val(),
                   cache    : false,
                beforeSend:function(){
                   $("#det_pedidos").html('<img src="img/loader.gif"/><strong>Cargando...</strong>')
                },
                success:function(data){
                    $("#det_pedidos").html(data)
                }                   
                });
            }
        </script>
    </body>
</html>


