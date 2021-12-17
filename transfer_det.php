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
                            <?php } 
                                $transferencias = consultas::get_datos("select * from v_transfer where tra_cod=".$_REQUEST['vtra_cod']);
                            ?>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i><i class="fa fa-list"></i>
                                    <h3 class="box-title">Agregar Detalle Transferencia</h3>
                                    <div class="box-tools">
                                        <a href="transfer_index.php" class="btn btn-primary btn-sm" data-title='Volver' rel='tooltip' data-placement='top'><i class="fa fa-arrow-left"></i> VOLVER</a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                          
                                            <?php 
                                            //consulta a la tabla ajustes
                                            if (!empty($transferencias)) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-condensed table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>N° Transferencia</th>
                                                            <th>Fecha</th>
                                                            <th>Empleado</th>
                                                            <th>Monto Ajustado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($transferencias as $tra) { ?>
                                                        <tr>
                                                            <td data-title='N° Transf.'><?php echo $tra['tra_cod'];?></td>
                                                            <td data-title='Fecha'><?php echo $tra['tra_fecha'];?></td>
                                                            <td data-title='Empleado'><?php echo $tra['empleado'];?></td>
                                                            <td data-title='Total'><?php echo number_format($tra['tra_total'],0,",",".");?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php }else { ?>
                                            <div class="alert alert-info flat">
                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                No se encontraron registros coincidentes...
                                            </div>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- FIN CABECERA-->
                                    <!-- INCICIO DETALLE DE ITEMS PEDIDOS, tal parece que no afecta en nada -->                 
                                   <?php
                                        $sql = "select origen.dep_descri as dep_ori,
                                                destino.dep_descri as dep_des,
                                                articulo.art_cod,
                                                articulo.art_descri,
                                                coalesce(transferencias_detalle.tra_cant,0) as tra_cant,
                                                coalesce(transferencias_detalle.tra_precio,0) as tra_precio,
                                                transferencias.tra_cod 
                                                from transferencias full outer join transferencias_detalle on transferencias.tra_cod = transferencias_detalle.tra_cod
                                                full outer join deposito as origen on transferencias_detalle.dep_ori = origen.dep_cod
                                                full outer join deposito as destino on transferencias_detalle.dep_des = destino.dep_cod
                                                full outer join articulo on transferencias_detalle.art_cod = articulo.art_cod,
                                                empleado
                                                where transferencias.emp_cod = empleado.emp_cod
                                                and dep_ori is not null
                                                and transferencias.tra_cod = " . $tra['tra_cod'];
                                        // echo $sql; return;
                                        $transferenciasdet = consultas::get_datos($sql);
                                        // print_r($transferenciasdet);
                                    if (!empty($ajustes)) { ?>                                    
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="box-header">
                                                <i class="fa fa-list"></i>
                                                <h3 class="box-title">Detalle de la transferencia de items° <?php echo $transferenciasdet[0]['tra_cod'];?></h3>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-condensed table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Origen</th>
                                                            <th>Descripción</th>
                                                            <th>Destino</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio</th>
                                                            <th>Subtotal</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <?php foreach ($transferenciasdet as $det) { ?>
                                                        <tr>
                                                            <td data-title="#"><?php echo $det['art_cod'];?></td>
                                                            <td data-title="Origen"><?php echo $det['dep_ori']?></td>
                                                            <td data-title="Descripción"><?php echo $det['art_descri']?></td>
                                                            <td data-title="Destino"><?php echo $det['dep_des']?></td>
                                                            <td data-title="Cantidad"><?php echo number_format($det['tra_cant'],2,",","."); ?></td>
                                                            <td data-title="Precio"><?php echo number_format($det['tra_precio'],0,"",".");?></td>
                                                            <td data-title="Subtotal"><?php echo number_format($det['tra_precio'] * $det['tra_cant'],0,"",".");?></td>
                                                            <td class="text-center">
                                                                <a onclick="add(<?php echo $det['tra_cod'];?>,<?php echo $transferencias[0]['tra_cod'];?>,<?php echo $det['art_cod'];?>,<?php echo $det['dep_ori'];?>)" class="btn btn-success btn-sm" role='button'
                                                                   data-title='Agregar' rel='tooltip' data-placement='top' data-toggle="modal" data-target="#editar">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </a>                                                                                                
                                                            </td>
                                                        </tr>         
                                                       <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>          
                                     <!--TERMINA DETALLE DE ITEMS PEDIDOS, tal parece que no afecta en nada -->
                                    <!-- INCICIO DETALLES-->
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
                                            <?php
                                                $sql = "select origen.dep_descri as dep_ori,
                                                origen.dep_cod as ori_cod,
                                                destino.dep_descri as dep_des,
                                                destino.dep_cod as des_cod,
                                                articulo.art_cod,
                                                articulo.art_descri,
                                                coalesce(transferencias_detalle.tra_cant,0) as tra_cant,
                                                coalesce(transferencias_detalle.tra_precio,0) as tra_precio,
                                                transferencias.tra_cod 
                                                from transferencias full outer join transferencias_detalle on transferencias.tra_cod = transferencias_detalle.tra_cod
                                                full outer join deposito as origen on transferencias_detalle.dep_ori = origen.dep_cod
                                                full outer join deposito as destino on transferencias_detalle.dep_des = destino.dep_cod
                                                full outer join articulo on transferencias_detalle.art_cod = articulo.art_cod,
                                                empleado
                                                where transferencias.emp_cod = empleado.emp_cod
                                                and transferencias.tra_cod = " . $transferencias[0]['tra_cod'];
                                                $detalles = consultas::get_datos($sql);
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
                                                            <th>Artículo</th>
                                                            <th>Origen</th>
                                                            <th>Destino</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio</th>
                                                            <th>Subtotal</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <?php foreach ($detalles as $det) { ?>
                                                        <tr>
                                                            <td data-title="#"><?php echo $det['art_cod'];?></td>
                                                            <td data-title="Articulo"><?php echo $det['art_descri'];?></td>
                                                            <td data-title="Origen"><?php echo $det['dep_ori'];?></td>
                                                            <td data-title="Destino"><?php echo $det['dep_des'];?></td>
                                                            <td data-title="Cantidad"><?php echo number_format($det['tra_cant'],2,",",".");?></td>
                                                            <td data-title="Precio"><?php echo number_format($det['tra_precio'],0,",",".");?></td>
                                                            <td data-title="Subtotal"><?php echo number_format($det['tra_precio'] * $det['tra_cant'],0,",",".");?></td>
                                                            <td class="text-center">
                                                                <a onclick="editar(<?php echo $det['tra_cod'];?>,<?php echo $det['art_cod'];?>,<?php echo $det['dep_ori'];?>)" class="btn btn-warning btn-sm" role='button'
                                                                   data-title='Editar' rel='tooltip' data-placement='top' data-toggle="modal" data-target="#editar">
                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                </a>
                                                                <a onclick="borrar(<?php echo "'".$det['tra_cod']."_".$det['ori_cod']."_".$det['des_cod']."_".$det['art_cod']."'"?>)" class="btn btn-danger btn-sm" role='button'
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
                                                <i class="fa fa-info-circle"></i> el ajuste aún no tiene detalles cargados...
                                            </div>       
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!-- FIN DETALLES-->
                                    <!-- INICIO FORMULARIO AGREGAR-->
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <form action="transfer_dcontrol.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                                <input type="hidden" name="accion" value="1">
                                                <input type="hidden" name="vtra_cod" value="<?php echo $transferencias[0]['tra_cod'];?>">
                                                <div class="box-body">
                                                    <!-- AGREGAR LISTA DESPLEGABLE DEPOSITO ORIGEN-->
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Origen:</label>
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php $depositos = consultas::get_datos("select * from deposito where id_sucursal = ".$_SESSION['id_sucursal']." order by dep_descri");?>
                                                                <select class="form-control select2" name="vdep_ori" required="">
                                                                    <option value="">Seleccione un origen</option>
                                                                    <?php foreach ($depositos as $deposito) { ?>
                                                                      <option value="<?php echo $deposito['dep_cod'];?>"><?php echo $deposito['dep_descri'];?></option>   
                                                                    <?php }?>
                                                                </select>  
                                                        </div>
                                                    </div>
                                                    <!-- FIN LISTA DESPLEGABLE DEPOSITO -->
                                                    <!-- AGREGAR LISTA DESPLEGABLE DEPOSITO DESTINO-->
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Destino:</label>
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php $depositos = consultas::get_datos("select * from deposito where id_sucursal = ".$_SESSION['id_sucursal']." order by dep_descri");?>
                                                                <select class="form-control select2" name="vdep_des" required="">
                                                                    <option value="">Seleccione un origen</option>
                                                                    <?php foreach ($depositos as $deposito) { ?>
                                                                      <option value="<?php echo $deposito['dep_cod'];?>"><?php echo $deposito['dep_descri'];?></option>   
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
                                                    <!-- FIN LISTA DESPLEGABLE ARTICULO --> 
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Cantidad:</label>
                                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                                            <input type="number" class="form-control" name="vtra_cant" min="1" value="1" required="" id="vtra_cant"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Precio:</label>
                                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                                            <input type="number" class="form-control" name="vtra_precio" min="1" required="" id="vprecio"/>
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
                           <!-- MODAL EDITAR DETALLE-->
                  <div class="modal fade" id="editar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content" id="detalles">
                          <?php 
                          $detalles = consultas::get_datos("select * from v_detalle_transfer where aju_cod=".$_REQUEST['vtra_cod']
        ." and art_cod =".$_REQUEST['vart_cod']." and dep_cod =".$_REQUEST['vdep_cod']);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
    <h4 class="modal-title"><i class="fa fa-edit"></i> <strong>Editar Detalle De Ajuste</strong></h4>
</div>
<form action="transfer_dcontrol.php" method="post" accept-charset="utf-8" class="form-horizontal">
    <input type="hidden" name="accion" value="2">
    <input type="hidden" name="vtra_cod" value="<?php echo $detalles[0]['tra_cod']?>">
    <input type="hidden" name="vdep_cod" value="<?php echo $detalles[0]['dep_cod']?>">
    <input type="hidden" name="vart_cod" value="<?php echo $detalles[0]['art_cod']?>">
    <input type="hidden" name="vart_cod" value="<?php echo $detalles[0]['mot_cod']?>">
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label col-sm-2">Depósito:</label>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <input type="text" class="form-control" readonly="" value="<?php echo $detalles[0]['dep_descri']?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Articulo:</label>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <input type="text" class="form-control" readonly="" value="<?php echo $detalles[0]['art_descri']?>"/>
            </div>
        </div> 
        <div class="form-group">
            <label class="control-label col-sm-2">Cantidad:</label>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <input type="number" name="vaju_cant" class="form-control" required="" value="<?php echo $detalles[0]['tra_cant']?>" min="1"/>
            </div>
        </div> 
        <div class="form-group">
            <label class="control-label col-sm-2">Precio:</label>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <input type="number" name="vaju_precio" class="form-control" required="" value="<?php echo $detalles[0]['tra_precio']?>" min="1"/>
            </div>
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
                  <!-- FIN MODAL EDITAR DETALLE-->
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $("#mensaje").delay(4000).slideUp(200,function(){
                $(this).alert('close');
            });
        </script>
        <script>
        
        function precio(){
            // alert($('#articulo').val())
            var valor = $('#articulo').val().split('_');
            $('#vprecio').val(valor[1]);
        };
        
        function editar(ven,art,dep){       
            $.ajax({
                type    : "GET",
                url     : "/lp3/transfer_dedit.php?vtra_cod="+ven+"&vdep_ori="+art+"&vdep_des="+dep,
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
            //alert(datos);
            var dat = datos.split('_');
            $('#si').attr('href','transfer_dcontrol.php?vtra_cod='+dat[0]+'&vdep_ori='+dat[1]+'&vdep_des='+dat[2]+'&vart_cod='+dat[3]+'&accion=3');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el articulo \n\
            <strong>'+dat[3]+'</strong> ?');            
        };

        function add(ped,ven,art,dep){
            $.ajax({
                type    : "GET",
                url     : "/lp3/transfer_dadd.php?vtra_cod="+ped+"&vtra_cod="+ajustes+"&vart_cod="+art+"&vdep_ori="+dep,
                cache   : false,
                beforeSend:function(){
                   $("#detalles").html('<img src="img/loader.gif"/><strong>Cargando...</strong>')
                },
                success:function(data){
                    $("#detalles").html(data)
                }
            });
        };            
        </script>        
    </body>
</html>