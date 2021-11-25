    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/Lp3/img/avatar_1.png">
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
                                    <h3 class="box-title">Empleados</h3>
                                    <div class="box-tools">
                                        <a href="empleado_add.php" class="btn btn-primary btn-sm" data-title="Agregar" rel="tooltip">
                                            <i class="fa fa-plus"></i>
                                            <a href="empleado_print.php" class="btn btn-default btn-sm" data-title="Imprimir" rel="tooltip" target="print">
                                            <i class="fa fa-print"></i>                                            
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form action="empleado_index.php" method="post" accept-charset="utf-8" class="form-horizontal">
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
                                            <?php $empleado = consultas::get_datos("select * from empleado where emp_nombre ilike '%".(isset($_REQUEST['buscar'])?$_REQUEST['buscar']:"")."%'order by emp_apellido");
                                                if (!empty($empleado)) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed dt-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th>Cargo</th>
                                                            <th>Nombres y Apellidos</th>
                                                            <th>Teléfono</th>
                                                            <th>Dirección</th>
                                                            <th>Código</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                     <?php foreach ($empleado as $emp){ ?>
                                                        <tr>
                                                            <td data-title="cargo"><?php echo $emp['car_cod'];?></td>
                                                            <td data-title="Nombres y Apellidos"><?php echo $emp['emp_nombre'].", " .$emp['emp_apellido'];?></td>
                                                             <td data-title="Telefono"><?php echo $emp['emp_tel'];?></td> 
                                                             <td data-title="Dirección"><?php echo $emp['emp_direcc'];?></td>
                                                             <td data-title="Código"><?php echo $emp['emp_cod'];?></td>
                                                             <td data-title="Acciones" class="text-center">
                                                                 <a href="empleado_edit.php?vemp_cod=<?php echo $emp['emp_cod'];?>" class="btn btn-warning btn-sm" role="button"
                                                                    data-title="Editar" >
                                                                 <i class="fa fa-edit"></i>
                                                                 </a>
                                                                 <a href="empleado_del.php?vemp_cod=<?php echo $emp['emp_cod'];?>" class="btn btn-danger btn-sm" role="button"
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
                                                  No se han Registrado aún Empleados...

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
                </div>
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $("#mensaje").delay(4000).slideUp(200,function(){
                $(this).alert('close');
            })
        </script>
    </body>
</html>


