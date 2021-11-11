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
        session_start(); /* Reanudar sesion */
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
                            <div class="box box-warning">
                                <div class="box-header">
                                   <i class="fa fa-file"></i>
                                    <h3 class="box-title">Perfil</h3>
                                    <div class="box-tools">
                                        <a href="menu.php" class="btn btn-primary btn-sm" data-title="Volver" rel="tooltip">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div> 
                                <form action="perfil_comando.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="box-body"> 
                                        <?php $usu = consultas::get_datos("select * from v_usuarios where usu_cod =" . $_SESSION['usu_cod']); ?>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <input type="hidden" name="accion" value="2"/>
                                                <input type="hidden" name="vusu_cod" value="<?php echo $usu[0]['usu_cod'] ?>"/>
                                                <label class="control-label col-lg-2 col-md-2 col-sm-1"> Nombre:</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <input type="text" name="vusu_nick" class="form-control" required="" disabled="" 
                                                           value="<?php echo $usu[0]['usu_nick'] ?>"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2">Contraseña:</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <input type="password" name="vclave" class="form-control" value="<?php echo $usu[0]['usu_clave']; ?>"required="" disabled=""/>                                                
                                                </div>
                                            </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Codigo Empleado:</label>
                                            <div class="ol-lg-6 col-md-6 col-sm-6">
                                                <input type="text" name="vcod_emp" class="form-control" value="<?php echo $usu[0]['car_descri']; ?>"required="" disabled=""/>                                                
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Tipo De Usuario:</label>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <input type="text" name="vgru_cod" class="form-control" value="<?php echo $usu[0]['gru_nombre']; ?>"required="" disabled=""/>                                                
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Sucursal:</label>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <input type="text" name="vid_sucursal" class="form-control" value="<?php echo $usu[0]['suc_descri']; ?>"required=""disabled=""/>                                                
                                        </div>
                                    </div>
                            </div>
                        </div> 
                     </div>  
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
</div>                  
<?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
</body>
</html>


