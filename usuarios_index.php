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
                            <div class="box box-primary">
                            <?php if ($_SESSION['USUARIOS']['leer']==='t') { ?>
                                <div class="box-header">
                                    <i class="fa fa-clipboard"></i>
                                    <h3 class="box-title">Usuarios</h3>
                                    <div class="box-tools">
                                        <a href="usuarios_print.php" class="btn btn-default btn-sm" data-title ="Imprimir" rel="tooltip" data-placement="top" target="print">
                                            <i class="fa fa-print"></i>
                                        </a>
                                        <?php if ($_SESSION['USUARIOS']['insertar']==='t') { ?> 
                                        <a onclick="add()" class="btn btn-primary btn-sm" data-title = "Agregar" rel="tooltip" 
                                           data-placement="top" data-toggle="modal" data-target="#mymodal"> 
                                            <i class="fa fa-plus"></i></a>   
                                            <?php } ?>                                      
                                    </div>
                                </div>
                                <!-- AQUI VA EL CONTENIDO DE LA TABLA-->
                                <div class="box-body">
                                <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <div class="alert alert-danger" role="alert" id="mensaje">
                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                                    <?php echo $_SESSION['mensaje'];
                                    $_SESSION['mensaje']=''; ?>
                                </div>
                                <?php }?>                                    
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <?php 
                                                $usuarios = consultas::get_datos("select * from v_usuarios order by car_cod");
                                                if (!empty($usuarios)) { ?>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <th>Empleado</th>
                                                                <th>Nick</th>
                                                                <th>Grupo</th>
                                                                <th>Sucursal</th>
                                                                <th>Código</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($usuarios as $usuario) { ?>
                                                            <tr>
                                                                <td data-title="Empleado"><?php echo $usuario['empleado']?></td>
                                                                <td data-title="Nick"><?php echo $usuario['usu_nick']?></td>
                                                                <td data-title="Grupo"><?php echo $usuario['gru_nombre']?></td>
                                                                <td data-title="Sucursal"><?php echo $usuario['suc_descri']?></td>
                                                                <td data-title="Código"><?php echo $usuario['usu_cod']?></td>
                                                                <td data-title="Acciones" class="text-center">
                                                                <?php if ($_SESSION['USUARIOS']['editar']=='t') { ?>
                                                                    <a onclick="editar(<?php echo "'".$usuario['car_cod']."_".$usuario['car_descri']."'"?>)" class="btn btn-warning btn-sm" role="button" data-title="Editar" 
                                                                       data-toggle="modal" data-target="#editar" rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-edit"></span></a>
                                                                        <?php }?>
                                                                        <?php if ($_SESSION['USUARIOS']['borrar']=='t') { ?>
                                                                    <a onclick="borrar(<?php echo "'".$usuario['car_cod']."_".$usuario['car_descri']."'"?>)" class="btn btn-danger btn-sm" role="button" data-title="Borrar" 
                                                                       rel="tooltip" data-placement="top" data-toggle='modal' data-target='#borrar'>
                                                                        <span class="glyphicon glyphicon-trash"></span></a>        
                                                                        <?php }?>                
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                               <?php }else{ ?>
                                            <div class="alert alert-info flat">
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                                No se han registrado cargos...
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
                  <?php require 'menu/footer_lte.ctp'; ?><!--PIE DE PAGINA-->  
                  <!-- FIN MODAL POR PAGINA-->  
                  <div class="modal fade" id="mymodal" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content" id="detalles">
                              
                          </div>
                      </div>                      
                  </div>                  
                  <!-- FIN MODAL POR PAGINA--> 
                  <!-- MODAL PARA EDITAR-->
                  <div class="modal fade" id="editar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="fa fa-remove"></i></button>
                                      <h4 class="modal-title"><i class="fa fa-edit"></i> Editar Cargos</h4>
                              </div>
                              <form action="usuarios_control.php" method="POST" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="2">
                                  <input type="hidden" name="vcar_cod" id="cod">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-lg-2 col-sm-2">Descripción</label>
                                          <div class="col-lg-10 col-sm-10">
                                              <input type="text" name="vcar_descri" class="form-control" required="" autofocus="" id="descri"/>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="reset" data-dismiss="modal" class="btn btn-default pull-left"><i class="fa fa-remove"></i> Cerrar</button>
                                      <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Actualizar</button>
                                  </div>
                              </form>
                          </div>
                      </div>                      
                  </div>
                  <!-- FIN MODAL PARA EDITAR-->  
                  <!-- MODAL PARA BORRAR-->
                  <div class="modal fade" id="borrar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="fa fa-remove"></i></button>
                                      <h4 class="modal-title custom_align" id="Heading">Atención!!!</h4>
                              </div>
                               <div class="modal-body">
                                   <div class="alert alert-danger" id="confirmacion"></div>
                                  </div>
                                  <div class="modal-footer">
                                      <button data-dismiss="modal" class="btn btn-default"><i class="fa fa-remove"></i> NO</button>
                                      <a id="si" role='buttom' class="btn btn-primary">
                                          <span class="glyphicon glyphicon-ok-sign"> SI</span>
                                      </a>
                                  </div>
                          </div>
                      </div>                      
                  </div>
                  <!-- FIN MODAL PARA BORRAR-->                   
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
            $('#mensaje').delay(4000).slideUp(200,function(){
               $(this).alert('close'); 
            });            
        </script>
        <script>
            $('.modal').on('shown.bs.modal',function(){
               $(this).find('input:text:visible:first').focus(); 
            });
        </script>    
        <script>
        function add(){
            $.ajax({
                type    : "GET",
                url     : "/lp3/usuarios_add.php",
                cache   : false,
                beforeSend:function(){
                    $("#detalles").html('<strong>Cargando...</strong>')
                },
                success:function(data){
                    $("#detalles").html(data)
                }
            })
        };            
            function editar(datos){
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#descri').val(dat[1]);
            };
            function borrar(datos){
                var dat = datos.split("_");
                $('#si').attr('href','cargo_control.php?vcar_cod='+dat[0]+'&vcar_descri='+dat[1]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea borrar el cargo <i><strong>'+dat[1]+'</strong></i>?');
            }
        </script>        
    </body>
</html>


