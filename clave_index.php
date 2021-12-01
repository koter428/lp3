<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/lp3/favicon.ico">
        <title>Perfil</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        require 'ver_session.php'; /*VERIFICAR SESSION*/
        @session_start(); /* Reanudar sesion */
        require 'menu/css_lte.ctp';
        ?><!--ARCHIVOS CSS-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require 'menu/header_lte.ctp'; ?><!--CABECERA PRINCIPAL--> 
            <?php require 'menu/toolbar_lte.ctp'; ?><!--MENU PRINCIPAL-->
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <?php
                            if (!empty($_SESSION['mensaje'])) {
                                $classType = "alert-danger";
                                ?>
                                <div class="<?php echo $classType ?> alert " id="mensaje">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                    <?php
                                    echo $_SESSION['mensaje'];
                                    $_SESSION['mensaje'] = '';
                                    ?>
                                </div>
                              <?php } ?>
                            <div class="box box-warning">
                            <?php if ($_SESSION['CAMBIAR CLAVE']['leer']==='t') { ?>
                                <div class="box-header">
                                    <i class="fa fa-key"></i>
                                    <h3 class="box-title">Modificar la Clave</h3>
                                    <div class="box-tools">
                                        <a href="menu.php" class="btn btn-primary btn-sm" data-title="Volver" rel="tooltip">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div> 
                                <form action="clave_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body"> 
                                        <?php $usu = consultas::get_datos("select * from usuarios where usu_cod =" . $_SESSION['usu_cod']); ?>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <input type="hidden" name="accion" value="2"/>
                                                <input type="hidden" name="vusu_cod" value="<?php echo $usu[0]['usu_cod'] ?>"/>
                                                <label class="control-label col-lg-2 col-md-2 col-sm-1">Clave Actual:</label>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <input type="password" name="vusu_clave_0" class="form-control" required="" placeholder="Ingrese La Clave Actual"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2">Clave Nueva:</label>
                                               <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <input type="password" name="vusu_clave_1" class="form-control" required="" placeholder="Ingrese La Nueva Clave"/>                                                
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2">Repetir clave nueva:</label>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <input type="password" name="vusu_clave_2" class="form-control" required="" placeholder="Ingrese Nuevamente La Clave Nueva"/>                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="box-footer">
                                        <button type="reset" class="btn btn-default" data-title="Cancelar" > 
                                            <i class="fa fa-remove"></i> Cancelar</button>                                        
                                        <button type="submit" class="btn btn-warning pull-right" data-title="Guardar" > 
                                            <i class="fa fa-edit"></i> Actualizar</button>
                                    </div>
                            </div>  
                        </div>
                        </form>
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
    <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
</div>                  
<?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
<script>
            $("#mensaje").delay(4000).slideUp(200, function () {
                $(this).alert('close');
            })
        </script>
</body>
</html>


