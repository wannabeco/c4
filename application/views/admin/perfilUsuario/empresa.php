<div class="container-fluid"  ng-controller="perfilEmpresa" ng-init="initPerfilEmpresa()" data-infoEmpresa ="<?php echo $idEmpresa;?>" id="InfoEmpresa">
    <!-- modal estandar-->
    <div id="modalUsuarios" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div id="modalFoto" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
                <form role="form"  id="formFotoPerfil" ng-submit="cambioFotoPerfil()" enctype="multipart/form-data">    
                    <div class="modal-header">
                      <h5 class="modal-title">Logo de emrpesa</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body"> 
                      <p class="text-justify">
                          Podrá elegir de su computadora una fotografía para acompañar su perfil. Esta fotografía debe estar en formato PNG, JPG ó GIF, no debe ser mayor a 2 MB y debe guardar la proporción de tamaño de 800 X 800 máximo (Cuadrado perfecto).
                        </p>
                        <input type="file" class="file" name="fotoPerfil" />
                        <input id="idUsuarioFoto" name="idUsuarioFoto"  class="form-control" value="<?php echo (isset($datos['idPersona']))?$datos['idPersona']:''; ?>" type="hidden">
                    </div>
                  <div class="modal-footer">
                    <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
                      <button type="submit" class="btn btn-raised btn-primary">CAMBIAR FOTO</button>
                  </div>
                </form>
            </div>
        </div>
    </div>

    <!-- cabecera de la plantilla-->
    <h1 class="h3 mb-4 text-gray-800">
        Datos de empresa
    </h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"  style="background-color:transparent !important">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Datos empresa</li>
        </ol>
    </nav>
    <!-- fin cabecera-->


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Información de empresa</h6>
        </div>
        <div class="card-body">
            <!-- Inicio formulario-->
              <div class="row">
                <div class="col col-lg-12">
                    <h3 class="text-center">DATOS EMPRESARIALES</h3>
                    <form role="form" name="dataEmpresa" id="dataEmpresa" ng-submit="procesaDataEmpresa()">
                          <div class="row">
                              <div class="col col-lg-12 text-center">
                                <div class="col col-lg-3 float-left" style="height: 100px;"></div>
                                <div class="col col-lg-6 col-md-6 text-center float-left">
                                  <div class="row-picture" style="margin:10% 0 0 0">
                                  <a data-toggle="modal" data-target="#modalFoto" style="cursor: pointer">
                                      <?php if($datos['icono'] != ""){ ?>
                                      <center>
                                          <div style="box-shadow:inset 0px 0px 3px #999;border:1px solid #999;border-radius:200px;width:150px;height:150px;background: url(<?php echo base_url()."res/fotos/personas/".$datos['idPersona']."/".$datos['icono'] ?>) no-repeat center center;background-size:120% "></div>
                                          <!--<img class="img img-circle" id="miniatura" src="<?php echo base_url()."res/fotos/personas/".$datos['idPersona']."/".$datos['icono'] ?>" alt="icon" width="35%">-->
                                      </center><br><br>
                                    <?php }else{ ?>
                                          <center><img class="img img-circle" id="miniatura" src="<?php echo base_url()."res/img/user.jpg" ?>" alt="icon" width="25%"></center><br><br>
                                    <?php } ?>
                                    </a>
                                  </div>
                                  <center><span class="small" style="margin:-10% 0 0 0">Click sobre el logo para cambiarlo</span></center><br><br>
                                </div>
                              </div>
                              <div class="col col-lg-4">
                                  <div class="form-group label-floating">
                                      <label class="control-label" for="tipoDocumento">Tipo de documento</label>
                                      <select  id="tipoDocumento" name="tipoDocumento" class="form-control">
                                          <option value=""></option>
                                        <?php  foreach($selects['tiposDoc'] as $listaTD){ ?>
                                            <option value="<?php echo $listaTD['idTipoDoc'] ?>" <?php echo (isset($datos['tipoDocumento']) && $listaTD['idTipoDoc'] == $datos['tipoDocumento'])?'selected':''; ?>><?php echo $listaTD['nombreTipoDoc'] ?></option>
                                        <?php } ?>
                                      </select>
                                  </div> 
                              </div>

                              <div class="col col-lg-4">
                                  <div class="form-group  label-floating">
                                      <label class="control-label" for="nroDocumento">NIT / RUT</label>
                                        <input autocomplete="off" id="nroDocumento" name="nroDocumento"  class="form-control" value="<?php echo (isset($datos['nroDocumento']))?$datos['nroDocumento']:''; ?>" type="text">
                                    <p class="help-block">Sin código de verificación</p>
                                  </div>
                              </div>

                              <div class="col col-lg-4">
                                  <div class="form-group  label-floating">
                                    <label class="control-label" for="nombre">Nombre de empresa</label>
                                    <input  autocomplete="off" id="nombre" name="nombre"  class="form-control" value="<?php echo (isset($datos['nombre']))?$datos['nombre']:''; ?>"  type="text">
                                    <p class="help-block"></p>
                                  </div> 
                              </div>
                              <div class="col col-lg-4">
                                  <div class="form-group  label-floating">
                                    <label class="control-label" for="departamento"> Departamento</label>
                                    <select name="departamento" id="departamento" class="form-control" ng-change="getCiudades()" ng-model="idDepartamento">
                                          <option value=""> Seleccione...</option>
                                          <option  ng-repeat="deptos in departamentos" value="{{deptos.ID_DPTO}}">{{deptos.NOMBRE}}</option>
                                    </select>
                                  </div> 
                              </div>
                              <div class="col col-lg-4">
                                  <div class="form-group  label-floating">
                                    <label class="control-label" for="ciudad"> Ciudad</label>
                                    <select name="ciudad" id="ciudad" class="form-control" ng-model="ciudad">
                                        <option value=""> Seleccione...</option>
                                        <option ng-repeat="ciudad in ciudades"value="{{ciudad.ID_CIUDAD}}">{{ciudad.NOMBRE}}</option>
                                    </select>
                                  </div> 
                              </div>
                              <div class="col col-lg-4">
                                  <div class="form-group  label-floating">
                                    <label class="control-label" for="direccion"> Dirección fiscal</label>
                                    <input  autocomplete="off" id="direccion" name="direccion"  class="form-control" value="<?php echo (isset($datos['direccion']))?$datos['direccion']:''; ?>"  type="text">
                                    <p class="help-block"></p>
                                  </div> 
                              </div>
                            <div class="col col-lg-4">
                                  <div class="form-group  label-floating">
                                    <label class="control-label" for="telefono">Teléfono de contacto</label>
                                    <input  autocomplete="off" id="telefono" name="telefono"  class="form-control" value="<?php echo (isset($datos['telefono']))?$datos['telefono']:''; ?>"  type="text">
                                    <p class="help-block">Sin caracteres especiales</p>
                                  </div> 
                              </div>
                            <div  class="col col-lg-4">
                              <div class="form-group  label-floating">
                                  <label class="control-label" for="email">Correo electrónico</label>
                                    <input autocomplete="off" id="email" name="email"  class="form-control" value="<?php echo (isset($datos['email']))?$datos['email']:''; ?>" type="text">
                                    <p class="help-block"></p>
                              </div>
                              <input id="idEmpresa" name="idEmpresa"  class="form-control" value="<?php echo (isset($datos['idEmpresa']))?$datos['idEmpresa']:''; ?>" type="hidden">
                            </div>
                          <div  class="col col-lg-12 text-center">
                          <button type="submit" class="btn btn-raised btn-primary">ACTUALIZAR INFORMACIÓN</button>
                          </div>


                        </div>
                    </form>
                  </div>
                </div>
            </div>
          </div>
            <!-- fin Inicio formulario-->
        </div>
    </div>

</div>