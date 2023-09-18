<form role="form"  ng-controller="procesaGuardadoListas" ng-init="habilitaForm()" id="formAgregaListas" ng-submit="procesaLista(<?php echo $edita ?>)">    
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h2 class="modal-title"><?php echo $titulo ?></h2>
    <p class="text-justify">
      Esta sección le permitirá crear listados de información que serán usados en los formularios que se mostrarán más adelante.
    </p>
  </div>
    <div class="modal-body">    

        
            <div class="form-group  label-floating">
                <label class="control-label" for="nombreLista">Nombre de la lista</label>
                  <input tabindex="2" autocomplete="off" id="nombreLista" name="nombreLista"  class="form-control" value="<?php echo (isset($datos['nroDocumento']))?$datos['nroDocumento']:''; ?>" type="text">
              <p class="help-block"></p>
            </div>

            <div class="form-group  label-floating">
                <label class="control-label" for="nombreTabla">Nombre de la lista en la base de datos</label>
                  <input tabindex="2" autocomplete="off" id="nombreTabla" name="nombreTabla"  class="form-control" value="<?php echo (isset($datos['nroDocumento']))?$datos['nroDocumento']:''; ?>" type="text">
              <p class="help-block">No utilice espacios ni caracteres especiales.</p>
            </div>
            
            
        <div class="form-group">
          <label for="inputError">Información a cargar</label>
          <p>Seleccione el archivo donde está la información que desee agregar a nuestro sistema. Tamaño máximo {{interfaz.tamanoArchivosExcel}} Kb ({{interfaz.lblArchivoExcel}}) Sólo se permite formatos de Excel</p>
            <!--<input type="text" value="<?php if(isset($anuncioConsultado)) { echo $anuncioConsultado['fechaFinalizacion']; } ?>" class="form-control " id="fechaFinalizacion" name="fechaFinalizacion" ng-model="fechaFinalizacion"  placeholder="Fecha en la que el anuncio debe desaparecer"/>-->
          <input id="excelFile" name="excelFile" type="file" data-show-upload="false" class="file file-loading" data-allowed-file-extensions='{{interfaz.tiposArchivoExcel}}' data-max-file-size="{{interfaz.tamanoArchivosExcel}}" path="uploadedFiles" data-show-preview="false" data-show-upload="true">
        </div>


  </div>
  <div class="modal-footer">
    <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
    <?php if(getPrivilegios()[0]['crear'] == 1 && $edita == 0){ ?>
      <button type="submit" class="btn btn-raised btn-primary"><?php echo $labelBtn ?></button>
    <?php } ?>
    
    <?php if(getPrivilegios()[0]['editar'] == 1 && $edita == 1){ ?>
      <button type="submit" class="btn btn-raised btn-primary"><?php echo $labelBtn ?></button>
    <?php } ?>

  </div>
</form>