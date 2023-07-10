<!-- <div class="container">
  <div class="row">
    <div class="col-lg-12">
        <div class="container-fluid text-center" style="margin-top:10%">
              <form class="form-signin" data-ember-action="2" id="formCambioClave" ng-submit="recordarClaveUsuario()">
                <img src="<?php echo base_url()?>res/img/logo.png" width="100%"><br><br>
                <h2 class="form-signin-heading">RECORDAR CONTRASEÑA</h2>
                <small class="text-muted">Escriba el correo electrónico con el cual se encuentra registrado.</small>
                <div class="row-picture" style="margin:10% 0 0 0">
                  <img class="img img-circle" id="miniatura" ng-src="{{fotoLogin}}" alt="icon" width="35%">
                </div>
                <input name="usuario" autocomplete="off" ng-change="getPicture()" ng-model="usuario" id="usuario" class="ember-view ember-text-field form-control login-input" placeholder="<?php echo lang("placeHolderCorreo") ?>" type="text">
                <button class="btn btn-raised btn-danger" data-bindattr-3="3">ENVIAR NUEVA CLAVE</button>
                <br><br>

              </form>
      </div>
    </div>
  </div>

</div> -->



<div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block fondo-login"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">¿Olvidó su clave?</h1>
                                        No se preocupe, ingrese el correo con el que habitualmente ingresa para enviarle una nueva</p>
                                    </div>
                                    <form class="user" id="formCambioClave" ng-submit="recordarClaveUsuario()">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"  aria-describedby="emailHelp"placeholder="Correo electrónico..." name="usuario" ng-model="usuario" id="usuario">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Recuperar clave
                                        </button>
                                    </form>
                                    <hr>
                                    <!-- <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url()?>login">¿Ya tiene una cuenta? ingresar!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>