<form role="form" ng-controller="checkeador" id="formulario"  ng-submit="checkboxes()">
    <div class="modal-header">
        <h5 class="modal-title pl-5"><?php echo $titulo ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
        </button>
    </div>
  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group pl-4 pt-5" style="margin-bottom: 0px;">
            <label for="nombre"><strong> Nombre:</strong> <?php echo $_SESSION['project']['info']["nombre"]." ".$_SESSION['project']['info']["apellido"];?></label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group pl-4" style="margin-bottom: 0px;">
            <label for="cargo"><strong>Cargo:</strong><?php echo $infoUsuario[0]['nombrePerfil']; ?></label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group pl-4" style="margin-bottom: 0px;">
            <label for="fecha"><strong>Fecha de Diligenciamiento de Formato:</strong> <?php echo formatoFechaEspanol($fecha); ?></label>
            </div>
        </div>
    </div>
    <div class="row p-4">
        <div class="col-md-12">
            <p>FORMATO DE CHEQUEO PARA EL REPORTE Y CUMPLIMIENTO DE LOS PROCESOS A LAS ÁREAS ENCARGADAS</p>
        </div>
    </div>

    <div class="row p-4">
        <div class="col-md-12">
            <div class="form-group col-md-8 float-left">
                <label>Preguntas:</label>
            </div>
            <div class="col-md-1 float-left">
                <label for="">SI</label>
            </div>
            <div class="col-md-1 float-left">
                <label for="">NO</label>
            </div>
            <div class="col-md-1 float-left">
                <label for="">N/A</label>
            </div>
        </div>
        <div class="col-md-12 bg-light">
            <div class="form-group">
                <div class="col-md-8 float-left text-justify">
                    <label>¿Se completó el procedimiento de acuerdo con los lineamientos establecidos en los manuales?</label>
                </div>
                <div class="col-md-4 float-left">
                    <div class="checkboxes pt-3">
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta1" name="pregunta1" style="height: 22px; width:22px;" value="SI">
                            <label class="form-check-label" for="pregunta1"></label>
                        </div>
                        <div class="form-check form-check-inline pl-3">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta1" name="pregunta1" style="height: 22px; width:22px;" value="NO">
                            <label class="form-check-label" for="pregunta1"></label>
                        </div>
                        <div class="form-check form-check-inline pl-3">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta1" name="pregunta1" style="height: 22px; width:22px;" value="NO/A">
                            <label class="form-check-label" for="pregunta1"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 pt-2">
            <div class="form-group">
                <div class="col-md-8 float-left text-justify">
                    <label>¿Se revisó que el procedimiento se haya realizado con apego a la normativa vigente?</label>
                </div>
                <div class="col-md-4 float-left">
                    <div class="checkboxes pt-3">
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta2" name="pregunta2" style="height: 22px; width:22px;" value="SI">
                            <label class="form-check-label" for="si"></label>
                        </div>
                        <div class="form-check form-check-inline pl-3">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta2" name="pregunta2" style="height: 22px; width:22px;" value="NO">
                            <label class="form-check-label" for="no"></label>
                        </div>
                        <div class="form-check form-check-inline pl-3">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta2" name="pregunta2" style="height: 22px; width:22px;" value="NO/A">
                            <label class="form-check-label" for="noa"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 bg-light pt-2">
            <div class="form-group">
                <div class="col-md-8 float-left text-justify">
                    <label> ¿Se recibió el reporte de información pertinente de los analistas y/o responsables del procedimiento de acuerdo con el procedimiento?</label>
                </div>
                <div class="col-md-4 float-left">
                    <div class="checkboxes pt-3">
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta3" name="pregunta3" style="height: 22px; width:22px;" value="SI">
                            <label class="form-check-label" for="si"></label>
                        </div>
                        <div class="form-check form-check-inline pl-3">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta3" name="pregunta3" style="height: 22px; width:22px;" value="NO">
                            <label class="form-check-label" for="no"></label>
                        </div>
                        <div class="form-check form-check-inline pl-3">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta3" name="pregunta3" style="height: 22px; width:22px;" value="NO/A">
                            <label class="form-check-label" for="noa"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 pt-2">
            <div class="form-group">
                <div class="col-md-8 float-left text-justify">
                    <label> ¿Se rindió reporte de la gestión al Área de Cumplimiento?</label>
                </div>
                <div class="col-md-4 float-left">
                    <div class="checkboxes">
                        <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input text-secondary" id="pregunta4" name="pregunta4" style="height: 22px; width:22px;" value="SI">
                        <label class="form-check-label" for="si"></label>
                        </div>
                        <div class="form-check form-check-inline pl-3">
                        <input type="checkbox" class="form-check-input text-secondary" id="pregunta4" name="pregunta4" style="height: 22px; width:22px;" value="NO">
                        <label class="form-check-label" for="no"></label>
                        </div>
                        <div class="form-check form-check-inline pl-3">
                        <input type="checkbox" class="form-check-input text-secondary" id="pregunta4" name="pregunta4" style="height: 22px; width:22px;" value="NO/A">
                        <label class="form-check-label" for="noa"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 bg-light pt-2">
            <div class="form-group">
                <div class="col-md-8 float-left text-justify">
                    <label>¿Se presentó alguna inconsistencia o falencia en el procedimiento?</label>
                </div>
                <div class="col-md-4 float-left">
                    <div class="checkboxes pt-3">
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta5" name="pregunta5" style="height: 22px; width:22px;" value="SI">
                            <label class="form-check-label" for="si"></label>
                        </div>
                        <div class="form-check form-check-inline pl-3">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta5" name="pregunta5" style="height: 22px; width:22px;" value="NO">
                            <label class="form-check-label" for="no"></label>
                        </div>
                        <div class="form-check form-check-inline pl-3">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta5" name="pregunta5" style="height: 22px; width:22px;" value="NO/A">
                            <label class="form-check-label" for="noa"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 pt-2">
            <div class="form-group">
                <div class="col-md-8 float-left text-justify">
                    <label>¿Se reportó la inconsistencia o falencia al Área de Cumplimiento?</label>
                </div>
                <div class="col-md-4 float-left">
                    <div class="checkboxes pt-3">
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta6" name="pregunta6" style="height: 22px; width:22px;" value="SI">
                            <label class="form-check-label" for="si"></label>
                        </div>
                        <div class="form-check form-check-inline pl-3">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta6" name="pregunta6" style="height: 22px; width:22px;" value="NO">
                            <label class="form-check-label" for="no"></label>
                        </div>
                        <div class="form-check form-check-inline pl-3">
                            <input type="checkbox" class="form-check-input text-secondary" id="pregunta6" name="pregunta6" style="height: 22px; width:22px;" value="NO/A">
                            <label class="form-check-label" for="noa"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input id="idNuevaMatriz" name="idNuevaMatriz" value="<?php echo $informacion["idNuevaMatriz"]; ?>" type="hidden" />
    <input id="idPersona" name="idPersona" value="<?php echo $_SESSION['project']['info']["idPersona"]; ?>" type="hidden"/>
    <input id="idMatrizRecurrente" name="idMatrizRecurrente" value="<?php echo $informacion["idMatrizRecurrente"]; ?>" type="hidden"/>
    <input id="idPerfil" name="idPerfil" value="<?php echo $informacion["idPerfil"]; ?>" type="hidden"/>
    <input id="idEmpresa" name="idEmpresa" value="<?php echo $_SESSION['project']['info']["idEmpresa"]; ?>" type="hidden"/>
    <div class="row p-4">
        <div class="col-md-12">
            <p>Comentarios:</p>
        </div>
    </div>

    <div class="row pl-4 pr-4">
      <div class="col-md-12">
        <div class="form-group">
          <textarea class="form-control" rows="3" id="comentarios" ng-model="comentarios"></textarea>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-md-12 p-4">
            <button type="submit" class="btn btn-raised btn-danger">Guardar</button>
        </div>
    </div>
  </div>
</form>
<style> 
    button{position: relative; float: right; }
</style>