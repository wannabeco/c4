<div class="container-fluid" ng-controller="crearMatriz" ng-init="initcreaMatriz()">

<!-- modal estandar-->
    <div id="modalParametros" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <!-- modal sugerir nueva matriz -->
    <div id="sugerirIteme" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content" id="modalCreaNuevoItem">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    
    <div id="modalCheck" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <?php if($_SESSION['project']['info']["idPerfil"] != 8){?>
        <div class="modal-dialog modal-lg">
        <?php } if($_SESSION['project']['info']["idPerfil"] == 8){?>
            <div class="modal-dialog modal-xl">
        <?php }?>
            <div class="modal-content" id="modalformCheck">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="row ml-2">
            <h1 class="h3 mb-0 text-gray-800 text-dark"><?php echo $titulo ?></h1>
        </div>  
        <?php if($_SESSION["project"]["info"]["idPerfil"] == 11){?>
            <button type="button" class="btn btn-primary float-right" ng-click="crearnuevaItem(<?php echo $infoMatrizRecurrentes[0]['idNuevaMatriz']; ?>)"><i class="fas fa-lightbulb"></i> Sugerir item</button>
        <?php }if(getPrivilegios()[0]['crear'] == 1){ ?>
            <div class="dropdown">
                <a class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-plus"></i> <?php echo lang("lblRelacion") ?> <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <h6 class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></h6>
                    <a class="dropdown-item" ng-click="cargaPlantillaparametros('<?php echo $idNuevaMatriz; ?>',0)" style="cursor:pointer"><i class="fa fa-fw fa-plus"></i> Nuevo Parametro</a>
                </div>
            </div>
        <?php } ?>
    </div>


    <!-- nav  -->
    <?php if($_SESSION["project"]["info"]["idPerfil"] != 8){?>
    <!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb"  style="background-color:transparent !important">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url()."MisMatrices/matrices/43";?>"><?php echo $infoMatrizRecurrentes[0]['nombreNuevaMatriz']; ?></a></li>
        </ol>
    </nav> -->
    <?php } if($_SESSION["project"]["info"]["idPerfil"] == 8){ ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb"  style="background-color:transparent !important">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                <li class="breadcrumb-item"><?php echo $infoMatrizRecurrentes[0]['nombreNuevaMatriz']; ?></li>
            </ol>
        </nav>
    <?php }?>
    <!-- fin nav -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Parámetro de check</h6>
        </div>
        <div class="card-body">
            <div style="overflow-x:auto;">
                <table class="table table-striped" style='width:100%;'>
                    <thead>
                        <tr>
                            <th>Obligación</th>
                            <th>Entidad</th>
                            <th>Norma Aplicable</th>
                            <th>Periodicidad</th>
                            <th>Frecuencia Check</th>
                            <th>Responsable</th>
                            <th>Cumplimiento</th>
                            <?php if($_SESSION['project']['info']["idPerfil"] < 4){?>
                                <th>Estado</th>
                            <?php }?>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach($infoMatrizRecurrentes as $info){ ?>
                            <tr>
                                <td><?php echo $info["obligacion"]; ?></td>
                                <td><?php echo $info["nombreEntidades"]; ?></td>
                                <td><?php echo $info["normatividad"]; ?></td>
                                <td><?php echo $info["frecuencia"]; ?></td>
                                <td><?php echo $info["nombreCuandoAplique"]; ?></td>
                                <td><?php echo $info["nombrePerfil"]; ?></td>
                                <td> 
                                    <?php
                                        $idMatrizRecurrente = $info['idMatrizRecurrente'];
                                        $porcentaje = isset($consultoSi[$idMatrizRecurrente]) ? $consultoSi[$idMatrizRecurrente] : 0;
                                        $porcentajeFormateado = number_format($porcentaje, 2);
                                        $badgeClass = 'badge badge-secondary';
                                        if ($porcentaje < 50) {
                                            $badgeClass = 'badge badge-danger';
                                        } elseif ($porcentaje >= 50 && $porcentaje <= 90) {
                                            $badgeClass = 'badge badge-warning';
                                        } elseif ($porcentaje > 90) {
                                            $badgeClass = 'badge badge-success';
                                        }
                                    ?>
                                        <span class="<?php echo $badgeClass; ?>"><?php echo $porcentajeFormateado; ?>%</span>
                                </td>
                                <?php if($_SESSION['project']['info']["idPerfil"] < 4){?>
                                    <td>
                                        <?php if($info["estado"] == 1){ ?>
                                        <span class="badge badge-success" value="1" >ACTIVO</span>
                                        <?php } else if($info["estado"] == 0){ ?>
                                        <span class="badge badge-secondary" value="0" >INACTIVO</span>
                                        <?php } ?>
                                    </td>
                                <?php }?>
                                <td>
                                    <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                        <a ng-click="cargaPlantillaparametros('<?php echo $info['idMatrizRecurrente'];?>',1)" data-toggle="tooltip" data-placement="top" title="Actualizar matriz" class="btn btn-dark btn-fab btn-fab-mini btn-xs" style="width:40px;"><i class="far fa-edit"></i></a>
                                    <?php }?>
                                    <?php if(getPrivilegios()[0]['borrar'] == 1){ ?>
                                        <a ng-click="borraParametro(<?php echo $info['idMatrizRecurrente'];?>)" ng-if="<?php echo $_SESSION['project']['info']["idPerfil"]; ?> == 1 || <?php echo $_SESSION['project']['info']["idPerfil"]; ?> == 2  || <?php echo $_SESSION['project']['info']["idPerfil"]; ?> == 3 " title="Eliminar Matriz"  class="btn btn-danger btn-fab btn-fab-mini btn-xs"><i class="fas fa-trash"></i></a>
                                    <?php } ?>
                                   <!-- inica codigo -->
                                   <?php if ($_SESSION['project']['info']['idPerfil'] != 11 && $_SESSION['project']['info']['idPerfil'] > 3) {
                                        $bloqueIfEjecutado = false;
                                        if (!empty($infoComentarios["datos"]) && $_SESSION['project']['info']['idPerfil'] != 8) {
                                            foreach ($infoComentarios["datos"] as $datos) {
                                                if ($info['idMatrizRecurrente'] == $datos["idMatrizRecurrente"]) {
                                                    ?>
                                                    <a ng-click="check('<?php echo $info['idNuevaMatriz'];?>',<?php echo $info['idMatrizRecurrente'];?>,1,<?php echo $periocidad;?>)" data-toggle="tooltip" data-placement="top" title="Listar Información" class="btn btn-dark btn-fab btn-fab-mini btn-xs ml-2"><i class="far fa-edit" style="cursor:pointer;"></i></a>
                                                    <?php
                                                    $bloqueIfEjecutado = true;
                                                }
                                            }
                                        }
                                        if (!$bloqueIfEjecutado && $_SESSION['project']['info']['idPerfil'] != 8) { ?>
                                            <a ng-click="check('<?php echo $info['idNuevaMatriz'];?>',<?php echo $info['idMatrizRecurrente'];?>,0,<?php echo $periocidad;?>)" data-toggle="tooltip" data-placement="top" title="Listar Información" class="btn btn-secondary btn-fab btn-fab-mini btn-xs float-left ml-2"><i class="fas fa-check-square"></i></a>
                                    <?php } } if ($_SESSION['project']['info']['idPerfil'] == 8 && $informacionCheck > 0) { 
                                        $bloqueIfEjecutado = false;
                                        foreach ($infoComentarios["datos"] as $datos) {
                                            if ($info['idMatrizRecurrente'] == $datos["idMatrizRecurrente"]) {
                                                ?>
                                                <a ng-click="checkCompleto('<?php echo $info["idMatrizRecurrente"];?>',<?php echo $idNuevaMatriz;?>,<?php echo $idEmpresas;?>,<?php echo $idResponsable;?>,1,<?php echo $periocidad;?>)" data-toggle="tooltip" data-placement="top" title="Listar Información" class="btn btn-secondary btn-fab btn-fab-mini btn-xs float-left ml-2"><i class="far fa-edit" style="cursor:pointer;"></i></a>
                                                <?php
                                                $bloqueIfEjecutado = true;
                                            }
                                        }
                                    }?>
                                    
                                    <!-- finaliza codigo -->
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
