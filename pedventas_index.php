<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/lp3/img/user.png">
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
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Pedidos Ventas</h3>
                                    <div class="box-tools">
                                        <a href="pedventas_add.php" class="btn btn-primary btn-sm pull-right" data-title='Agregar' rel='tooltip' data-placement='top'><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form action="pedventas_index.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                                  <div class="box-body">
                                                    <div class="form-group">
                                                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                      <div class="input-group custom-search-form">
                                                        <input type="search" class="form-control" name="buscar" 
                                                           placeholder="Ingrese el valor a buscar..." autofocus=""/>
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
                                            //consulta a la tabla marca
                                            $pedidos = consultas::get_datos("select * from v_pedido_cabventa where ped_Cod::varchar ilike '%".(isset($_REQUEST['buscar'])?$_REQUEST['buscar']:"")."%' and ped_cod!='0' order by ped_cod");
                                            //var_dump($pedidos);
                                            if (!empty($pedidos)) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-condensed table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>N° Pedido</th>
                                                            <th>Fecha</th>
                                                            <th>cliente</th>
                                                            <th>total</th>
                                                            <th>Estado</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    <tbody>
                                                        <?php foreach ($pedidos as $ped) { ?>
                                                        <tr>
                                                            <td data-title='N° Pedido'><?php echo $ped['ped_cod'];?></td>
                                                            <td data-title='Fecha'><?php echo $ped['ped_fecha'];?></td>
                                                            <td data-title='Clientes'><?php echo $ped['cliente'];?></td>
                                                            <td data-title='total'><?php echo $ped['ped_total'];?></td>
                                                            <td data-title='Estado'><?php echo $ped['ped_fecha'];?></td> 
                                                            <td data-title='Acciones' class="text-center">
                                                                <a href="marca_edit.php?vmar_cod=<?php echo $ped['ped_cod'];?>" class="btn btn-warning btn-sm" role='button'
                                                                   data-title='Editar' rel='tooltip' data-placement='top'>
                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                </a>
                                                                <a href="marca_del.php?vmar_cod=<?php echo $ped['ped_cod'];?>" class="btn btn-danger btn-sm" role='button'
                                                                   data-title='Borrar' rel='tooltip' data-placement='top'>
                                                                    <span class="glyphicon glyphicon-trash"></span>
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
                                                No se han registrado Pedidos Ventas...
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
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $("#mensaje").delay(4000).slideUp(200,function(){
                $(this).alert('close');
            })
        </script>
    </body>
</html>


