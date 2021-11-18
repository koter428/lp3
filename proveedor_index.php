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
        require 'ver_session.php'; /*VERIFICAR SESSION*/
        session_start(); /* Reanudar sesion */
        require 'menu/css_lte.ctp';
        ?><!--ARCHIVOS CSS-->

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require 'menu/header_lte.ctp'; ?><!--CABECERA PRINCIPAL-->
            <?php require 'menu/toolbar_lte.ctp'; ?><!--MENU PRINCIPAL-->
            <div class="content-wrapper">
                <!-- CONTENEDOR PRINCIPAL -->
                <div class="content">
                    <!-- FILA 1 --> 
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <div class="alert alert-danger" id="mensaje">
                                    <span class="glyphicon glyphicon-info-sign"></span> 
                                    <?php
                                    echo $_SESSION['mensaje'];
                                    $_SESSION['mensaje'] = '';
                                    ?>
                                </div>
                            <?php } ?>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Proveedores</h3>
                                     <div class="box-tools">
                                        <div class="box-tools">
                                            <a href="proveedor_add.php" class="btn btn-primary btn-sm" data-title="Agregar" rel="tooltip">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                            <a href="proveedor_print.php"class="btn btn-default btn-sm" data-title="Imprimir" rel="tooltip" target="print">
                                            <i class="fa fa-print"></i>  
                                        </a>                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form action="proveedor_index.php" method="post" accept-charset="utf-8" class="form-horizontal">
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
                                            //consulta a la tabla proveedor
                                            $proveedores = consultas::get_datos("select * from proveedor where prv_ruc ilike '%".(isset($_REQUEST['buscar'])?$_REQUEST['buscar']:"")."%'order by prv_cod");
                                            //var_dump($proveedores);
                                            if (!empty($proveedores)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table table-condensed table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Ruc </th>
                                                                <th>Razon Social </th>
                                                                <th>Direccion</th>
                                                                <th>Telefono </th> 
                                                                <th class="text-center">Acciones </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($proveedores as $prv) { ?>
                                                                <tr>
                                                                    <td data-title='Ruc'><?php echo $prv['prv_ruc']; ?></td>
                                                                    <td data-title='razonsocial'><?php echo $prv['prv_razonsocial']; ?></td>
                                                                    <td data-title='direccion'><?php echo $prv['prv_direccion']; ?></td>
                                                                    <td data-title='telefono'><?php echo $prv['prv_telefono']; ?></td>
                                                                    <td data-title='Acciones' class="text-center"><a href="proveedor_edit.php?vprv_cod=<?php echo $prv['prv_cod']; ?>" 
                                                                                                                     class="btn btn-warning btn-sm" 
                                                                                                                     role='button' data-title='Editar' rel='tooltip' data-placement='left'>
                                                                            <span class="glyphicon glyphicon-edit"></span></a>
                                                                        <a href="proveedor_del.php?vprv_cod=<?php echo $prv['prv_cod']; ?>" class="btn btn-danger btn-sm" role='button'
                                                                           data-title='Borrar' rel='tooltip' data-placement='left'>
                                                                            <span class="glyphicon glyphicon-trash"></span></a></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php } else { ?>
                                                <div class="alert alert-info flat">
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    No se han registrado proveedores...
                                                </div>
                                            <?php }
                                            ?>
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
            }
            )

        </script>
    </body>
</html>


