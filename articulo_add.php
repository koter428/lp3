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
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="fa fa-plus"></i>
                                <h3 class="box-title">Agregar Articulo</h3>
                                <div class="box-tools">
                                    <a href="articulo_index.php" class="btn btn-primary btn-sm" data-title="Volver" rel="tooltip">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="articulo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="box-body">
                                    <?php
                                    $marcas = consultas::get_datos("SELECT * FROM marca ORDER BY mar_cod;");
                                    $impuestos = consultas::get_datos("SELECT * FROM tipo_impuesto ORDER BY tipo_cod;");
                                    ?>
                                    <div class="form-group">
                                        <input type="hidden" name="accion" value="1" />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Descripcion:</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="vart_descri" class="form-control" required="" value="" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Marca:</label>
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <select name="vmar_cod" class="custom-select" id="inputGroupSelect04">
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
                                                <select name="vtipo_cod" class="custom-select" id="inputGroupSelect04">
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
                                            <input type="text" name="vart_codbarra" class="form-control" required="" value="" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Precio Compra:</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="vart_precioc" class="form-control" required="" value="" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Precio Venta:</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="vart_preciov" class="form-control" required="" value="" />
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default" data-title="Cancelar">
                                <i class="fa fa-remove"></i> Cancelar</button>
                            <button type="submit" class="btn btn-primary pull-right" data-title="Guardar">
                                <i class="fa fa-floppy-o"></i>Registrar</button>
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
