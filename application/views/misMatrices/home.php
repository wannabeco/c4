<div class="container-fluid" ng-controller="misMatrices" ng-init="initmisMatrices()">
    <!-- modal estandar-->
    <div id="modalParametros" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-dark">MATRÍZ DE OBLIGACIONES</h1>
        <?php if($_SESSION['project']['info']['idPerfil'] == 11){ ?>
            <div class="dropdown">
                <a class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i> <?php echo lang("lblRelacion") ?> <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <h6 class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></h6>
                    <a class="dropdown-item" ng-click="agregarMatriz()" style="cursor:pointer"><i class="fa fa-fw fa-plus"></i> Agregar matriz</a>
                </div>
            </div>
        <?php }?>
    </div>
    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">MATRÍZ DE OBLIGACIONES</h6>
        </div> -->
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Matrices</th>
                        <?php if($_SESSION['project']['info']['idPerfil'] == 11){ ?>
                            <th scope="col">Fecha</th>
                        <?php } ?>
                        <!-- <th scope="col">Pago</th> -->
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($inforMiMatriz["continuar"] == 1){
                            foreach($infor as $info){ ?>
                        <tr>
                            <td>
                                <p class="text-dark"><?php echo $info["nombreNuevaMatriz"]; ?></p>
                            </td>
                            <?php if($_SESSION['project']['info']['idPerfil'] == 11){ ?>
                                <td>
                                    <p class="text-dark"><?php echo formatoFechaEspanol($info["fechaPago"]); ?></p>
                                </td>
                            <?php } ?>
                            <td>
                                <?php if(getPrivilegios()[0]['ver'] == 1){ ?>
                                    <a ng-click="verMatriz('<?php echo $info['idNuevaMatriz'];?>',0)" data-toggle="tooltip" data-placement="top" title="Listar Información" class="btn-fab btn-fab-mini btn-xs text-success float-left"><i class="fas fa-eye" style="font-size: 30px; cursor:pointer;"></i></a>
                                <?php }?>
                                    <div class="form-group form-check float-left ml-4 ">
                                        <input type="checkbox" class="form-check-input text-secondary" id="exampleCheck1" style="height: 22px; width:22px;">
                                    </div>
                            </td>
                        </tr>
                    <?php } } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>