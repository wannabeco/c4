<div class="container-fluid" ng-controller="planes" ng-init="initPlanes()">
    <!-- modal estandar-->
    <div id="modalCreaPlanes" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="row ml-2">
        <h1 class="h3 mb-0 text-gray-800 text-dark"><?php echo $titulo;?></h1>
        </div>
        <div class="dropdown">
                <a class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i> <?php echo lang("lblRelacion") ?> <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <h6 class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></h6>
                    <a class="dropdown-item" ng-click="creaPlanes(0)" style="cursor:pointer"><i class="fa fa-fw fa-plus"></i> Agregar Plan</a>
                </div>
            </div>
    </div>  
  
      
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Listado de planes</h6>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Nombre de plan</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Dirigido</th>
                        <th scope="col">Promoción</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($infoPlanes as $info){ ?>
                        <tr>
                            <td>
                                <p class="text-dark"><?php echo ucfirst($info["nombrePlan"]); ?></p>
                            </td>
                            <td>
                                <p class="text-dark"><?php echo ucfirst($info["tituloPlan"]); ?></p>
                            </td>
                            <td>
                                <p class="text-dark"><?php echo ucfirst($info["descripcion"]); ?></p>
                            </td>
                            <td>
                                <p class="text-dark"><?php echo "$ ".number_format($info["precio"],0, ',', '.'); ?></p>
                            </td>
                            <td>
                                <?php if($info["dirigido"] == 0){?>
                                    <span class="badge badge-info">Empresas</span>
                                <?php }if($info["dirigido"] == 1){ ?>
                                    <span class="badge badge-warning">Oficial de cumplimiento</span>
                                <?php }?>
                            </td>
                            <td>
                                <?php if($info["promocion"] == 0){?>
                                    <span class="badge badge-info">Sin promoción</span>
                                <?php }if($info["promocion"] == 1){ ?>
                                    <span class="badge badge-success">Promoción</span>
                                <?php }?>
                            </td>

                            <td>
                            <!-- <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
                                <a ng-click="cargaPlantillaparametros('',0)" data-toggle="tooltip" data-placement="top" title="Agregar Parametros" class="btn btn-primary btn-fab btn-fab-mini btn-xs"><i class="fas fa-plus"></i></a>
                            <?php }?>
                            <?php if(getPrivilegios()[0]['ver'] == 1){ ?>
                                <a ng-click="verMatriz('',0)" data-toggle="tooltip" data-placement="top" title="Listar Información" class="btn btn-primary btn-fab btn-fab-mini btn-xs"><i class="fas fa-eye"></i></a>
                            <?php }?> -->
                            <?php if($_SESSION['project']['info']['idPerfil']== 1 || $_SESSION['project']['info']['idPerfil']== 2 || $_SESSION['project']['info']['idPerfil']== 3){ ?>
                                <a ng-click="creaPlanes('<?php echo $info["idPlan"];?>',1)" data-toggle="tooltip" data-placement="top" title="Actualizar matriz" class="btn btn-dark btn-fab btn-fab-mini btn-xs"><i class="far fa-edit"></i></a>
                            <?php }?>
                            <?php if($_SESSION['project']['info']['idPerfil']== 1 || $_SESSION['project']['info']['idPerfil']== 2 || $_SESSION['project']['info']['idPerfil']== 3){ ?>
                                    <a ng-click="BorrarPlan(<?php echo $info["idPlan"];?>)" title="Eliminar Matriz"  class="btn btn-danger btn-fab btn-fab-mini btn-xs"><i class="fas fa-trash"></i></a> 
                            <?php } ?>  
                            </td>
                        </tr>
                    <?php }?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>