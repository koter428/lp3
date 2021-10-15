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
        <link rel="shortcut icon" type="image/x-icon" href="/lp3/img/avatar.png">
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
                            <?php if(!empty($_SESSION['mensaje'])){ ?>
                            <div class="alert alert-danger" role="alert" id="mensaje">
                                <i class="fa fa-info"></i>
                                <?php echo $_SESSION['mensaje'];?>
                            </div>
                            <?php } ?>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-android-person"></i>
                                        <h3 class="box-title">Clientes</h3>
                                        <div class="box-tools">
                                            <a href="cliente_add.php" class="btn btn-primary pull-right btn-sm" data-title="Agregar" >
                                            <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <?php $Clientes= consultas::get_datos("select * from clientes order by cli_cod");
                                            if(!empty($Clientes)){?>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed dt-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th>C.I Nº</th>
                                                            <th>Nombres y Apellidos</th>
                                                            <th>Teléfono</th>
                                                            <th>Dirección</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($Clientes as $cliente){ ?>
                                                        <tr>
                                                            <td data-title="C.I Nº"><?php echo $cliente['cli_ci'];?></td>
                                                            <td data-title="Nombres y Apellidos"><?php echo $cliente['cli_nombre']."" .$cliente['cli_apellido'];?></td>
                                                             <td data-title="Telefono"><?php echo $cliente['cli_telefono'];?></td> 
                                                             <td data-title="Dirección"><?php echo $cliente['cli_direcc'];?></td>
                                                             <td data-title="Acciones" class="text-center">
                                                                 <a href="cliente_edit.php?vcli_cod=<?php echo $cliente['cli_cod'];?>" class="btn btn-warning btn-sm" role="button"
                                                                    data-title="Editar" >
                                                                 <i class="fa fa-edit"></i>
                                                                 </a>
                                                                 <a href="cliente_del.php?vcli_cod=<?php echo $cliente['cli_cod'];?>" class="btn btn-danger btn-sm" role="button"
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
