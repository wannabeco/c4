<form role="form"  ng-controller="planes" ng-init="initPlanes()" id="formCreaPlanes"  ng-submit="crearPlan(<?php echo $edita; ?>,<?php echo $idPlan; ?>)">    
  <div class="modal-header">
      <h5 class="modal-title"><?php echo $titulo ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
    <div class="modal-body" id="datosPlan">
        <div class="col col-lg-12">
            <div class="form-group  label-floating">
                <label class="control-label" for="nombrePlan"><strong>Nombre de plan</strong></label>
                <input tabindex="5" autocomplete="off" id="nombrePlan" name="nombrePlan"  class="form-control" value="<?php echo (isset($infoPlanes['nombrePlan']))?$infoPlanes['nombrePlan']:'';?>">
                <p class="help-block"></p>
            </div> 
        </div>
        <div class="col col-lg-12">
            <div class="form-group  label-floating">
                <label class="control-label" for="tituloPLan"><strong>Titulo</strong></label>
                <input tabindex="5" autocomplete="off" id="tituloPlan" name="tituloPlan"  class="form-control" value="<?php echo (isset($infoPlanes['tituloPlan']))?$infoPlanes['tituloPlan']:'';?>">
                <p class="help-block"></p>
            </div> 
        </div>
        <div class="col col-lg-12">
            <div class="form-group  label-floating">
                <label class="control-label" for="descripcion"><strong>Descripción</strong></label>
                <input tabindex="5" autocomplete="off" id="descripcion" name="descripcion"  class="form-control" value="<?php echo (isset($infoPlanes['descripcion']))?$infoPlanes['descripcion']:'';?>">
                <p class="help-block"></p>
            </div> 
        </div>
        <div class="col col-lg-12">
            <div class="form-group  label-floating">
                <label class="control-label" for="precio"><strong>Precio</strong></label>
                <input type="number" tabindex="5" autocomplete="off" id="precio" name="precio" maxlength="10" class="form-control" value="<?php echo (isset($infoPlanes['precio']))?$infoPlanes['precio']:'';?>">
                <p class="help-block"></p>
            </div> 
        </div>
        <div class="col col-lg-12">
            <div class="form-group  label-floating">
                <label class="control-label" for="dirigido"><strong>Dirigido</strong></label>
                <select ng-model="dirige" class="form-control" id="dirigido" name="dirigido">
                    <option selected>Seleccione...</option>
                    <option <?php if(isset($infoPlanes['dirigido']) && $infoPlanes['dirigido'] == 0){ ?> selected <?php } ?> value="0">Empresas</option>
                    <option <?php if(isset($infoTienda['dirigido']) && $infoTienda['dirigido'] == 1){ ?> selected<?php } ?> value="1">Oficial de cumplimiento</option>
                </select>
                <p class="help-block"></p>
            </div> 
        </div>
        <div ng-if="dirige== 0">
            <div class="col col-lg-12">
                <div class="form-group  label-floating">
                    <label class="control-label" for="canMatrices"><strong>Cantidad de checks</strong></label>
                    <input type="number" tabindex="5" autocomplete="off" id="canMatrices" name="canMatrices" maxlength="10" class="form-control" value="<?php echo (isset($infoPlanes['canMatrices']))?$infoPlanes['canMatrices']:'';?>">
                    <p class="help-block"></p>
                </div> 
            </div>
            <div class="col col-lg-12">
                <div class="form-group  label-floating">
                    <label class="control-label" for="canUsuarios"><strong>Cantidad de usuarios</strong></label>
                    <input type="number" tabindex="5" autocomplete="off" id="canUsuarios" name="canUsuarios" maxlength="10" class="form-control" value="<?php echo (isset($infoPlanes['canUsuarios']))?$infoPlanes['canUsuarios']:'';?>">
                    <p class="help-block"></p>
                </div> 
            </div>
            <div class="col col-lg-12">
                <div class="form-group  label-floating">
                    <label class="control-label" for="mesCobraYear"><strong>Meses a cobrar Anual</strong></label>
                    <input type="number" tabindex="5" autocomplete="off" id="mesCobraYear" name="mesCobraYear" maxlength="10" class="form-control" value="<?php echo (isset($infoPlanes['mesCobraYear']))?$infoPlanes['mesCobraYear']:'';?>">
                    <p class="help-block"></p>
                </div> 
            </div>
        </div>
        <div class="col col-lg-12">
            <div class="form-group  label-floating">
                <label class="control-label" for="promocion"><strong>Promoción</strong></label>
                <select ng-model="Promocion" class="form-control" id="promocion" name="promocion">
                <option <?php if(isset($infoPlanes['promocion']) && $infoPlanes['promocion'] == 0){ ?> selected<?php } ?> value="0">No</option>
                <option <?php if(isset($infoTienda['promocion']) && $infoTienda['promocion'] == 1){ ?> selected<?php } ?> value="1">Si</option>
                </select>
            </div> 
        </div>
        <div ng-show="Promocion === '1'" class="col col-lg-12">
            <div class="form-group  label-floating">
            <label class="control-label" for="fechaInicio"><strong>Fecha inicio</strong></label>
            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" value="<?php echo (isset($infoPlanes['fechaInicio']))?$infoPlanes['fechaInicio']:'';?>">
            </div> 
        </div>
        <div ng-show="Promocion === '1'" class="col col-lg-12">
            <div class="form-group  label-floating">
            <label class="control-label" for="fechaFinaliza"><strong>Fecha finaliza</strong></label>
            <input type="date" class="form-control" id="fechaFinaliza" name="fechaFinaliza" value="<?php echo (isset($infoPlanes['fechaFinaliza']))?$infoPlanes['fechaFinaliza']:'';?>">
            </div> 
        </div>
        <div class="col col-lg-12">
            <div class="form-group  label-floating">
                <label class="control-label" for="estado"><strong>Estado</strong></label>
                <select class="form-control" id="estado" name="estado">
                    <option selected>Seleccione...</option>
                    <option <?php if(isset($infoPlanes['estado']) && $infoPlanes['estado'] == 0){ ?> selected<?php } ?> value="0">Inactivo</option>
                    <option <?php if(isset($infoTienda['estado']) && $infoTienda['estado'] == 1){ ?> selected<?php } ?> value="1">Activo</option>
                </select>
                <p class="help-block"></p>
            </div> 
        </div>
        
    </div>
  <div class="modal-footer">
    <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
    <?php if($edita == 0){?>
        <button type="submit" class="btn btn-raised btn-primary">Crear</button>
    <?php } if($edita > 0){?>
            <button type="submit" class="btn btn-raised btn-primary">Guardar</button>
    <?php }?>   
  </div>
</form>