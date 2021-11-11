<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/Lp3/img/avatar_1.png">
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php if (!empty($_SESSION['mensaje'])) { ?>
                            <div class="alert alert-danger" role="alert" id="mensaje">
                                <i class="fa fa-info"></i>
                                <?php echo $_SESSION['mensaje'];?>
                            </div>
                             <?php } ?>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-android-person"></i>
                                    <h3 class="box-title">Usuarios</h3>
                                    <div class="box-tools">
                                        <a href="usuarios_add.php" class="btn btn-primary btn-sm" data-title="Agregar" rel="tooltip">
                                            <i class="fa fa-plus"></i>
                                            <a href="usuarios_print.php" class="btn btn-default btn-sm" data-title="Imprimir" rel="tooltip" target="print">
                                            <i class="fa fa-print"></i>                                            
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form action="usuarios_index.php" method="post" accept-charset="utf-8" class="form-horizontal">
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
                                            <?php $usuarios = consultas::get_datos("select * from usuarios where usu_nick ilike '%".(isset($_REQUEST['buscar'])?$_REQUEST['buscar']:"")."%'order by  usu_cod");
                                                if (!empty($usuarios)) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed dt-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th>Usuarios</th>
                                                            <th>empleado</th>
                                                            <th>Grupo</th>
                                                            <th>Sucursal</th>
                                                            <th class="text-center">Acciones</th>
                                                         </tr>
                                                    </thead>
                                                    <tbody>
                                                     <?php foreach ($usuarios as $usu){ ?>
                                                        <tr>
                                                            <td data-title="Usuarios"><?php echo $usu['usu_nick'];?></td>
                                                             <td data-title="empleado"><?php echo $usu['emp_cod'];?></td> 
                                                             <td data-title="Grupo"><?php echo $usu['gru_cod'];?></td>
                                                             <td data-title="Sucursal"><?php echo $usu['id_sucursal'];?></td>
                                                             <td data-title="Acciones" class="text-center">
                                                                 <a href="usuarios_edit.php?vcli_cod=<?php echo $usu['usu_cod'];?>" class="btn btn-warning btn-sm" role="button"
                                                                    data-title="Editar" >
                                                                 <i class="fa fa-edit"></i>
                                                                 </a>
                                                                 <a href="usuarios_del.php?vcli_cod=<?php echo $usu['usu_cod'];?>" class="btn btn-danger btn-sm" role="button"
                                                                    data-title="Borrar" >
                                                                 <i class="fa fa-trash"></i>
                                                                 </a>
                                                             </td>
                                                        </tr>
                                                        <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>  
                                          <?php }else{ ?>
                                            <div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                                  No se han Registrado aún clientes...

                                            </div>
                                           <?php } ?>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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


