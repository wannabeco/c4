<div class="container-fluid" ng-controller="crearMatriz" ng-init="initcreaMatriz()">
    <!-- modal estandar-->
    <div id="modalParametros" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div id="modalMatriz" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modaldeMatriz">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Checks <!--<small><?php echo $_SESSION['project']['info']['nombre']." ".$_SESSION['project']['info']['apellido']; ?></small>--></h1>
        <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
            <div class="dropdown">
                <a class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i> <?php echo lang("lblAcciones") ?> <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <h6 class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></h6>
                    <a class="dropdown-item" ng-click="irCreaMatriz()" style="cursor:pointer"><i class="fa fa-fw fa-plus"></i> Nuevo Check</a>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Checks Creados</h6>
        </div>
        <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre de Check</th>
                    <!-- <th scope="col">Tipo de empresa</th> -->
                    <th scope="col">estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($infoMatrices as $info){ ?>
                    <tr>
                        <td>
                            <?php echo $info["nombreNuevaMatriz"]; ?>
                        </td>
                        <!--<td>
                            <?php echo $info["TipoEmpresa"]; ?>
                        </td>-->
                        <td>
                            <?php if($info["estado"] == 1){ ?>
                            <span class="badge badge-success" value="1" >ACTIVO</span>
                            <?php } else if($info["estado"] == 0){ ?>
                            <span class="badge badge-secondary" value="0" >INACTIVO</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
                                <a ng-click="cargaPlantillaparametros('<?php echo $info['idNuevaMatriz'];?>',0)" data-toggle="tooltip" data-placement="top" title="Agregar Parametros" class="btn btn-primary btn-fab btn-fab-mini btn-xs"><i class="fas fa-plus"></i></a>
                            <?php }?>
                            <?php if(getPrivilegios()[0]['ver'] == 1){ ?>
                                <a ng-click="verMatriz('<?php echo $info['idNuevaMatriz'];?>',0)" data-toggle="tooltip" data-placement="top" title="Listar Información" class="btn btn-secondary btn-fab btn-fab-mini btn-xs"><i class="fas fa-eye"></i></a>
                            <?php }?>
                            <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                <a ng-click="cargaPlantillaMatriz('<?php echo $info['idNuevaMatriz'];?>')" data-toggle="tooltip" data-placement="top" title="Actualizar matriz" class="btn btn-dark btn-fab btn-fab-mini btn-xs"><i class="far fa-edit"></i></a>
                            <?php }?>
                            <?php if(getPrivilegios()[0]['borrar'] == 1){ ?>
                                <?php if($info["tieneRecurrencia"]== 0){ ?>
                                    <a ng-click="borraMatriz(<?php echo $info['idNuevaMatriz'];?>)" ng-if="<?php echo $_SESSION['project']['info']["idPerfil"]; ?> == 1 || <?php echo $_SESSION['project']['info']["idPerfil"]; ?> == 2  || <?php echo $_SESSION['project']['info']["idPerfil"]; ?> == 3 " title="Eliminar Matriz"  class="btn btn-danger btn-fab btn-fab-mini btn-xs"><i class="fas fa-trash"></i></a> 
                            <?php } } ?>
                        </td>
                    </tr>
                <?php } ?>
                
            </tbody>
        </table>
        </div>
    </div>
</div>