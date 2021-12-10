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
                                    <h3 class="box-title">Agregar Compra</h3>
                                    <div class="box-tools">
                                        <a href="compras_index.php" class="btn btn-primary btn-sm" data-title="Volver" rel="tooltip">
                                            <i class="fa fa-arrow-left"></i> VOLVER
                                        </a>
                                    </div>
                                </div> 
                                <form action="compras_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <input type="hidden" name="accion" value="1">
                                    <input type="hidden" name="vcom_cod" value="0">
                                    <div class="box-body">
                                        <div class="form-group">                                            
                                            <?php $fecha = consultas::get_datos("select current_date as fecha");?>
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Fecha:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5"> 
                                                <input type="date" name="vcom_fecha" class="form-control" readonly="" value="<?php echo $fecha[0]['fecha'];?>"/>
                                            </div>
                                            <label class="control-label col-lg-2 col-md-2">Condición:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5">
                                                <select class="form-control select2" name="vtipo_compra" required="" id="tipo_compra" onchange="tipoventa()">
                                                    <option value="CONTADO">CONTADO</option>
                                                    <option value="CREDITO">CREDITO</option>
                                                </select>    
                                            </div>                                            
                                        </div>  
                                        <!-- AGREGAR LISTA DESPLEGABLE proveedores -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-md-2">Proveedores:</label>
                                            <div class="col-lg-6 col-md-6 col-sm-5">
                                                <div class="input-group">
                                                    <?php $proveedores = consultas::get_datos("select * from proveedor order by prv_ruc");?>
                                                    <select class="form-control select2" name="vprv_cod" required="" id="proveedor" onchange="pedidos()">
                                                        <option value="">Seleccione un Proveedor</option>
                                                        <?php foreach ($proveedores as $proveedor) { ?>
                                                          <option value="<?php echo $proveedor['prv_cod'];?>"><?php echo "(".$proveedor['prv_ruc'].") ".$proveedor['prv_razonsocial'];?></option>   
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
                                            <div id="det_pedidos"></div>
                                        </div>
                                        <!-- FIN LISTA DESPLEGABLE proveedor -->  
                                        <div class="form-group tipo" style="display: none;">                                            
                                            <label class="control-label col-lg-2 col-md-2 col-sm-2"> Cant. Cuotas:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5"> 
                                                <input type="number" name="vcan_cuota" class="form-control" min="1" value="1" required="" id="cuotas"/>
                                            </div>
                                            <label class="control-label col-lg-2 col-md-2">Intervalo:</label>
                                            <div class="col-lg-4 col-md-4 col-sm-5">
                                                <input type="number" name="vcom_plazo" class="form-control" min="0" max="36" value="0" required="" id="intervalo"/>
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
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            function tipocompra(){
//                alert($("#tipo_compra").val())
                  if ($('#tipo_compra').val()==='CONTADO') {
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
             * DEL PROVEEDOR SELECCIONADO */
            
            function pedidos(){
                $.ajax({
                   type     : "GET",
                   url      : "/lp3/compras_pedidos.php?vprv_cod="+$('#proveedor').val(),
                   cache    : false,
                beforeSend:function(){
                   $("#det_pedidos").html('<img src="img/loader.gif"/ width="60" height="40"><strong>&nbsp;&nbsp;Cargando...</strong>')
                },
                success:function(data){
                    $("#det_pedidos").html(data)
                }                   
                });
            }
        </script>
    </body>
</html>


