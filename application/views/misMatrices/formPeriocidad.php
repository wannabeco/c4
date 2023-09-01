<form role="form"  ng-controller="misMatrices" id="creaPeriocidad" ng-init="initmisMatrices()"  ng-submit="crearPeriocidad()">    
    <div class="modal-header">
      <h5 class="modal-title mb-0 text-gray-800 text-dark ml-2"><?php echo $titulo ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
    <div class="modal-body">
        <div class="col col-lg-12">
            <div class="form-group  label-floating">
                <label class="control-label" for="idPeriodicidad"><strong>Periodicidad</strong></label>
                <select tabindex="11" id="idPeriodicidad" name="idPeriodicidad" class="form-control">
                    <option value="">Seleccione...</option>
                    <?php foreach ($periodicidad as $periodi) { ?>
                        <option <?php if (isset($periocidades[0]["idPeriodicidad"]) && $periocidades[0]["idPeriodicidad"] == $periodi['idperiodicidad']) { echo "selected"; } ?> value="<?php echo $periodi['idperiodicidad'] ?>"><?php echo $periodi['nombrePeriodicidad']; ?></option>
                    <?php } ?>
                </select>
            </div> 
        </div>
        <div class="col col-lg-12">
            <div class="form-group label-floating">
                <label class="control-label" for="nombreRel"><strong>Descripción</strong></label>
                <input autocomplete="off" id="nombreRel" name="nombreRel" class="form-control" value="<?php echo (isset($periocidades[0]['nombreRel'])) ? $periocidades[0]['nombreRel'] : ''; ?>" type="text">
                <p class="help-block"></p>
            </div> 
        </div>
    </div>
    <input type="text" id="editar" value="<?php echo $editar;?>" hidden>
    <input type="text" id="idRelPeriocidad" value="<?php echo $idRelPeriocidad;?>" hidden>
    <div class="modal-footer">
        <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
        <?php if($editar == 0){?>
            <button type="submit" class="btn btn-raised btn-primary">Crear</button>
        <?php }if($editar == 1){?>
            <button type="submit" class="btn btn-raised btn-primary">Actualizar</button>
        <?php }?>
    </div>
</form>