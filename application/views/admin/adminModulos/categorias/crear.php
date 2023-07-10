<div class="modal" tabindex="-1" role="dialog" id="modalCategoria">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modalCreaModulo">
            
            <form role="form" ng-submit="agregarCategoria()" id="formAgregaPersona">    
                <div class="modal-header">
                    <h5 class="modal-title">Agregar nueva categoría</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="cajaNombreEmpresa">
                    <div class="form-group" id="cajaNombreEmpresa">
                        <input tabindex="1" autocomplete="off" id="categoria" name="categoria" ng-model="categoria" class="ember-view ember-text-field form-control login-input" placeholder="Escriba el nombre de la categoría"  type="text">
                        <small class="help-block">Nombre que identificará la categorría de los módulos</small>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
                        <button type="submit" class="btn btn-raised btn-primary">Guardar</button>
                </div>

            </form>

        </div>
    </div>
</div>