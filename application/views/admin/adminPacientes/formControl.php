<form role="form"  ng-controller="procesaGuardadoPac" id="formAgregaPaciente" ng-submit="procesaUsuarioPac(<?php echo $edita ?>)">    
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h2 class="modal-title"><?php echo $titulo ?></h2>
    <p class="text-justify">
      En esta zona podrá agregar pacientes al aplicativo. Debe completar el formulario que verá a continuación.
    </p>
  </div>
    <div class="modal-body">    

        <div class="row">
          <div class="col col-lg-12">
            <h3>DATOS DEL PACIENTE</h3>
           </div> 
          <div class="col col-lg-6">
              <div class="form-group label-floating">
                <label class="control-label" for="tipoPaciente">Tipo de paciente</label>
                <select  id="tipoPaciente" name="tipoPaciente" class="form-control">
                    <option value=""></option>
                    <?php if(isset($_SESSION['tipoPac']) && $_SESSION['tipoPac'] == "PAD"){ ?>
                      <option value="PAD"  <?php echo (isset($datos['tipoPaciente']) && 'PAD' == $datos['tipoPaciente'])?'selected':''; ?>>PAD</option>
                    <?php }?>
                    <?php if(isset($_SESSION['tipoPac']) && $_SESSION['tipoPac'] == "CE"){ ?>
                      <option value="CE" <?php echo (isset($datos['tipoPaciente']) && 'CE' == $datos['tipoPaciente'])?'selected':''; ?>>CONSULTA EXTERNA</option>
                    <?php }?>
                </select>
              </div> 
          </div>
          <div class="col col-lg-6">
              <div class="form-group label-floating">
                <label class="control-label" for="tip_doc_pac">Tipo de documento</label>
                <select  id="tip_doc_pac" name="tip_doc_pac" class="form-control">
                    <option value=""></option>
                  <?php foreach($selects['tiposDoc'] as $listaTD){ ?>
                      <option value="<?php echo $listaTD['idTipoDoc'] ?>" <?php echo (isset($datos['tip_doc_pac']) && $listaTD['idTipoDoc'] == $datos['tip_doc_pac'])?'selected':''; ?>><?php echo $listaTD['nombreTipoDoc'] ?></option>
                  <?php } ?>
                </select>
              </div> 
          </div>

          <div  class="col col-lg-6">
            <div class="form-group  label-floating">
                <label class="control-label" for="num_doc">Documento de identidad</label>
                  <input autocomplete="off" id="num_doc" name="num_doc"  class="form-control" value="<?php echo (isset($datos['num_doc']))?$datos['num_doc']:''; ?>" type="text">
              <p class="help-block"></p>
            </div>
          </div>

            <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="nombre_paciente">Nombres del paciente</label>
                  <input autocomplete="off" id="nombre_paciente" name="nombre_paciente"  class="form-control" value="<?php echo (isset($datos['nombre_paciente']))?$datos['nombre_paciente']:''; ?>"  type="text">
                  <p class="help-block"></p>
                </div> 
            </div>
           <div class="col col-lg-6">
                <div class="form-group label-floating">
                  <label class="control-label" for="apellido_paciente">Apellidos del paciente</label>
                  <input autocomplete="off" id="apellido_paciente" name="apellido_paciente"  class="form-control" value="<?php echo (isset($datos['apellido_paciente']))?$datos['apellido_paciente']:''; ?>"  type="text">
                  <p class="help-block"></p>
                </div> 
            </div>

           <?php if(isset($_SESSION['tipoPac']) && $_SESSION['tipoPac'] == "PAD"){ ?> 
              <div  class="col col-lg-6">
                <div class="form-group label-floating">
                    <label class="control-label" for="estado_paciente">Estado del paciente</label>
                    <select  id="estado_paciente" name="estado_paciente" class="form-control">
                        <option value=""></option>
                        <option value="puntual" <?php if(isset($datos['estado_paciente']) && $datos['estado_paciente'] == 'puntual'){ ?> selected<?php } ?> >Puntual</option>
                        <option value="cronico" <?php if(isset($datos['estado_paciente']) && $datos['estado_paciente'] == 'cronico'){ ?> selected<?php } ?> >Crónico</option>
                        <option value="phd" <?php if(isset($datos['estado_paciente']) && $datos['estado_paciente'] == 'phd'){ ?> selected<?php } ?> >Phd</option>
                        <option value="evento" <?php if(isset($datos['estado_paciente']) && $datos['estado_paciente'] == 'evento'){ ?> selected<?php } ?> >Evento</option>
                    </select>
                </div>
              </div>
          <?php } ?>
          <div  class="col col-lg-6">
            <div class="form-group label-floating">
                <label class="control-label" for="id_app_lista_aseguradoras">Aseguradora</label>
                <select  id="id_app_lista_aseguradoras" name="id_app_lista_aseguradoras" class="form-control">
                    <option value=""></option>
                    <?php foreach($selects['aseguradoras'] as $epss){ ?>
                        <option value="<?php echo $epss['id_app_lista_aseguradoras'] ?>" <?php echo (isset($datos['id_app_lista_aseguradoras']) && $epss['id_app_lista_aseguradoras'] == $datos['id_app_lista_aseguradoras'])?'selected':''; ?>><?php echo $epss['des_asegurador'] ?></option>
                    <?php } ?>
                </select>
            </div>
          </div>

            <div  class="col col-lg-6">
              <div class="form-group  label-floating">
                  <label class="control-label" for="fecha_nacimiento">Fecha de nacimiento</label>
                    <input autocomplete="off" id="fecha_nacimiento" name="fecha_nacimiento"  class="form-control" value="<?php echo (isset($datos['fecha_nacimiento']))?$datos['fecha_nacimiento']:''; ?>" type="text">
                <p class="help-block"></p>
              </div>
            </div>
            <div  class="col col-lg-6">
              <div class="form-group  label-floating">
                  <label class="control-label" for="edad">Edad</label>
                    <input autocomplete="off" id="edad" name="edad"  class="form-control" value="<?php echo (isset($datos['edad']))?$datos['edad']:''; ?>" type="text">
                <p class="help-block"></p>
              </div>
            </div>

            <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="idSexo">Sexo</label>
                  <select  id="idSexo" name="idSexo" class="form-control">
                      <option value=""></option>
                    <?php foreach($selects['sexo'] as $listaSexo){ ?>
                        <option value="<?php echo $listaSexo['idSexo'] ?>" <?php echo (isset($datos['idSexo']) && $listaSexo['idSexo'] == $datos['idSexo'])?'selected':''; ?>><?php echo $listaSexo['nombreSexo'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>

            <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="id_estado_civil">Estado Civil</label>
                  <select  id="id_estado_civil" name="id_estado_civil" class="form-control">
                      <option value=""></option>
                    <?php foreach($selects['estadoCivil'] as $estadoCivil){ ?>
                        <option value="<?php echo $estadoCivil['id_estado_civil'] ?>" <?php echo (isset($datos['id_estado_civil']) && $estadoCivil['id_estado_civil'] == $datos['id_estado_civil'])?'selected':''; ?>><?php echo $estadoCivil['des_estado_civil'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>

            <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="id_ocupacion">Ocupación</label>
                  <select  id="id_ocupacion" name="id_ocupacion" class="form-control">
                      <option value=""></option>
                    <?php foreach($selects['ocupaciones'] as $ocupaciones){ ?>
                        <option value="<?php echo $ocupaciones['id_ocupacion'] ?>" <?php echo (isset($datos['id_ocupacion']) && $ocupaciones['id_ocupacion'] == $datos['id_ocupacion'])?'selected':''; ?>><?php echo $ocupaciones['descripcion'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>

            <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="id_escolaridad">Escolaridad</label>
                  <select  id="id_escolaridad" name="id_escolaridad" class="form-control">
                      <option value=""></option>
                    <?php foreach($selects['escolaridad'] as $escolaridad){ ?>
                        <option value="<?php echo $escolaridad['id_escolaridad'] ?>" <?php echo (isset($datos['id_escolaridad']) && $escolaridad['id_escolaridad'] == $datos['id_escolaridad'])?'selected':''; ?>><?php echo $escolaridad['niveleducativo'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>

            <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="id_religion">Religión</label>
                  <select  id="id_religion" name="id_religion" class="form-control">
                      <option value=""></option>
                    <?php foreach($selects['religion'] as $religion){ ?>
                        <option value="<?php echo $religion['id_religion'] ?>" <?php echo (isset($datos['id_religion']) && $religion['id_religion'] == $datos['id_religion'])?'selected':''; ?>><?php echo $religion['des_religiones'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>

            <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="id_grupo_etnico">Grupo étnico</label>
                  <select  id="id_grupo_etnico" name="id_grupo_etnico" class="form-control">
                      <option value=""></option>
                    <?php foreach($selects['grupoEtnico'] as $grupoEtnico){ ?>
                        <option value="<?php echo $grupoEtnico['id_grupo_etnico'] ?>" <?php echo (isset($datos['id_grupo_etnico']) && $grupoEtnico['id_grupo_etnico'] == $datos['id_grupo_etnico'])?'selected':''; ?>><?php echo $grupoEtnico['grupo_etnia'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>

            <div  class="col col-lg-6">
              <div class="form-group  label-floating">
                  <label class="control-label" for="ciudadPaciente">Ciudad de residencia</label>
                  <select  id="ciudadPaciente" name="ciudadPaciente" class="form-control">
                      <option value=""></option>
                      <?php foreach($selects['ciudades'] as $listaProf){ 
                          $cidDoc = $listaProf['ID_DPTO']."-".$listaProf['ID_CIUDAD'];
                        ?>
                          <option value="<?php echo $cidDoc ?>" <?php echo (isset($datos['ciudadPaciente']) && $cidDoc == $datos['ciudadPaciente'])?'selected':''; ?>><?php echo $listaProf['NOMBRE'] ?></option>
                      <?php } ?>
                  </select>
              </div>
            </div>

            <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="direccion_paciente"> Dirección de residencia</label>
                  <input autocomplete="off" id="direccion_paciente" name="direccion_paciente"  class="form-control" value="<?php echo (isset($datos['direccion_paciente']))?$datos['direccion_paciente']:''; ?>"  type="text">
                  <p class="help-block"></p>
                </div> 
            </div>
            <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="barrio_paciente"> Barrio</label>
                  <input autocomplete="off" id="barrio_paciente" name="barrio_paciente"  class="form-control" value="<?php echo (isset($datos['barrio_paciente']))?$datos['barrio_paciente']:''; ?>"  type="text">
                  <p class="help-block"></p>
                </div> 
            </div>
           <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="telefono_paciente">Teléfono de contacto</label>
                  <input autocomplete="off" id="telefono_paciente" name="telefono_paciente"  class="form-control" value="<?php echo (isset($datos['telefono_paciente']))?$datos['telefono_paciente']:''; ?>"  type="text">
                  <p class="help-block">Sin caracteres especiales</p>
                </div> 
            </div>
           <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="celular_paciente">Celular de contacto</label>
                  <input autocomplete="off" id="celular_paciente" name="celular_paciente"  class="form-control" value="<?php echo (isset($datos['celular_paciente']))?$datos['celular_paciente']:''; ?>"  type="text">
                  <p class="help-block">Sin caracteres especiales</p>
                </div> 
            </div>

            <div  class="col col-lg-6">
              <div class="form-group  label-floating">
                  <label class="control-label" for="email_paciente">Correo electrónico</label>
                    <input autocomplete="off" id="email_paciente" name="email_paciente"  class="form-control" value="<?php echo (isset($datos['email_paciente']))?$datos['email_paciente']:''; ?>" type="text">
                    <p class="help-block">Este dato será el usuario de inicio de sesión</p>
              </div>
            </div>

            <div  class="col col-lg-6">
                <?php if($edita == 1){ ?>
                  <div class="form-group  label-floating"">
                    <label class="control-label" for="estado">Estado del paciente</label>
                    <select class=" form-control" id="estado" name="estado">
                      <option value="1" <?php if($datos['estado'] == 1){?>selected<?php }?>>Activo</option>
                      <option value="0" <?php if($datos['estado'] == 0){?>selected<?php }?>>Inactivo</option>
                    </select>
                  </div> 
                  <input id="idPaciente" name="idPaciente" value="<?php echo $idPaciente ?>" type="hidden">
                <?php } ?>
            </div>

         </div>
         <div class="row">
            <div class="col col-lg-12">
              <h3>DATOS DEL ACOMPAÑANTE</h3>
            </div> 
            <div class="col col-lg-6">
                <div class="form-group label-floating">
                  <label class="control-label" for="tip_doc_pac_aco">Tipo de documento</label>
                  <select   id="tip_doc_pac_aco" name="tip_doc_pac_aco" class="form-control">
                      <option value=""></option>
                    <?php foreach($selects['tiposDoc'] as $listaTD){ ?>
                        <option value="<?php echo $listaTD['idTipoDoc'] ?>" <?php echo (isset($datos['tip_doc_pac_aco']) && $listaTD['idTipoDoc'] == $datos['tip_doc_pac_aco'])?'selected':''; ?>><?php echo $listaTD['nombreTipoDoc'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>
            <div  class="col col-lg-6">
              <div class="form-group  label-floating">
                  <label class="control-label" for="num_doc_aco">Documento de identidad</label>
                    <input  autocomplete="off" id="num_doc_aco" name="num_doc_aco"  class="form-control" value="<?php echo (isset($datos['num_doc_aco']))?$datos['num_doc_aco']:''; ?>" type="text">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="nombre_aco">Nombres del acompañante</label>
                  <input  autocomplete="off" id="nombre_aco" name="nombre_aco"  class="form-control" value="<?php echo (isset($datos['nombre_aco']))?$datos['nombre_aco']:''; ?>"  type="text">
                  <p class="help-block"></p>
                </div> 
            </div>



            <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="id_estado_civil_aco">Estado Civil</label>
                  <select id="id_estado_civil_aco" name="id_estado_civil_aco" class="form-control">
                      <option value=""></option>
                    <?php foreach($selects['estadoCivil'] as $estadoCivilAco){ ?>
                        <option value="<?php echo $estadoCivilAco['id_estado_civil'] ?>" <?php echo (isset($datos['id_estado_civil_aco']) && $estadoCivilAco['id_estado_civil'] == $datos['id_estado_civil_aco'])?'selected':''; ?>><?php echo $estadoCivilAco['des_estado_civil'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>

            <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="id_ocupacion_aco">Ocupación</label>
                  <select id="id_ocupacion_aco" name="id_ocupacion_aco" class="form-control">
                      <option value=""></option>
                    <?php foreach($selects['ocupaciones'] as $ocupacionesAco){ ?>
                        <option value="<?php echo $ocupacionesAco['id_ocupacion'] ?>" <?php echo (isset($datos['id_ocupacion_aco']) && $ocupacionesAco['id_ocupacion'] == $datos['id_ocupacion_aco'])?'selected':''; ?>><?php echo $ocupacionesAco['descripcion'] ?></option>
                    <?php } ?>
                  </select>
                </div> 
            </div>
           <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="telefono_aco">Teléfono de contacto</label>
                  <input autocomplete="off" id="telefono_aco" name="telefono_aco"  class="form-control" value="<?php echo (isset($datos['telefono_aco']))?$datos['telefono_aco']:''; ?>"  type="text">
                  <p class="help-block">Sin caracteres especiales</p>
                </div> 
            </div>


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