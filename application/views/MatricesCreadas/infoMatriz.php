<div class="container-fluid" ng-controller="crearMatriz" ng-init="initcreaMatriz()">
    <!-- modal estandar-->
    <div id="modalParametros" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div id="modalCheck" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalformCheck">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> <!--<small><?php echo $_SESSION['project']['info']['nombre']." ".$_SESSION['project']['info']['apellido']; ?></small>--></h1>
        <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
            <div class="dropdown">
                <a class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-plus"></i> Crear <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <h6 class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></h6>
                    <a class="dropdown-item" ng-click="cargaPlantillaparametros('<?php echo $idNuevaMatriz; ?>',0)" style="cursor:pointer"><i class="fa fa-fw fa-plus"></i> Nuevo Parametro</a>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- nav  -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"  style="background-color:transparent !important">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $infoModulo['nombreModulo']; ?></li>
        </ol>
    </nav>
    <!-- fin nav -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Parametros de matriz</h6>
        </div>
        <div class="card-body">
            <div style="overflow-x:auto;">
                <table class="table table-striped" style='width:100%;'>
                    <thead>
                        <tr>
                            <th>Obligacion</th>
                            <th>Entidad</th>
                            <!-- <th>Norma Aplicable</th>
                            <th>Frecuencia</th>
                            <th>Cuando Aplique</th> -->
                            <th>Responsable</th>
                            <!-- <th>Aplica para ccsm</th>
                            <th>Metodologia de control</th>
                            <th>Periodicidadl</th> -->
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach($infoMatrizRecurrentes as $info){ ?>
                            <tr>
                                <td><?php echo $info["obligacion"]; ?></td>
                                <td><?php echo $info["nombreEntidades"]; ?></td>
                                <!-- <td><?php echo $info["normatividad"]; ?></td> -->
                                <!-- <td><?php echo $info["frecuencia"]; ?></td> -->
                                <!-- <td><?php echo $info["nombreCuandoAplique"]; ?></td> -->
                                <td><?php echo $info["nombrePerfil"]; ?></td>
                                <!-- <td><?php echo $info["nombreCcsm"]; ?></td> -->
                                <!-- <td><?php echo $info["nombreMetodoControl"]; ?></td> -->
                                <!-- <td><?php echo $info["nombrePeriodicidad"]; ?></td> -->
                                <td>
                                    <?php if($info["estado"] == 1){ ?>
                                    <span class="badge badge-success" value="1" >ACTIVO</span>
                                    <?php } else if($info["estado"] == 0){ ?>
                                    <span class="badge badge-secondary" value="0" >INACTIVO</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                        <a ng-click="cargaPlantillaparametros('<?php echo $info['idMatrizRecurrente'];?>',1)" data-toggle="tooltip" data-placement="top" title="Actualizar matriz" class="btn btn-info btn-fab btn-fab-mini btn-xs" style="width:40px;"><i class="far fa-edit"></i></a>
                                    <?php }?>
                                    <?php if(getPrivilegios()[0]['borrar'] == 1){ ?>
                                        <a ng-click="borraParametro(<?php echo $info['idMatrizRecurrente'];?>)" ng-if="<?php echo $_SESSION['project']['info']["idPerfil"]; ?> == 1 || <?php echo $_SESSION['project']['info']["idPerfil"]; ?> == 2  || <?php echo $_SESSION['project']['info']["idPerfil"]; ?> == 3 " title="Eliminar Matriz"  class="btn btn-danger btn-fab btn-fab-mini btn-xs"><i class="fas fa-trash"></i></a>
                                    <?php } ?>
                                    <?php if($_SESSION['project']['info']['idPerfil'] < 4 ){?>
                                        <a ng-click="verMatriz('<?php echo $info['idNuevaMatriz'];?>',0)" data-toggle="tooltip" data-placement="top" title="Listar Información" class="btn-fab btn-fab-mini btn-xs text-success float-left"><i class="fas fa-eye" style="font-size: 30px; cursor:pointer;"></i></a>
                                    <?php } ?>
                                    <?php if( $_SESSION['project']['info']['idPerfil'] != 11 && $_SESSION['project']['info']['idPerfil'] > 3){
                                                if($infoComentarios["continuar"] == 1){ ?>
                                                    <a ng-click="check('<?php echo $info['idNuevaMatriz'];?>',0)" data-toggle="tooltip" data-placement="top" title="Listar Información" class="btn-fab btn-fab-mini btn-xs text-primary float-left"><i class="far fa-edit" style="font-size: 30px; cursor:pointer;"></i></a>        
                                                <?php } elseif($infoComentarios["continuar"] == 0){?>
                                                    <a ng-click="check('<?php echo $info['idNuevaMatriz'];?>',0)" data-toggle="tooltip" data-placement="top" title="Listar Información" class="btn-fab btn-fab-mini btn-xs text-success float-left"><i class="fas fa-list" style="font-size: 30px; cursor:pointer;"></i></a>
                                                <?php } } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>