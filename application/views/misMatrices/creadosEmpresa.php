<div class="container-fluid" ng-controller="buscar" ng-init="initbuscar()">
    <!-- modal estandar-->
    <div id="miNuevocheck" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content" id="modalmiNuevocheck">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <!-- modal crear parametro interno -->
    <div id="modalParametros" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="row col-md-12">
            <div class="col-md-6">
                <h1 class="h3 mb-0 text-gray-800 text-dark float-left">Mis check's creados</h1>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="top" title="Crear Nuevo Check" ng-click="creoMiCheck()"><i class="fas fa-plus"></i> Creo mi check</button>
                <button type="button" class="btn btn-primary float-right"  data-toggle="tooltip" data-placement="top" title="Ver checks sugeridos" style="margin-right: 20px;" ng-click="matricesDisponibles()"><i class="fas fa-check-circle"></i> Check Sugeridos</button>
            </div>
        </div><br>
    </div>
    <div class="col-md-12">
        <div ng-if="inforMiMatriz.continuar === 0">
            <div ng-if="Checks < 100" class="col-md-7" style="padding-left: 0px; left: -10px;">
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-info-circle"></i> Recuerde que los checks adicionales a los <strong> {{ Checks }} </strong> que incluye el plan serán cobradas.
                </div>
            </div>
            <div ng-if="Checks == 100" class="col-md-7" style="padding-left: 0px; left: -10px;">
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-info-circle"></i> Recuerde que los checks actuales son <strong> Limitados </strong>.
                </div>
            </div>
        </div>
        <div ng-if="inforMiMatriz.continuar === 1">
            <div ng-if="Checks < 100" class="col-md-7" style="padding-left: 0px; left: -10px;">
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> Recuerde que los checks adicionales a los <strong> {{ Checks }} </strong> que incluye el plan, <strong> serán cobradas.</strong>
                </div>
            </div>
            <div ng-if="Checks == 100" class="col-md-7" style="padding-left: 0px; left: -10px;">
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> Recuerde que los checks actuales son <strong> Limitados </strong>.
                </div>
            </div>
        </div>
    </div>
    <div class="row col-md-12 text-dark tiposDos"></div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Listado de check's creados</h6>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Check de obligaciones</th>
                        <th scope="col">Descripción</th>
                        <!-- <th scope="col">Pago</th> -->
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($inforMiMatriz as $info){ ?>
                        <tr>
                            <td><p class="text-dark"><?php echo $info["nombreNuevaMatriz"];?></p></td>
                            <td><p class="text-dark"><?php echo $info["descripcion"];?></p></td>
                            <td>
                                <?php if(getPrivilegios()[0]['ver'] == 1){?>
                                    <?php if(consultoRelacionComprada($info["idEmpresa"], $info["idNuevaMatriz"])) { ?>
                                        <a ng-click="cargaPlantillaparametros('<?php echo $info['idNuevaMatriz'];?>',0)" data-toggle="tooltip" data-placement="top" title="Agregar Parametros" class="btn btn-primary btn-fab btn-fab-mini btn-xs"><i class="fas fa-plus"></i></a>
                                        <?php if(consultoRecurrentes($info["idNuevaMatriz"])){?>
                                            <a ng-click="verMatriz('<?php echo $info['idNuevaMatriz'];?>',0)" data-toggle="tooltip" data-placement="top" title="Listar Información" class="btn btn-secondary btn-fab btn-fab-mini btn-xs"><i class="fas fa-eye"></i></a>
                                        <?php }else{?>
                                        <?php }?>   
                                    <?php } else { ?>
                                        <div ng-if="inforMiMatriz.continuar === 0">
                                        <button type="button" class="btn btn-secondary float-left ml-2 agregaGratisDos" data-toggle="tooltip" data-placement="top" title="Activar" data-idEmpresa="<?php echo $idEmpresa;?>" data-nombreNuevaMatriz="<?php echo $info["nombreNuevaMatriz"];?>" data-idNuevaMatriz="<?php echo $info["idNuevaMatriz"];?>">Activar</button>
                                        </div>
                                        <div ng-if="inforMiMatriz.continuar === 1">
                                        <button type="button" class="btn btn-secondary float-left ml-2 PagaraButton" data-toggle="tooltip" data-placement="top" title="Activar" data-idEmpresa="<?php echo $idEmpresa;?>" data-nombreNuevaMatriz="<?php echo $info["nombreNuevaMatriz"];?>" data-idNuevaMatriz="<?php echo $info["idNuevaMatriz"];?>" data-precio="<?php echo $info["precio"];?>">Activar</button>
                                        </div> 
                                    <?php } ?>
                                        <a ng-click="actualizoCheck(<?php echo $info["idNuevaMatriz"];?>,1)"  data-toggle="tooltip" data-placement="top" title="Editar"  class="btn btn-dark btn-fab btn-fab-mini btn-xs ml-2"><i class="fas fa-edit"></i></a>
                                        <a ng-click="borraMatrizCreada(<?php echo $info["idNuevaMatriz"];?>)"  data-toggle="tooltip" data-placement="top" title="Eliminar"  class="btn btn-danger btn-fab btn-fab-mini btn-xs ml-2"><i class="fas fa-trash"></i></a>
                                <?php }?>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>