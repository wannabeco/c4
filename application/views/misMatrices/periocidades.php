<div class="container-fluid" ng-controller="misMatrices" ng-init="initmisMatrices()">
    <!-- modal estandar-->
    <div id="modalParametros" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div id="modalPeriocidad" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content" id="modaldePeriocidad">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row ml-2">
        <h1 class="h3 mb-0 text-gray-800 text-dark">Periodos de checks</h1>
    </div>
    <?php if($_SESSION["project"]["info"]["idPerfil"] != 8){?>  
        <a class="btn btn-sm btn-primary" ng-click="periocidad('',0)" style="cursor:pointer"><i class="fa fa-fw fa-plus"></i> Agregar Nuevo</a>
    <?php }?>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Listado de periodos</h6>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Descripción</th>
                        <th scope="col">Periodo</th>
                        <?php if($_SESSION["project"]["info"]["idPerfil"] == 8){?>
                            <th scope="col">Responsable</th>
                        <?php }?>   
                        <th scope="col">Fecha</th>
                        <!-- <th scope="col">Pago</th> -->
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($periocidades["continuar"] == 1){
                            foreach($periodicidad as $info){ ?>
                        <tr>
                            <td><p class="text-dark"><?php echo $info["nombreRel"]; ?></p></td>
                            <td><p class="text-dark"><?php echo $info["nombrePeriodicidad"]; ?></p></td>
                            <?php if($_SESSION["project"]["info"]["idPerfil"] == 8){?>
                                <td><p class="text-dark"><?php echo $info["nombrePerfil"]; ?></p></td>
                            <?php }?>  
                            <td><p class="text-dark"><?php echo formatoFechaEspanol($info["fecha"]); ?></p></td>
                            <td>
                                <?php if(getPrivilegios()[0]['ver'] == 1){
                                    if($_SESSION["project"]["info"]["idPerfil"] != 8){?>    
                                            <a ng-click="verMatrices('<?php echo $info['idRelPeriocidad'];?>',<?php echo $idEmpresa; ?>)" data-toggle="tooltip" data-placement="top" title="Ingresar" class="btn btn-secondary btn-fab btn-fab-mini btn-xs float-left"><i class="fas fa-sign-out-alt"></i></a>
                                            <a ng-click="periocidad('<?php echo $info['idRelPeriocidad'];?>',1)" title="Editar "  class="btn btn-dark btn-fab btn-fab-mini btn-xs ml-2"><i class="fas fa-edit"></i></a>
                                            <a ng-click="borraPeriocidad('<?php echo $info['idRelPeriocidad'];?>')" title="Eliminar "  class="btn btn-danger btn-fab btn-fab-mini btn-xs ml-2"><i class="fas fa-trash"></i></a>
                                <?php }?>
                                <?php } if($_SESSION["project"]["info"]["idPerfil"] == 8){ ?>
                                    <a ng-click="verMatrices('<?php echo $info['idRelPeriocidad'];?>',<?php echo $idEmpresa; ?>)" data-toggle="tooltip" data-placement="top" title="Ingresar" class="btn btn-secondary btn-fab btn-fab-mini btn-xs float-left"><i class="fas fa-sign-out-alt"></i></a>
                                <?php }?>
                            </td>
                        </tr>
                    <?php } } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>