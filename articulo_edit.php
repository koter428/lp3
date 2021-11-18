<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
    session_start();/*Reanudar sesion*/
    require 'menu/css_lte.ctp'; ?>
    <!--ARCHIVOS CSS-->

</head>
<?php // print_r($_GET); return; ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php require 'menu/header_lte.ctp'; ?>
        <!--CABECERA PRINCIPAL-->
        <?php require 'menu/toolbar_lte.ctp'; ?>
        <!--MENU PRINCIPAL-->
        <div class="content-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="box box-warning">
                            <div class="box-header">
                                <i class="fa fa-edit"></i>
                                <h3 class="box-title">Editar Articulo</h3>
                                <div class="box-tools">
                                    <a href="articulo_index.php" class="btn btn-primary btn-sm" data-title="Volver">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="articulo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="box-body">
                                    <?php
                                        $resultado = consultas::get_datos("select * from articulo where art_cod='" . $_GET['vart_cod'] . "'");
                                        $sql = "SELECT * FROM marca ORDER BY CASE WHEN mar_cod='" . $resultado[0]["mar_cod"] . "' THEN 1 ELSE 2 END, mar_cod;";
                                        $marcas = consultas::get_datos($sql);
                                        $sql = "SELECT * FROM tipo_impuesto ORDER BY CASE WHEN tipo_cod='" . $resultado[0]["tipo_cod"] . "' THEN 1 ELSE 2 END, tipo_cod;";
                                        $impuestos = consultas::get_datos($sql);
                                    ?>
                                    <div class="form-group">
                                        <input type="hidden" name="accion" value="2" />
                                        <input type="hidden" name="vart_cod" value="<?php echo $resultado[0]['art_cod'] ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Descripcion:</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="vart_descri" class="form-control" required="" value="<?php echo $resultado[0]['art_descri'] ?>" maxlength="15" />
                                        </div>
                                    </div>
                                    <!-- AGREGAR LISTA DESPLEGABLE MARCA -->
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Marca:</label>
                                        <div class="col-lg-5">
                                              <div class="input-group">
                                                    <?php $marcas = consultas::get_datos("select * from marca order by mar_descri");?>
                                                    <select class="form-control select2" name="vmar_cod" required="">
                                                        <option value="">Seleccione una marca</option>
                                                        <?php foreach ($marcas as $marca) { ?>
                                                          <option value="<?php echo $marca['mar_cod'];?>"><?php echo $marca['mar_descri'];?></option>   
                                                        <?php }?>
                                                    </select>  
                                                    <span class="input-group-btn btn-flat">
                                                        <a class="btn btn-primary" data-title ="Agregar Marca " rel="tooltip" data-placement="top"
                                                           data-toggle="modal" data-target="#registrar">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                        </div>
                                    </div>
                                    <!-- FIN LISTA DESPLEGABLE MARCA -->
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Cod. Barra:</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="vart_codbarra" class="form-control" required="" value="<?php echo $resultado[0]['art_codbarra'] ?>" 
                                            maxlength="15"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-sm-2">Precio Compra:</label>
                                       <div class="col-lg-4 col-md-4 col-sm-4">
                                            <input type="number" name="vart_precioc" class="form-control" required="" value="<?php echo $resultado[0]['art_precioc'] ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Precio Venta:</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <input type="number" name="vart_preciov" class="form-control" required="" value="<?php echo $resultado[0]['art_preciov'] ?>" />
                                        </div>
                                    </div>
                                     <!-- AGREGAR LISTA DESPLEGABLE IMPUESTO -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Impuesto:</label>
                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                <div class="input-group" method="post">
                                                    <?php $tipos = consultas::get_datos("select * from tipo_impuesto order by tipo_cod");?>
                                                    <select class="form-control select2" name="vtipo_cod" required="">
                                                        <option value="">Seleccione un impuesto</option>
                                                        <?php foreach ($tipos as $tipo) { ?>
                                                          <option value="<?php echo $tipo['tipo_cod'];?>"><?php echo $tipo['tipo_descri'];?></option>   
                                                        <?php }?>
                                                    </select>  
                                                    <span class="input-group-btn btn-flat">
                                                        <a class="btn btn-primary" data-title ="Agregar Impuesto " rel="tooltip" data-placement="top"
                                                           data-toggle="modal" data-target="#registrar2">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FIN LISTA DESPLEGABLE IMPUESTO --> 
                                </div>

                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default" data-title="Cancelar">
                                <i class="fa fa-remove"></i> Cancelar</button>
                            <button type="submit" class="btn btn-warning pull-right" data-title="Guardar">
                                <i class="fa fa-edit"></i> Actualizar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'menu/footer_lte.ctp'; ?>
     <!-- MODAL REGISTRAR MARCA -->
                  <div class="modal fade" id="registrar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                  <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registrar Marca</strong></h4>
                              </div>
                              <form action="marca_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="4">
                                  <input type="hidden" name="vmar_cod" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-sm-3">Agregar una Marca:</label>
                                          <div class="col-sm-9">
                                              <input type="text" name="vmar_descri" class="form-control" required="" autofocus=""/>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                          <i class="fa fa-remove"></i> Cerrar</button>
                                          <button type="submit" class="btn btn-primary pull-right">
                                          <i class="fa fa-floppy-o"></i> Registrar</button>                                          
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <!-- FIN MODAL REGISTRAR MARCA -->
                   <!-- MODAL REGISTRAR IMPUESTO -->
                  <div class="modal fade" id="registrar2" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                  <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registra Impuesto</strong></h4>
                              </div>
                              <form action="impuesto_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="4">
                                  <input type="hidden" name="vtipo_cod" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-sm-3">Agregar un Impuesto:</label>
                                          <div class="col-sm-9">
                                              <input type="text" name="vtipo_descri" class="form-control" required="" autofocus=""/>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                          <i class="fa fa-remove"></i> Cerrar</button>
                                          <button type="submit" class="btn btn-primary pull-right">
                                          <i class="fa fa-floppy-o"></i> Registrar</button>                                          
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <!-- FIN MODAL REGISTRAR IMPUESTO --> 
    <!--ARCHIVOS JS-->
    </div>
    <?php require 'menu/js_lte.ctp'; ?>
    <!--ARCHIVOS JS-->
</body>

</html>
