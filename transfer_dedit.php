<?php 
require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';
    @session_start();
    $detalles = consultas::get_datos("select * from v_detalle_transfer where aju_cod=".$_REQUEST['vtra_cod']
        ." and art_cod =".$_REQUEST['vart_cod']." and dep_cod =".$_REQUEST['vdep_cod']);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
    <h4 class="modal-title"><i class="fa fa-edit"></i> <strong>Editar Detalle De Ajuste</strong></h4>
</div>
<form action="transfer_dcontrol.php" method="post" accept-charset="utf-8" class="form-horizontal">
    <input type="hidden" name="accion" value="2">
    <input type="hidden" name="vtra_cod" value="<?php echo $detalles[0]['tra_cod']?>">
    <input type="hidden" name="vdep_cod" value="<?php echo $detalles[0]['dep_cod']?>">
    <input type="hidden" name="vart_cod" value="<?php echo $detalles[0]['art_cod']?>">
    <input type="hidden" name="vart_cod" value="<?php echo $detalles[0]['mot_cod']?>">
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label col-sm-2">Depósito:</label>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <input type="text" class="form-control" readonly="" value="<?php echo $detalles[0]['dep_descri']?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Articulo:</label>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <input type="text" class="form-control" readonly="" value="<?php echo $detalles[0]['art_descri']?>"/>
            </div>
        </div> 
        <div class="form-group">
            <label class="control-label col-sm-2">Cantidad:</label>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <input type="number" name="vaju_cant" class="form-control" required="" value="<?php echo $detalles[0]['tra_cant']?>" min="1"/>
            </div>
        </div> 
        <div class="form-group">
            <label class="control-label col-sm-2">Precio:</label>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <input type="number" name="vaju_precio" class="form-control" required="" value="<?php echo $detalles[0]['tra_precio']?>" min="1"/>
            </div>
        </div>                 
    </div>
    <div class="modal-footer">
        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
            <i class="fa fa-remove"></i> Cerrar</button>
        <button type="submit" class="btn btn-primary pull-right">
            <i class="fa fa-floppy-o"></i> Editar</button>                                          
    </div>
</form>