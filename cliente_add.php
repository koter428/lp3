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
        session_start();/*Reanudar sesion*/
        require 'menu/css_lte.ctp'; ?><!--ARCHIVOS CSS-->

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
         <?php require 'menu/header_lte.ctp'; ?><!--CABECERA PRINCIPAL-->
           <?php require 'menu/toolbar_lte.ctp';?><!--MENU PRINCIPAL-->
           <div class="content-wrapper">
             <!-- CONTENEDOR PRINCIPAL -->
              <div class="content">
              <!<!-- FILA -->    
                 <div class="row">
                  <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box box-primary">
                 <div class="box-header">
                     <i class="ion ion-android-add"></i>
                     <h3 class="box-title">Agregar Clientes</h3>
                     <div class="box-tools">
                         <a href="cliente_index.php" class="btn btn-primary pull-right btn-sm" data-title="Volver">
                         <i class="fa fa-arrow-left"></i></a>
                     </div>
                 </div> <!<!-- /.box-header -->
                 <form action="cliente_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                     <div class="box-body">
                         <input type="hidden"  name="vcli_cod" value="0"/>
                         <input type="hidden"  name="accion" value="1"/>
                         <div class="form-group">
                            
                             <label class="col-lg-2 control-label">C.I Nº</label>
                             <div class="col-lg-4">
                                  <input type="number" name="vcli_ci" class="form-control" required="" autofocus="" min="1" placeholder="Ingrese el CI del cliente"/>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-lg-2 control-label">Nombres</label>
                             <div class="col-lg-6">
                                 <input type="text" name="vcli_nombre" class="form-control" required="" placeholder="Ingrese el nombre del cliente"/>
                             </div>
                         </div>
                         <div class="form-group">
                            
                             <label class="col-lg-2 control-label">Apellidos</label>
                             <div class="col-lg-6">
                                 <input type="text" name="vcli_apellido" class="form-control" required="" placeholder="Ingrese el Apellido del cliente"/>
                             </div>
                         </div>
                         <div class="form-group">
                            
                             <label class="col-lg-2 control-label">Telefono</label>
                             <div class="col-lg-4">
                                 <input type="tel" name="vcli_telefono" class="form-control" placeholder="Ingrese el teléfono del cliente"/>
                             </div>
                         </div>
                         <div class="form-group">
                            
                             <label class="col-lg-2 control-label">Dirección</label>
                             <div class="col-lg-6">
                                 <textarea class="form-control" name="vcli_direcc" placeholder="Ingrese la Dirección del cliente"></textarea>
                                
                             </div>
                         </div>
                     </div>
                     <div class="box-footer">
                         <button type="reset" class="btn btn-default " data-title="Cancelar" >
                             <i class="fa fa-remove"></i> Cancelar</button>
                         <button type="submit" class="btn btn-primary pull-right" data-title="Guardar" >
                             <i class="fa fa-floppy-o"></i> Registrar</button>
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
