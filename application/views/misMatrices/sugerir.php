<form role="form"  ng-controller="buscar" ng-init="initbuscar()" id="formsugerir"  ng-submit="sugerirMatriz()">    
  <div class="modal-header">
      <h5 class="modal-title"><?php echo $titulo ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
    <div class="modal-body" id="cajaNombreEmpresa">
        <div class="col col-lg-12">
            <div class="form-group  label-floating">
                <label class="control-label" for="nombre"><strong>Nombre del usuario</strong></label>
                <input tabindex="5" autocomplete="off" id="nombre" name="nombre"  class="form-control" value="<?php echo $_SESSION["project"]["info"]["nombre"]." ".$_SESSION["project"]["info"]["apellido"];?>"  type="text" disabled>
                <p class="help-block"></p>
            </div> 
        </div>
        <div class="col col-lg-12">
            <div class="form-group  label-floating">
                <label class="control-label" for="email"><strong>Correo electrónico</strong></label>
                <input tabindex="5" autocomplete="off" id="email" name="email"  class="form-control" value="<?php echo $_SESSION["project"]["info"]["email"]; ?>"  type="text" disabled>
                <p class="help-block"></p>
            </div> 
        </div>
        <div class="form-group col-md-12 float-left">
            <label for="exampleInputEmail1">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" maxlength="250"></textarea>
        </div>
    </div>
  <div class="modal-footer">
    <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
    <button type="submit" class="btn btn-raised btn-primary">Guardar</button>
  </div>
</form>