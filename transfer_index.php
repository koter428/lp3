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
                            <?php } ?>
                            <div class="box box-primary">
                            <?php if ($_SESSION['TRANSFERENCIAS']['leer']==='t') { ?>
                                <div class="box-header">
                                    <i class="fa fa-newspaper-o"></i>
                                    <h3 class="box-title">TRANSFERENCIA</h3>
                                    <div class="box-tools">
                                    <?php if ($_SESSION['TRANSFERENCIAS']['insertar']==='t') { ?> 
                                        <a href="transfer_add.php" class="btn btn-primary btn-sm pull-right" data-title='Agregar' rel='tooltip' data-placement='top'><i class="fa fa-plus"></i></a>
                                        <?php } ?> 
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form  method="get" accept-charset="utf-8" class="form-horizontal">
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
                                            //consulta a la tabla transfer
                                            //print_r($_SESSION); return;
                                            $sql = "select to_char(tra_fecha,'dd-mm-yyyy') as tra_fecha, 
                                                    empleado.emp_nombre || ' ' || empleado.emp_apellido as empleado, 
                                                    origen.dep_descri as dep_ori,
                                                    destino.dep_descri as dep_des,
                                                    articulo.art_descri,
                                                    coalesce(transferencias_detalle.tra_cant,0) as tra_cant,
                                                    transferencias.tra_cod 
                                                    from transferencias full outer join transferencias_detalle on transferencias.tra_cod = transferencias_detalle.tra_cod
                                                    full outer join deposito as origen on transferencias_detalle.dep_ori = origen.dep_cod
                                                    full outer join deposito as destino on transferencias_detalle.dep_des = destino.dep_cod
                                                    full outer join articulo on transferencias_detalle.art_cod = articulo.art_cod,
                                                    empleado
                                                    where transferencias.emp_cod = empleado.emp_cod
                                                    and coalesce(articulo.art_descri::varchar,'') ilike '%". (isset($_REQUEST['buscar'])?$_REQUEST['buscar']:""). "%' order by tra_fecha, art_descri ";
                                            // echo $sql; return;
                                            $transfer = consultas::get_datos($sql);
                                            if (!empty($transfer)) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-condensed table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Fecha Transfer.</th>
                                                            <th>Empleado</th>
                                                            <th>Origen</th>
                                                            <th>Destino</th>
                                                            <th>Artículo</th>
                                                            <th>Cantidad</th>
                                                            <th>Código</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($transfer as $tra) { ?>
                                                        <tr>
                                                            <td data-title='Fecha transfer'><?php echo $tra['tra_fecha'];?></td>
                                                            <td data-title='Empleado'><?php echo $tra['empleado'];?></td>
                                                            <td data-title='Origen'><?php echo $tra['dep_ori'];?></td>
                                                            <td data-title='Destino'><?php echo $tra['dep_des'];?></td>
                                                            <td data-title='Artículo'><?php echo $tra['art_descri'];?></td>
                                                            <td data-title='Cantidad'><?php echo number_format($tra['tra_cant'],2,",",".");?></td>
                                                            <td data-title='Código'><?php echo $tra['tra_cod'];?></td>
                                                            <td data-title='Acciones' class="text-center">
                                                                <a href="transfer_det.php?vtra_cod=<?php echo $tra['tra_cod'];?>" class="btn btn-success btn-sm" role='button'
                                                                   data-title='Detalles' rel='tooltip' data-placement='top'>
                                                                    <span class="glyphicon glyphicon-list"></span>
                                                                </a>
                                                                <?php if ($_SESSION['TRANSFERENCIAS']['editar']=='t') { ?>                                                               
                                                                <a href="transfer_edit.php?vtra_cod=<?php echo $tra['tra_cod'];?>" class="btn btn-warning btn-sm" role='button'
                                                                   data-title='Editar' rel='tooltip' data-placement='top'>
                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                </a> <?php }?>
                                                                <?php if ($_SESSION['TRANSFERENCIAS']['borrar']=='t') { ?>
                                                                    <a onclick="borrar(<?php echo "'".$tra['tra_cod']."_".$tra['art_descri']."'";?>)" class="btn btn-danger btn-sm" role='button'
                                                                    data-title='Borrar' rel='tooltip' data-placement='top' data-toggle="modal" data-target="#borrar">
                                                                    <span class="glyphicon glyphicon-trash"></span>
                                                                    </a>     
                                                                    <?php }?>                                                                   
                                                                    <a href="transfer_print.php?vtra_cod=<?php echo $tra['tra_cod'];?>" class="btn btn-default btn-sm" role='button'
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
                                                No se han registrado transferencias...
                                            </div>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <?php }else{ ?>
                             <div>
                                 <div class="box-body">
                                     <div class="alert alert-info flat">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                   No posee permisos de lectura 
                                    </div>
                                </div>
                            </div>
                            <?php } ?> 
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
                  <!-- FIN MODAL BORRAR -->                   
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $("#mensaje").delay(4000).slideUp(200,function(){
                $(this).alert('close');
            });
        </script>
        <script>
             function borrar(datos){
            var dat = datos.split("_");
            $('#si').attr('href','transfer_control.php?vtra_cod='+dat[0]+'&vart_descri='+dat[1]+'&accion=3');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
            Desea borrrar la transferencia <strong>'+dat[1]+'</strong>?');
            }
        </script>        
    </body>
</html>


