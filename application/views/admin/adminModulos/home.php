 <div class="container-fluid"  ng-controller="modulos" ng-init="adminInit()" id="contenedorModulos">

    <div class="modal" tabindex="-1" role="dialog" id="modalNModulo">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modalCreaModulo">
                
            </div>
        </div>
    </div>




 <?php
        $this->load->view("admin/adminModulos/categorias/crear");
        $this->load->view("admin/adminModulos/categorias/editar");
    ?>


    <!-- modal estandar-->
    <div id="modalUsuarios" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <!-- cabecera de la plantilla-->
    <h1 class="h3 mb-4 text-gray-800">
        <?php echo $infoModulo['nombreModulo'] ?>
        
        <!-- <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
            <div class="dropdown">
                <a class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i> <?php echo lang("lblAcciones") ?> <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <h6 class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></h6>
                    <a class="dropdown-item" ng-click="cargaPlantillaControl('',0)" style="cursor:pointer"><i class="fa fa-fw fa-plus"></i> NUEVO USUARIO</a>
                </div>
            </div>
        <?php } ?> -->
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
            <h6 class="m-0 font-weight-bold text-primary">Lista de Módulos</h6>
        </div>
        <div class="card-body">
                <!-- Categorias -->
                <h4>
                    Categorías 

                    <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
                        <a data-toggle="modal" data-target="#modalCategoria" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm d-float-right"><i class="fas fa-download fa-plus text-white-50"></i> Nueva categoría</a>
                    <?php } ?> 

                </h4><br>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <!--<th class="text-center">ID CATEGORÍA</th>-->
                                <th>Categoría</th>
                                <!--<th class="text-center">ÍCONO</th>-->
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="categorias in modulos">
                                <!--<td class="text-center">{{categorias.idPadre}}</td>-->
                                <td class="align-middle">{{categorias.nombreModulo}}</td>
                                <!--<td class="text-center">Icono</td>-->
                                <td class="text-center align-middle">
                                    <span class="badge badge-success" ng-if="categorias.estado==1" value="1" >ACTIVO</span>
                                    <span class="badge badge-default" ng-if="categorias.estado==0" value="0" >INACTIVO</span>
                                </td>
                                <td  class="text-center align-middle">
                                    <?php if( getPrivilegios()[0]['ver'] == 1 ){ ?>
                                        <a ng-click="consultaModulosCategoria(categorias.idPadre)" title="Ver los módulos de la categoría {{categorias.nombreModulo}}" class="btn btn-primary btn-fab btn-fab-mini"><i class="fa fa-list"></i></a>
                                    <?php }?>
                                    <?php if( getPrivilegios()[0]['editar'] == 1 ){ ?>
                                        <a ng-click="estadoCategoriaPrincipal(categorias.idPadre,categorias.estado)" ng-if="categorias.estado==1" title="Apagar categoría {{categorias.nombreModulo}}" class="btn btn-primary btn-fab btn-fab-mini"><i class="fas fa-eye-slash"></i></a>
                                        <a ng-click="estadoCategoriaPrincipal(categorias.idPadre,categorias.estado)" ng-if="categorias.estado==0" title="Encender categoría {{categorias.nombreModulo}}" class="btn btn-primary btn-fab btn-fab-mini"><i class="fas fa-eye"></i></a>
                                        <a data-toggle="modal" data-target="#modalCategoriaEditar" ng-click="cargarDataCategoria(categorias)" title="Editar nombre de la categoría {{categorias.nombreModulo}}" class="btn btn-primary btn-fab btn-fab-mini"><i class="fas fa-edit"></i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Fin categorías-->


                <!-- modulos-->
                <div class="row" id="panelModulo" style="display:none;margin:5% 0 0 0 ">
                    <div class="col-lg-12">
                        <h4>
                            Módulos de la categoría
                            <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
                                <a ng-click="cargaPlantillaCreacionModulos('',0)" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm d-float-right"><i class="fas fa-download fa-plus text-white-50"></i> Nuevo módulo</a>
                            <?php } ?> 
                        </h4>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <!--<th class="text-center">ID CATEGORÍA</th>-->
                                        <th>Nombre módulo</th>
                                        <th>Controlador</th>
                                        <th class="text-center">Ícono</th>
                                        <!--<th class="text-center">ÍCONO</th>-->
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="modulos in modulosInternos">
                                        <!--<td class="text-center">{{modulos.idPadre}}</td>-->
                                        <td class="align-middle">{{modulos.nombreModulo}}</td>
                                        <td class="align-middle">{{modulos.urlModulo}}</td>
                                        <td class="align-middle text-center"><i ng-if="modulos.icono != ''" class="{{modulos.icono}}"></i></td>
                                        <!--<td class="text-center">Icono</td>-->
                                        <td class="text-center align-middle">
                                            <span class="badge badge-success" ng-if="modulos.estado==1" value="1" >ACTIVO</span>
                                            <span class="badge badge-secondary" ng-if="modulos.estado==0" value="0" >INACTIVO</span>
                                        </td>
                                        <td  class="text-center align-middle">
                                            <!--<a href="javascript:void(0)" title="Editar" class="btn btn-primary btn-fab btn-fab-mini"><i class="material-icons">edit</i></a>-->
                                            <!--<a href="javascript:void(0)" title="Eliminar" class="btn btn-danger btn-fab btn-fab-mini"><i class="material-icons">delete</i></a>-->
                                            <?php if( getPrivilegios()[0]['ver'] == 1 ){ ?>
                                                <a ng-click="cargaPlantillaCreacionModulos(modulos.idPadre,1)" title="Ver configuración del módulo {{modulos.nombreModulo}}" class="btn btn-primary btn-fab btn-fab-mini"><i class="fa fa-file"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
                <!-- fin modulos-->
        </div>
    </div>

</div>