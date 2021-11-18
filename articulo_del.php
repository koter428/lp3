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
                        <div class="box box-danger">
                            <div class="box-header">
                                <i class="fa fa-trash"></i>
                                <h3 class="box-title">Borrar Articulo</h3>
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
                                    $marcas = consultas::get_datos("SELECT * FROM marca ORDER BY CASE WHEN mar_cod='" . $resultado[0]["mar_cod"] . "' THEN 1 ELSE 2 END, mar_cod;");
                                    $impuestos = consultas::get_datos("SELECT * FROM tipo_impuesto ORDER BY CASE WHEN tipo_cod='" . $resultado[0]["tipo_cod"] . "' THEN 1 ELSE 2 END, tipo_cod;");
                                    ?>
                                    <div class="form-group">
                                        <input type="hidden" name="accion" value="3" />
                                        <input type="hidden" name="vart_cod" value="<?php echo $resultado[0]['art_cod'] ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Descripcion:</label>
                                        <div class="col-lg-6">
                                            <input type="text" disabled name="vart_descri" class="form-control" required="" value="<?php echo $resultado[0]['art_descri'] ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Marca:</label>
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <select name="vmar_cod" disabled class="custom-select" id="inputGroupSelect04">
                                                    <?php foreach ($marcas as $marca) { ?>
                                                        <option value="<?php echo $marca["mar_cod"] ?>"><?php echo $marca["mar_descri"] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Impuesto:</label>
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <select name="vtipo_cod" disabled class="custom-select" id="inputGroupSelect04">
                                                    <?php foreach ($impuestos as $impuesto) { ?>
                                                        <option value="<?php echo $impuesto["tipo_cod"] ?>"><?php echo $impuesto["tipo_descri"] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Codigo Barras:</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="vart_codbarra" disabled class="form-control" required="" value="<?php echo $resultado[0]['art_codbarra'] ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Precio Compra:</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="vart_precioc" disabled class="form-control" required="" value="<?php echo $resultado[0]['art_precioc'] ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Precio Venta:</label>
                                        <div class="col-lg-6">
                                            <input type="text" disabled name="vart_preciov" class="form-control" required="" value="<?php echo $resultado[0]['art_preciov'] ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" class="btn btn-default" data-title="Cancelar">
                                        <i class="fa fa-remove"></i> Cancelar</button>
                                    <button type="submit" class="btn btn-danger pull-right" data-title="Guardar">
                                        <i class="fa fa-trash"></i> Borrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'menu/footer_lte.ctp'; ?>
        <!--ARCHIVOS JS-->
    </div>
    <?php require 'menu/js_lte.ctp'; ?>
    <!--ARCHIVOS JS-->
</body>

</html>
