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
                                    <a class="small text-danger" href="<?php echo base_url()?>login">¿Ya tiene una cuenta? ingresar!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>