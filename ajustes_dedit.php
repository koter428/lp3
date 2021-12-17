<?php 
require 'ver_session.php'; /*VERIFICAR SESSION*/
    require 'clases/conexion.php';
    @session_start();
    $sql = "select * from v_detalle_ajustes where aju_cod=" . $_REQUEST['vaju_cod'] .
    "and art_cod =" . $_REQUEST['vart_cod'] . " and dep_cod =".$_REQUEST['vdep_cod'];
    // echo $sql;return;
    $detalles = consultas::get_datos($sql);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
    <h4 class="modal-title"><i class="fa fa-edit"></i> <strong>Editar Detalle De Ajuste</strong></h4>
</div>
<form action="ajustes_dcontrol.php" method="post" accept-charset="utf-8" class="form-horizontal">
    <input type="hidden" name="accion" value="2">
    <input type="hidden" name="vaju_cod" value="<?php echo $detalles[0]['aju_cod']?>">
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
                <input type="text" class="form-control" name="vart_cod" readonly="" value="<?php echo $_REQUEST['vart_cod'] . "_" . $detalles[0]['art_descri']?>"/>
            </div>
        </div> 
        <div class="form-group">
            <label class="control-label col-sm-2">Cantidad:</label>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <input type="number" name="vaju_cant" class="form-control" required="" value="<?php echo $detalles[0]['aju_cant']?>" min="1"/>
            </div>
        </div> 
        <div class="form-group">
            <label class="control-label col-sm-2">Precio:</label>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <input type="number" name="vaju_precio" class="form-control" required="" value="<?php echo $detalles[0]['aju_precio']?>" min="1"/>
            </div>
        </div>         
        <!-- AGREGAR LISTA DESPLEGABLE MOTIVO -->
        <div class="form-group">
            <label class="col-lg-2 control-label">Motivo:</label>
            <div class="col-lg-5">
                <div class="input-group">
                        <?php 
                            $motivos = consultas::get_datos("select * from ajustes_motivos order by mot_cod = " . $detalles[0]['mot_cod'] . " asc "); 
                        ?>
                        <select class="form-control select2" name="vmot_cod" required="" id="mot" onchange="tipo()">
                            <option value="">Seleccione un motivo</option>
                            <?php foreach ($motivos as $motivo) { ?>
                                <option value="<?php echo $motivo['mot_cod'] . "_" . $motivo['mot_tipo']; ?>" selected><?php echo $motivo['mot_descri']; ?></option>
                            <?php } ?>
                        </select>
                        <span class="input-group-btn btn-flat"></span>
                </div>
            </div>
        </div>
        <!-- FIN LISTA DESPLEGABLE MOTIVO -->
        <div class="form-group">
            <label class="control-label col-sm-2">Tipo:</label>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <input type="text" name="vmot_tipo" class="form-control" required="" id="v_mot_tipo" value="<?php  echo($detalles[0]['mot_tipo'] == "E" ? "ENTRADA" : "SALIDA");?>" disabled/>
            </div>
        </div>         
    </div>
    <div class="modal-footer">
        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
            <i class="fa fa-remove"></i> Cerrar</button>
        <button type="submit" class="btn btn-primary pull-right">
        <i class="fa fa-floppy-o"></i> Editar</button>                                          
    </div>

    <script>
        function tipo() {
            var valor = $('#mot').val().split('_');
            valor = valor[1];
            if (valor == "E")
                valor = "ENTRADA";
            else
                valor = "SALIDA";
            // alert(valor);
            document.getElementById("v_mot_tipo").value = valor;
        };
    </script>
</form>