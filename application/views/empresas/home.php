<div class="container-fluid" ng-controller="empresas" ng-init="initEmpresas()">
    <!-- modal estandar-->
    <div id="modalParametros" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div id="modalRelEmpresa" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalRelCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $titulo;?> <!--<small><?php echo $_SESSION['project']['info']['nombre']." ".$_SESSION['project']['info']['apellido']; ?></small>--></h1>
        <?php if($_SESSION['project']['info']['idPerfil'] == 8 && $_SESSION['project']['info']['idEmpresa'] == 0){?>
            <button type="button" class="btn btn-primary" ng-click="buscaEmpresa()"><i class="fa fa-fw fa-plus"></i> Agregar empresa</button>
        <?php }?>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Lista de empresas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre Empresa</th>
                    <th scope="col">Telefono</th>
                    <?php if($_SESSION['project']['info']['idPerfil'] != 8){?>
                    <th scope="col">estado</th>
                    <?php } if($_SESSION['project']['info']['idPerfil'] == 8 && $_SESSION['project']['info']['idEmpresa'] == 0){?>
                    <th scope="col">Fecha</th>
                    <?php } ?>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($infoEmpresas as $info){ ?>
                    <tr>
                        <td>
                            <?php echo $info["nombre"]; ?>
                        </td>
                        <td>
                            <?php echo $info["telefono"]; ?>
                        </td>
                        <?php if($_SESSION['project']['info']['idPerfil'] != 8){?>
                        <td>
                            <?php if($info["estado"] == 1){ ?>
                            <span class="badge badge-success" value="1" >ACTIVO</span>
                            <?php } else if($info["estado"] == 0){ ?>
                            <span class="badge badge-secondary" value="0" >INACTIVO</span>
                            <?php } ?>
                        </td>
                        <?php } if($_SESSION['project']['info']['idPerfil'] == 8 && $_SESSION['project']['info']['idEmpresa'] == 0){?>
                            <td scope="col"><?php echo formatoFechaEspanolHora($info["fecha"]);?></td>
                        <?php } ?>
                        <td>
                            <?php if($_SESSION['project']['info']['idPerfil'] == 8){ ?>
                                <!-- eliminar la relacion de empresas con oficial de cumplimiento -->
                                <a ng-click="matrices(<?php echo $info['idEmpresa'];?>)" title="Ver Matrices"  class="btn btn-dark btn-fab btn-fab-mini btn-xs"><i class="fa fa-list-ol"></i></a>
                            <?php }?>
                            <?php if(getPrivilegios()[0]['ver'] == 1){ ?>
                                <a ng-click="verEmpresa('<?php echo $info['idEmpresa'];?>',0)" data-toggle="tooltip" data-placement="top" title="Listar Información" class="btn btn-secondary btn-fab btn-fab-mini btn-xs"><i class="fas fa-eye"></i></a>
                            <?php } if(getPrivilegios()[0]['crear'] == 1){?>
                                <!-- <a ng-click="cargaPlantillaparametros('<?php echo $info['idEmpresa'];?>',0)" data-toggle="tooltip" data-placement="top" title="Agregar Parametros" class="btn btn-primary btn-fab btn-fab-mini btn-xs"><i class="fas fa-plus"></i></a> -->
                            <?php } if(getPrivilegios()[0]['editar'] == 1){?>
                                <a ng-click="cargaPlantillaparametros('<?php echo $info['idEmpresa'];?>',1)" data-toggle="tooltip" data-placement="top" title="Actualizar Empresa" class="btn btn-dark btn-fab btn-fab-mini btn-xs"><i class="far fa-edit"></i></a>
                            <?php }if(getPrivilegios()[0]['borrar'] == 1){ ?>
                                <a ng-click="borraEmpresas(<?php echo $info['idEmpresa'];?>)" ng-if="<?php echo $_SESSION['project']['info']["idPerfil"]; ?> == 1 || <?php echo $_SESSION['project']['info']["idPerfil"]; ?> == 2  || <?php echo $_SESSION['project']['info']["idPerfil"]; ?> == 3 " title="Eliminar Empresa"  class="btn btn-danger btn-fab btn-fab-mini btn-xs"><i class="fas fa-trash"></i></a>
                            <?php }if($_SESSION['project']['info']['idPerfil'] == 8 && $_SESSION['project']['info']['idEmpresa'] == 0){ ?>
                                <!-- eliminar la relacion de empresas con oficial de cumplimiento -->
                                <a ng-click="eliminaRel(<?php echo $info['idEmpresa'];?>)" title="Eliminar Empresa"  class="btn btn-danger btn-fab btn-fab-mini btn-xs"><i class="fas fa-trash"></i></a>
                            <?php }?>
                        </td>
                    </tr>
                <?php } ?>
                
            </tbody>
        </table>
            </div>
        </div>
    </div>
</div>