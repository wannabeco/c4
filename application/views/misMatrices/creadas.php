<div class="container-fluid" ng-controller="buscar" ng-init="initbuscar()">
    <!-- modal estandar-->
    <div id="modalParametros" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <!-- modal sugerir nueva matriz -->
    <div id="sugerirMatriz" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content" id="modalCreaNueva">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <!-- solicitar check a la medidia -->
    <div id="solicitarcheck" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content" id="modalCreaNuevaSolicitud">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <!-- te sugerimos check -->
    <div id="segerimosCheck" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalsegerimosCheck">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-dark pl-4"><?php echo $titulo;?></h1>
        <?php if($_SESSION['project']['info']['idPerfil'] == 11){?>
            <button type="button" class="btn btn-primary float-left" style="position: relative;left: 200px;" ng-click="sugerimosCheck()"><i class="fas fa-check-circle"></i> Check sugeridos</button>
            <button type="button" class="btn btn-primary float-left" style="position: relative;left: 100px;" ng-click="solicitar()"><i class="fas fa-comment-dots"></i> Solicitar checks a la medida</button>
            <button type="button" class="btn btn-primary float-right" ng-click="crearnueva()"><i class="fas fa-lightbulb"></i> Sugerir Nuevo checks</button>
        <?php }?>
    </div>
    <div ng-if="inforMiMatriz.continuar === 0">
        <div ng-if="Checks < 100" class="col-md-7">
            <div class="alert alert-success" role="alert">
            <i class="fas fa-info-circle"></i> Recuerde que los checks adicionales a los <strong> {{ Checks }} </strong> que incluye el plan serán cobradas.
            </div>
        </div>
        <div ng-if="Checks == 100" class="col-md-7">
            <div class="alert alert-success" role="alert">
            <i class="fas fa-info-circle"></i> Recuerde que los checks actuales son <strong> Limitados </strong>.
            </div>
        </div>
    </div>
    <div ng-if="inforMiMatriz.continuar === 1">
        <div ng-if="Checks < 100" class="col-md-7">
            <div class="alert alert-info" role="alert">
            <i class="fas fa-exclamation-triangle"></i> Recuerde que los checks adicionales a los <strong> {{ Checks }} </strong> que incluye el plan, <strong> serán cobradas.</strong>
            </div>
        </div>
        <div ng-if="Checks == 100" class="col-md-7">
            <div class="alert alert-info" role="alert">
            <i class="fas fa-exclamation-triangle"></i> Recuerde que los checks actuales son <strong> Limitados </strong>.
            </div>
        </div>
    </div>
    <div class="">
        <!-- buscador -->
        <div class="col-md-12 p-4">
            <div class="form-group input-group">
                <input class="form-control" width="90%" id="busca" type="text" placeholder="Buscar checks..." ng-model="searchText" ng-keyup="search()"/>
            </div>
        </div>
    </div>
    <div class="row col-md-12 text-dark tipos"></div>
    <div class="p-4">
        <!-- card -->
        <div class="card mb-3 col-md-6 float-left" style="width:600px; height:200px;" ng-repeat="matriz in infoMatrices | limitTo: pageSize: (currentPage - 1) * pageSize" ng-class="{'float-right': $index % 2 != 0}">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="<?php echo base_url();?>res/img/LogoDefinitivo.png" class="imagencard" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ matriz.nombreNuevaMatriz }}</h5>
                        <p class="card-text text-justify">{{ matriz.descripcion }}</p>
                        <div ng-if="inforMiMatriz.continuar === 0">
                            <p class="card-text col-md-4 float-left"><small class="text-muted" style="text-decoration: line-through;">$ {{ matriz.precio| number }}</small></p>
                            <form ng-submit="agregaGratis(matriz.nombreNuevaMatriz, matriz.idNuevaMatriz)" class="flat-left">
                                <input type="text" id="idEmpresa" name="idEmpresa" value="<?php echo $idEmpresa;?>" hidden>
                                <button class="btn btn-primary float-right" type="submit"><i class="fas fa-plus"></i> Agregar</button>
                            </form>
                        </div>
                        <div ng-if="inforMiMatriz.continuar === 1">
                            <p class="card-text col-md-4 float-left"><small class="text-muted">$ {{ matriz.precio| number }} </small></p>
                            <form ng-submit="agrega(matriz.nombreNuevaMatriz, matriz.idNuevaMatriz, matriz.precio)" class="flat-left">
                                <input type="text" id="idEmpresa" name="idEmpresa" value="<?php echo $idEmpresa;?>" hidden>
                                <button class="btn btn-primary float-right" type="submit"><i class="fas fa-plus"></i> Agregar</button>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- paginador -->
    <div class="row col-md-12">
        <div style="display: flex; justify-content: center; width: 100%;">
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item" ng-class="{ 'disabled': currentPage === 1 }">
                <a class="page-link" href="#" ng-click="setCurrentPage(1)">Principio</a>
                </li>
                <li class="page-item" ng-class="{ 'disabled': currentPage === 1 }">
                <a class="page-link" href="#" ng-click="setCurrentPage(currentPage - 1)">Anterior</a>
                </li>
                <li class="page-item" ng-repeat="page in getPagesArray()">
                <a class="page-link" href="#" ng-click="setCurrentPage(page)" ng-class="{ 'active': currentPage === page }">{{ page }}</a>
                </li>
                <li class="page-item" ng-class="{ 'disabled': currentPage === totalPages }">
                <a class="page-link" href="#" ng-click="setCurrentPage(currentPage + 1)">Siguiente</a>
                </li>
                <li class="page-item" ng-class="{ 'disabled': currentPage === totalPages }">
                <a class="page-link" href="#" ng-click="setCurrentPage(totalPages)">Ultima</a>
                </li>
            </ul>
        </nav>
        </div>
    </div>
</div>
<style>
    .imagencard{
        width:150px;
        height:130px;
        margin-top: 20px;
        margin-left: 20px;
    }
    .card-title{
        font-size:1.05rem;
    }
    .card-text{
        font-size:0.85rem;
    }
</style>