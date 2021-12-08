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
        @@session_start();/*Reanudar sesion*/
        require 'menu/css_lte.ctp'; ?><!--ARCHIVOS CSS-->

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require 'menu/header_lte.ctp'; ?><!--CABECERA PRINCIPAL-->
            <?php require 'menu/toolbar_lte.ctp';?><!--MENU PRINCIPAL-->
            <div class="content-wrapper">
                <!-- CONTENEDOR PRINCIPAL -->
                <div class="content">
                    <!-- FILA 1 -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php if (!empty($_SESSION['mensaje'])) { ?>
                            <div class="alert alert-danger" id="mensaje">
                                <span class="glyphicon glyphicon-info-sign"></span>
                                <?php echo $_SESSION['mensaje'];
                                    $_SESSION['mensaje'] = '';
                                ?>
                            </div>
                            <?php } ?>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Detalle Pedido</h3>
                                    <div class="box-tools">
                                        <a href="pedventas_index.php" class="btn btn-primary btn-sm pull-right" data-title='Volver' rel='tooltip' data-placement='top'><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                          
                                            <?php 
                                            //consulta a la tabla marca
                                            $pedidos = consultas::get_datos("select * from v_pedido_cabventa where ped_cod=".$_REQUEST['vped_cod']);
                                            //var_dump($marcas);
                                            if (!empty($pedidos)) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-condensed table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>N° Pedido</th>
                                                            <th>Fecha</th>
                                                            <th>Cliente</th>
                                                            <th>Total</th>
                                                            <th>Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pedidos as $ped) { ?>
                                                        <tr>
                                                            <td data-title='N° Pedido'><?php echo $ped['ped_cod'];?></td>
                                                            <td data-title='Fecha'><?php echo $ped['ped_fecha'];?></td>
                                                            <td data-title='Cliente'><?php echo $ped['cliente'];?></td>
                                                            <td data-title='Total'><?php echo number_format($ped['ped_total'],0,",",".");?></td>
                                                            <td data-title='Estado'><?php echo $ped['estado'];?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php }else { ?>
                                            <div class="alert alert-info flat">
                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                No se han registrado marcas...
                                            </div>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- FIN CABECERA-->
                                    <!-- INCICIO DETALLES-->
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <?php $detalles = consultas::get_datos("select * from v_detalle_pedventa where ped_cod=".$pedidos[0]['ped_cod']);
                                                 if (!empty($detalles)) { ?>
                                            <div class="box-header">
                                                <i class="fa fa-list"></i>
                                                <h3 class="box-title">Detalle Items</h3>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-condensed table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Descripción</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio</th>
                                                            <th>Impuesto</th>
                                                            <th>Subtotal</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <?php foreach ($detalles as $det) { ?>
                                                        <tr>
                                                            <td data-title="#"><?php echo $det['art_cod'];?></td>
                                                            <td data-title="Descripción"><?php echo $det['art_descri']." ".$det['mar_descri'];?></td>
                                                            <td data-title="Cantidad"><?php echo $det['ped_cant'];?></td>
                                                            <td data-title="Precio"><?php echo number_format($det['ped_precio'],0,",",".");?></td>
                                                            <td data-title="Impuesto"><?php echo $det['tipo_descri'];?></td>
                                                            <td data-title="Precio"><?php echo number_format($det['subtotal'],0,",",".");?></td>
                                                            <td class="text-center">
                                                                <a onclick="editar(<?php echo $det['ped_cod'];?>,<?php echo $det['art_cod'];?>,<?php echo $det['dep_cod'];?>)" class="btn btn-warning btn-sm" role='button'
                                                                   data-title='Editar' rel='tooltip' data-placement='top' data-toggle="modal" data-target="#editar">
                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                </a>
                                                                <a onclick="borrar(<?php echo "'".$det['ped_cod']."_".$det['art_cod']."_".$det['dep_cod']."_".$det['art_descri']." ".$det['mar_descri']."'"?>)" class="btn btn-danger btn-sm" role='button'
                                                                   data-title='Borrar' rel='tooltip' data-placement='top' data-toggle="modal" data-target="#borrar">
                                                                    <span class="glyphicon glyphicon-trash"></span>
                                                                </a>                                                                  
                                                            </td>
                                                        </tr>         
                                                       <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php }else{ ?>
                                            <div class="alert alert-info flat">
                                                <i class="fa fa-info-circle"></i> El pedido aún no tiene detalles cargados...
                                            </div>       
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!-- FIN DETALLES-->
                                    <!-- INICIO FORMULARIO AGREGAR-->
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <form action="pedventas_dcontrol.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                                <input type="hidden" name="accion" value="1">
                                                <input type="hidden" name="vped_cod" value="<?php echo $pedidos[0]['ped_cod'];?>">
                                                <div class="box-body">
                                                    <!-- AGREGAR LISTA DESPLEGABLE DEPOSITO -->
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Deposito:</label>
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php $depositos = consultas::get_datos("select * from deposito where id_sucursal = ".$_SESSION['id_sucursal']." order by dep_descri");?>
                                                                <select class="form-control select2" name="vdep_cod" required="">
                                                                    <option value="">Seleccione un deposito</option>
                                                                    <?php foreach ($depositos as $deposito) { ?>
                                                                      <option value="<?php echo $deposito['dep_cod'];?>"><?php  echo $deposito['dep_descri'];?></option>   
                                                                    <?php }?>
                                                                </select>  
                                                        </div>
                                                    </div>
                                                    <!-- FIN LISTA DESPLEGABLE DEPOSITO -->
                                                    <!-- AGREGAR LISTA DESPLEGABLE ARTICULO -->
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Articulo:</label>
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php $articulos = consultas::get_datos("select * from v_articulo order by art_descri");?>
                                                            <select class="form-control select2" name="vart_cod" required="" id="articulo" onchange="precio()">
                                                                    <option value="">Seleccione un articulo</option>
                                                                    <?php foreach ($articulos as $articulo) { ?>
                                                                      <option value="<?php echo $articulo['art_cod']."_".$articulo['art_preciov'];?>"><?php echo $articulo['art_descri']." ".$articulo['mar_descri'];?></option>   
                                                                    <?php }?>
                                                                </select>  
                                                        </div>
                                                    </div>
                                                    <!-- FIN LISTA DESPLEGABLE MARCA --> 
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Cantidad:</label>
                                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                                            <input type="number" class="form-control" name="vped_cant" min="1" value="1" required=""/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Precio:</label>
                                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                                            <input type="number" class="form-control" name="vped_precio" min="1" required="" id="vprecio"/>
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                                <div class="box-footer">
                                                    <button type="submit" class="btn btn-primary pull-right">
                                                        <i class="fa fa-floppy-o"></i> Agregar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- FIN FORMULARIO AGREGAR-->
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <!-- FIN FILA 1 -->
                </div>   
                <!-- FIN CONTENEDOR PRINCIPAL -->
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS--> 
                  <!-- MODAL EDITAR DETALLE-->
                  <div class="modal fade" id="editar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content" id="detalles">
                              
                          </div>
                      </div>
                  </div>
                  <!-- FIN MODAL EDITAR DETALLE-->
                  <!-- MODAL BORRAR -->
                  <div class="modal fade" id="borrar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                  <h4 class="modal-title"><i class="fa fa-trash"></i> Atenci&oacute;n!!!</h4>
                              </div>
                                  <div class="modal-body">
                                      <div class="alert alert-danger" id="confirmacion"></div>
                                  </div>
                                  <div class="modal-footer">
                                      <a  id="si" class="btn btn-primary">
                                          <i class="fa fa-check"></i> Si</a>
                                          <button type="button" class="btn btn-default" data-dismiss="modal">
                                      <i class="fa fa-remove"></i> No</button>                                          
                                  </div>
                          </div>
                      </div>
                  </div>
                  <!-- FIN MODAL BORRAR -->                    
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $("#mensaje").delay(4000).slideUp(200,function(){
                $(this).alert('close');
            });
        </script>
        <script>
        function precio(){
            //alert($('#articulo').val())
            var valor = $('#articulo').val().split('_');
            $('#vprecio').val(valor[1]);
        };
        function editar(ped,art,dep){
            $.ajax({
                type    : "GET",
                url     : "/lp3/pedventas_dedit.php?vped_cod="+ped+"&vart_cod="+art+"&vdep_cod="+dep,
                cache   : false,
                beforeSend:function(){
                   $("#detalles").html('<img src="img/loader.gif"/><strong>Cargando...</strong>')
                },
                success:function(data){
                    $("#detalles").html(data)
                }
            });
        };
        function borrar(datos){
            var dat = datos.split('_');
            $('#si').attr('href','pedventas_dcontrol.php?vped_cod='+dat[0]+'&vart_cod='+dat[1]+'&vdep_cod='+dat[2]+'&accion=3');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el articulo \n\
    <strong>'+dat[3]+'</strong> ?');            
        }
        </script>        
    </body>
</html>


