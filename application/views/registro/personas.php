<div class="container">
    <script id="metamorph-1-start" type="text/x-placeholder"></script><script id="metamorph-21-start" type="text/x-placeholder"></script>
    <div class="container text-center" style="margin-top:8%">
        <h2 class="form-signin-heading"><?php echo lang("tituloRegistroPer") ?></h2>
        <small class="text-muted"><?php echo lang("regP_textoBienvenida") ?></small><br><br>
        <form class="form-registro bs-component" id="formRegEmpresas" role="form" ng-submit="registraPersona()">
        <fieldset>
        <div class="row">
          <div class="col-lg-6">
                 <div class="form-group" id="cajaNombreEmpresa">
                  <input tabindex="1" id="nombre" name="nombre" ng-model="nombre" class="ember-view ember-text-field form-control login-input" placeholder="<?php echo lang("plh_nombre_persona") ?>"  type="text">
                  <p class="help-block"><?php echo lang('txtInfo9') ?></p>
                </div>
                <div class="form-group">
                  <select tabindex="5" id="departamento" name="departamento" ng-model="departamento"   class="ember-view ember-text-field form-control login-input-pass" ng-change="getCiudad()">
                      <option value=""><?php echo lang('lbl_sel_depto') ?></option>
                      <?php foreach($listaDeptos as $deptos){ ?>
                        <option value="<?php echo $deptos['ID_DPTO']?>"><?php echo strtoupper($deptos['NOMBRE'])?></option>
                      <?php }?>
                  </select>
                  <p class="help-block"><?php echo lang('txtInfo10') ?></p>
                </div>
            
                <div class="form-group">
                  <input tabindex="7" id="clave" name="clave" ng-model="clave" class="ember-view ember-text-field form-control login-input" placeholder="<?php echo lang("plh_clave") ?>" type="password">
                  <p class="help-block"><?php echo lang('txtInfo7') ?></p>
                </div>
          </div>
          <div class="col-lg-6">

                <div class="form-group">
                  <input tabindex="4" id="email" name="email" ng-model="email" class="ember-view ember-text-field form-control login-input-pass" placeholder="<?php echo lang("plh_mail") ?>" type="email">
                  <p class="help-block"><?php echo lang('txtInfo4') ?></p>
                </div>
                <div class="form-group">
                  <select tabindex="6" id="ciudad" name="ciudad" ng-model="ciudad"   class="ember-view ember-text-field form-control login-input-pass">
                      <option value=""><?php echo lang('lbl_sel_ciudad') ?></option>
                      <option ng-repeat="ciu in ciudadesSelect.datos" value="{{ciu.ID_CIUDAD}}">{{ciu.NOMBRE}}</option>
                  </select>
                  <p class="help-block"><?php echo lang('txtInfo11') ?></p>
                </div>
            
                <div class="form-group">
                  <input tabindex="8" id="rclave" name="rclave" ng-model="rclave" class="ember-view ember-text-field form-control login-input" placeholder="<?php echo lang("plh_rclave") ?>" type="password">
                  <p class="help-block"><?php echo lang('txtInfo8') ?></p>
                </div>

          </div>
          <div class="col-lg-12">
              <div class="checkbox">
              <label>
                <input type="checkbox" id="terminos" name="terminos" ng-model="terminos"> <?php echo lang('plh_terminos') ?>
              </label>
            </div>
          </div>
        </div>


        

            <br><br>
          <script id="metamorph-22-start" type="text/x-placeholder"></script><script id="metamorph-22-end" type="text/x-placeholder"></script>
          <button class="btn btn-raised btn-primary" data-bindattr-3="3"><?php echo lang("reg_btn_registroEm") ?></button>
          <br><br><br>
          <a href="<?php echo base_url()?>" class="ember-view btn btn-sm btn-default"> <?php echo lang("reg_btn_cancelar") ?> </a>
          </fieldset>
        </form>
  </div>
</div>