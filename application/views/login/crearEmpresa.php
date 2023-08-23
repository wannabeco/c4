<div ng-controller="creaEmpresa" ng-init="initcreaEmpresa()">
    <div class="container"  ><?php $infoEmpresas;?>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block fondo-login"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Crear cuenta en <?php echo lang("titulo")?></h1>
                            </div>
                            <div class="form-group col-md-12 float-left">
                            <label>
                                <input type="radio" name="registro1" id="registro1" value="1" ng-model="registro" ng-checked="isFirstRadioSelected"/>
                                <span>Empresas</span>
                            </label>

                            <label class="text-rigth" style="float: right;">
                                <input type="radio" name="registro2" id="registro2" value="2" ng-model="registro">
                                <span> Oficial de cumplimiento</span>
                            </label>
                            </div>
                                <!-- registro de empresa -->
                                <div ng-if="registro == 1">
                                    <form class="user" id="dataEmpresa" role="form" ng-submit="registraEmpresa()">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="nombre" name="nombre" placeholder="Nombre Empresa" autocomplete="off">
                                            </div>
                                            <div class="col-sm-6">
                                                <select class="form-control" id="tipoEmpresa" name="tipoEmpresa" style="border-radius: 10rem;height: 49px; font-size:.8rem;">
                                                    <option value="0" selected> Seleccione el tipo de empresa</option> 
                                                    <?php foreach($infoEmpresas as $tipoEmpresas){ ?> 
                                                        <option <?php if(isset($infoEmpresas['idTipoEmpresa']) && $infoEmpresas['idTipoEmpresa'] == $tipoEmpresas['idTipoEmpresa']){ ?> selected<?php } ?> value="<?php echo $tipoEmpresas['idTipoEmpresa']; ?>"><?php echo $tipoEmpresas['TipoEmpresa']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="nombreUsuario" name="nombreUsuario" placeholder="Nombres" autocomplete="off">
                                            </div>
        
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-user" id="apellido" name="apellido" placeholder="Apellidos" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email" name="email"placeholder="Correo Electrónico" autocomplete="off"> 
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user" name="clave" id="clave" placeholder="Contraseña">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user" id="rclave" name="rclave" placeholder="Repita contraseña">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">Continuar</button>
                                        <hr>
                                    </form>
                                </div>
                            <!-- fin registro empresa -->
                            <!-- registro de oficial de cumplimiento -->
                                <div ng-if="registro == 2">
                                    <form class="user" id="dataOficial" role="form" ng-submit="registraOficial()">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="nombreUsuarios" name="nombreUsuarios" placeholder="Nombres" autocomplete="off">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-user" id="apellidos" name="apellidos" placeholder="Apellidos" autocomplete="off">
                                            </div>  
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                <input type="number" class="form-control form-control-user" id="celular" name="celular" placeholder="3110000000" maxlength="10" autocomplete="off">
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-12 form-group" style="padding:0px;">
                                            <select class="form-control" id="empresa" name="empresa" style="border-radius: 10rem;height: 49px; font-size:.8rem;">
                                                <option value="0" selected> Seleccione la empresa</option> 
                                                <?php foreach($infoEmpresa as $Empresa){ ?> 
                                                    <option <?php if(isset($infoEmpresa['idEmpresa']) && $infoEmpresa['idEmpresa'] == $Empresa['idEmpresa']){ ?> selected<?php } ?> value="<?php echo $Empresa['idEmpresa']; ?>"><?php echo $Empresa['nombre']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div> -->
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" id="email" name="email"placeholder="Correo Electrónico" autocomplete="off"> 
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="password" class="form-control form-control-user" name="clave" id="clave" placeholder="Contraseña">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="password" class="form-control form-control-user" id="rclave" name="rclave" placeholder="Repita contraseña">
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Continuar">
                                            <!-- <button class="btn btn-primary btn-user btn-block">Registrar</button> -->
                                            <hr>
                                    </form>
                                </div>
                            <!-- fin registro de oficial de cumplimiento -->
                            <div class="text-center">
                                <a class="small text-danger" href="<?php echo base_url() ?>Inicio/recordarClave">¿Recordar contraseña?</a><br>
                            </div>
                            <div class="text-center">
                                <a class="small text-danger" href="<?php echo base_url() ?>login">¿Ya tienes una cuenta?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var registro1 = document.getElementById("registro1");
        registro1.checked = true;
    });
</script>