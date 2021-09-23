<?php

echo "HOLA MUNDO";
?>
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
        require 'menu/css_lte.ctp'; ?><!--ARCHIVOS CSS-->

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require 'menu/header_lte.ctp'; ?><!--CABECERA PRINCIPAL-->
            <?php require 'menu/toolbar_lte.ctp';?><!--MENU PRINCIPAL-->
            <div class="content-wrapper">
                 <!-- CONTENEDOR PRINCIPAL-->
                <div class="content">
                    <!-- FILA 1-->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                     <h3 class="box-title">Marcas</h3>
                                     <div class="box-tools">
                                         <a href="#" class="btn btn-primary btn-sm pull-right" data-title='Agregar' 
                                           rel='tooltip' data-placement='left'><i class="fa fa-plus"></i></a>
                                </div>
                            </div>      
                          <div class="box-body no-padding">
                            <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                   <?php 
                                            //Consulta la tabla Marca
                                        $marcas= consultas::get_datos("select * from marca order by mar_cod");
                                        //var_dump ($marcas);
                                        if (!empty ($marcas)) { ?>
                                   <div class="table responsive">
                                       <table class="table table-bordered table-condensed table-striped table-hover">
                                           <thead>
                                               <tr>
                                                   <th>Marcas</th>
                                                   <th class="text-center">Acciones</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <?php 
                                                foreach ($marcas as $mar) { ?>
                                               <tr>
                                                   <td data-title='Descripcion'> <?php echo $mar['mar_descri'];?></td>
                                                   <td data-title='Acciones' class="text-center">
                                                       <a href="#" class="btn btn-warning btn-sm" role='button'
                                                                   data-title='Editar' rel='tooltip' data-placement='left'>
                                                                    <span class="glyphicon glyphicon-edit"></span> 
                                                                </a>
                                                                <a href="#" class="btn btn-danger btn-sm" role='button'
                                                                   data-title='Borrar' rel='tooltip' data-placement='left'>
                                                                    <span class="glyphicon glyphicon-trash"></span> 
                                                                </a>
                                                   </td>
                                               </tr>
                                                <?php } ?>
                                               ?>
                                           </tbody>
                                       </table>
                                       
                                   </div>  
                                       <?php }else{ ?>
                                   <div class="alert alert-info flat">
                                       <span class="glyphicon glyphicon-info-sign"></span>
                                       NO SE HAN REGISTRADO MARCAS ...
                                   </div> 
                                        <?php }
                                          ?>                         
                        </div>
                    </div>
             <!--FIN FILA 1-->
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
         </div> 
      </div>
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
    </body>
</html>

