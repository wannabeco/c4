<form role="form"  ng-controller="crearParametrosMatriz" id="formAgregaParametros"  ng-submit="agregaNuevaParametro(<?php echo $edita ?>)">    
  <div class="modal-header">
      <h5 class="modal-title"><?php echo $titulo ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body" id="cajaNombreEmpresa">
        <?php json_encode($infoMatriz);
          //var_dump($infoMatriz);die();
        ?>
           <div class="col col-lg-12">
                <div class="form-group label-floating">
                  <label class="control-label" for="obligacion"><strong>Obligación</strong></label>
                  <textarea tabindex="6" autocomplete="off" id="obligacion" name="obligacion"  class="form-control" value=""  type="text" placeholder="Ejemplo: Efectuar reuniones"><?php echo (isset($infoMatriz[0]['obligacion']))?$infoMatriz[0]['obligacion']:''; ?></textarea>
                  <p class="help-block"></p>
                </div> 
            </div>
            <div class="col col-lg-12">
                <div class="form-group  label-floating">
                  <label class="control-label" for="idEntidad"><strong>Entidad</strong></label>
                  <select tabindex="11"  id="idEntidad" name="idEntidad" class="form-control">
                  <option value="">Seleccione...</option>
                    <?php foreach($entidades as $entidad){ ?>
                        <option value="<?php echo $entidad['idEntidad'] ?>" <?php echo (isset($infoMatriz[0]['idEntidad']) && $entidad['idEntidad'] == $infoMatriz[0]['idEntidad'])?'selected':''; ?>><?php echo $entidad['nombreEntidades'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>
         
            <div class="col col-lg-12">
                <div class="form-group label-floating">
                  <label class="control-label" for="normatividad"><strong>Norma Aplicable</strong></label>
                  <textarea tabindex="6" autocomplete="off" id="normatividad" name="normatividad"  class="form-control" value=""  type="text" placeholder="Ejemplo: Efectuar reuniones"><?php echo (isset($infoMatriz[0]['normatividad']))?$infoMatriz[0]['normatividad']:''; ?></textarea>
                  <p class="help-block"></p>
                </div> 
            </div>
            <div class="col col-lg-12">
                <div class="form-group label-floating">
                  <label class="control-label" for="frecuencia"><strong>Frecuencia</strong></label>
                  <textarea tabindex="6" autocomplete="off" id="frecuencia" name="frecuencia"  class="form-control" value=""  type="text" placeholder="Ejemplo: Mensualmente"><?php echo (isset($infoMatriz[0]['frecuencia']))?$infoMatriz[0]['frecuencia']:''; ?></textarea>
                  <p class="help-block"></p>
                </div> 
            </div>
            <div class="col col-lg-12">
                <div class="form-group  label-floating">
                  <label class="control-label" for="idcuandoAplique"><strong>Cuando aplique</strong></label>
                  <select tabindex="11"  id="idcuandoAplique" name="idcuandoAplique" class="form-control">
                  <option value="">Seleccione...</option>
                    <?php foreach($cuandoAplique as $aplique){ ?>
                        <option value="<?php echo $aplique['idCuandoAplique'] ?>" <?php echo (isset($infoMatriz[0]['idcuandoAplique']) && $aplique['idCuandoAplique'] == $infoMatriz[0]['idcuandoAplique'])?'selected':''; ?>><?php echo $aplique['nombreCuandoAplique'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>
            <div class="col col-lg-12">
                <div class="form-group  label-floating">
                  <label class="control-label" for="idResponsable"><strong>Responsable</strong></label>
                  <select tabindex="11"  id="idResponsable" name="idResponsable" class="form-control">
                  <option value="">Seleccione...</option>

                    <?php if($_SESSION['project']['info']['idPerfil'] == 1 || $_SESSION['project']['info']['idPerfil'] == 2 ){ ?>
                        <?php foreach($responsable as $respons){ ?>
                          <option value="<?php echo $respons['idPerfil'] ?>" <?php echo (isset($infoMatriz[0]['idResponsable']) && $respons['idPerfil'] == $infoMatriz[0]['idResponsable'])?'selected':''; ?>><?php echo $respons['nombrePerfil'] ?></option>
                        <?php } }?>
                        <?php if($_SESSION['project']['info']['idPerfil'] == 3) { ?>
                          <?php 
                            $contador = 0;
                            foreach($responsable as $respons){
                                $contador++;
                                if($contador > 2){
                          ?>
                          <option value="<?php echo $respons['idPerfil'] ?>" <?php echo (isset($infoMatriz[0]['idResponsable']) && $respons['idPerfil'] == $infoMatriz[0]['idResponsable'])?'selected':''; ?>><?php echo $respons['nombrePerfil'] ?></option>
                    <?php } } }?>
                  </select>
                </div> 
            </div>
            <div class="col col-lg-12">
                <div class="form-group  label-floating">
                  <label class="control-label" for="idccsm"><strong>Aplica para ccsm</strong></label>
                  <select tabindex="11"  id="idccsm" name="idccsm" class="form-control">
                  <option value="">Seleccione...</option>
                    <?php foreach($aplicaCcsm as $ccsm){ ?>
                        <option value="<?php echo $ccsm['idccsm'] ?>" <?php echo (isset($infoMatriz[0]['idccsm']) && $ccsm['idccsm'] == $infoMatriz[0]['idccsm'])?'selected':''; ?>><?php echo $ccsm['nombreCcsm'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>
            <div class="col col-lg-12">
                <div class="form-group  label-floating">
                  <label class="control-label" for="idMetodoControl"><strong>Metodologia de control</strong></label>
                  <select tabindex="11"  id="idMetodoControl" name="idMetodoControl" class="form-control">
                  <option value="">Seleccione...</option>
                    <?php foreach($metodoControl as $control){ ?>
                        <option value="<?php echo $control['idMetodoControl'] ?>" <?php echo (isset($infoMatriz[0]['idMetodoControl']) && $control['idMetodoControl'] == $infoMatriz[0]['idMetodoControl'])?'selected':''; ?>><?php echo $control['nombreMetodoControl'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>
            <div class="col col-lg-12">
                <div class="form-group  label-floating">
                  <label class="control-label" for="idperiodicidad"><strong>Periodicidad</strong></label>
                  <select tabindex="11"  id="idperiodicidad" name="idperiodicidad" class="form-control">
                  <option value="">Seleccione...</option>
                    <?php foreach($periodicidad as $periodi){ ?>
                        <option value="<?php echo $periodi['idperiodicidad'] ?>" <?php echo (isset($infoMatriz[0]['idperiodicidad']) && $periodi['idperiodicidad'] == $infoMatriz[0]['idperiodicidad'])?'selected':''; ?>><?php echo $periodi['nombrePeriodicidad'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>
            <?php if($edita == 1){ ?>
            <div class="col col-lg-12">
                <div class="form-group  label-floating">
                  <label class="control-label" for="estado"><strong>Estado</strong></label>
                  <select tabindex="11"  id="estado" name="estado" class="form-control">
                  <option value="">Seleccione...</option>
                    <?php foreach($estados as $estado){ ?>
                        <option value="<?php echo $estado['idEstado'] ?>" <?php echo (isset($infoMatriz[0]['estado']) && $estado['idEstado'] == $infoMatriz[0]['estado'])?'selected':''; ?>><?php echo $estado['nombreEstado'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>
            <?php } ?>
            <input id="idNuevaMatriz" name="idNuevaMatriz" value="<?php echo $id; ?>" type="hidden"/>
      <!-- fin formulario-->    


  </div>
  <div class="modal-footer">
    <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
    <?php if($edita == 1){ ?>
      <button ng-click="ActualizaParametros(<?php echo $infoMatriz[0]["idMatrizRecurrente"] ?>)" class="btn btn-raised btn-primary">Actualizar</button>
      <?php }else if($edita == 0){ ?>
      <button type="submit" class="btn btn-raised btn-primary">Guardar</button>
    <?php } ?>
  </div>
</form>