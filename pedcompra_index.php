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
         
        @session_start();/*Reanudar sesion*/
        include './ver_session.php'; 
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
                                    <i class="fa fa-newspaper-o"></i>
                                    <h3 class="box-title">Pedido de Compras</h3>
                                    <div class="box-tools">
                                        <a href="pedcompra_add.php" class="btn btn-primary btn-sm pull-right" data-title='Agregar' rel='tooltip' data-placement='top'><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form  method="post" accept-charset="utf-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="input-group custom-search-form">
                                                                <input type="search" class="form-control" name="buscar"
                                                                       placeholder="Ingrese valor a buscar..." autofocus=""/>
                                                                <span class="input-group-btn">
                                                                    <button type="submit" class="btn btn-primary btn-flat" data-title="Buscar" 
                                                                            rel="tooltip"><i class="fa fa-search"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>                                            
                                            <?php 
                                            //consulta a la tabla 
                                            $pedidos = consultas::get_datos("select * from v_pedido_cabcompra"
                                                    . " where id_sucursal =".$_SESSION['id_sucursal']." and ped_com::varchar ilike '%".(isset($_REQUEST['buscar'])?$_REQUEST['buscar']:"")."%' order by ped_com desc");
                                            //var_dump($pedidos);
                                            if (!empty($pedidos)) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-condensed table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>N° Pedido</th>
                                                            <th>Fecha</th>
                                                            <th>Proveedor</th>
                                                            <th>Total</th>
                                                            <th>Estado</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pedidos as $ped) { ?>
                                                        <tr>
                                                            <td data-title='N° Pedido'><?php echo $ped['ped_com'];?></td>
                                                            <td data-title='Fecha'><?php echo $ped['ped_fecha'];?></td>
                                                            <td data-title='Proveedor'><?php echo $ped['proveedor'];?></td>
                                                            <td data-title='Total'><?php echo number_format($ped['ped_total'],0,",",".");?></td> <!<!-- PARA QUE SEPARE DECIMALES -->
                                                            <td data-title='Estado'><?php echo $ped['estado'];?></td>
                                                            <td data-title='Acciones' class="text-center">
                                                                <?php if($ped['estado']=="PENDIENTE"){?>
                                                                <a href="pedcompra_det.php?vped_com=<?php echo $ped['ped_com'];?>" class="btn btn-success btn-sm" role='button'
                                                                   data-title='Detalles' rel='tooltip' data-placement='top'>
                                                                    <span class="glyphicon glyphicon-list"></span>
                                                                </a>                                                                
                                                                <a href="pedcompra_edit.php?vped_com=<?php echo $ped['ped_com'];?>" class="btn btn-warning btn-sm" role='button'
                                                                   data-title='Editar' rel='tooltip' data-placement='top'>
                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                </a>
                                                                <a onclick="anular(<?php echo "'".$ped['ped_com']."_".$ped['proveedor']."_".$ped['ped_fecha']."'"?>)" class="btn btn-danger btn-sm" role='button'
                                                                   data-title="anular" rel="tooltip" data-placement='top' data-toggle="modal" data-target="#anular">
                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                </a>                                                                        
                                                                <?php }?>
                                                                <a href="pedcompra_print.php?vped_com=<?php echo $ped['ped_com'];?>" class="btn btn-default btn-sm" role='button'
                                                                   data-title='Imprimir' rel='tooltip' data-placement='top' target="print">
                                                                    <span class="glyphicon glyphicon-print"></span>
                                                                </a>                                                                   
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php }else { ?>
                                            <div class="alert alert-info flat">
                                                <span class="glyphicon glyphicon-info-sign"></span> 
                                                No se han registrado Pedidos de Compras...
                                            </div>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <!-- FIN FILA 1 -->
                </div>   
                <!-- FIN CONTENEDOR PRINCIPAL -->
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
                  <!-- MODAL ANULAR -->
                  <div class="modal fade" id="anular" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                  <h4 class="modal-title custom_align">Atenci&oacute;n!!!</h4>
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
                  <!-- FIN MODAL ANULAR -->                   
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $("#mensaje").delay(4000).slideUp(200,function(){
                $(this).alert('close');
            });
        </script>
        <script>
            function anular(datos){
                var dat = datos.split('_');
               $('#si').attr('href','pedcompra_control.php?vped_com='+dat[0]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> "Desea anular el \n\
                pedido N° <strong>'+dat[0]+'</strong> de fecha <strong>'+dat[2]+'</strong> del Proveedor <strong>'+dat[1]+'</strong> ?');
            }
        </script>         
    </body>
</html>