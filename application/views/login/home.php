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
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido a <?php echo lang("titulo")?></h1>
                                    </div>
                                    <div class="row-picture" style="margin:10% 0 0 0">
                                      <center><img class="img img-circle" id="miniatura" ng-src="{{fotoLogin}}" alt="icon" width="35%" style="margin:auto !important;border-radius:50% 50% 50% 50%"></center><br>
                                    </div>
                                    <form class="user" id="formLogin" ng-submit="loginInApp()">
                                        <div class="form-group">
                                            <input type="email" ng-change="getPicture()" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Correo electrónico" name="usuario" ng-model="usuario" id="usuario" >
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" placeholder="Contraseña" name="clave" ng-model="clave" id="clave">
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            <?php echo lang("labelBtnLogin") ?>
                                        </button>
                                        <!-- <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url() ?>Inicio/recordarClave">¿Recordar contraseña?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url() ?>Inicio/creaEmpresa">Crea una cuenta!</a><br>
                                        <small>V 2.0 &copy;<?php echo date("Y") ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>