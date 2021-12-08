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
        require 'ver_session.php'; /*VERIFICAR SESSION*/
        @session_start();/*Reanudar sesion*/
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
                        <?php if (!empty($_SESSION['mensaje'])) { ?>
                            <div class="alert alert-danger" id="mensaje">
                                <span class="glyphicon glyphicon-info-sign"></span>
                                <?php echo $_SESSION['mensaje'];
                                $_SESSION['mensaje'] = '';
                                ?>
                            </div>
                            <?php } ?>               
                            <div class="box box-primary">
                            <?php if ($_SESSION['PAGINAS']['leer']==='t') { ?>
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Paginas</h3>                                    
                                    <div class="box-tools">
                                    <?php if ($_SESSION['PAGINAS']['insertar']==='t') { ?> 
                                        <a class="btn btn-primary btn-sm" data-title="Agregar" rel="tooltip" 
                                           data-toggle="modal" data-target="#registrar">
                                            <i class="fa fa-plus"></i>
                                        </a> <?php } ?> 
                                        <a href="paginas_print.php" class="btn btn-default btn-sm" data-title="Imprimir" rel="tooltip" target="print">
                                            <i class="fa fa-print"></i>
                                        </a>                                        
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form action="paginas_index.php" method="post" accept-charset="utf-8" class="form-horizontal">
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
                                            /*$valor = '';
                                            if (isset($_REQUEST['buscar'])) {
                                                $valor = $_REQUEST['buscar'];
                                            }*/
                                            
                                            // $paginas = consultas::get_datos("select * from paginas where pag_nombre ilike '%".(isset($_REQUEST['buscar'])?$_REQUEST['buscar']:"")."%'order by pag_cod"); 
                                            $sql= "select p.pag_nombre, p.pag_direc, m.mod_nombre, p.pag_cod from paginas p, modulos m where p.mod_cod = m.mod_cod and p.pag_nombre ilike '%" . (isset($_REQUEST['buscar'])?$_REQUEST['buscar']:"") . "%' order by p.pag_nombre";
                                            $paginas = consultas::get_datos($sql);
                                            if (!empty($paginas)) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-condensed table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Ubicación</th>
                                                            <th>Módulo</th>
                                                            <th>Código</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($paginas as $pag) { ?>
                                                        <tr>
                                                            <td data-title="Nombre"><?php echo $pag['pag_nombre'];?></td>
                                                            <td data-title="direccion"><?php echo $pag['pag_direc'];?></td>
                                                            <td data-title="modulo"><?php echo $pag['mod_nombre'];?></td>
                                                            <td data-title="codigo"><?php echo $pag['pag_cod'];?></td>
                                                            <td data-title="Acciones" class="text-center">
                                                            <?php if ($_SESSION['PAGINAS']['editar']=='t') { ?>
                                                                <a href="paginas_edit.php?vpag_cod=<?php echo $pag['pag_cod'];?>" class="btn btn-warning btn-sm" role="button"
                                                                    data-title="Editar" >
                                                                    <i class="fa fa-edit"></i>
                                                                </a> <?php }?> 
                                                                <?php if ($_SESSION['PAGINAS']['borrar']=='t') { ?>
                                                                <a onclick="borrar(<?php echo "'".$pag['pag_cod']."_".$pag['pag_nombre']."'";?>)" class="btn btn-danger btn-sm" role="buttom" 
                                                                   data-title="Borrar" rel="tooltip" data-toggle="modal" data-target="#borrar">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>   <?php }?>                                                               
                                                            </td>
                                                        </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php }else{ ?>
                                            <div class="alert alert-info flat">
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                                No se han registrado páginas...
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
                  <!-- MODAL REGISTRAR -->
                  <div class="modal fade" id="registrar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                  <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registrar Paginas</strong></h4>
                              </div>
                              <form action="paginas_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="1">
                                  <input type="hidden" name="vpag_cod" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-sm-2">Nombre:</label>
                                          <div class="col-sm-10">
                                              <input type="text" name="vpag_nombre" class="form-control" required="" autofocus=""/>
                                          </div> 
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-sm-2">Dirección:</label>
                                          <div class="col-sm-10">
                                              <input type="text" name="vpag_direc" class="form-control" required="" />
                                          </div>
                                      </div>
                                      <!-- AGREGAR LISTA DESPLEGABLE MODULO -->
                                      <div class="form-group">
                                            <label class="control-label col-lg-2">Modulo:</label>
                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                <div class="input-group" method="post">
                                                    <?php $modulos = consultas::get_datos("select * from modulos order by mod_nombre");?>
                                                    <select class="form-control select2" name="vmod_cod" required="">
                                                        <option value="">Seleccione un módulo</option>
                                                        <?php foreach ($modulos as $modulo) { ?>
                                                          <option value="<?php echo $modulo['mod_cod'];?>"><?php echo $modulo['mod_nombre'];?></option>   
                                                        <?php }?>
                                                    </select>  
                                                    <span class="input-group-btn btn-flat">
                                                           data-toggle="modal" data-target="#registrar2">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FIN LISTA DESPLEGABLE MODULOS -->      
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
                  <!-- FIN MODAL REGISTRAR -->
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
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $("#mensaje").delay(4000).slideUp(200,function(){
                $(this).alert('close');
            });
            $(".modal").on('shown.bs.modal',function(){
                $(this).find('input:text:visible:first').focus();
            });
        </script>          
        <script>
            function editar(datos){
                var dat = datos.split("_");
                $("#cod").val(dat[0]);
                $("#nombre").val(dat[1]);
                $("#direccion").val(dat[2]);
                $("#mod                                                                                                                                                                 ulo").val(dat[3]);
            };
            function borrar(datos){
                var dat = datos.split("_");
                $('#si').attr('href','paginas_control.php?vpag_cod='+dat[0]+'&vpag_nombre='+dat[1]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
                Desea borrrar la pagina <strong>'+dat[1]+'</strong>?');
            }
        </script>
    </body>
</html>


