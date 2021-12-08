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
    @session_start();/*Reanudar sesion*/
    require 'menu/css_lte.ctp'; ?>
    <!--ARCHIVOS CSS-->

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php require 'menu/header_lte.ctp'; ?>
        <!--CABECERA PRINCIPAL-->
        <?php require 'menu/toolbar_lte.ctp'; ?>
        <!--MENU PRINCIPAL-->
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
                        <?php if ($_SESSION['SUCURSAL']['leer']==='t') { ?>
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Sucursales</h3>
                                <div class="box-tools">
                                <?php if ($_SESSION['SUCURSAL']['insertar']==='t') { ?> 
                                    <a href="sucursal_add.php" class="btn btn-primary btn-sm pull-right" data-title='Agregar' rel='tooltip' data-placement='left'><i class="fa fa-plus"></i></a>
                                    <?php } ?> 
                                    <a href="sucursal_print.php" class="btn btn-default btn-sm" data-title="Imprimir" rel="tooltip" target="print">
                                            <i class="fa fa-print"></i>                                            
                                        </a>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <form action="sucursal_index.php" method="post" accept-charset="utf-8" class="form-horizontal">
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
                                        //consulta a la tabla sucursal
                                        $sucursales = consultas::get_datos("select * from sucursal where suc_descri ilike '%".(isset($_REQUEST['buscar'])?$_REQUEST['buscar']:"")."%'order by id_sucursal");
                                        //var_dump($sucursales);
                                        if (!empty($sucursales)) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-condensed table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Sucursal </th>
                                                            <th>Código</th>
                                                            <th class="text-center">Acciones </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($sucursales as $suc) { ?>
                                                            <tr>
                                                                <td data-title='Descripción'><?php echo $suc['suc_descri']; ?></td>
                                                                <td data-title='Código'><?php echo $suc['id_sucursal']; ?></td>
                                                                <td data-title='Acciones' class="text-center">
                                                                <?php if ($_SESSION['SUCURSAL']['editar']=='t') { ?>
                                                                    <a href="sucursal_edit.php?vid_sucursal=<?php echo $suc['id_sucursal']; ?>" class="btn btn-warning btn-sm" role='button' data-title='Editar' rel='tooltip' data-placement='left'>
                                                                        <span class="glyphicon glyphicon-edit"></span>
                                                                    </a>    <?php }?> 
                                                                    <?php if ($_SESSION['SUCURSAL']['borrar']=='t') { ?>
                                                                        <a onclick="borrar(<?php echo "'".$suc['id_sucursal']."_".$suc['suc_descri']."'";?>)" class="btn btn-danger btn-sm" role='button'
                                                                        data-title='Borrar' rel='tooltip' data-placement='top' data-toggle="modal" data-target="#borrar">
                                                                        <span class="glyphicon glyphicon-trash"></span></a>         
                                                                </td>    <?php }?> 
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>
                                            <div class="alert alert-info flat">
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                                No se han registrado sucursales...
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
            </div>
        </div>
        <?php require 'menu/footer_lte.ctp'; ?>
        <!--ARCHIVOS JS-->
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
    <?php require 'menu/js_lte.ctp'; ?>
    <!--ARCHIVOS JS-->
    <script>
            $("#mensaje").delay(4000).slideUp(200,function(){
                $(this).alert('close');
            })
        </script>
        <script>
        function borrar(datos){
            var dat = datos.split("_");
            $('#si').attr('href','sucursal_control.php?vid_sucursal='+dat[0]+'&vsuc_descri='+dat[1]+'&accion=3');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
            Desea borrrar el sucursal <strong>'+dat[1]+'</strong>?');
        }        
        </script>
</body>

</html>
