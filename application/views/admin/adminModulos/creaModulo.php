<form role="form"  ng-controller="modulos" id="formAgregaModulo" ng-init="initModal()" ng-submit="procesaModulos(<?php echo $edita ?>)">    
  <div class="modal-header">
      <h5 class="modal-title"><?php echo $titulo ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
      <small>Los módulos son los encargados de lograr el funcionamiento de la aplicación, estos deben ser creados por programadores con experiencia en codeigniter V3</small>
      <div class="form-group">
        <label for="nombreModulo"><strong>Nombre del módulo</strong></label>
        <input tabindex="1" autocomplete="off" id="nombreModulo" name="nombreModulo" aria-describedby="ayudaNombre"  class="ember-view ember-text-field form-control login-input" value="<?php echo (isset($datos['nombreModulo']))?$datos['nombreModulo']:''; ?>" placeholder="Ejemplo: Módulo contable"  type="text">
        <small id="ayudaNombre" class="form-text text-muted">Nombre que identificará el módulo</small>
      </div> 

    <div class="form-group">
      <label for="urlModulo"><strong>Ruta del módulo</strong></label>
      <input tabindex="1" autocomplete="off" id="urlModulo"  name="urlModulo" aria-describedby="ayudaUrl"  class="ember-view ember-text-field form-control login-input" value="<?php echo (isset($datos['urlModulo']))?$datos['urlModulo']:''; ?>" placeholder="Ejemplo: Controlador/funcion/"  type="text">
      <small id="ayudaUrl" class="form-text text-muted">Ruta donde está la lógica de programación del módulo. Se escribe el nombre del controlador y la función principal</small>
    </div> 

    <div class="form-group">
      <label for="icono"><strong>Ícono del módulo</strong></label>
      <input tabindex="1" autocomplete="off" id="icono"  name="icono" aria-describedby="ayudaIcono"  class="ember-view ember-text-field form-control login-input" value="<?php echo (isset($datos['icono']))? $datos['icono'] : ''; ?>" placeholder="Ejemplo: fa fa-file"  type="text">
      <small id="ayudaIcono" class="form-text text-muted">Ícono para identificar el módulo. Librería Fontawesome V5. <a href="https://fontawesome.com/v5/search?q=edit&o=r" target="_blank">Ver íconos aquí</a></small>
    </div> 

    <div class="form-group">
      <label for="orden"><strong>Orden del módulo</strong></label>
      <input tabindex="1" autocomplete="off" id="orden"  name="orden" aria-describedby="ayudaOrden"  class="ember-view ember-text-field form-control login-input" value="<?php echo (isset($datos['orden']))? $datos['orden'] : ''; ?>" placeholder="Ejemplo: 1"  type="text">
      <small id="ayudaOrden" class="form-text text-muted">Ordenamiento de los módulos en el menú principal</small>
    </div> 


    <?php if($edita == 1){ ?>
      <div class="form-group">
        <select class=" form-control" id="estado" name="estado">
          <option value="1" <?php if($datos['estado'] == 1){?>selected<?php }?>>Activo</option>
          <option value="0" <?php if($datos['estado'] == 0){?>selected<?php }?>>Inactivo</option>
        </select>
      </div> 
    <?php } ?>
    
      <div class="form-group">
        <input tabindex="1" autocomplete="off" id="idPadre" name="idPadre" value="<?php echo $padre ?>" type="hidden">
        <input tabindex="1" autocomplete="off" id="idEditar" name="idEditar" value="<?php echo $idEdita ?>" type="hidden">
      </div> 
      <br>

      <small class="form-text text-muted">
        Seleccione los perfiles que pueden ver este módulo y los provilegios que tendrá dentro del mismo.
      </p>
    
      <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th colspan="4" class="text-center">PRIVILEGIOS</th>
            </tr>
            <tr>
                <th>PERFILES</th>
                <th class="text-center">VER</th>
                <th class="text-center">CREAR</th>
                <th class="text-center">EDITAR</th>
                <th class="text-center">BORRAR</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($perfiles as $p){ ?>
              <tr class="modulosLista" rel="<?php echo $p['idPerfil'] ?>">
                  <td><?php echo $p['nombrePerfil'] ?></td>
                  <td class="text-center"><input type="checkbox" id="ver<?php echo $p['idPerfil'] ?>" value="1" <?php if(isset($p['ver']) && $p['ver'] == 1){ ?>checked="checked"<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="crear<?php echo $p['idPerfil'] ?>" value="1" <?php if(isset($p['crear']) && $p['crear'] == 1){ ?>checked="checked"<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="editar<?php echo $p['idPerfil'] ?>" value="1" <?php if(isset($p['editar']) && $p['editar'] == 1){ ?>checked="checked"<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="borrar<?php echo $p['idPerfil'] ?>" value="1" <?php if(isset($p['borrar']) && $p['borrar'] == 1){ ?>checked="checked"<?php }?>></td>
              </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>


  </div>
  <div class="modal-footer">
      <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
      <button type="submit" class="btn btn-primary"><?php echo $labelBtn ?></button>

  </div>


</form>