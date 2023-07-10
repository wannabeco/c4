<form role="form"  ng-controller="empresas"  ng-init="initEmpresas()" id="formRelEmpresa"  ng-submit="crearRelacion()">    
  <div class="modal-header">
      <h5 class="modal-title"><?php echo $titulo ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body" id="cajaNombreEmpresa">
        <div class="col col-lg-12">
                <div class="form-group  label-floating">
                  <label class="control-label" for="idMetodoControl"><strong>Seleccione una empresa</strong></label>
                  <select tabindex="11"  id="idEmpresa" name="idEmpresa" class="form-control">
                  <option value="">Seleccione...</option>
                        <?php foreach($infoEmpresas as $Empresa){ ?> 
                            <option <?php if(isset($infoEmpresas['idEmpresa']) && $infoEmpresas['idEmpresa'] == $Empresa['idEmpresa']){ ?> selected<?php } ?> value="<?php echo $Empresa['idEmpresa']; ?>"><?php echo $Empresa['nombre']; ?></option>
                        <?php } ?>
                  </select>
                </div> 
            </div>
      <!-- fin formulario-->    

      <input id="idPersona" name="idPersona" value="<?php echo $_SESSION['project']['info']['idPersona']; ?>" type="hidden"/>
      <input id="idPerfil" name="idPerfil" value="<?php echo $_SESSION['project']['info']['idPerfil']; ?>" type="hidden"/>

  </div>
  <div class="modal-footer">
    <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
    <button type="submit" class="btn btn-raised btn-primary">Guardar</button>
  </div>
</form>