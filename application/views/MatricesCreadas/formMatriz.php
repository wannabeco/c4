<form role="form"  ng-controller="crearParametrosMatriz" id="formMatriz" ng-init="initformMatriz()"  ng-submit="actualizarMatriz(<?php echo $informacionMatriz[0]["idNuevaMatriz"] ?>)">    
  <div class="modal-header">
      <h5 class="modal-title"><?php echo $titulo ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
  </div>
  <div class="modal-body" id="cajaNombreEmpresa">
        <?php   
            json_encode($informacionMatriz);
            //var_dump($informacionMatriz);
        ?>
           <div class="col col-lg-12">
                <div class="form-group label-floating">
                  <label class="control-label" for="nombreNuevaMatriz"><strong>Nombre de matriz</strong></label>
                  <textarea tabindex="6" autocomplete="off" id="nombreNuevaMatriz" name="nombreNuevaMatriz"  class="form-control" value=""  type="text" placeholder="Ejemplo: Efectuar reuniones"><?php echo $informacionMatriz[0]["nombreNuevaMatriz"]; ?></textarea>
                  <p class="help-block"></p>
                </div> 
            </div>
            <div class="col-lg-12">
                <div class="form-group  label-floating">
                    <label class="control-label" for="dirigida"><strong>Tipo de matriz</strong></label>
                    <select tabindex="11"  id="dirigida" name="dirigida" class="form-control" onchange="angular.element(document.getElementById('formMatriz')).scope().muestraTipoEmpresa()">
                        <option value="">Seleccione...</option>
                            <?php foreach($dirigida as $dirige){ ?>
                                <option value="<?php echo $dirige['idDirigida'] ?>" <?php echo (isset($informacionMatriz[0]['dirigida']) && $dirige['idDirigida'] == $informacionMatriz[0]['dirigida'])?'selected':''; ?>><?php echo $dirige['nombre'] ?></option>
                            <?php } ?>
                    </select>
                </div> 
            </div>
            <div class="form-group col-md-12" ng-if="tipoP == 2">
                <label for="exampleFormControlSelect1">Tipo empresa</label>
                <select class="custom-select" id="tipoEmpresa" name="tipoEmpresa" ng-model="selectedOption" ng-change="agregaNuevo(<?php echo $informacionMatriz[0]['idNuevaMatriz']?>)">
                    <option value="" >Seleccione...</option>
                    <?php foreach($infoTipoEmpresa as $tipoEmpresa){ ?>
                            <option value="<?php echo $tipoEmpresa['idTipoEmpresa']. ',' . $tipoEmpresa['TipoEmpresa'] ?>" ><?php echo $tipoEmpresa['TipoEmpresa'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-12 text-dark tipo">
            </div>
        <?php if($informacionMatriz[0]["dirigida"] ==2){ ?>
            <div class="col col-lg-12" ng-if="tipoP == 2">
                <div class="form-group">
                    <label class="control-label"><strong>Tipos de empresa seleccionados</strong></label>
                    <?php foreach($relaciones as $relacion){ ?>
                        <span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;"><?php echo $relacion["TipoEmpresa"];?> <a class="text-danger" ng-click="deliminaAdiccion(<?php echo $relacion["idAccionaciones"];?>)" style="cursor:pointer;"> X </a></span>
                    <?php } ?>
                </div> 
            </div>
        <?php } ?>
            <div class="col col-lg-12">
                <div class="form-group">
                  <label class="control-label" for="estado"><strong>Estado</strong></label>
                  <select tabindex="11"  id="estado" name="estado" class="form-control">
                  <option value="">Seleccione...</option>
                    <?php foreach($estados as $estado){ ?>
                        <option value="<?php echo $estado['idEstado'] ?>" <?php echo (isset($informacionMatriz[0]['estado']) && $estado['idEstado'] == $informacionMatriz[0]['estado'])?'selected':''; ?>><?php echo $estado['nombreEstado'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>
            <input id="idNuevaMatriz" name="idNuevaMatriz" value="<?php echo $id; ?>" type="hidden"/>
      <!-- fin formulario-->    
    </div>
    <div class="modal-footer">
        <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
        <button type="submit" class="btn btn-raised btn-primary">Actualizar</button>
    </div>
</form>