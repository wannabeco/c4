<form role="form"  ng-controller="buscar" id="agregaNuevaMatriz" ng-init="initbuscar()"  ng-submit="crearMiMatriz()">    
    <div class="modal-header">
      <h5 class="modal-title mb-0 text-gray-800 text-dark ml-2"><?php echo $titulo ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
    <div class="modal-body">
        <div class="col col-lg-12">
                <div class="form-group  label-floating">
                    <label for="exampleInputEmail1">Nombre de matriz</label>
                    <input type="text" class="form-control" id="nombreNuevaMatriz" name="nombreNuevaMatriz" value="<?php echo (isset($consultoCheck[0]['nombreNuevaMatriz'])) ? $consultoCheck[0]['nombreNuevaMatriz'] : ''; ?>">
                </div> 
            </div>
            <div class="form-group col-md-12 float-left">
                <label for="exampleInputEmail1">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" maxlength="250"><?php echo (isset($consultoCheck[0]['descripcion'])) ? $consultoCheck[0]['descripcion'] : ''; ?></textarea>
                <span id="caracteres-utilizados"></span>
            </div>
        </div>
        <input type="number" class="form-control" id="Precio" name="Precio" value="80000" hidden/>
        <input type="text" id="idEmpresa" name="idEmpresa" value="<?php echo $_SESSION["project"]["info"]["idEmpresa"];?>" hidden>
        <input type="text" id="editar" value="<?php echo $editar;?>" hidden>
        <?php if($editar ==1){?>
            <input type="text" id="idNuevaMatriz" name="idNuevaMatriz" value="<?php echo $idNuevaMatriz;?>" hidden>
        <?php }?>
        </div>
    <div class="modal-footer">
        <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
        <?php if($editar == 0){?>
            <button type="submit" class="btn btn-raised btn-primary">Crear</button>
        <?php }if($editar == 1){?>
            <button type="submit" class="btn btn-raised btn-primary">Actualizar</button>
        <?php }?>
    </div>
</form>