<div class="modal" tabindex="-1" role="dialog" id="modalCategoriaEditar">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modalCreaModulo">
            
            <form role="form" ng-submit="editarCategoria()" id="formAgregaPersona">    
                <div class="modal-header">
                    <h5 class="modal-title">Editar Categoría</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="cajaNombreEmpresa">
                    <div class="form-group" id="cajaNombreEmpresa">
                        <input tabindex="1" autocomplete="off" id="" name="" ng-model="categoriaEditar.nombreModulo" class="ember-view ember-text-field form-control login-input" placeholder="Escriba el nombre de la categoría"  type="text">
                        <p class="help-block">Nombre que identificará la categoría de los módulos</p>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
                        <button type="submit" class="btn btn-raised btn-primary">Editar</button>
                </div>

            </form>

        </div>
    </div>
</div>