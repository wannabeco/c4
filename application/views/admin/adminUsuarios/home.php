<div class="container-fluid" ng-controller="usuariosApp" ng-init="initUsuarios()" id="contenedorUsuarios">
    <!-- modal estandar-->
    <div id="modalUsuarios" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <!-- cabecera de la plantilla-->
    <h1 class="h3 mb-0 text-gray-800 text-dark ml-2">
        <?php echo $infoModulo['nombreModulo'] ?>
        
        <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
            <div class="dropdown float-right">
                <a class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i> <?php echo lang("lblAcciones") ?> <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <h6 class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></h6>
                    <a class="dropdown-item" ng-click="cargaPlantillaControl('',0)" style="cursor:pointer"><i class="fa fa-fw fa-plus"></i> NUEVO USUARIO</a>
                </div>
            </div>
        <?php } ?>
    </h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"  style="background-color:transparent !important">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $infoModulo['nombreModulo'] ?></li>
        </ol>
    </nav>
    <!-- fin cabecera-->


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Lista de usuarios</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Perfil</th>
                            <th class="text-center">Acceso</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="ulist in usuarios  | filter:q as results">
                            <td class="align-middle">{{ulist.nombre}} {{ulist.apellido}}</td>
                            <td class="align-middle">{{ulist.nombrePerfil}}</td>
                            <td class="align-middle text-center">
                                <i class="fa fa-lock" ng-if="ulist.clave != null" title="Este usuario posee datos de acceso a la plataforma. Usuario y clave"></i>
                                <small ng-if="ulist.clave == null">Sin datos de acceso</small>
                            </td>
                            <td class="align-middle text-center">
                                <span class="badge badge-success" ng-if="ulist.estadoU==1" value="1" >ACTIVO</span>
                                <span class="badge badge-secondary" ng-if="ulist.estadoU==0" value="0" >INACTIVO</span>
                            </td>
                            <td class="align-middle text-center">

                                <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                    <a ng-click="cargaPlantillaControl(ulist.idPersona,1)" title="Editar usuario" class="btn btn-dark btn-fab btn-fab-mini"><i class="fas fa-user-edit"></i></a>
                                    <a ng-click="generaDatosAcceso(ulist.idPersona)" title="Generar datos de acceso" class="btn btn-secondary btn-fab btn-fab-mini"><i class="fa fa-lock"></i></a>
                                <?php }?>
                                <?php if(getPrivilegios()[0]['borrar'] == 1){ 
                                            if($_SESSION['project']['info']['idPerfil'] != 11){   
                                ?>
                                    <a ng-click="borraUsuario(ulist.idPersona)" ng-if="ulist.idPersona!=1 || ulist.idPersona!=2 || ulist.idPersona!=3 " title="Eliminar"  class="btn btn-danger btn-fab btn-fab-mini btn-xs"><i class="fas fa-trash"></i></a>
                                <?php } } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>