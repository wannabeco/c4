<div class="container-fluid" ng-controller="sugerencias" ng-init="initsugerencias()">
    <!-- modal estandar-->
    <div id="modalSugerencias" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php if($_SESSION['project']['info']['idPerfil'] < 4){?>
            <h1 class="h3 mb-0 text-gray-800 text-dark">Sugerencias</h1>
        <?php }if($_SESSION['project']['info']['idPerfil'] == 11){ ?>
            <h1 class="h3 mb-0 text-gray-800 text-dark">Mis sugerencias</h1>
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
                        <th scope="col">Fecha</th>
                        <?php if($_SESSION['project']['info']['idPerfil'] < 4){?>
                            <th scope="col">Cooresponde a matriz</th>
                        <?php }?> 
                        <th scope="col">Descripcion</th>
                        <th scope="col">Respuestas</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($misSugerencias as $info){ ?>
                        <tr>
                            <td>
                                <p class="text-dark"><?php echo formatoFechaEspanol($info["fechaSugerencia"]); ?></p>
                            </td>
                            <?php if($_SESSION['project']['info']['idPerfil'] < 4){?>
                                <?php if($info["nombredeMatriz"] == ""){?>
                                    <td>
                                    <a class="badge badge-info">Solicita Nueva matriz</a>
                                    </td>
                                <?php }if($info["nombredeMatriz"] != ""){?>
                                <td>
                                    <a class="badge badge-dark">Solicita item interno</a>
                                    <p class="text-dark"><?php echo $info["nombredeMatriz"]; ?></p>
                                </td>
                            <?php } }?> 
                            <td>
                                <p class="text-dark"><?php echo $info["descripcion"]; ?></p>
                            </td>
                            <td>
                                <?php if($info["estaRespuesta"] == 0){ ?>
                                    <a class="badge badge-danger">Sin respuesta</a>
                                <?php }else if($info["estaRespuesta"] == 1){ ?>
                                    <a class="badge badge-success">Respuesta Disponible</a>
                                <?php }?>    
                            </td>
                            <td>
                                <?php if($_SESSION['project']['info']['idPerfil'] == 11){ ?>
                                    <a ng-click="verSugerencia('<?php echo $info['idSugiere'];?>',0)" data-toggle="tooltip" data-placement="top" title="Listar Información" class="btn-fab btn-fab-mini btn-xs text-success float-left"><i class="fas fa-eye" style="font-size: 30px; cursor:pointer;"></i></a>
                                <?php }if($_SESSION['project']['info']['idPerfil'] < 4){ 
                                        if($info["estaRespuesta"] == 1){ ?>
                                        <a ng-click="verSugerencia('<?php echo $info['idSugiere'];?>',0)" data-toggle="tooltip" data-placement="top" title="Listar Información" class="btn-fab btn-fab-mini btn-xs text-success float-left"><i class="fas fa-eye" style="font-size: 30px; cursor:pointer;"></i></a>
                                    <?php }if($info["estaRespuesta"] == 0){ ?>
                                        <a ng-click="verSugerencia('<?php echo $info['idSugiere'];?>',0)" data-toggle="tooltip" data-placement="top" title="Listar Información" class="btn-fab btn-fab-mini btn-xs text-primary float-left"><i class="fas fa-edit" style="font-size: 30px; cursor:pointer;"></i></a>
                                <?php } }?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>