<form role="form" method="POST"  ng-controller="checkeador" id="formulario" ng-init="initcheckeador()"  ng-submit="checkboxes()">
    <div class="modal-header">
        <h5 class="modal-title pl-5"><?php echo $titulo ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
        </button>
    </div>
    <?php if($dita = 1){?>
        <input type="text" id="CheckConsultados" value="<?php echo json_encode($consultacheck);?>" hidden>
    <?php }?>
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group pl-4 pt-5" style="margin-bottom: 0px;">
                <?php if($_SESSION['project']['info']["idPerfil"] != 8){?>
                    <label for="nombre"><strong> Nombre:</strong> <?php echo $_SESSION['project']['info']["nombre"]." ".$_SESSION['project']['info']["apellido"];?></label>
                <?php } if($_SESSION['project']['info']["idPerfil"] == 8){?>
                    <label for="nombre"><strong> Nombre: <?php echo $informacionPersona[0]["nombre"]." ".$informacionPersona[0]["apellido"];?></strong></label>
                <?php }?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group pl-4" style="margin-bottom: 0px;">
            <label for="cargo"><strong>Cargo:</strong><?php echo $infoUsuario[0]['nombrePerfil']; ?></label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group pl-4" style="margin-bottom: 0px;">
                <?php if($_SESSION['project']['info']["idPerfil"] != 8){?>
                    <label for="fecha"><strong>Fecha de Diligenciamiento de Formato:</strong> <?php echo formatoFechaEspanol($fecha); ?></label>
                    <?php } if($_SESSION['project']['info']["idPerfil"] == 8){?>
                        <label for="fecha"><strong>Fecha de Diligenciamiento de Formato:</strong> <?php echo formatoFechaEspanol($consulta["datos"][0]["fechaRespuesta"]); ?></label>
                    <?php }?>
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
        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?>
            <div class="form-group col-md-8 float-left">
        <?php }if($_SESSION['project']['info']["idPerfil"] == 8){?>
            <div class="form-group col-md-7 float-left">
        <?php }?>
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
            <?php if($_SESSION['project']['info']["idPerfil"] == 8){?>
                <div class="col-md-2 float-left">
                    <label for="">Oficial</label>
                </div>
            <?php }?>
        </div>
        <!-- pregunta 1 -->
        <div class="col-md-12 bg-light">
            <div class="form-group">
                <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="col-md-8 float-left text-justify"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="col-md-7 float-left text-justify"><?php }?>
                    <label>¿Se completó el procedimiento de acuerdo con los lineamientos establecidos en los manuales?</label>
                </div>
                <?php if($_SESSION['project']['info']["idPerfil"] != 8){?> <div class="col-md-4 float-left"> <?php }if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="col-md-3 float-left"><?php }?>
                    <div class="checkboxes pt-3">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input text-secondary" id="pregunta1" name="pregunta1" style="height: 22px; width:22px;" value="SI" ng-click="mostrarInput1()" ng-checked="respuestas[0] == SI" ng-disabled="perfilUsuario == 8">
                            <label class="form-check-label" for="pregunta1"></label>
                        </div>
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="form-check form-check-inline pl-3"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="form-check form-check-inline pl-5"><?php }?>
                            <input type="radio" class="form-check-input text-secondary" id="pregunta1" name="pregunta1" style="height: 22px; width:22px;" value="NO" ng-click="ocultaInput1()" ng-checked="respuestas[0] == NO" ng-disabled="perfilUsuario == 8">
                            <label class="form-check-label" for="pregunta1"></label>
                        </div>
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="form-check form-check-inline pl-3"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="form-check form-check-inline pl-5"><?php }?>
                            <input type="radio" class="form-check-input text-secondary" id="pregunta1" name="pregunta1" style="height: 22px; width:22px;" value="NO/A" ng-click="ocultaInput1()" ng-checked="respuestas[0] == NO/A" ng-disabled="perfilUsuario == 8">
                            <label class="form-check-label" for="pregunta1"></label>
                        </div>
                    </div>
                </div>
                <?php if($_SESSION['project']['info']["idPerfil"] == 8){?>
                <div class="col-md-2 float-left">
                    <div class="checkboxes pt-3">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input text-secondary" id="pregunta1o" name="pregunta1o" style="height: 22px; width:22px;" value="SI">
                            <label class="form-check-label" for="pregunta1">SI</label>
                        </div>
                        <div class="form-check form-check-inline pl-3">
                            <input type="radio" class="form-check-input text-secondary" id="pregunta1o" name="pregunta1o" style="height: 22px; width:22px;" value="NO">
                            <label class="form-check-label" for="pregunta1">NO</label>
                        </div>
                    </div>
                </div>
                <?php }?>
                <div class="col-md-10 float-left text-justify">
                    <div class="custom-file" id="archivoPregunta1">
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?>
                            <label for="archivo">Seleccione un archivo:</label>
                            <input type="file" name="fotoFile1" id="fotoFile1" onchange="angular.element(this).scope().uploadPic('fotoFile1','fotoPresentacion','botonfoto1','preloaderfoto1','archivo1')">
                            <input type="hidden" name="archivo1" id="archivo1" value="{{urlArchivo1}}">
                                <a href="<?php echo base_url()."assets/uploads/files/".$_SESSION['project']['info']['idEmpresa']; ?>/{{ urlArchivo1 }}" target="_blank" title="Documento actual">
                                    <button type="button" class="btn btn-raised btn-primary"><i class="fas fa-download"></i></button>
                                </a>
                        <?php } if($_SESSION['project']['info']["idPerfil"] == 8){?>
                            <input type="hidden" name="archivo1" id="archivo1" value="{{ urlArchivo1}}">
                            <a href="<?php echo base_url()."assets/uploads/files/".$_SESSION['project']['info']['idEmpresa']; ?>/{{ urlArchivo1 }}" target="_blank" title="Documento actual">
                                <button type="button" class="btn btn-raised btn-primary"><i class="fas fa-file-pdf"></i></button>
                            </a>
                        <?php }?>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
        <!-- pregunta 2 -->
        <div class="col-md-12 pt-2">
            <div class="form-group">
            <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="col-md-8 float-left text-justify"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="col-md-7 float-left text-justify"><?php }?>
                    <label>¿Se revisó que el procedimiento se haya realizado con apego a la normativa vigente?</label>
                </div>
                <?php if($_SESSION['project']['info']["idPerfil"] != 8){?> <div class="col-md-4 float-left"> <?php }if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="col-md-3 float-left"><?php }?>
                    <div class="checkboxes pt-3">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input text-secondary" id="pregunta2" name="pregunta2" style="height: 22px; width:22px;" value="SI" ng-click="mostrarInput2()" ng-checked="respuestas[1] == SI">
                            <label class="form-check-label" for="si"></label>
                        </div>
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="form-check form-check-inline pl-3"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="form-check form-check-inline pl-5"><?php }?>
                            <input type="radio" class="form-check-input text-secondary" id="pregunta2" name="pregunta2" style="height: 22px; width:22px;" value="NO" ng-click="ocultaInput2()" ng-checked="respuestas[1] == NO">
                            <label class="form-check-label" for="no"></label>
                        </div>
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="form-check form-check-inline pl-3"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="form-check form-check-inline pl-5"><?php }?>
                            <input type="radio" class="form-check-input text-secondary" id="pregunta2" name="pregunta2" style="height: 22px; width:22px;" value="NO/A" ng-click="ocultaInput2()" ng-checked="respuestas[1] == NO/A">
                            <label class="form-check-label" for="noa"></label>
                        </div>
                    </div>
                </div>
                <?php if($_SESSION['project']['info']["idPerfil"] == 8){?>
                    <div class="col-md-2 float-left">
                        <div class="checkboxes pt-3">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input text-secondary" id="pregunta2o" name="pregunta2o" style="height: 22px; width:22px;" value="SI">
                                <label class="form-check-label" for="pregunta1">SI</label>
                            </div>
                            <div class="form-check form-check-inline pl-3">
                                <input type="radio" class="form-check-input text-secondary" id="pregunta2o" name="pregunta2o" style="height: 22px; width:22px;" value="NO">
                                <label class="form-check-label" for="pregunta1">NO</label>
                            </div>
                        </div>
                    </div>
                <?php }?>
                <div class="col-md-10 float-left text-justify">
                    <div class="custom-file" id="archivoPregunta2">
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?>
                            <label for="archivo2">Seleccione un archivo:</label>
                            <!-- <input type="file" id="archivo2" name="archivo2" accept=".pdf"><br><br> -->
                            <input type="file" name="fotoFile2" id="fotoFile2" onchange="angular.element(this).scope().uploadPic('fotoFile2','fotoPresentacion','botonfoto2','preloaderfoto2','archivo2')">
                            <input type="hidden" name="archivo2" id="archivo2" value="{{urlArchivo2}}">
                            <a href="<?php echo base_url()."assets/uploads/files/".$_SESSION['project']['info']['idEmpresa']."/"; ?>{{urlArchivo2}}" target="_blank" title="Documento actual">
                                <button type="button" class="btn btn-raised btn-primary"><i class="fas fa-download"></i></button>
                            </a>
                        <?php } if($_SESSION['project']['info']["idPerfil"] == 8){?>
                            <input type="hidden" name="archivo1" id="archivo1" value="{{ urlArchivo2}}">
                            <a href="<?php echo base_url()."assets/uploads/files/".$_SESSION['project']['info']['idEmpresa']; ?>/{{ urlArchivo2 }}" target="_blank" title="Documento actual">
                                <button type="button" class="btn btn-raised btn-primary"><i class="fas fa-file-pdf"></i></button>
                            </a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <!-- pregunta3 -->
        <div class="col-md-12 bg-light pt-2">
            <div class="form-group">
                    <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="col-md-8 float-left text-justify"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="col-md-7 float-left text-justify"><?php }?>
                    <label> ¿Se recibió el reporte de información pertinente de los analistas y/o responsables del procedimiento de acuerdo con el procedimiento?</label>
                </div>
                <?php if($_SESSION['project']['info']["idPerfil"] != 8){?> <div class="col-md-4 float-left"> <?php }if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="col-md-3 float-left"><?php }?>
                    <div class="checkboxes pt-3">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input text-secondary" id="pregunta3" name="pregunta3" style="height: 22px; width:22px;" value="SI" ng-click="mostrarInput3()" ng-checked="respuestas[2] == SI">
                            <label class="form-check-label" for="si"></label>
                        </div>
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="form-check form-check-inline pl-3"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="form-check form-check-inline pl-5"><?php }?>
                            <input type="radio" class="form-check-input text-secondary" id="pregunta3" name="pregunta3" style="height: 22px; width:22px;" value="NO" ng-click="ocultaInput3()" ng-checked="respuestas[2] == NO">
                            <label class="form-check-label" for="no"></label>
                        </div>
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="form-check form-check-inline pl-3"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="form-check form-check-inline pl-5"><?php }?>
                            <input type="radio" class="form-check-input text-secondary" id="pregunta3" name="pregunta3" style="height: 22px; width:22px;" value="NO/A" ng-click="ocultaInput3()" ng-checked="respuestas[2] == NO/A">
                            <label class="form-check-label" for="noa"></label>
                        </div>
                    </div>
                </div>
                <?php if($_SESSION['project']['info']["idPerfil"] == 8){?>
                    <div class="col-md-2 float-left">
                        <div class="checkboxes pt-3">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input text-secondary" id="pregunta3o" name="pregunta3o" style="height: 22px; width:22px;" value="SI">
                                <label class="form-check-label" for="pregunta1">SI</label>
                            </div>
                            <div class="form-check form-check-inline pl-3">
                                <input type="radio" class="form-check-input text-secondary" id="pregunta3o" name="pregunta3o" style="height: 22px; width:22px;" value="NO">
                                <label class="form-check-label" for="pregunta1">NO</label>
                            </div>
                        </div>
                    </div>
                <?php }?>
                <div class="col-md-10 float-left text-justify">
                    <div class="custom-file" id="archivoPregunta3">
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?>
                            <label for="archivo3">Seleccione un archivo:</label>
                            <input type="file" name="fotoFile3" id="fotoFile3" onchange="angular.element(this).scope().uploadPic('fotoFile3','fotoPresentacion','botonfoto3','preloaderfoto3','archivo3')">
                            <input type="hidden" name="archivo3" id="archivo3" value="{{urlArchivo3}}">
                            <a href="<?php echo base_url()."assets/uploads/files/".$_SESSION['project']['info']['idEmpresa']."/"; ?>{{urlArchivo3}}" target="_blank" title="Documento actual">
                                <button type="button" class="btn btn-raised btn-primary"><i class="fas fa-download"></i></button>
                            </a>
                        <?php } if($_SESSION['project']['info']["idPerfil"] == 8){?>
                            <input type="hidden" name="archivo1" id="archivo1" value="{{ urlArchivo3}}">
                            <a href="<?php echo base_url()."assets/uploads/files/".$_SESSION['project']['info']['idEmpresa']; ?>/{{ urlArchivo3 }}" target="_blank" title="Documento actual">
                                <button type="button" class="btn btn-raised btn-primary"><i class="fas fa-file-pdf"></i></button>
                            </a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <!-- pregunta 4 -->
        <div class="col-md-12 pt-2">
            <div class="form-group">
                    <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="col-md-8 float-left text-justify"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="col-md-7 float-left text-justify"><?php }?>
                    <label> ¿Se rindió reporte de la gestión al Área de Cumplimiento?</label>
                </div>
                <?php if($_SESSION['project']['info']["idPerfil"] != 8){?> <div class="col-md-4 float-left"> <?php }if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="col-md-3 float-left"><?php }?>
                    <div class="checkboxes">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input text-secondary" id="pregunta4" name="pregunta4" style="height: 22px; width:22px;" value="SI" ng-click="mostrarInput4()" ng-checked="respuestas[3] == SI">
                            <label class="form-check-label" for="si"></label>
                        </div>
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="form-check form-check-inline pl-3"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="form-check form-check-inline pl-5"><?php }?>
                            <input type="radio" class="form-check-input text-secondary" id="pregunta4" name="pregunta4" style="height: 22px; width:22px;" value="NO" ng-click="ocultaInput4()" ng-checked="respuestas[3] == NO">
                            <label class="form-check-label" for="no"></label>
                        </div>
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="form-check form-check-inline pl-3"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="form-check form-check-inline pl-5"><?php }?>
                            <input type="radio" class="form-check-input text-secondary" id="pregunta4" name="pregunta4" style="height: 22px; width:22px;" value="NO/A" ng-click="ocultaInput4()" ng-checked="respuestas[3] == NO/A">
                            <label class="form-check-label" for="noa"></label>
                        </div>
                    </div>
                </div>
                <?php if($_SESSION['project']['info']["idPerfil"] == 8){?>
                    <div class="col-md-2 float-left">
                        <div class="checkboxes pt-3">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input text-secondary" id="pregunta4o" name="pregunta4o" style="height: 22px; width:22px;" value="SI">
                                <label class="form-check-label" for="pregunta1">SI</label>
                            </div>
                            <div class="form-check form-check-inline pl-3">
                                <input type="radio" class="form-check-input text-secondary" id="pregunta4o" name="pregunta4o" style="height: 22px; width:22px;" value="NO">
                                <label class="form-check-label" for="pregunta1">NO</label>
                            </div>
                        </div>
                    </div>
                <?php }?>
                <div class="col-md-10 float-left text-justify">
                    <div class="custom-file" id="archivoPregunta4">
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?>
                            <label for="archivo4">Seleccione un archivo:</label>
                            <input type="file" name="fotoFile4" id="fotoFile4" onchange="angular.element(this).scope().uploadPic('fotoFile4','fotoPresentacion','botonfoto4','preloaderfoto4','archivo4')">
                            <input type="hidden" name="archivo4" id="archivo4" value="{{urlArchivo4}}">
                            <a href="<?php echo base_url()."assets/uploads/files/".$_SESSION['project']['info']['idEmpresa']."/"; ?>{{urlArchivo4}}" target="_blank" title="Documento actual">
                                <button type="button" class="btn btn-raised btn-primary"><i class="fas fa-download"></i></button>
                            </a>
                        <?php } if($_SESSION['project']['info']["idPerfil"] == 8){?>
                            <input type="hidden" name="archivo1" id="archivo1" value="{{ urlArchivo4}}">
                            <a href="<?php echo base_url()."assets/uploads/files/".$_SESSION['project']['info']['idEmpresa']; ?>/{{ urlArchivo4 }}" target="_blank" title="Documento actual">
                                <button type="button" class="btn btn-raised btn-primary"><i class="fas fa-file-pdf"></i></button>
                            </a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <!-- pregunta 5 -->
        <div class="col-md-12 bg-light pt-2">
            <div class="form-group">
                    <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="col-md-8 float-left text-justify"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="col-md-7 float-left text-justify"><?php }?>
                    <label>¿Se presentó alguna inconsistencia o falencia en el procedimiento?</label>
                </div>
                <?php if($_SESSION['project']['info']["idPerfil"] != 8){?> <div class="col-md-4 float-left"> <?php }if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="col-md-3 float-left"><?php }?>
                    <div class="checkboxes pt-3">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input text-secondary" id="pregunta5" name="pregunta5" style="height: 22px; width:22px;" value="SI" ng-click="mostrarInput5()" ng-checked="respuestas[4] == SI">
                            <label class="form-check-label" for="si"></label>
                        </div>
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="form-check form-check-inline pl-3"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="form-check form-check-inline pl-5"><?php }?>
                            <input type="radio" class="form-check-input text-secondary" id="pregunta5" name="pregunta5" style="height: 22px; width:22px;" value="NO" ng-click="ocultaInput5()" ng-checked="respuestas[4] == NO">
                            <label class="form-check-label" for="no"></label>
                        </div>
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="form-check form-check-inline pl-3"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="form-check form-check-inline pl-5"><?php }?>
                            <input type="radio" class="form-check-input text-secondary" id="pregunta5" name="pregunta5" style="height: 22px; width:22px;" value="NO/A" ng-click="ocultaInput5()" ng-checked="respuestas[4] == NO/A">
                            <label class="form-check-label" for="noa"></label>
                        </div>
                    </div>
                </div>
                <?php if($_SESSION['project']['info']["idPerfil"] == 8){?>
                    <div class="col-md-2 float-left">
                        <div class="checkboxes pt-3">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input text-secondary" id="pregunta5o" name="pregunta5o" style="height: 22px; width:22px;" value="SI">
                                <label class="form-check-label" for="pregunta1">SI</label>
                            </div>
                            <div class="form-check form-check-inline pl-3">
                                <input type="radio" class="form-check-input text-secondary" id="pregunta5o" name="pregunta5o" style="height: 22px; width:22px;" value="NO">
                                <label class="form-check-label" for="pregunta1">NO</label>
                            </div>
                        </div>
                    </div>
                <?php }?>
                <div class="col-md-10 float-left text-justify">
                    <div class="custom-file" id="archivoPregunta5">
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?>
                            <label for="archivo5">Seleccione un archivo:</label>
                            <input type="file" name="fotoFile5" id="fotoFile5" onchange="angular.element(this).scope().uploadPic('fotoFile5','fotoPresentacion','botonfoto5','preloaderfoto5','archivo5')">
                            <input type="hidden" name="archivo5" id="archivo5" value="{{urlArchivo5}}">
                            <a href="<?php echo base_url()."assets/uploads/file/".$_SESSION['project']['info']['idEmpresa']."/"; ?>{{urlArchivo5}}" target="_blank" title="Documento actual">
                                <button type="button" class="btn btn-raised btn-primary"><i class="fas fa-download"></i></button>
                            </a>
                        <?php } if($_SESSION['project']['info']["idPerfil"] == 8){?>
                            <input type="hidden" name="archivo1" id="archivo1" value="{{ urlArchivo5}}">
                            <a href="<?php echo base_url()."assets/uploads/files/".$_SESSION['project']['info']['idEmpresa']; ?>/{{ urlArchivo5 }}" target="_blank" title="Documento actual">
                                <button type="button" class="btn btn-raised btn-primary"><i class="fas fa-file-pdf"></i></button>
                            </a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <!-- pregunta 6 -->
        <div class="col-md-12 pt-2">
            <div class="form-group">
                <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="col-md-8 float-left text-justify"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="col-md-7 float-left text-justify"><?php }?>
                    <label>¿Se reportó la inconsistencia o falencia al Área de Cumplimiento?</label>
                </div>
                <?php if($_SESSION['project']['info']["idPerfil"] != 8){?> <div class="col-md-4 float-left"> <?php }if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="col-md-3 float-left"><?php }?>
                    <div class="checkboxes pt-3">
                        <div class="form-radio form-check-inline">
                            <input type="radio" class="form-check-input text-secondary" id="pregunta6" name="pregunta6" style="height: 22px; width:22px;" value="SI" ng-click="mostrarInput6()" ng-checked="respuestas[5] == SI">
                            <label class="form-check-label" for="si"></label>
                        </div>
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="form-check form-check-inline pl-3"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="form-check form-check-inline pl-5"><?php }?>
                            <input type="radio" class="form-check-input text-secondary" id="pregunta6" name="pregunta6" style="height: 22px; width:22px;" value="NO" ng-click="ocultaInput6()" ng-checked="respuestas[5] == NO">
                            <label class="form-check-label" for="no"></label>
                        </div>
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?><div class="form-check form-check-inline pl-3"><?php } if($_SESSION['project']['info']["idPerfil"] == 8){?><div class="form-check form-check-inline pl-5"><?php }?>
                            <input type="radio" class="form-check-input text-secondary" id="pregunta6" name="pregunta6" style="height: 22px; width:22px;" value="NO/A" ng-click="ocultaInput6()" ng-checked="respuestas[5] == NO/A">
                            <label class="form-check-label" for="noa"></label>
                        </div>
                    </div>
                </div>
                <?php if($_SESSION['project']['info']["idPerfil"] == 8){?>
                    <div class="col-md-2 float-left">
                        <div class="checkboxes pt-3">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input text-secondary" id="pregunta6o" name="pregunta6o" style="height: 22px; width:22px;" value="SI">
                                <label class="form-check-label" for="pregunta1">SI</label>
                            </div>
                            <div class="form-check form-check-inline pl-3">
                                <input type="radio" class="form-check-input text-secondary" id="pregunta6o" name="pregunta6o" style="height: 22px; width:22px;" value="NO">
                                <label class="form-check-label" for="pregunta1">NO</label>
                            </div>
                        </div>
                    </div>
                <?php }?>
                <div class="col-md-10 float-left text-justify">
                    <div class="custom-file" id="archivoPregunta6">
                        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?>
                            <label for="archivo6">Seleccione un archivo:</label>
                            <input type="file" name="fotoFile6" id="fotoFile6" onchange="angular.element(this).scope().uploadPic('fotoFile6','fotoPresentacion','botonfoto6','preloaderfoto6','archivo6')">
                            <input type="hidden" name="archivo6" id="archivo6" value="{{urlArchivo6}}">
                            <a href="<?php echo base_url()."assets/uploads/file/".$_SESSION['project']['info']['idEmpresa']."/"; ?>{{urlArchivo6}}" target="_blank" title="Documento actual">
                                <button type="button" class="btn btn-raised btn-primary"><i class="fas fa-download"></i></button>
                            </a>
                        <?php } if($_SESSION['project']['info']["idPerfil"] == 8){?>
                            <input type="hidden" name="archivo1" id="archivo1" value="{{ urlArchivo6}}">
                            <a href="<?php echo base_url()."assets/uploads/files/".$_SESSION['project']['info']['idEmpresa']; ?>/{{ urlArchivo6 }}" target="_blank" title="Documento actual">
                                <button type="button" class="btn btn-raised btn-primary"><i class="fas fa-file-pdf"></i></button>
                            </a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($_SESSION['project']['info']["idPerfil"] != 8){?>
        <input id="idNuevaMatriz" name="idNuevaMatriz" value="<?php echo $informacion["idNuevaMatriz"]; ?>" type="hidden" />
        <input id="idPersona" name="idPersona" value="<?php echo $_SESSION['project']['info']["idPersona"]; ?>" type="hidden"/>
        <input id="idMatrizRecurrente" name="idMatrizRecurrente" value="<?php echo $idRecurrente;?>" type="hidden"/>
        <input id="idEmpresa" name="idEmpresa" value="<?php echo $_SESSION['project']['info']["idEmpresa"]; ?>" type="hidden"/>
        <input id="idPerfil" value="<?php echo $_SESSION['project']['info']["idPerfil"]; ?>" type="hidden"/>
        <input id="edita" value="<?php echo $edita; ?>" type="hidden"/>
    <?php }if($_SESSION['project']['info']["idPerfil"] == 8){?>
        <input id="idMatrizRecurrente" name="idMatrizRecurrente" value="<?php echo $idRecurrente;?>" type="hidden"/>
        <input id="idNuevaMatriz" name="idNuevaMatriz" value="<?php echo $informacion["idNuevaMatriz"]; ?>" type="hidden" />
        <input id="idPersona" name="idPersona" value="<?php echo $infoUsuario[0]["idPersona"]; ?>" type="hidden" />
        <input id="idEmpresa" name="idEmpresa" value="<?php echo $infoUsuario[0]["idEmpresa"]; ?>" type="hidden"/>
        <input id="idPerfil" value="<?php echo $_SESSION['project']['info']["idPerfil"]; ?>" type="hidden"/>
        <input id="edita" value="<?php echo $edita; ?>" type="hidden"/>
    <?php }?>

    <div class="row p-4">
        <div class="col-md-12">
            <p>Comentarios:</p>
        </div>
    </div>

    <div class="row pl-4 pr-4">
      <div class="col-md-12">
        <div class="form-group">
          <textarea class="form-control" rows="3" id="comentarios" ng-model="comentarios"><?php echo (isset($consulta["datos"][0]["comentario"]))?></textarea>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-md-12 p-4">
        
            <?php if($edita == 0){?>
                <button type="submit" class="btn btn-raised btn-danger ml-4"><?php echo $labelBtn;?></button>
            <?php } if($edita == 1){
                        if($_SESSION['project']['info']["idPerfil"] != 8){    
            ?>
                <button type="button" class="btn btn-raised btn-danger ml-4" ng-click="enviarFormulario()"><?php echo $labelBtn;?></button>
            <?php }if($_SESSION['project']['info']["idPerfil"] == 8){ ?>
                <button type="button" class="btn btn-raised btn-danger ml-4" ng-click="enviarFormularioOficial()">Guardar</button>
            <?php }}?>
            <button type="button" data-dismiss="modal" class="btn btn-raised btn-light"><?php echo lang('reg_btn_cancelar') ?></button>
        </div>
    </div>
  </div>
</form>
<style> 
    button{position: relative; float: right; }
</style>