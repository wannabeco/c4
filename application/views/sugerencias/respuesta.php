<form role="form"  ng-controller="sugerencias" ng-init="initsugerencias()" id="formSugieres"  ng-submit="actualizaSugerencia()">    
    <div class="modal-header">
        <?php if($_SESSION['project']['info']['idPerfil'] > 3){?>
            <h5 class="modal-title"><?php echo $titulo ?></h5>
        <?php } if($_SESSION['project']['info']['idPerfil'] < 4){
                    if($misSugerencias["estaRespuesta"]== 0){?>
                <h5 class="modal-title">Sugerencia sin responder</h5>
        <?php }if($misSugerencias["estaRespuesta"]== 1){ ?>
                <h5 class="modal-title">Sugerencia respondida</h5>
        <?php }}?>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body" id="cajaNombreEmpresa">
        <?php if($misSugerencias["estaRespuesta"]== 1){?>
            <div class="col-md-12 float-left">
                <div class="alert alert-success" role="alert">
                <i class="fas fa-smile-wink"></i> Respuesta disponible.
                </div>
            </div>
        <?php }?>
        <div class="col col-lg-6 float-left">
            <div class="form-group  label-floating">
                <label class="control-label" for="nombre"><strong>Nombre del usuario</strong></label>
                <input tabindex="5" autocomplete="off" id="nombre" name="nombre"  class="form-control" value="<?php echo $misSugerencias["nombre"];?>"  type="text" disabled>
                <p class="help-block"></p>
            </div> 
        </div>
        <div class="col col-lg-6 float-left">
            <div class="form-group  label-floating">
                <label class="control-label" for="email"><strong>Correo electrónico</strong></label>
                <input tabindex="5" autocomplete="off" id="email" name="email"  class="form-control" value="<?php echo $misSugerencias["emailUsuario"]; ?>"  type="text" disabled>
                <p class="help-block"></p>
            </div> 
        </div>
        <div class="form-group col-md-12 float-left">
            <label for="exampleInputEmail1">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" maxlength="250" disabled><?php echo $misSugerencias["descripcion"]; ?></textarea>
        </div>
        <?php if($_SESSION['project']['info']['idPerfil'] <4 && $misSugerencias["estaRespuesta"]== 0){?>
            <div class="form-group col-md-12 float-left">
            <label for="exampleInputEmail1">Responder</label>
            <textarea class="form-control" id="respuesta" name="respuesta" rows="3" maxlength="250"></textarea>
        </div>
        <?php }if($_SESSION['project']['info']['idPerfil'] > 3){ if($misSugerencias["estaRespuesta"]== 0){?>
            <div class="col-md-12 float-left">
                <div class="alert alert-danger" role="alert">
                <i class="fas fa-frown-open"></i> Aún no se encuentran respuestas para tu solicitud.
                </div>
            </div>
        <?php }} if($misSugerencias["estaRespuesta"]== 1){?>
            <!-- fecha de respuesta -->
            <div class="col-md-6 float-left">
                <div class="form-group  label-floating">
                    <label class="control-label" for="nombre"><strong>Fecha de respuesta</strong></label>
                    <input tabindex="5" autocomplete="off" id="nombre" name="nombre"  class="form-control" value="<?php echo formatoFechaEspanol($misSugerencias["fechaRespuesta"]);?>"  type="text" disabled>
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="col-md-6 float-left">
                <div class="form-group  label-floating">
                    <label class="control-label" for="nombre"><strong>Estado de respuesta</strong></label>
                    <h5><span class="badge badge-success">Respondido</span></h5>
                </div>
            </div>
             <!--respuesta  -->
            <div class="form-group col-md-12 float-left">
                <label for="exampleInputEmail1">Respuesta</label>
                <textarea class="form-control" rows="3" maxlength="250"><?php echo $misSugerencias["respuesta"]; ?></textarea>
            </div>
        <?php } ?> 
        <input value="<?php echo $misSugerencias["idSugiere"]?>" id="idSugiere" hidden>  
    </div>
  <div class="modal-footer">
    <button type="button"  data-dismiss="modal" class="btn   btn-danger">Cerrar</button>
    <?php if($_SESSION['project']['info']['idPerfil'] < 4){
            if($misSugerencias["estaRespuesta"]== 0){
        ?>
        <button type="submit" class="btn btn-raised btn-primary">Guardar respuesta</button>
    <?php } }?>
  </div>
</form>