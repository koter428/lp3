<?php 
require 'ver_session.php'; /*VERIFICAR SESSION*/
require 'clases/conexion.php';
@session_start();
$detalles = consultas::get_datos("select * from v_detalle_pedcompra where ped_com=".$_REQUEST['vped_com']
        ." and art_cod =".$_REQUEST['vart_cod']." and dep_cod =".$_REQUEST['vdep_cod']);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
    <h4 class="modal-title"><i class="fa fa-edit"></i> <strong>Editar Detalle Pedido</strong></h4>
</div>
<form action="pedcompra_dcontrol.php" method="post" accept-charset="utf-8" class="form-horizontal">
    <input type="hidden" name="accion" value="2">
    <input type="hidden" name="vped_com" value="<?php echo $detalles[0]['ped_com']?>">
    <input type="hidden" name="vdep_cod" value="<?php echo $detalles[0]['dep_cod']?>">
    <input type="hidden" name="vart_cod" value="<?php echo $detalles[0]['art_cod']."_".$detalles[0]['ped_precio']?>">
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label col-sm-2">Deposito:</label>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <input type="text" class="form-control" readonly="" value="<?php echo $detalles[0]['dep_descri']?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Articulo:</label>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <input type="text" class="form-control" readonly="" value="<?php echo $detalles[0]['art_descri']." ".$detalles[0]['mar_descri']?>"/>
            </div>
        </div> 
        <div class="form-group">
            <label class="control-label col-sm-2">Cantidad:</label>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <input type="number" name="vped_cant" class="form-control" required="" value="<?php echo $detalles[0]['ped_cant']?>" min="1"/>
            </div>
        </div> 
        <div class="form-group">
            <label class="control-label col-sm-2">Precio:</label>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <input type="number" name="vped_precio" class="form-control" required="" value="<?php echo $detalles[0]['ped_precio']?>" min="1"/>
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